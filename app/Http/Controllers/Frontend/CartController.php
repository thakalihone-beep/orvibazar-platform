<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $total = 0;
        $subtotal = 0;
        $discount = 0;

        if (!empty($cart)) {
            // Get product details for each cart item
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)
                ->where('status', 'published')
                ->get()
                ->keyBy('id');

            foreach ($cart as $productId => $item) {
                $product = $products->get($productId);
                if ($product) {
                    $price = $product->discount_price && $product->discount_price < $product->price
                        ? $product->discount_price
                        : $product->price;

                    $itemTotal = $price * $item['quantity'];
                    $subtotal += $itemTotal;

                    // Calculate discount if applicable
                    if ($product->discount_price && $product->discount_price < $product->price) {
                        $discount += ($product->price - $product->discount_price) * $item['quantity'];
                    }

                    $cartItems[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'price' => $product->price,
                        'discount_price' => $product->discount_price,
                        'final_price' => $price,
                        'quantity' => $item['quantity'],
                        'total' => $itemTotal,
                        'image' => $this->getProductImage($product),
                        'stock_qty' => $product->stock_qty,
                        'in_stock' => $product->stock_qty > 0,
                        'is_on_sale' => $product->discount_price && $product->discount_price < $product->price,
                    ];
                }
            }

            $total = $subtotal;
        }

        // Get cart count
        $cartCount = $this->getCartCount();

        return view('frontend.cart.index', compact('cartItems', 'total', 'subtotal', 'discount', 'cartCount'));
    }

    /**
     * Add product to cart
     */
    public function add(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ], 422);
            }
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $productId = $request->product_id;
        $quantity = (int) $request->quantity;

        // Get product
        $product = Product::where('id', $productId)
            ->where('status', 'published')
            ->first();

        if (!$product) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found or unavailable.',
                ], 404);
            }
            return redirect()->back()->with('error', 'Product not found or unavailable.');
        }

        // Check stock
        if ($product->stock_qty < $quantity) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock available. Only ' . $product->stock_qty . ' left.',
                ], 422);
            }
            return redirect()->back()->with('error', 'Not enough stock available. Only ' . $product->stock_qty . ' left.');
        }

        // Get current cart
        $cart = Session::get('cart', []);

        // Add or update item
        if (isset($cart[$productId])) {
            // Check if adding more exceeds stock
            $newQuantity = $cart[$productId]['quantity'] + $quantity;
            if ($product->stock_qty < $newQuantity) {
                if ($request->ajax()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Cannot add more. Only ' . $product->stock_qty . ' available.',
                    ], 422);
                }
                return redirect()->back()->with('error', 'Cannot add more. Only ' . $product->stock_qty . ' available.');
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
            ];
        }

        // Save cart to session
        Session::put('cart', $cart);

        // Get updated cart count
        $cartCount = $this->getCartCount();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully!',
                'cart_count' => $cartCount,
                'cart_total' => $this->getCartTotal(),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update cart item quantity
     */
    public function update(Request $request, $productId)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => $validator->errors()->first(),
                ], 422);
            }
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $quantity = (int) $request->quantity;

        // Get cart
        $cart = Session::get('cart', []);

        if (!isset($cart[$productId])) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Item not found in cart.',
                ], 404);
            }
            return redirect()->back()->with('error', 'Item not found in cart.');
        }

        // Get product
        $product = Product::where('id', $productId)
            ->where('status', 'published')
            ->first();

        if (!$product) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Product not found.',
                ], 404);
            }
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Check stock
        if ($product->stock_qty < $quantity) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Not enough stock available. Only ' . $product->stock_qty . ' left.',
                ], 422);
            }
            return redirect()->back()->with('error', 'Not enough stock available. Only ' . $product->stock_qty . ' left.');
        }

        // Update quantity
        $cart[$productId]['quantity'] = $quantity;
        Session::put('cart', $cart);

        // Calculate item total
        $price = $product->discount_price && $product->discount_price < $product->price
            ? $product->discount_price
            : $product->price;
        $itemTotal = $price * $quantity;

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated successfully!',
                'item_total' => number_format($itemTotal, 2),
                'cart_count' => $this->getCartCount(),
                'cart_total' => $this->getCartTotal(),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove item from cart
     */
    public function remove(Request $request, $productId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Item removed from cart.',
                    'cart_count' => $this->getCartCount(),
                    'cart_total' => $this->getCartTotal(),
                ]);
            }

            return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Item not found in cart.',
            ], 404);
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart.');
    }

    /**
     * Clear entire cart
     */
    public function clear(Request $request)
    {
        Session::forget('cart');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart cleared successfully.',
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }

    /**
     * Get cart count (total items)
     */
    public function getCartCount()
    {
        $cart = Session::get('cart', []);
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'] ?? 0;
        }
        return $count;
    }

    /**
     * Get cart total
     */
    public function getCartTotal()
    {
        $cart = Session::get('cart', []);
        $total = 0;

        if (!empty($cart)) {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)
                ->where('status', 'published')
                ->get()
                ->keyBy('id');

            foreach ($cart as $productId => $item) {
                $product = $products->get($productId);
                if ($product) {
                    $price = $product->discount_price && $product->discount_price < $product->price
                        ? $product->discount_price
                        : $product->price;
                    $total += $price * $item['quantity'];
                }
            }
        }

        return number_format($total, 2);
    }

    /**
     * Get product image
     */
    private function getProductImage($product)
    {
        if ($product->images && is_array($product->images) && count($product->images) > 0) {
            return asset('storage/' . $product->images[0]);
        }
        return 'https://via.placeholder.com/300x300/1a1a1a/ffffff?text=' . urlencode($product->name);
    }

    /**
     * Mini cart (for header/partial)
     */
    public function miniCart()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $total = 0;

        if (!empty($cart)) {
            $productIds = array_keys($cart);
            $products = Product::whereIn('id', $productIds)
                ->where('status', 'published')
                ->get()
                ->keyBy('id');

            foreach ($cart as $productId => $item) {
                $product = $products->get($productId);
                if ($product) {
                    $price = $product->discount_price && $product->discount_price < $product->price
                        ? $product->discount_price
                        : $product->price;

                    $total += $price * $item['quantity'];

                    $cartItems[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'slug' => $product->slug,
                        'final_price' => $price,
                        'quantity' => $item['quantity'],
                        'total' => $price * $item['quantity'],
                        'image' => $this->getProductImage($product),
                    ];
                }
            }
        }

        $cartCount = $this->getCartCount();

        return view('frontend.partials.mini-cart', compact('cartItems', 'total', 'cartCount'));
    }

    /**
     * Check if product is in cart
     */
    public function isInCart($productId)
    {
        $cart = Session::get('cart', []);
        return isset($cart[$productId]);
    }

    /**
     * Get item quantity in cart
     */
    public function getItemQuantity($productId)
    {
        $cart = Session::get('cart', []);
        return $cart[$productId]['quantity'] ?? 0;
    }
}
