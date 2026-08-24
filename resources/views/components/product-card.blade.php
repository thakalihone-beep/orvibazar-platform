@props([
    'product' => null,
    'image' => null,
    'title' => null,
    'price' => 0,
    'discount_price' => null,
    'original_price' => null,
    'rating' => 0,
    'reviews' => 0,
    'stock' => 'in-stock', // in-stock, low-stock, out-of-stock
    'sale' => false,
    'link' => '#',
    'product_id' => null,
    'sku' => null,
    'show_quick_add' => true,
    'show_rating' => true,
    'show_stock' => true,
    'show_wishlist' => true,
    'layout' => 'vertical' // vertical, horizontal, grid
])

@php
    $finalTitle = $title ?? $product?->name ?? 'Product Title';
    $rawPrice = (float)($price ?: ($product?->price ?? 0));
    $rawDiscount = $discount_price ?? $product?->discount_price ?? null;
    $rawOriginal = $original_price !== null ? (float)$original_price : null;

    if ($rawDiscount && (float)$rawDiscount > 0 && (float)$rawDiscount < $rawPrice) {
        $isOnSale = true;
        $displayPrice = (float)$rawDiscount;
        $strikePrice = $rawPrice;
    } elseif ($rawOriginal && $rawPrice < $rawOriginal) {
        $isOnSale = true;
        $displayPrice = $rawPrice;
        $strikePrice = $rawOriginal;
    } else {
        $isOnSale = $sale;
        $displayPrice = $rawPrice;
        $strikePrice = null;
    }

    $discount = 0;
    if ($isOnSale && $strikePrice && $strikePrice > 0) {
        $discount = round((($strikePrice - $displayPrice) / $strikePrice) * 100);
    }

    $finalImage = $image ?? $product?->image_url ?? 'https://via.placeholder.com/300x300/1a1a1a/ffffff?text=' . urlencode($finalTitle);
    $finalLink = ($link && $link !== '#') ? $link : ($product ? (Route::has('product.show') ? route('product.show', $product->slug) : '/products/' . $product->slug) : '#');
    $finalRating = $rating ?: (float)($product?->avg_rating ?? 0);
    $finalReviews = $reviews ?: ($product?->reviews_count ?? 0);
    $finalStock = $stock !== 'in-stock' ? $stock : ($product?->stock_status ?? $stock);

    // Stock status classes
    $stockClasses = [
        'in-stock' => 'var(--color-success)',
        'low-stock' => 'var(--color-warning)',
        'out-of-stock' => 'var(--color-error)'
    ];

    $stockLabels = [
        'in-stock' => 'In Stock',
        'low-stock' => 'Low Stock',
        'out-of-stock' => 'Out of Stock'
    ];

    $stockIcons = [
        'in-stock' => 'fa-check-circle',
        'low-stock' => 'fa-exclamation-circle',
        'out-of-stock' => 'fa-times-circle'
    ];

    // Generate unique ID for this card
    $cardId = 'product-' . ($product_id ?? $product?->id ?? uniqid());
@endphp

