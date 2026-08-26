@extends('layouts.app')

@section('title', 'My Wishlist - OrviBazar')

@section('content')
<div style="padding: var(--spacing-2xl) 0; background: var(--color-bg-light); min-height: 60vh;">
    <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">

        <!-- Page Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-xl); flex-wrap: wrap; gap: var(--spacing-md);">
            <div>
                <h1 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); display: flex; align-items: center; gap: var(--spacing-sm);">
                    <i class="fas fa-heart" style="color: var(--color-accent);"></i>
                    My Wishlist
                    <span style="font-size: var(--font-size-base); color: var(--color-text-muted); font-weight: var(--font-weight-normal); margin-left: var(--spacing-sm);">
                        ({{ count($wishlistItems) }} items)
                    </span>
                </h1>
                <p style="color: var(--color-text-muted); margin-top: var(--spacing-xs);">
                    <i class="fas fa-info-circle"></i>
                    {{ count($wishlistItems) > 0 ? 'Products you\'ve saved for later' : 'Start adding products to your wishlist' }}
                </p>
            </div>

            @if(count($wishlistItems) > 0)
            <div style="display: flex; gap: var(--spacing-sm);">
                <button onclick="clearWishlist()"
                    style="background: var(--color-error); color: white; border: none; padding: 10px 20px; border-radius: var(--radius-md); cursor: pointer; font-weight: var(--font-weight-semibold); display: flex; align-items: center; gap: var(--spacing-sm); transition: all var(--transition-fast);"
                    onmouseover="this.style.opacity='0.8'"
                    onmouseout="this.style.opacity='1'">
                    <i class="fas fa-trash"></i> Clear All
                </button>
                <a href="{{ route('shop') }}"
                    style="background: var(--color-primary); color: white; padding: 10px 20px; border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-semibold); display: flex; align-items: center; gap: var(--spacing-sm); transition: all var(--transition-fast);"
                    onmouseover="this.style.opacity='0.8'"
                    onmouseout="this.style.opacity='1'">
                    <i class="fas fa-shopping-bag"></i> Continue Shopping
                </a>
            </div>
            @endif
        </div>

        <!-- Wishlist Items Grid -->
        @if(count($wishlistItems) > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: var(--spacing-lg);">
            @foreach($wishlistItems as $item)
            <div class="wishlist-item" data-product-id="{{ $item['id'] }}"
                style="background: white; border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm); transition: all var(--transition-base); position: relative;"
                onmouseover="this.style.boxShadow='var(--shadow-md)'; this.style.transform='translateY(-4px)'"
                onmouseout="this.style.boxShadow='var(--shadow-sm)'; this.style.transform='translateY(0)'">

                <!-- Product Image -->
                <div style="position: relative; padding-top: 100%; background: var(--color-bg-light);">
                    @if($item['image'])
                    <img src="{{ asset('storage/' . $item['image']) }}"
                        alt="{{ $item['name'] }}"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                        onerror="this.src='https://via.placeholder.com/400x400/1a1a1a/ffffff?text=No+Image'">
                    @else
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: var(--color-bg-light); color: var(--color-text-muted);">
                        <i class="fas fa-image" style="font-size: 48px; opacity: 0.3;"></i>
                    </div>
                    @endif

                    <!-- Stock Badge -->
                    @if(isset($item['stock_qty']) && $item['stock_qty'] > 0)
                    <span style="position: absolute; top: var(--spacing-sm); left: var(--spacing-sm); background: var(--color-success); color: white; padding: 4px 12px; border-radius: var(--radius-full); font-size: var(--font-size-xs); font-weight: var(--font-weight-semibold);">
                        In Stock
                    </span>
                    @else
                    <span style="position: absolute; top: var(--spacing-sm); left: var(--spacing-sm); background: var(--color-error); color: white; padding: 4px 12px; border-radius: var(--radius-full); font-size: var(--font-size-xs); font-weight: var(--font-weight-semibold);">
                        Out of Stock
                    </span>
                    @endif

                    <!-- Remove Button -->
                    <button onclick="removeFromWishlist({{ $item['id'] }}, this)"
                        style="position: absolute; top: var(--spacing-sm); right: var(--spacing-sm); background: white; border: none; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; box-shadow: var(--shadow-sm); display: flex; align-items: center; justify-content: center; transition: all var(--transition-fast); color: var(--color-error);"
                        onmouseover="this.style.transform='scale(1.1)'; this.style.background='var(--color-error)'; this.style.color='white'"
                        onmouseout="this.style.transform='scale(1)'; this.style.background='white'; this.style.color='var(--color-error)'"
                        title="Remove from wishlist">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Product Details -->
                <div style="padding: var(--spacing-md);">
                    <a href="{{ route('product.show', $item['slug']) }}"
                        style="text-decoration: none; color: var(--color-text-primary); display: block;">
                        <h3 style="font-size: var(--font-size-base); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-sm); line-height: var(--line-height-tight);
                            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $item['name'] }}
                        </h3>
                    </a>

                    <!-- Price -->
                    <div style="display: flex; align-items: center; gap: var(--spacing-sm); margin-bottom: var(--spacing-md);">
                        @if(isset($item['discount_price']) && $item['discount_price'] && $item['discount_price'] < $item['price'])
                        <span style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-accent);">
                            ${{ number_format($item['discount_price'], 2) }}
                        </span>
                        <span style="font-size: var(--font-size-sm); color: var(--color-text-muted); text-decoration: line-through;">
                            ${{ number_format($item['price'], 2) }}
                        </span>
                        <span style="background: var(--color-accent); color: var(--color-primary); padding: 2px 8px; border-radius: var(--radius-full); font-size: var(--font-size-xs); font-weight: var(--font-weight-bold);">
                            {{ round((($item['price'] - $item['discount_price']) / $item['price']) * 100) }}% OFF
                        </span>
                        @else
                        <span style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-text-primary);">
                            ${{ number_format($item['price'], 2) }}
                        </span>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div style="display: flex; gap: var(--spacing-sm);">
                        @if(isset($item['stock_qty']) && $item['stock_qty'] > 0)
                        <button onclick="addToCart({{ $item['id'] }}, '{{ addslashes($item['name']) }}', {{ $item['price'] }})"
                            style="flex: 1; background: var(--color-accent); color: var(--color-primary); border: none; padding: 10px; border-radius: var(--radius-md); cursor: pointer; font-weight: var(--font-weight-semibold); transition: all var(--transition-fast); display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm);"
                            onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='var(--shadow-md)'"
                            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                        @else
                        <button disabled
                            style="flex: 1; background: var(--color-border-light); color: var(--color-text-muted); border: none; padding: 10px; border-radius: var(--radius-md); cursor: not-allowed; font-weight: var(--font-weight-semibold); display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm);">
                            <i class="fas fa-times"></i> Out of Stock
                        </button>
                        @endif
                    </div>

                    <!-- Added Date -->
                    <div style="margin-top: var(--spacing-sm); font-size: var(--font-size-xs); color: var(--color-text-muted); display: flex; align-items: center; gap: var(--spacing-xs);">
                        <i class="far fa-clock"></i>
                        Added {{ \Carbon\Carbon::parse($item['added_at'])->diffForHumans() }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Mobile Action Buttons -->
        <div style="margin-top: var(--spacing-xl); display: flex; flex-direction: column; gap: var(--spacing-sm);">
            <a href="{{ route('shop') }}"
                style="display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm); background: var(--color-primary); color: white; padding: 14px; border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-semibold); text-align: center;">
                <i class="fas fa-shopping-bag"></i> Continue Shopping
            </a>
            <button onclick="clearWishlist()"
                style="display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm); background: transparent; color: var(--color-error); border: 2px solid var(--color-error); padding: 14px; border-radius: var(--radius-md); cursor: pointer; font-weight: var(--font-weight-semibold); transition: all var(--transition-fast);"
                onmouseover="this.style.background='var(--color-error)'; this.style.color='white'"
                onmouseout="this.style.background='transparent'; this.style.color='var(--color-error)'">
                <i class="fas fa-trash"></i> Clear All Wishlist
            </button>
        </div>

        @else
        <!-- Empty Wishlist State -->
        <div style="text-align: center; padding: var(--spacing-3xl) 0; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <div style="font-size: 80px; color: var(--color-border-light); margin-bottom: var(--spacing-lg);">
                <i class="far fa-heart"></i>
            </div>
            <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-md); color: var(--color-text-primary);">
                Your Wishlist is Empty
            </h2>
            <p style="color: var(--color-text-muted); max-width: 400px; margin: 0 auto var(--spacing-xl); line-height: var(--line-height-loose);">
                Start exploring our products and save your favorites to your wishlist.
                You'll find something you love!
            </p>
            <div style="display: flex; gap: var(--spacing-md); justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('shop') }}"
                    style="background: var(--color-accent); color: var(--color-primary); padding: 14px 40px; border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-bold); display: inline-flex; align-items: center; gap: var(--spacing-sm); transition: all var(--transition-fast);"
                    onmouseover="this.style.transform='scale(1.05)'"
                    onmouseout="this.style.transform='scale(1)'">
                    <i class="fas fa-shopping-bag"></i> Start Shopping
                </a>
                <a href="{{ route('categories') }}"
                    style="background: var(--color-primary); color: white; padding: 14px 40px; border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-semibold); display: inline-flex; align-items: center; gap: var(--spacing-sm); transition: all var(--transition-fast);"
                    onmouseover="this.style.transform='scale(1.05)'"
                    onmouseout="this.style.transform='scale(1)'">
                    <i class="fas fa-th-large"></i> Browse Categories
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // ============================================
    // REMOVE FROM WISHLIST - FIXED VERSION
    // ============================================
    function removeFromWishlist(productId, button) {
        if (!confirm('Are you sure you want to remove this item from your wishlist?')) {
            return;
        }

        // Disable button
        button.disabled = true;
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
        button.style.opacity = '0.6';

        // FIXED: Build URL correctly using route helper with parameter
        const url = '{{ route("wishlist.remove", ":id") }}'.replace(':id', productId);

        fetch(url, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the item card with animation
                const itemCard = button.closest('.wishlist-item');
                if (itemCard) {
                    itemCard.style.transition = 'all 0.3s ease';
                    itemCard.style.transform = 'scale(0.8)';
                    itemCard.style.opacity = '0';
                    setTimeout(() => {
                        itemCard.remove();
                        // Update count
                        updateWishlistUI(data.wishlist_count);
                        showToast('success', data.message);

                        // If no items left, reload page to show empty state
                        if (data.wishlist_count === 0) {
                            setTimeout(() => window.location.reload(), 500);
                        }
                    }, 300);
                }
            } else {
                showToast('error', data.message || 'Failed to remove item');
                button.disabled = false;
                button.innerHTML = '<i class="fas fa-times"></i>';
                button.style.opacity = '1';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Something went wrong');
            button.disabled = false;
            button.innerHTML = '<i class="fas fa-times"></i>';
            button.style.opacity = '1';
        });
    }

    // ============================================
    // CLEAR WISHLIST - FIXED VERSION
    // ============================================
    function clearWishlist() {
        if (!confirm('Are you sure you want to clear your entire wishlist?')) {
            return;
        }

        fetch('{{ route('wishlist.clear') }}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove all items with animation
                const items = document.querySelectorAll('.wishlist-item');

                if (items.length === 0) {
                    updateWishlistUI(0);
                    showToast('success', data.message);
                    setTimeout(() => window.location.reload(), 500);
                    return;
                }

                items.forEach((item, index) => {
                    setTimeout(() => {
                        item.style.transition = 'all 0.3s ease';
                        item.style.transform = 'scale(0.8)';
                        item.style.opacity = '0';
                        setTimeout(() => item.remove(), 300);
                    }, index * 100);
                });

                setTimeout(() => {
                    updateWishlistUI(0);
                    showToast('success', data.message);
                    // Reload page after clearing
                    setTimeout(() => window.location.reload(), 1000);
                }, items.length * 100 + 500);
            } else {
                showToast('error', data.message || 'Failed to clear wishlist');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Something went wrong');
        });
    }

    // ============================================
    // ADD TO CART - FIXED VERSION
    // ============================================
    function addToCart(productId, productName, price) {
        // Show loading state
        const button = event && event.target ? event.target.closest('button') : null;
        let originalText = '';

        if (button) {
            originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            button.disabled = true;
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
                quantity: 1
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update cart count in navbar
                const cartCount = document.getElementById('cartCount');
                if (cartCount) {
                    cartCount.textContent = data.cart_count || (parseInt(cartCount.textContent) + 1);
                }

                showToast('success', `${productName} added to cart!`);

                // Reset button
                if (button) {
                    button.innerHTML = '<i class="fas fa-check"></i> Added!';
                    button.style.background = 'var(--color-success)';
                    setTimeout(() => {
                        button.innerHTML = originalText;
                        button.disabled = false;
                        button.style.background = '';
                    }, 2000);
                }
            } else {
                showToast('error', data.message || 'Failed to add to cart');
                if (button) {
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('error', 'Something went wrong');
            if (button) {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        });
    }

    // ============================================
    // UPDATE WISHLIST UI
    // ============================================
    function updateWishlistUI(count) {
        // Update navbar wishlist count
        const wishlistCount = document.getElementById('wishlistCount');
        if (wishlistCount) {
            wishlistCount.textContent = count;
            if (count === 0) {
                wishlistCount.style.display = 'none';
            } else {
                wishlistCount.style.display = 'inline';
            }
        }

        // Update mobile wishlist count
        const mobileWishlistCount = document.getElementById('mobileWishlistCount');
        if (mobileWishlistCount) {
            mobileWishlistCount.textContent = count;
            if (count === 0) {
                mobileWishlistCount.style.display = 'none';
            } else {
                mobileWishlistCount.style.display = 'inline';
            }
        }

        // Update page header count
        const countElement = document.querySelector('.wishlist-count');
        if (countElement) {
            countElement.textContent = count;
        }

        // Update the header count text
        const headerCount = document.querySelector('h1 span');
        if (headerCount) {
            headerCount.textContent = `(${count} items)`;
        }
    }

    // ============================================
    // TOAST NOTIFICATION
    // ============================================
    function showToast(type, message) {
        const existingToast = document.querySelector('.toast-notification');
        if (existingToast) {
            existingToast.remove();
        }

        const toast = document.createElement('div');
        toast.className = 'toast-notification';

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

        setTimeout(() => {
            if (toast.parentElement) {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }
        }, 5000);
    }
</script>

<style>
    /* Additional styles */
    .wishlist-item {
        transition: all 0.3s ease;
    }

    .wishlist-item:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,0.15) !important;
    }

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

    @media (max-width: 640px) {
        .wishlist-items-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>
@endpush
