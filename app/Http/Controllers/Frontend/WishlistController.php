<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
        $wishlist = Session::get('wishlist', []);
        $wishlistItems = [];

        if (!empty($wishlist)) {
            $products = Product::whereIn('id', $wishlist)
                ->where('status', 'published')
                ->get();

            foreach ($products as $product) {
                $wishlistItems[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'discount_price' => $product->discount_price,
                    'image' => $product->images[0] ?? null,
                    'stock_qty' => $product->stock_qty,
                ];
            }
        }

        return view('frontend.wishlist.index', compact('wishlistItems'));
    }

    /**
     * Toggle wishlist item
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $productId = $request->product_id;
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

        return response()->json([
            'success' => true,
            'action' => $action,
            'message' => $message,
            'wishlist_count' => count($wishlist),
        ]);
    }

    /**
     * Add to wishlist
     */
    public function add($productId)
    {
        $wishlist = Session::get('wishlist', []);

        if (!in_array($productId, $wishlist)) {
            $wishlist[] = $productId;
            Session::put('wishlist', $wishlist);
        }

        return redirect()->back()->with('success', 'Added to wishlist!');
    }

    /**
     * Remove from wishlist
     */
    public function remove($productId)
    {
        $wishlist = Session::get('wishlist', []);
        $wishlist = array_filter($wishlist, function($id) use ($productId) {
            return $id != $productId;
        });
        Session::put('wishlist', array_values($wishlist));

        return redirect()->back()->with('success', 'Removed from wishlist!');
    }

    /**
     * Check if product is in wishlist
     */
    public function isInWishlist($productId)
    {
        $wishlist = Session::get('wishlist', []);
        return response()->json([
            'in_wishlist' => in_array($productId, $wishlist),
        ]);
    }

    /**
     * Get wishlist count
     */
    public function getWishlistCount()
    {
        $wishlist = Session::get('wishlist', []);
        return response()->json([
            'count' => count($wishlist),
        ]);
    }
}
