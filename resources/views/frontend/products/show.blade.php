{{-- resources/views/frontend/products/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">

    {{-- Breadcrumb --}}
    <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="{{ route('home') }}">Home</a>
        <span class="separator">/</span>
        <a href="{{ route('shop') }}">Shop</a>
        <span class="separator">/</span>
        @if($product->category)
            <a href="{{ route('category.show', $product->category->slug) }}">{{ $product->category->name }}</a>
            <span class="separator">/</span>
        @endif
        <span class="current">{{ $product->name }}</span>
    </nav>

    {{-- Product Detail --}}
    <div class="product-detail">
        {{-- Gallery --}}
        <div class="gallery">
            <div class="main-image">
                @php
                    $images = $product->images ?? [];
                    $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                @endphp
                <img
                    src="{{ $firstImage ? asset('storage/' . $firstImage) : 'https://via.placeholder.com/600x600/1a1a1a/ffffff?text=' . urlencode($product->name) }}"
                    alt="{{ $product->name }}"
                    id="mainProductImage"
                >
            </div>
            @if(is_array($images) && count($images) > 1)
                <div class="thumbnails">
                    @foreach($images as $index => $image)
                        <img
                            src="{{ asset('storage/' . $image) }}"
                            alt="{{ $product->name }} - Image {{ $index + 1 }}"
                            class="{{ $index === 0 ? 'active' : '' }}"
                            onclick="changeMainImage(this)"
                        >
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="product-info">
            <h1 class="product-name">{{ $product->name }}</h1>

            {{-- Rating --}}
            <div style="display: flex; align-items: center; gap: var(--spacing-sm); margin-bottom: var(--spacing-sm);">
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star {{ $i <= round($product->avg_rating ?? 0) ? 'filled' : '' }}">★</span>
                    @endfor
                </div>
                <span class="rating-text">
                    ({{ number_format($product->avg_rating ?? 0, 1) }} / 5 •
                    {{ $product->reviews_count ?? 0 }} reviews)
                </span>
            </div>

            {{-- Price --}}
            <div style="margin: var(--spacing-md) 0;">
                @if($product->discount_price && $product->discount_price < $product->price)
                    <span class="product-price" style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-sale);">
                        NRs. {{ number_format($product->discount_price, 2) }}
                    </span>
                    <span class="original-price" style="font-size: var(--font-size-lg); color: var(--color-text-muted); text-decoration: line-through; margin-left: var(--spacing-sm);">
                        NRs. {{ number_format($product->price, 2) }}
                    </span>
                    @php
                        $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                    @endphp
                    <span style="background: var(--color-sale-bg); color: white; padding: 2px 10px; border-radius: var(--radius-full); font-size: var(--font-size-sm); font-weight: var(--font-weight-bold); margin-left: var(--spacing-sm);">
                        Save {{ $discountPercent }}%
                    </span>
                @else
                    <span class="product-price" style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold);">
                        NRs. {{ number_format($product->price, 2) }}
                    </span>
                @endif
            </div>

            {{-- Stock Status --}}
            <div style="margin: var(--spacing-sm) 0;">
                @if($product->stock_qty > 10)
                    <span style="color: var(--color-success); font-weight: var(--font-weight-medium);">
                        <i class="fas fa-check-circle"></i> In Stock
                    </span>
                @elseif($product->stock_qty > 0)
                    <span style="color: var(--color-warning); font-weight: var(--font-weight-medium);">
                        <i class="fas fa-exclamation-triangle"></i> Low Stock ({{ $product->stock_qty }} left)
                    </span>
                @else
                    <span style="color: var(--color-error); font-weight: var(--font-weight-medium);">
                        <i class="fas fa-times-circle"></i> Out of Stock
                    </span>
                @endif
            </div>

            {{-- Description --}}
            <div class="product-description">
                <h3 style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-sm);">Description</h3>
                <p>{{ $product->description ?? 'No description available.' }}</p>
            </div>

            {{-- Tags --}}
            @if($product->tags && is_array($product->tags) && count($product->tags) > 0)
                <div style="margin: var(--spacing-md) 0; display: flex; gap: var(--spacing-sm); flex-wrap: wrap;">
                    @foreach($product->tags as $tag)
                        <span style="background: var(--color-off-white); padding: 4px 12px; border-radius: var(--radius-full); font-size: var(--font-size-xs);">
                            #{{ $tag }}
                        </span>
                    @endforeach
                </div>
            @endif

            {{-- Quantity & Add to Cart --}}
            <form action="{{ route('cart.add') }}" method="POST" style="margin-top: var(--spacing-lg);">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div style="display: flex; align-items: center; gap: var(--spacing-md); flex-wrap: wrap;">
                    <div class="quantity-selector">
                        <button type="button" onclick="decrementQuantity()">−</button>
                        <input type="number" name="quantity" class="qty-input" value="1" min="1" max="{{ $product->stock_qty }}" id="quantityInput">
                        <button type="button" onclick="incrementQuantity()">+</button>
                    </div>

                    @if($product->stock_qty > 0)
                        <button type="submit" class="btn-accent" style="flex: 1; justify-content: center;">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                    @else
                        <button type="button" class="btn-secondary" style="flex: 1; justify-content: center; cursor: not-allowed; opacity: 0.6;" disabled>
                            <i class="fas fa-times-circle"></i> Out of Stock
                        </button>
                    @endif
                </div>
            </form>

            {{-- Buy Now Button --}}
            @if($product->stock_qty > 0)
                <form action="{{ route('checkout.now') }}" method="POST" style="margin-top: var(--spacing-sm);">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="quantity" value="1" id="buyNowQuantity">
                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; background: var(--color-primary);">
                        <i class="fas fa-bolt"></i> Buy Now
                    </button>
                </form>
            @endif

            {{-- Additional Info --}}
            <div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-md); border-top: 1px solid var(--color-border-light);">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-sm); font-size: var(--font-size-sm); color: var(--color-text-muted);">
                    <div>
                        <strong>Category:</strong>
                        <a href="{{ route('category.show', $product->category->slug ?? '#') }}" style="color: var(--color-primary);">
                            {{ $product->category->name ?? 'Uncategorized' }}
                        </a>
                    </div>
                    <div>
                        <strong>Vendor:</strong>
                        <span>{{ $product->vendor->name ?? 'OrviBazar' }}</span>
                    </div>
                    <div>
                        <strong>SKU:</strong>
                        <span>{{ $product->sku ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <strong>Added:</strong>
                        <span>{{ $product->created_at ? $product->created_at->format('M d, Y') : 'N/A' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if($relatedProducts && $relatedProducts->count() > 0)
        <section style="padding: var(--spacing-2xl) 0; border-top: 1px solid var(--color-border-light);">
            <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-xl);">
                <i class="fas fa-tags" style="color: var(--color-accent);"></i> Related Products
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: var(--spacing-lg);">
                @foreach($relatedProducts as $related)
                    <x-product-card
                        :product="$related"
                        image="{{ is_array($related->images) && count($related->images) > 0 ? asset('storage/' . $related->images[0]) : 'https://via.placeholder.com/300x300/1a1a1a/ffffff?text=' . urlencode($related->name) }}"
                        title="{{ $related->name }}"
                        price="{{ $related->price }}"
                        discount_price="{{ $related->discount_price }}"
                        rating="{{ $related->avg_rating ?? 0 }}"
                        reviews="{{ $related->reviews_count ?? 0 }}"
                        stock="{{ $related->stock_qty > 10 ? 'in-stock' : ($related->stock_qty > 0 ? 'low-stock' : 'out-of-stock') }}"
                        sale="{{ $related->discount_price && $related->discount_price < $related->price }}"
                        link="{{ route('product.show', $related->slug) }}"
                        product_id="{{ $related->id }}"
                    />
                @endforeach
            </div>
        </section>
    @endif

    {{-- Reviews Section --}}
    <section style="padding: var(--spacing-2xl) 0; border-top: 1px solid var(--color-border-light);">
        <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-xl);">
            <i class="fas fa-comments" style="color: var(--color-accent);"></i> Customer Reviews
            <span style="font-size: var(--font-size-base); font-weight: var(--font-weight-regular); color: var(--color-text-muted);">
                ({{ $product->reviews_count ?? 0 }})
            </span>
        </h2>

        @if($product->reviews && $product->reviews->count() > 0)
            <div style="display: grid; gap: var(--spacing-md);">
                @foreach($product->reviews as $review)
                    <div style="background: var(--color-bg-card); padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: var(--spacing-sm);">
                            <div>
                                <div style="display: flex; align-items: center; gap: var(--spacing-sm);">
                                    <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--color-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: var(--font-size-sm);">
                                        {{ strtoupper(substr($review->user->name ?? 'U', 0, 2)) }}
                                    </div>
                                    <div>
                                        <p style="font-weight: var(--font-weight-semibold); margin: 0;">
                                            {{ $review->user->name ?? 'Anonymous' }}
                                        </p>
                                        <p style="font-size: var(--font-size-xs); color: var(--color-text-muted); margin: 0;">
                                            {{ $review->created_at ? $review->created_at->format('M d, Y') : 'N/A' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="stars">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="star {{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            "{{ $review->comment }}"
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: var(--color-text-muted); text-align: center; padding: var(--spacing-2xl) 0;">
                <i class="fas fa-comment-slash" style="font-size: var(--font-size-2xl); display: block; margin-bottom: var(--spacing-md);"></i>
                No reviews yet. Be the first to review this product!
            </p>
        @endif
    </section>
</div>

@push('scripts')
<script>
// Change main image on thumbnail click
function changeMainImage(element) {
    // Update main image
    const mainImage = document.getElementById('mainProductImage');
    mainImage.src = element.src;

    // Update active state
    document.querySelectorAll('.thumbnails img').forEach(img => {
        img.classList.remove('active');
    });
    element.classList.add('active');
}

// Quantity controls
function incrementQuantity() {
    const input = document.getElementById('quantityInput');
    const max = parseInt(input.getAttribute('max')) || 999;
    const current = parseInt(input.value) || 1;
    if (current < max) {
        input.value = current + 1;
        updateBuyNowQuantity();
    }
}

function decrementQuantity() {
    const input = document.getElementById('quantityInput');
    const current = parseInt(input.value) || 1;
    if (current > 1) {
        input.value = current - 1;
        updateBuyNowQuantity();
    }
}

function updateBuyNowQuantity() {
    const qtyInput = document.getElementById('quantityInput');
    const buyNowQty = document.getElementById('buyNowQuantity');
    if (buyNowQty) {
        buyNowQty.value = qtyInput.value;
    }
}

// Prevent negative values in quantity input
document.addEventListener('DOMContentLoaded', function() {
    const qtyInput = document.getElementById('quantityInput');
    if (qtyInput) {
        qtyInput.addEventListener('change', function() {
            const max = parseInt(this.getAttribute('max')) || 999;
            let value = parseInt(this.value) || 1;
            if (value < 1) value = 1;
            if (value > max) value = max;
            this.value = value;
            updateBuyNowQuantity();
        });
    }
});

// Add to cart with quantity
document.querySelector('form[action*="cart.add"]')?.addEventListener('submit', function(e) {
    const qty = document.getElementById('quantityInput');
    if (qty) {
        const hiddenQty = document.createElement('input');
        hiddenQty.type = 'hidden';
        hiddenQty.name = 'quantity';
        hiddenQty.value = qty.value;
        this.appendChild(hiddenQty);
    }
});
</script>
@endpush
@endsection
