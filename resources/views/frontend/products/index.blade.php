@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' - OrviBazar' : 'Shop - OrviBazar')

@section('content')
<div style="padding: var(--spacing-2xl) 0; background: var(--color-bg-light); min-height: 60vh;">
    <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">

        <!-- Page Header -->
        <div style="margin-bottom: var(--spacing-xl);">
            <h1 style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-bold); display: flex; align-items: center; gap: var(--spacing-sm);">
                @if(isset($category))
                    <i class="fas {{ $category->icon ?? 'fa-tag' }}" style="color: var(--color-accent);"></i>
                    {{ $category->name }}
                @else
                    <i class="fas fa-store" style="color: var(--color-accent);"></i>
                    All Products
                @endif
            </h1>
            <p style="color: var(--color-text-muted); margin-top: var(--spacing-xs);">
                <i class="fas fa-info-circle"></i>
                {{ $products->total() }} {{ Str::plural('product', $products->total()) }} found
                @if(isset($category))
                    in {{ $category->name }}
                @endif
            </p>
        </div>

        <!-- Products Grid -->
        @if($products && $products->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: var(--spacing-lg);">
            @foreach($products as $product)
                @php
                    $inWishlist = false;
                    if (Auth::check()) {
                        $inWishlist = \App\Models\Wishlist::where('user_id', Auth::id())
                            ->where('product_id', $product->id)
                            ->exists();
                    } else {
                        $wishlist = Session::get('wishlist', []);
                        $inWishlist = in_array($product->id, $wishlist);
                    }

                    $images = $product->images ?? [];
                    $image = is_array($images) && count($images) > 0
                        ? asset('storage/' . $images[0])
                        : 'https://via.placeholder.com/400x400/1a1a1a/ffffff?text=' . urlencode($product->name);
                @endphp

                <x-product-card
                    :product="$product"
                    image="{{ $image }}"
                    title="{{ $product->name }}"
                    price="{{ $product->price }}"
                    discount_price="{{ $product->discount_price }}"
                    rating="{{ $product->avg_rating ?? 0 }}"
                    reviews="{{ $product->reviews_count ?? 0 }}"
                    stock="{{ $product->stock_qty > 10 ? 'in-stock' : ($product->stock_qty > 0 ? 'low-stock' : 'out-of-stock') }}"
                    sale="{{ $product->discount_price && $product->discount_price < $product->price }}"
                    link="{{ route('product.show', $product->slug) }}"
                    product_id="{{ $product->id }}"
                    :in_wishlist="$inWishlist"
                />
            @endforeach
        </div>

        <!-- Pagination -->
        <div style="margin-top: var(--spacing-xl);">
            {{ $products->links() }}
        </div>

        @else
        <!-- Empty State -->
        <div style="text-align: center; padding: var(--spacing-3xl) 0; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <div style="font-size: 80px; color: var(--color-border-light); margin-bottom: var(--spacing-lg);">
                <i class="fas fa-box-open"></i>
            </div>
            <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-md); color: var(--color-text-primary);">
                No Products Found
            </h2>
            <p style="color: var(--color-text-muted); max-width: 400px; margin: 0 auto var(--spacing-xl); line-height: var(--line-height-loose);">
                @if(isset($category))
                    No products available in {{ $category->name }} at the moment.
                @else
                    No products available at the moment. Please check back later!
                @endif
            </p>
            <a href="{{ route('home') }}"
                style="background: var(--color-accent); color: var(--color-primary); padding: 14px 40px; border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-bold); display: inline-flex; align-items: center; gap: var(--spacing-sm); transition: all var(--transition-fast);"
                onmouseover="this.style.transform='scale(1.05)'"
                onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-home"></i> Back to Home
            </a>
        </div>
        @endif
    </div>
</div>

<style>
    /* Pagination styling */
    .pagination {
        display: flex;
        justify-content: center;
        gap: var(--spacing-sm);
        flex-wrap: wrap;
    }

    .pagination a, .pagination span {
        padding: 8px 16px;
        border-radius: var(--radius-md);
        background: white;
        color: var(--color-text-primary);
        text-decoration: none;
        transition: all var(--transition-fast);
        border: 1px solid var(--color-border-light);
    }

    .pagination a:hover {
        background: var(--color-accent);
        color: var(--color-primary);
        border-color: var(--color-accent);
    }

    .pagination .active span {
        background: var(--color-accent);
        color: var(--color-primary);
        border-color: var(--color-accent);
    }

    .pagination .disabled span {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>
@endsection