<div id="{{ $cardId }}"
     class="product-card"
     style="background: var(--color-bg-card); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm); transition: all var(--transition-base); position: relative; height: 100%; {{ $layout === 'horizontal' ? 'display: flex;' : '' }}">

    <!-- Product Image Container -->
    <div class="product-image-container" style="position: relative; {{ $layout === 'horizontal' ? 'width: 40%; flex-shrink: 0;' : 'padding-top: 100%;' }} overflow: hidden; background: var(--color-off-white);">

        <!-- Product Image -->
        <a href="{{ $finalLink }}" style="display: block; width: 100%; height: 100%;">
            <img src="{{ $finalImage }}"
                 alt="{{ $finalTitle }}"
                 style="position: {{ $layout === 'horizontal' ? 'relative' : 'absolute' }}; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; transition: transform var(--transition-slow);"
                 loading="lazy">
        </a>

        <!-- Sale Badge -->
        @if($isOnSale && $finalStock !== 'out-of-stock')
            <span class="sale-badge" style="position: absolute; top: var(--spacing-sm); right: var(--spacing-sm); background: var(--color-sale-bg); color: white; padding: 4px 12px; border-radius: var(--radius-full); font-size: var(--font-size-xs); font-weight: var(--font-weight-bold); text-transform: uppercase; z-index: 2; animation: pulse-badge 2s infinite;">
                <i class="fas fa-tag" style="margin-right: 4px;"></i> {{ $discount > 0 ? "-{$discount}%" : 'SALE' }}
            </span>
        @endif

        <!-- Wishlist Button -->
        @if($show_wishlist)
            <button class="wishlist-btn"
                    onclick="toggleWishlist('{{ $cardId }}')"
                    style="position: absolute; top: var(--spacing-sm); {{ $isOnSale ? 'right: 70px;' : 'right: var(--spacing-sm);' }} background: white; border: none; width: 32px; height: 32px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-sm); transition: all var(--transition-fast); z-index: 2; color: var(--color-text-muted);">
                <i class="fas fa-heart" style="font-size: 14px; transition: color var(--transition-fast);"></i>
            </button>
        @endif

        <!-- Stock Badge -->
        @if($show_stock && $finalStock !== 'in-stock')
            <span class="stock-badge {{ $finalStock }}"
                  style="position: absolute; bottom: var(--spacing-sm); left: var(--spacing-sm); padding: 4px 12px; border-radius: var(--radius-full); font-size: var(--font-size-xs); font-weight: var(--font-weight-medium); z-index: 2; background: {{ $stockClasses[$finalStock] ?? 'var(--color-mid-gray)' }}; color: white; display: flex; align-items: center; gap: 4px;">
                <i class="fas {{ $stockIcons[$finalStock] ?? 'fa-info-circle' }}"></i>
                {{ $stockLabels[$finalStock] ?? 'Unknown' }}
            </span>
        @endif

        <!-- Quick Add to Cart Button -->
        @if($show_quick_add && $finalStock !== 'out-of-stock')
            <button class="quick-add-btn"
                    onclick="quickAddToCart('{{ $cardId }}', '{{ addslashes($finalTitle) }}', {{ (float)$displayPrice }})"
                    style="position: absolute; bottom: -50px; left: 50%; transform: translateX(-50%); background: var(--color-primary); color: var(--color-text-light); border: none; padding: var(--spacing-sm) var(--spacing-lg); border-radius: var(--radius-full); font-weight: var(--font-weight-medium); cursor: pointer; transition: all var(--transition-base); opacity: 0; white-space: nowrap; z-index: 3; box-shadow: var(--shadow-md);">
                <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
        @endif

        <!-- Out of Stock Overlay -->
        @if($finalStock === 'out-of-stock')
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); display: flex; align-items: center; justify-content: center; z-index: 2;">
                <span style="color: white; font-weight: var(--font-weight-bold); font-size: var(--font-size-lg); text-transform: uppercase; letter-spacing: 2px; background: rgba(0,0,0,0.8); padding: 8px 20px; border-radius: var(--radius-md);">
                    Out of Stock
                </span>
            </div>
        @endif
    </div>

    <!-- Product Info -->
    <div class="product-info" style="padding: var(--spacing-md); {{ $layout === 'horizontal' ? 'flex: 1; display: flex; flex-direction: column; justify-content: center;' : '' }}">

        <!-- Product Title -->
        <a href="{{ $finalLink }}" style="text-decoration: none; color: inherit;">
            <h3 class="product-title" style="font-size: var(--font-size-md); font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 48px; transition: color var(--transition-fast);">
                {{ $finalTitle }}
            </h3>
        </a>

        <!-- Rating -->
        @if($show_rating && $finalRating > 0)
            <div style="display: flex; align-items: center; gap: var(--spacing-xs); margin: var(--spacing-xs) 0;">
                <div class="stars" style="display: flex; gap: 2px;">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($finalRating))
                            <span class="star filled" style="color: var(--color-star); font-size: var(--font-size-sm);">★</span>
                        @elseif($i == ceil($finalRating) && ($finalRating - floor($finalRating)) >= 0.5)
                            <span class="star filled" style="color: var(--color-star); font-size: var(--font-size-sm);">★</span>
                        @else
                            <span class="star" style="color: var(--color-star-empty); font-size: var(--font-size-sm);">★</span>
                        @endif
                    @endfor
                </div>
                @if($finalReviews > 0)
                    <span class="rating-text" style="font-size: var(--font-size-xs); color: var(--color-text-muted); margin-left: var(--spacing-xs);">
                        ({{ $finalReviews }})
                    </span>
                @endif
            </div>
        @endif

        <!-- Price -->
        <div class="product-price" style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); display: flex; align-items: center; gap: var(--spacing-sm); flex-wrap: wrap; margin-top: var(--spacing-xs);">
            <span class="sale-price" style="color: {{ $isOnSale ? 'var(--color-sale)' : 'var(--color-primary)' }};">
                NRs. {{ number_format($displayPrice, 2) }}
            </span>
            @if($isOnSale && $strikePrice)
                <span class="original-price" style="font-size: var(--font-size-sm); color: var(--color-text-muted); text-decoration: line-through; font-weight: var(--font-weight-regular);">
                    NRs. {{ number_format($strikePrice, 2) }}
                </span>
            @endif
        </div>

        <!-- Additional Info (SKU, etc.) -->
        @if($sku)
            <div style="margin-top: var(--spacing-xs); font-size: var(--font-size-xs); color: var(--color-text-muted);">
                SKU: {{ $sku }}
            </div>
        @endif

        <!-- Action Buttons for Horizontal Layout -->
        @if($layout === 'horizontal' && $finalStock !== 'out-of-stock')
            <div style="display: flex; gap: var(--spacing-sm); margin-top: var(--spacing-md);">
                <button onclick="addToCart('{{ $cardId }}', '{{ addslashes($finalTitle) }}', {{ (float)$displayPrice }})"
                        style="flex: 1; padding: 8px 16px; background: var(--color-accent); color: var(--color-primary); border: none; border-radius: var(--radius-md); font-weight: var(--font-weight-semibold); cursor: pointer; transition: all var(--transition-fast); display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm);">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
                <button onclick="toggleWishlist('{{ $cardId }}')"
                        style="padding: 8px 16px; background: var(--color-off-white); border: none; border-radius: var(--radius-md); cursor: pointer; transition: all var(--transition-fast); display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm);">
                    <i class="fas fa-heart" style="color: var(--color-text-muted);"></i>
                </button>
            </div>
        @endif

        <!-- Quick Actions for Vertical Layout -->
        @if($layout === 'vertical' && $finalStock !== 'out-of-stock' && !$show_quick_add)
            <button onclick="addToCart('{{ $cardId }}', '{{ addslashes($finalTitle) }}', {{ (float)$displayPrice }})"
                    style="width: 100%; margin-top: var(--spacing-sm); padding: 8px; background: var(--color-primary); color: white; border: none; border-radius: var(--radius-md); font-weight: var(--font-weight-medium); cursor: pointer; transition: all var(--transition-fast); display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm);">
                <i class="fas fa-shopping-cart"></i> Add to Cart
            </button>
        @endif
    </div>
