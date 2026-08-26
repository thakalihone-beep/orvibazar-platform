{{-- resources/views/frontend/products/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">

    {{-- Breadcrumb --}}
    <nav class="breadcrumb" aria-label="Breadcrumb" style="padding: var(--spacing-md) 0; display: flex; gap: var(--spacing-xs); font-size: var(--font-size-sm); color: var(--color-text-muted);">
        <a href="{{ route('home') }}" style="color: var(--color-text-muted); text-decoration: none;">Home</a>
        <span class="separator">/</span>
        <a href="{{ route('shop') }}" style="color: var(--color-text-muted); text-decoration: none;">Shop</a>
        <span class="separator">/</span>
        @if($product->category)
            <a href="{{ route('category.show', $product->category->slug) }}" style="color: var(--color-text-muted); text-decoration: none;">{{ $product->category->name }}</a>
            <span class="separator">/</span>
        @endif
        <span class="current" style="color: var(--color-text-primary);">{{ $product->name }}</span>
    </nav>

    {{-- Product Detail --}}
    <div class="product-detail" style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-2xl); padding: var(--spacing-xl) 0;">

        {{-- Gallery --}}
        <div class="gallery">
            <div class="main-image" style="position: relative; background: var(--color-bg-light); border-radius: var(--radius-lg); overflow: hidden; aspect-ratio: 1;">
                @php
                    $images = $product->images ?? [];
                    $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
                @endphp
                <img
                    src="{{ $firstImage ? asset('storage/' . $firstImage) : 'https://via.placeholder.com/600x600/1a1a1a/ffffff?text=' . urlencode($product->name) }}"
                    alt="{{ $product->name }}"
                    id="mainProductImage"
                    style="width: 100%; height: 100%; object-fit: cover;"
                >

                {{-- Wishlist Button on Product Page --}}
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
                @endphp
                <button
                    onclick="toggleWishlistProduct({{ $product->id }}, this)"
                    class="wishlist-btn {{ $inWishlist ? 'active' : '' }}"
                    style="
                        position: absolute;
                        top: var(--spacing-md);
                        right: var(--spacing-md);
                        background: white;
                        border: none;
                        border-radius: 50%;
                        width: 48px;
                        height: 48px;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        transition: all var(--transition-base);
                        z-index: 10;
                        box-shadow: var(--shadow-md);
                        color: {{ $inWishlist ? '#e74c3c' : 'var(--color-text-muted)' }};
                        font-size: 22px;
                    "
                    onmouseenter="this.style.transform='scale(1.1)'; this.style.boxShadow='var(--shadow-lg)';"
                    onmouseleave="this.style.transform='scale(1)'; this.style.boxShadow='var(--shadow-md)';"
                    aria-label="Toggle wishlist"
                >
                    <i class="{{ $inWishlist ? 'fas' : 'far' }} fa-heart"></i>
                </button>
            </div>

            @if(is_array($images) && count($images) > 1)
                <div class="thumbnails" style="display: flex; gap: var(--spacing-sm); margin-top: var(--spacing-md); overflow-x: auto; padding-bottom: var(--spacing-sm);">
                    @foreach($images as $index => $image)
                        <img
                            src="{{ asset('storage/' . $image) }}"
                            alt="{{ $product->name }} - Image {{ $index + 1 }}"
                            class="{{ $index === 0 ? 'active' : '' }}"
                            onclick="changeMainImage(this)"
                            style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--radius-sm); cursor: pointer; border: 2px solid {{ $index === 0 ? 'var(--color-accent)' : 'transparent' }}; transition: all var(--transition-fast);"
                            onmouseenter="this.style.borderColor='var(--color-accent)'"
                            onmouseleave="this.style.borderColor='{{ $index === 0 ? 'var(--color-accent)' : 'transparent' }}'"
                        >
                    @endforeach
                </div>
            @endif
        </div>

        {{-- Product Info --}}
        <div class="product-info">
            <h1 class="product-name" style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-sm);">{{ $product->name }}</h1>

            {{-- Rating --}}
            <div style="display: flex; align-items: center; gap: var(--spacing-sm); margin-bottom: var(--spacing-sm);">
                <div class="stars" style="display: flex; gap: 2px;">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star" style="color: {{ $i <= round($product->avg_rating ?? 0) ? 'var(--color-star)' : 'var(--color-star-empty)' }}; font-size: var(--font-size-lg);">★</span>
                    @endfor
                </div>
                <span class="rating-text" style="font-size: var(--font-size-sm); color: var(--color-text-muted);">
                    ({{ number_format($product->avg_rating ?? 0, 1) }} / 5 • {{ $product->reviews_count ?? 0 }} reviews)
                </span>
            </div>

            {{-- Price --}}
            <div style="margin: var(--spacing-md) 0;">
                @if($product->discount_price && $product->discount_price < $product->price)
                    <span style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-sale);">
                        NRs. {{ number_format($product->discount_price, 2) }}
                    </span>
                    <span style="font-size: var(--font-size-lg); color: var(--color-text-muted); text-decoration: line-through; margin-left: var(--spacing-sm);">
                        NRs. {{ number_format($product->price, 2) }}
                    </span>
                    @php
                        $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                    @endphp
                    <span style="background: var(--color-sale-bg); color: white; padding: 2px 10px; border-radius: var(--radius-full); font-size: var(--font-size-sm); font-weight: var(--font-weight-bold); margin-left: var(--spacing-sm);">
                        Save {{ $discountPercent }}%
                    </span>
                @else
                    <span style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold);">
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
            <div class="product-description" style="margin: var(--spacing-md) 0;">
                <h3 style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-sm);">Description</h3>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">{{ $product->description ?? 'No description available.' }}</p>
            </div>

            {{-- Tags --}}
            @if($product->tags && is_array($product->tags) && count($product->tags) > 0)
                <div style="margin: var(--spacing-md) 0; display: flex; gap: var(--spacing-sm); flex-wrap: wrap;">
                    @foreach($product->tags as $tag)
                        <span style="background: var(--color-off-white); padding: 4px 12px; border-radius: var(--radius-full); font-size: var(--font-size-xs); color: var(--color-text-muted);">
                            #{{ $tag }}
                        </span>
                    @endforeach
                </div>
            @endif

            {{-- Quantity & Add to Cart --}}
            <form action="{{ route('cart.add') }}" method="POST" style="margin-top: var(--spacing-lg);" onsubmit="return handleAddToCart(event)">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div style="display: flex; align-items: center; gap: var(--spacing-md); flex-wrap: wrap;">
                    <div class="quantity-selector" style="display: flex; align-items: center; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); overflow: hidden;">
                        <button type="button" onclick="decrementQuantity()" style="background: var(--color-bg-light); border: none; padding: 8px 16px; font-size: var(--font-size-lg); cursor: pointer; transition: background var(--transition-fast);" onmouseenter="this.style.background='var(--color-off-white)'" onmouseleave="this.style.background='var(--color-bg-light)'">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" name="quantity" class="qty-input" value="1" min="1" max="{{ $product->stock_qty }}" id="quantityInput" style="width: 60px; text-align: center; border: none; padding: 8px 0; font-size: var(--font-size-base); font-weight: var(--font-weight-semibold);">
                        <button type="button" onclick="incrementQuantity()" style="background: var(--color-bg-light); border: none; padding: 8px 16px; font-size: var(--font-size-lg); cursor: pointer; transition: background var(--transition-fast);" onmouseenter="this.style.background='var(--color-off-white)'" onmouseleave="this.style.background='var(--color-bg-light)'">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    @if($product->stock_qty > 0)
                        <button type="submit" class="btn-accent" style="flex: 1; justify-content: center; padding: 12px 24px; background: var(--color-accent); color: var(--color-primary); border: none; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-fast); display: flex; align-items: center; gap: var(--spacing-sm); font-size: var(--font-size-base);" onmouseenter="this.style.transform='scale(1.02)'; this.style.boxShadow='var(--shadow-md)'" onmouseleave="this.style.transform='scale(1)'; this.style.boxShadow='none'">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                    @else
                        <button type="button" class="btn-secondary" style="flex: 1; justify-content: center; cursor: not-allowed; opacity: 0.6; padding: 12px 24px; background: var(--color-bg-light); border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-weight: var(--font-weight-bold); color: var(--color-text-muted); display: flex; align-items: center; gap: var(--spacing-sm);" disabled>
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
                    <button type="submit" style="width: 100%; justify-content: center; padding: 14px; background: var(--color-primary); color: white; border: none; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-fast); display: flex; align-items: center; gap: var(--spacing-sm); font-size: var(--font-size-base);" onmouseenter="this.style.opacity='0.8'; this.style.transform='scale(1.01)'" onmouseleave="this.style.opacity='1'; this.style.transform='scale(1)'">
                        <i class="fas fa-bolt"></i> Buy Now
                    </button>
                </form>
            @endif

            {{-- Additional Info --}}
            <div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-md); border-top: 1px solid var(--color-border-light);">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-sm); font-size: var(--font-size-sm); color: var(--color-text-muted);">
                    <div>
                        <strong>Category:</strong>
                        <a href="{{ route('category.show', $product->category->slug ?? '#') }}" style="color: var(--color-primary); text-decoration: none;">
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
                    @php
                        $relatedInWishlist = false;
                        if (Auth::check()) {
                            $relatedInWishlist = \App\Models\Wishlist::where('user_id', Auth::id())
                                ->where('product_id', $related->id)
                                ->exists();
                        } else {
                            $wishlist = Session::get('wishlist', []);
                            $relatedInWishlist = in_array($related->id, $wishlist);
                        }
                    @endphp
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
                        :in_wishlist="$relatedInWishlist"
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
                                <div class="stars" style="display: flex; gap: 2px;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span class="star" style="color: {{ $i <= $review->rating ? 'var(--color-star)' : 'var(--color-star-empty)' }}; font-size: var(--font-size-sm);">★</span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin: 0;">
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
// ============================================
// PRODUCT PAGE WISHLIST TOGGLE
// ============================================
function toggleWishlistProduct(productId, buttonElement) {
    if (!productId) {
        showNotification('Product ID is required', 'error');
        return;
    }

    // Toggle UI immediately for better UX
    const isActive = buttonElement.classList.toggle('active');
    const icon = buttonElement.querySelector('i');
    if (icon) {
        icon.classList.toggle('far');
        icon.classList.toggle('fas');
    }

    // Update button color
    if (isActive) {
        buttonElement.style.color = '#e74c3c';
    } else {
        buttonElement.style.color = 'var(--color-text-muted)';
    }

    // Animate the button
    buttonElement.style.transform = 'scale(1.3)';
    setTimeout(() => {
        buttonElement.style.transform = 'scale(1)';
    }, 200);

    // Send request to server
    fetch('{{ route('wishlist.toggle') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            product_id: productId,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const message = data.action === 'added'
                ? 'Added to wishlist!'
                : 'Removed from wishlist!';
            showNotification(message, 'success');

            // Update wishlist count in navbar
            if (data.wishlist_count !== undefined) {
                const wishlistCount = document.getElementById('wishlistCount');
                if (wishlistCount) {
                    wishlistCount.textContent = data.wishlist_count;
                    if (data.wishlist_count === 0) {
                        wishlistCount.style.display = 'none';
                    } else {
                        wishlistCount.style.display = 'inline';
                    }
                }

                const mobileWishlistCount = document.getElementById('mobileWishlistCount');
                if (mobileWishlistCount) {
                    mobileWishlistCount.textContent = data.wishlist_count;
                    if (data.wishlist_count === 0) {
                        mobileWishlistCount.style.display = 'none';
                    } else {
                        mobileWishlistCount.style.display = 'inline';
                    }
                }
            }
        } else {
            // Revert UI if failed
            buttonElement.classList.toggle('active');
            if (icon) {
                icon.classList.toggle('far');
                icon.classList.toggle('fas');
            }
            if (buttonElement.classList.contains('active')) {
                buttonElement.style.color = '#e74c3c';
            } else {
                buttonElement.style.color = 'var(--color-text-muted)';
            }
            showNotification(data.message || 'Failed to update wishlist', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Revert UI if failed
        buttonElement.classList.toggle('active');
        if (icon) {
            icon.classList.toggle('far');
            icon.classList.toggle('fas');
        }
        if (buttonElement.classList.contains('active')) {
            buttonElement.style.color = '#e74c3c';
        } else {
            buttonElement.style.color = 'var(--color-text-muted)';
        }
        showNotification('An error occurred. Please try again.', 'error');
    });
}

