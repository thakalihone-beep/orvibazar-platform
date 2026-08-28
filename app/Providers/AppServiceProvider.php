<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /*
        |------------------------------------------------------------------
        | Navbar View Composer
        |------------------------------------------------------------------
        | Automatically share navbar data (categories, cart, wishlist)
        | with the navbar component on every request.
        */
        view()->composer('components.navbar', function ($view) {
            // Categories with children and product count
            $categories = Category::where('is_active', true)
                ->with(['children' => function ($q) {
                    $q->where('is_active', true)->withCount('products');
                }])
                ->withCount('products')
                ->orderBy('name')
                ->get();

            // Cart data from session
            $sessionCart = Session::get('cart', []);
            $cartItems = [];
            $cartTotal = 0;

            if (! empty($sessionCart)) {
                $productIds = array_keys($sessionCart);
                $products = Product::whereIn('id', $productIds)
                    ->where('status', 'published')
                    ->get()
                    ->keyBy('id');

                foreach ($sessionCart as $productId => $item) {
                    $product = $products->get($productId);
                    if ($product) {
                        $price = ($product->discount_price && $product->discount_price < $product->price)
                            ? (float) $product->discount_price
                            : (float) $product->price;

                        $images = $product->images ?? [];
                        $imageUrl = ! empty($images)
                            ? (str_starts_with($images[0], 'http') ? $images[0] : asset('storage/'.ltrim($images[0], '/')))
                            : 'https://via.placeholder.com/60';

                        $qty = $item['quantity'] ?? 1;
                        $cartTotal += $price * $qty;

                        $cartItems[] = [
                            'id' => $product->id,
                            'name' => $product->name,
                            'slug' => $product->slug,
                            'price' => $price,
                            'quantity' => $qty,
                            'image' => $imageUrl,
                        ];
                    }
                }
            }

            $cartCount = count($cartItems);

            // Wishlist count from session
            $wishlistCount = count(Session::get('wishlist', []));

            $view->with(compact('categories', 'cartItems', 'cartCount', 'cartTotal', 'wishlistCount'));
        });
    }
}