</div>

<style>
/* Product Card Hover Effects */
.product-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-hover);
}

.product-card:hover .product-image-container img {
    transform: scale(1.05);
}

.product-card:hover .quick-add-btn {
    bottom: var(--spacing-md);
    opacity: 1;
}

.quick-add-btn:hover {
    background: var(--color-accent) !important;
    color: var(--color-primary) !important;
    transform: translateX(-50%) scale(1.05) !important;
    box-shadow: var(--shadow-glow) !important;
}

/* Wishlist Button Animation */
.wishlist-btn:hover {
    transform: scale(1.1);
    box-shadow: var(--shadow-md);
}

.wishlist-btn.active {
    color: var(--color-accent);
}

.wishlist-btn.active i {
    color: var(--color-accent);
}

/* Sale Badge Animation */
@keyframes pulse-badge {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

/* Product Title Link Hover */
.product-title:hover {
    color: var(--color-accent);
}

/* Stock Badge Variants */
.stock-badge.in-stock {
    background: var(--color-success);
}

.stock-badge.low-stock {
    background: var(--color-warning);
}

.stock-badge.out-of-stock {
    background: var(--color-error);
}

/* Responsive */
@media (max-width: 768px) {
    .product-card {
        min-height: 300px;
    }

    .product-card .quick-add-btn {
        bottom: var(--spacing-sm);
        opacity: 1;
        padding: var(--spacing-xs) var(--spacing-md);
        font-size: var(--font-size-xs);
        width: calc(100% - var(--spacing-md));
    }

    .product-card.horizontal {
        flex-direction: column !important;
    }

    .product-card.horizontal .product-image-container {
        width: 100% !important;
        padding-top: 100% !important;
    }
}

@media (max-width: 480px) {
    .product-card .product-title {
        font-size: var(--font-size-sm);
        min-height: 40px;
    }

    .product-card .product-price {
        font-size: var(--font-size-lg);
    }

    .product-card .sale-badge,
    .product-card .discount-badge {
        font-size: 10px;
        padding: 2px 8px;
    }
}
</style>

<script>
// ============================================
// PRODUCT CARD FUNCTIONALITY
// ============================================

/**
 * Quick Add to Cart - Product Card
 */
function quickAddToCart(cardId, productName, price) {
    const card = document.getElementById(cardId);
    const btn = card.querySelector('.quick-add-btn');
    const originalText = btn.innerHTML;

    // Show loading state
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
    btn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        // Success state
        btn.innerHTML = '<i class="fas fa-check"></i> Added!';
        btn.style.background = 'var(--color-success)';
        btn.style.color = 'white';

        // Update cart count
        const cartCount = document.getElementById('cartCount');
        if (cartCount) {
            const currentCount = parseInt(cartCount.textContent) || 0;
            cartCount.textContent = currentCount + 1;
        }

        // Show notification
        showToast('success', `${productName} added to cart!`);

        // Reset button after delay
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.background = '';
            btn.style.color = '';
            btn.disabled = false;
        }, 2000);
    }, 800);
}

