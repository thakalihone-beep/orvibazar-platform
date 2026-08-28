<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Buy Now: add the selected product to the cart and go to checkout.
     */
    public function now(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $productId = (int) $request->product_id;
        $quantity = (int) $request->quantity;

        $product = Product::where('id', $productId)
            ->where('status', 'published')
            ->first();

        if (! $product) {
            return back()->with('error', 'Product not found or unavailable.');
        }

        if ($product->stock_qty < $quantity) {
            return back()->with('error', 'Not enough stock available. Only '.$product->stock_qty.' left.');
        }

        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = ['quantity' => $quantity];
        }

        Session::put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }
}
