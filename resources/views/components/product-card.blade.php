{{-- @props([
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
])

<div class="product-card">
    <div class="product-image">
        <a href="{{ $link }}"></a><img src="{{ $image }}" alt="{{ $title }}" loading="lazy"></a>


        @if($sale && $discount_price && $discount_price < $price)
            <span class="sale-badge">SALE</span>
        @endif

        <span class="stock-badge {{ $stock }}">
            @switch($stock)
                @case('in-stock')
                    In Stock
                    @break
                @case('low-stock')
                    Low Stock
                    @break
                @case('out-of-stock')
                    Out of Stock
                    @break
                @default
                    {{ ucfirst(str_replace('-', ' ', $stock)) }}
            @endswitch
        </span>

        @if($stock !== 'out-of-stock')
            <button class="quick-add-btn" onclick="quickAddToCart({{ $product_id ?? 'null' }})">
                <i class="fas fa-cart-plus"></i> Quick Add
            </button>
        @endif
    </div>

    <div class="product-info">
        <a href="{{ $link }}" class="product-title">{{ $title }}</a>

        <div class="stars">
            @for($i = 1; $i <= 5; $i++)
                <span class="star {{ $i <= round($rating) ? 'filled' : '' }}">★</span>
            @endfor
            <span class="rating-text">({{ $reviews }})</span>
        </div>

        <div class="product-price">
            @if($discount_price && $discount_price < $price)
                <span class="sale-price">NRs. {{ number_format($discount_price, 2) }}</span>
                <span class="original-price">NRs. {{ number_format($price, 2) }}</span>
            @else
                NRs. {{ number_format($price, 2) }}
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
function quickAddToCart(productId) {
    if (!productId) {
        alert('Product ID is required');
        return;
    }

    fetch('{{ route('cart.add') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: 1,
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success notification
            showNotification('Product added to cart!', 'success');
        } else {
            showNotification('Failed to add product', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred', 'error');
    });
}

function showNotification(message, type = 'success') {
    // Simple notification - can be enhanced with a proper toast system
    const colors = {
        success: 'var(--color-success)',
        error: 'var(--color-error)',
        warning: 'var(--color-warning)',
        info: 'var(--color-info)',
    };

    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 16px 24px;
        background: ${colors[type] || '#333'};
        color: white;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        z-index: 9999;
        animation: slideIn 0.3s ease;
        font-weight: 500;
    `;
    notification.textContent = message;
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}
</script>

<style>
@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
@keyframes slideOut {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(100%); opacity: 0; }
}
</style>
@endpush --}}

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
    'in_wishlist' => false, // Add this prop to check if product is already in wishlist
])

<div class="product-card">
    <div class="product-image">
        {{-- Wishlist Button at Top Left --}}
        <button
            class="wishlist-btn {{ $in_wishlist ? 'active' : '' }}"
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
            <i class="{{ $in_wishlist ? 'fas' : 'far' }} fa-heart" style="transition: all var(--transition-base);"></i>
        </button>

        {{-- Wrap image in anchor tag --}}
        <a href="{{ $link }}" style="display: block; width: 100%; height: 100%;">
            <img src="{{ $image }}" alt="{{ $title }}" loading="lazy">
        </a>

        @if($sale && $discount_price && $discount_price < $price)
            <span class="sale-badge">SALE</span>
        @endif

        <span class="stock-badge {{ $stock }}">
            @switch($stock)
                @case('in-stock')
                    In Stock
                    @break
                @case('low-stock')
                    Low Stock
                    @break
                @case('out-of-stock')
                    Out of Stock
                    @break
                @default
                    {{ ucfirst(str_replace('-', ' ', $stock)) }}
            @endswitch
        </span>

        @if($stock !== 'out-of-stock')
            <button class="quick-add-btn" onclick="event.stopPropagation(); quickAddToCart({{ $product_id ?? 'null' }})">
                <i class="fas fa-cart-plus"></i> Quick Add
            </button>
        @endif
    </div>

    <div class="product-info">
        <a href="{{ $link }}" class="product-title">{{ $title }}</a>

        <div class="stars">
            @for($i = 1; $i <= 5; $i++)
                <span class="star {{ $i <= round($rating) ? 'filled' : '' }}">★</span>
            @endfor
            <span class="rating-text">({{ $reviews }})</span>
        </div>

        <div class="product-price">
            @if($discount_price && $discount_price < $price)
                <span class="sale-price">NRs. {{ number_format($discount_price, 2) }}</span>
                <span class="original-price">NRs. {{ number_format($price, 2) }}</span>
            @else
                NRs. {{ number_format($price, 2) }}
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
// Wishlist toggle function
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

            // Update wishlist count if available
            if (data.wishlist_count !== undefined) {
                const wishlistCounts = document.querySelectorAll('.wishlist-count');
                wishlistCounts.forEach(el => {
                    el.textContent = data.wishlist_count;
                });
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

// Quick add to cart function
function quickAddToCart(productId) {
    if (!productId) {
        showNotification('Product ID is required', 'error');
        return;
    }

    // Show loading state
    const buttons = document.querySelectorAll('.quick-add-btn');
    buttons.forEach(btn => {
        if (btn.onclick && btn.onclick.toString().includes(`quickAddToCart(${productId})`)) {
            const originalText = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            btn.disabled = true;

            // Reset after operation
            setTimeout(() => {
                btn.innerHTML = originalText;
                btn.disabled = false;
            }, 3000);
        }
    });

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
            showNotification('Product added to cart successfully!', 'success');

            // Update cart count if available
            if (data.cart_count !== undefined) {
                const cartCounts = document.querySelectorAll('.cart-count, [data-cart-count]');
                cartCounts.forEach(el => {
                    el.textContent = data.cart_count;
                });
            }
        } else {
            showNotification(data.message || 'Failed to add product', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred. Please try again.', 'error');
    });
}

// Notification system
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
        z-index: 9999;
        animation: slideIn 0.3s ease;
        font-weight: 500;
        max-width: 400px;
        display: flex;
        align-items: center;
        gap: 10px;
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
    `;

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
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

        /* Wishlist button hover effect */
        .wishlist-btn:hover {
            background: #ff6b6b !important;
            color: white !important;
        }

        .wishlist-btn.active {
            background: #e74c3c !important;
            color: white !important;
        }

        .wishlist-btn.active i {
            font-weight: 900;
        }

        /* Product card hover effects */
        .product-card:hover .wishlist-btn {
            transform: scale(1.05);
        }
    `;
    document.head.appendChild(style);
}

// Initialize wishlist buttons on page load
document.addEventListener('DOMContentLoaded', function() {
    // You can add logic here to check wishlist status from server
    // and update buttons accordingly
});
</script>
@endpush