/**
 * Add to Cart - Full Button
 */
function addToCart(cardId, productName, price) {
    const card = document.getElementById(cardId);
    const btn = card.querySelector('button:last-child');
    const originalText = btn.innerHTML;

    // Show loading
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
    btn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        btn.innerHTML = '<i class="fas fa-check"></i> Added!';
        btn.style.background = 'var(--color-success)';
        btn.style.color = 'white';

        // Update cart count
        const cartCount = document.getElementById('cartCount');
        if (cartCount) {
            const currentCount = parseInt(cartCount.textContent) || 0;
            cartCount.textContent = currentCount + 1;
        }

        showToast('success', `${productName} added to cart!`);

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.style.background = '';
            btn.style.color = '';
            btn.disabled = false;
        }, 2000);
    }, 800);
}

/**
 * Toggle Wishlist
 */
function toggleWishlist(cardId) {
    const card = document.getElementById(cardId);
    const wishlistBtn = card.querySelector('.wishlist-btn');
    const icon = wishlistBtn.querySelector('i');

    // Toggle active state
    if (wishlistBtn.classList.contains('active')) {
        wishlistBtn.classList.remove('active');
        icon.style.color = 'var(--color-text-muted)';
        wishlistBtn.style.transform = 'scale(0.8)';
        setTimeout(() => {
            wishlistBtn.style.transform = 'scale(1)';
        }, 200);
        showToast('info', 'Removed from wishlist');
    } else {
        wishlistBtn.classList.add('active');
        icon.style.color = 'var(--color-accent)';
        wishlistBtn.style.transform = 'scale(1.2)';
        setTimeout(() => {
            wishlistBtn.style.transform = 'scale(1)';
        }, 200);

        // Update wishlist count
        const wishlistCount = document.getElementById('wishlistCount');
        if (wishlistCount) {
            const currentCount = parseInt(wishlistCount.textContent) || 0;
            wishlistCount.textContent = currentCount + 1;
        }

        showToast('success', 'Added to wishlist! ❤️');
    }
}

