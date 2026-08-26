<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WishlistController extends Controller
{
    /**
     * Display wishlist page
     */
    public function index()
    {
        $wishlistItems = [];

        if (Auth::check()) {
            // Logged in user - get from database
            $wishlist = Wishlist::with('product')
                ->where('user_id', Auth::id())
                ->whereHas('product', function($query) {
                    $query->where('status', 'published');
                })
                ->get();

            foreach ($wishlist as $item) {
                $product = $item->product;
                if ($product) {
                    $images = $product->images ?? [];
                    $wishlistItems[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'discount_price' => $product->discount_price,
                        'image' => is_array($images) && count($images) > 0 ? $images[0] : null,
                        'stock_qty' => $product->stock_qty,
                        'added_at' => $item->created_at,
                    ];
                }
            }
        } else {
            // Guest user - get from session
            $wishlist = Session::get('wishlist', []);

            if (!empty($wishlist)) {
                $products = Product::whereIn('id', $wishlist)
                    ->where('status', 'published')
                    ->get();

                foreach ($products as $product) {
                    $images = $product->images ?? [];
                    $wishlistItems[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'discount_price' => $product->discount_price,
                        'image' => is_array($images) && count($images) > 0 ? $images[0] : null,
                        'stock_qty' => $product->stock_qty,
                        'added_at' => now(),
                    ];
                }
            }
        }

        return view('frontend.wishlist.index', compact('wishlistItems'));
    }

    /**
     * Toggle wishlist item (AJAX)
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->product_id;
        $action = '';
        $message = '';
        $wishlistCount = 0;

        if (Auth::check()) {
            // Logged in user - database operations
            $wishlist = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->first();

            if ($wishlist) {
                // Remove from wishlist
                $wishlist->delete();
                $action = 'removed';
                $message = 'Removed from wishlist';
            } else {
                // Add to wishlist
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                ]);
                $action = 'added';
                $message = 'Added to wishlist';
            }

            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            // Guest user - session operations
            $wishlist = Session::get('wishlist', []);

            if (in_array($productId, $wishlist)) {
                // Remove from wishlist
                $wishlist = array_filter($wishlist, function($id) use ($productId) {
                    return $id != $productId;
                });
                $action = 'removed';
                $message = 'Removed from wishlist';
            } else {
                // Add to wishlist
                $wishlist[] = $productId;
                $action = 'added';
                $message = 'Added to wishlist';
            }

            Session::put('wishlist', array_values($wishlist));
            $wishlistCount = count($wishlist);
        }

        return response()->json([
            'success' => true,
            'action' => $action,
            'message' => $message,
            'wishlist_count' => $wishlistCount,
        ]);
    }

    /**
     * Add to wishlist
     */
    public function add($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }

        if (Auth::check()) {
            // Database
            $exists = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->exists();

            if (!$exists) {
                Wishlist::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                ]);
            }
        } else {
            // Session
            $wishlist = Session::get('wishlist', []);
            if (!in_array($productId, $wishlist)) {
                $wishlist[] = $productId;
                Session::put('wishlist', $wishlist);
            }
        }

        return redirect()->back()->with('success', 'Added to wishlist!');
    }

    /**
     * Remove from wishlist
     */
    public function remove($productId)
    {
        if (Auth::check()) {
            // Remove from database
            Wishlist::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->delete();

            $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        } else {
            // Remove from session
            $wishlist = Session::get('wishlist', []);
            $wishlist = array_filter($wishlist, function($id) use ($productId) {
                return $id != $productId;
            });
            Session::put('wishlist', array_values($wishlist));
            $wishlistCount = count($wishlist);
        }

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Removed from wishlist!',
                'wishlist_count' => $wishlistCount,
            ]);
        }

        return redirect()->back()->with('success', 'Removed from wishlist!');
    }

    /**
     * Clear wishlist
     */
    public function clear()
    {
        if (Auth::check()) {
            // Clear from database
            Wishlist::where('user_id', Auth::id())->delete();
            $wishlistCount = 0;
        } else {
            // Clear from session
            Session::forget('wishlist');
            $wishlistCount = 0;
        }

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Wishlist cleared successfully!',
                'wishlist_count' => $wishlistCount,
            ]);
        }

        return redirect()->back()->with('success', 'Wishlist cleared successfully!');
    }

    /**
     * Get wishlist count
     */
    public function getCount()
    {
        if (Auth::check()) {
            $count = Wishlist::where('user_id', Auth::id())->count();
        } else {
            $count = count(Session::get('wishlist', []));
        }

        return response()->json([
            'count' => $count,
        ]);
    }

    /**
     * Check if product is in wishlist
     */
    public function isInWishlist($productId)
    {
        if (Auth::check()) {
            $inWishlist = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $productId)
                ->exists();
        } else {
            $wishlist = Session::get('wishlist', []);
            $inWishlist = in_array($productId, $wishlist);
        }

        return response()->json([
            'in_wishlist' => $inWishlist,
        ]);
    }
}
