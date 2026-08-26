@props([
    'product' => null,
    'image' => null,
    'title' => 'Product',
    'price' => 0,
    'discount_price' => null,
    'rating' => 0,
    'reviews' => 0,
    'stock' => 'in-stock',
    'sale' => false,
    'link' => '#',
    'product_id' => null,
    'in_wishlist' => false,
])

@php
    // Check if product is in wishlist for guest or authenticated user
    $isInWishlist = false;
    if ($product_id) {
        if (Auth::check()) {
            $isInWishlist = \App\Models\Wishlist::where('user_id', Auth::id())
                ->where('product_id', $product_id)
                ->exists();
        } else {
            $wishlist = Session::get('wishlist', []);
            $isInWishlist = in_array($product_id, $wishlist);
        }
    }
@endphp

<div class="product-card" style="position: relative; background: var(--color-bg-card); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm); transition: all var(--transition-base); height: 100%; display: flex; flex-direction: column;">
    <div class="product-image" style="position: relative; padding-top: 100%; background: var(--color-bg-light); overflow: hidden;">

        {{-- Wishlist Button --}}
        <button
            class="wishlist-btn {{ $isInWishlist ? 'active' : '' }}"
            onclick="event.preventDefault(); event.stopPropagation(); toggleWishlist({{ $product_id ?? 'null' }}, this)"
            aria-label="Add to wishlist"
            style="
                position: absolute;
                top: var(--spacing-sm);
                left: var(--spacing-sm);
                background: white;
                border: none;
                border-radius: 50%;
                width: 38px;
                height: 38px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all var(--transition-base);
                z-index: 10;
                box-shadow: var(--shadow-sm);
                color: var(--color-text-muted);
                font-size: 18px;
            "
            onmouseenter="this.style.transform='scale(1.1)'; this.style.boxShadow='var(--shadow-md)';"
            onmouseleave="this.style.transform='scale(1)'; this.style.boxShadow='var(--shadow-sm)';"
        >
            <i class="{{ $isInWishlist ? 'fas' : 'far' }} fa-heart" style="transition: all var(--transition-base);"></i>
        </button>

        {{-- Product Image Link --}}
        <a href="{{ $link }}" style="display: block; width: 100%; height: 100%; position: absolute; top: 0; left: 0;">
            <img
                src="{{ $image ?? 'https://via.placeholder.com/400x400/1a1a1a/ffffff?text=No+Image' }}"
                alt="{{ $title }}"
                loading="lazy"
                style="width: 100%; height: 100%; object-fit: cover; transition: transform var(--transition-base);"
                onmouseover="this.style.transform='scale(1.05)'"
                onmouseout="this.style.transform='scale(1)'"
                onerror="this.src='https://via.placeholder.com/400x400/1a1a1a/ffffff?text=No+Image'"
            >
        </a>

        {{-- Sale Badge --}}
        @if($sale && $discount_price && $discount_price < $price)
            <span style="position: absolute; top: var(--spacing-sm); right: var(--spacing-sm); background: var(--color-sale-bg); color: white; padding: 4px 12px; border-radius: var(--radius-full); font-size: var(--font-size-xs); font-weight: var(--font-weight-bold);">
                SALE
            </span>
        @endif

        {{-- Stock Badge --}}
        <span style="position: absolute; bottom: var(--spacing-sm); left: var(--spacing-sm); background: {{ $stock === 'in-stock' ? 'var(--color-success)' : ($stock === 'low-stock' ? 'var(--color-warning)' : 'var(--color-error)') }}; color: white; padding: 4px 12px; border-radius: var(--radius-full); font-size: var(--font-size-xs); font-weight: var(--font-weight-semibold);">
            @switch($stock)
                @case('in-stock')
                    <i class="fas fa-check-circle"></i> In Stock
                    @break
                @case('low-stock')
                    <i class="fas fa-exclamation-triangle"></i> Low Stock
                    @break
                @case('out-of-stock')
                    <i class="fas fa-times-circle"></i> Out of Stock
                    @break
                @default
                    {{ ucfirst(str_replace('-', ' ', $stock)) }}
            @endswitch
        </span>

        {{-- Quick Add Button --}}
        @if($stock !== 'out-of-stock')
            <button
                class="quick-add-btn"
                onclick="event.stopPropagation(); quickAddToCart({{ $product_id ?? 'null' }}, this)"
                style="
                    position: absolute;
                    bottom: var(--spacing-sm);
                    right: var(--spacing-sm);
                    background: var(--color-accent);
                    color: var(--color-primary);
                    border: none;
                    padding: 6px 14px;
                    border-radius: var(--radius-md);
                    font-size: var(--font-size-xs);
                    font-weight: var(--font-weight-semibold);
                    cursor: pointer;
                    transition: all var(--transition-base);
                    display: flex;
                    align-items: center;
                    gap: var(--spacing-xs);
                    opacity: 0.9;
                "
                onmouseenter="this.style.opacity='1'; this.style.transform='scale(1.05)';"
                onmouseleave="this.style.opacity='0.9'; this.style.transform='scale(1)';"
            >
                <i class="fas fa-cart-plus"></i> Quick Add
            </button>
        @endif
    </div>

    <div class="product-info" style="padding: var(--spacing-md); flex: 1; display: flex; flex-direction: column;">
        <a href="{{ $link }}" class="product-title" style="text-decoration: none; color: var(--color-text-primary); font-size: var(--font-size-base); font-weight: var(--font-weight-semibold); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: var(--spacing-xs); min-height: 48px;">
            {{ $title }}
        </a>

        {{-- Rating --}}
        <div class="stars" style="display: flex; align-items: center; gap: 2px; margin-bottom: var(--spacing-xs);">
            @for($i = 1; $i <= 5; $i++)
                <span class="star" style="color: {{ $i <= round($rating) ? 'var(--color-star)' : 'var(--color-star-empty)' }}; font-size: var(--font-size-sm);">★</span>
            @endfor
            <span style="font-size: var(--font-size-xs); color: var(--color-text-muted); margin-left: var(--spacing-xs);">({{ $reviews }})</span>
        </div>

        {{-- Price --}}
        <div class="product-price" style="margin-top: auto; padding-top: var(--spacing-sm);">
            @if($discount_price && $discount_price < $price)
                <span style="font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); color: var(--color-sale);">
                    NRs. {{ number_format($discount_price, 2) }}
                </span>
                <span style="font-size: var(--font-size-sm); color: var(--color-text-muted); text-decoration: line-through; margin-left: var(--spacing-xs);">
                    NRs. {{ number_format($price, 2) }}
                </span>
            @else
                <span style="font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); color: var(--color-text-primary);">
                    NRs. {{ number_format($price, 2) }}
                </span>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