/**
 * Toast Notification System
 */
function showToast(type, message) {
    // Remove existing toast if any
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) {
        existingToast.remove();
    }

    // Create toast element
    const toast = document.createElement('div');
    toast.className = 'toast-notification';

    // Set background color based on type
    const colors = {
        'success': 'var(--color-success)',
        'error': 'var(--color-error)',
        'warning': 'var(--color-warning)',
        'info': 'var(--color-info)'
    };

    const icons = {
        'success': 'fa-check-circle',
        'error': 'fa-times-circle',
        'warning': 'fa-exclamation-circle',
        'info': 'fa-info-circle'
    };

    toast.style.cssText = `
        position: fixed;
        bottom: var(--spacing-xl);
        right: var(--spacing-xl);
        background: ${colors[type] || 'var(--color-primary)'};
        color: white;
        padding: var(--spacing-md) var(--spacing-lg);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-lg);
        z-index: 9999;
        display: flex;
        align-items: center;
        gap: var(--spacing-sm);
        animation: slideInUp 0.3s ease;
        font-weight: var(--font-weight-medium);
        max-width: 400px;
        min-width: 280px;
        font-size: var(--font-size-sm);
    `;

    toast.innerHTML = `
        <i class="fas ${icons[type] || 'fa-info-circle'}" style="font-size: 20px;"></i>
        <span>${message}</span>
        <button onclick="this.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; font-size: 18px; margin-left: auto; padding: 0 4px;">
            <i class="fas fa-times"></i>
        </button>
    `;

    document.body.appendChild(toast);

    // Auto remove after 5 seconds
    setTimeout(() => {
        if (toast.parentElement) {
            toast.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }
    }, 5000);
}

// Add animations
const styleSheet = document.createElement("style");
styleSheet.textContent = `
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(30px);
        }
    }

    .product-card {
        transition: all var(--transition-base);
    }

    .wishlist-btn {
        transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
`;
document.head.appendChild(styleSheet);

// ============================================
// LAZY LOADING FOR PRODUCT IMAGES
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    // Check if Intersection Observer is supported
    if ('IntersectionObserver' in window) {
        const images = document.querySelectorAll('.product-card img[loading="lazy"]');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.style.opacity = '0';
                    img.style.transition = 'opacity 0.5s ease';

                    // Load the image
                    const src = img.getAttribute('src');
                    if (src) {
                        const newImg = new Image();
                        newImg.onload = function() {
                            img.style.opacity = '1';
                        };
                        newImg.src = src;
                    }

                    observer.unobserve(img);
                }
            });
        });

        images.forEach(img => imageObserver.observe(img));
    }
});

// ============================================
// KEYBOARD SHORTCUTS FOR PRODUCT CARDS
// ============================================
document.addEventListener('keydown', function(e) {
    // 'A' key to add first visible product to cart (when in product grid)
    if (e.key === 'a' && e.ctrlKey) {
        const firstProduct = document.querySelector('.product-card:not(.out-of-stock) .quick-add-btn');
        if (firstProduct) {
            firstProduct.click();
            e.preventDefault();
        }
    }
});
</script>