// ============================================
// CHANGE MAIN IMAGE
// ============================================
function changeMainImage(element) {
    const mainImage = document.getElementById('mainProductImage');
    if (mainImage) {
        mainImage.src = element.src;
    }
    document.querySelectorAll('.thumbnails img').forEach(img => {
        img.classList.remove('active');
        img.style.borderColor = 'transparent';
    });
    element.classList.add('active');
    element.style.borderColor = 'var(--color-accent)';
}

// ============================================
// QUANTITY CONTROLS
// ============================================
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
    if (buyNowQty && qtyInput) {
        buyNowQty.value = qtyInput.value;
    }
}

// ============================================
// HANDLE ADD TO CART WITH QUANTITY
// ============================================
function handleAddToCart(event) {
    const form = event.target;
    const qtyInput = document.getElementById('quantityInput');
    if (qtyInput) {
        // Update or add quantity field
        let qtyField = form.querySelector('input[name="quantity"]');
        if (!qtyField) {
            qtyField = document.createElement('input');
            qtyField.type = 'hidden';
            qtyField.name = 'quantity';
            form.appendChild(qtyField);
        }
        qtyField.value = qtyInput.value;
    }
    return true;
}

// ============================================
// NOTIFICATION SYSTEM
// ============================================
function showNotification(message, type = 'success') {
    const existing = document.querySelectorAll('.custom-notification');
    existing.forEach(el => el.remove());

    const colors = {
        success: '#2ecc71',
        error: '#e74c3c',
        warning: '#f39c12',
        info: '#3498db',
    };

    const notification = document.createElement('div');
    notification.className = 'custom-notification';
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 16px 24px;
        background: ${colors[type] || '#333'};
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 99999;
        animation: slideIn 0.3s ease;
        font-weight: 500;
        max-width: 400px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-family: system-ui, -apple-system, sans-serif;
    `;

    const icons = {
        success: '✓',
        error: '✕',
        warning: '⚠',
        info: 'ℹ',
    };

    notification.innerHTML = `
        <span style="font-size: 20px; font-weight: bold;">${icons[type] || 'ℹ'}</span>
        <span>${message}</span>
        <button onclick="this.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; font-size: 18px; margin-left: auto; padding: 0 4px;">
            <i class="fas fa-times"></i>
        </button>
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.animation = 'slideOut 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }
    }, 4000);
}

// Add animation styles if not exists
if (!document.getElementById('notification-styles')) {
    const style = document.createElement('style');
    style.id = 'notification-styles';
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
        .wishlist-btn:hover {
            background: #ff6b6b !important;
            color: white !important;
        }
        .wishlist-btn.active {
            background: #e74c3c !important;
            color: white !important;
        }
    `;
    document.head.appendChild(style);
}

// ============================================
// INITIALIZE QUANTITY ON PAGE LOAD
// ============================================
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
</script>
@endpush
@endsection