// ============================================
// TOGGLE WISHLIST - CONNECTED TO BACKEND
// ============================================
function toggleWishlist(productId, buttonElement) {
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

                // Update mobile wishlist count
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
        showNotification('An error occurred. Please try again.', 'error');
    });
}

// ============================================
// QUICK ADD TO CART - CONNECTED TO BACKEND
// ============================================
function quickAddToCart(productId, button) {
    if (!productId) {
        showNotification('Product ID is required', 'error');
        return;
    }

    // Show loading state
    const originalText = button ? button.innerHTML : 'Quick Add';
    if (button) {
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
        button.disabled = true;
        button.style.opacity = '0.6';
    }

    fetch('{{ route('cart.add') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Product added to cart!', 'success');

            // Update cart count in navbar
            const cartCount = document.getElementById('cartCount');
            if (cartCount) {
                cartCount.textContent = data.cart_count || (parseInt(cartCount.textContent) + 1);
            }

            // Reset button
            if (button) {
                button.innerHTML = '<i class="fas fa-check"></i> Added!';
                button.style.background = 'var(--color-success)';
                button.style.color = 'white';
                button.style.opacity = '1';
                setTimeout(() => {
                    button.innerHTML = originalText;
                    button.disabled = false;
                    button.style.background = '';
                    button.style.color = '';
                    button.style.opacity = '0.9';
                }, 2000);
            }
        } else {
            showNotification(data.message || 'Failed to add product', 'error');
            if (button) {
                button.innerHTML = originalText;
                button.disabled = false;
                button.style.opacity = '0.9';
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred. Please try again.', 'error');
        if (button) {
            button.innerHTML = originalText;
            button.disabled = false;
            button.style.opacity = '0.9';
        }
    });
}

// ============================================
// NOTIFICATION SYSTEM
// ============================================
function showNotification(message, type = 'success') {
    // Remove existing notifications
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
        .product-card:hover .quick-add-btn {
            opacity: 1 !important;
            transform: scale(1.05);
        }
        .quick-add-btn {
            opacity: 0.85;
            transition: all 0.3s ease;
        }
    `;
    document.head.appendChild(style);
}
</script>
@endpush
