<!-- resources/views/components/navbar.blade.php -->
<nav
    style="background: var(--color-bg-header); color: var(--color-text-light); padding: 0 var(--container-padding); height: var(--header-height); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: var(--z-header); box-shadow: var(--shadow-md);">

    <!-- Logo -->
    <a href="/"
        style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-text-light); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-sm);">
        <i class="fas fa-store" style="color: var(--color-accent);"></i>
        OrviBazar
    </a>

    <!-- Search Bar -->
    <div
        style="flex: 1; max-width: 500px; margin: 0 var(--spacing-xl); display: flex; align-items: center; background: var(--color-primary-light); border-radius: var(--radius-full); overflow: hidden; transition: all var(--transition-base);">
        <input id="searchInput" type="text" placeholder="Search products..."
            style="flex: 1; padding: 10px 20px; background: transparent; border: none; color: var(--color-text-light); font-size: var(--font-size-sm); outline: none;">
        <button id="searchBtn"
            style="padding: 10px 20px; background: var(--color-accent); border: none; color: var(--color-primary); cursor: pointer; transition: background var(--transition-fast);">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Navigation Links -->
    <div style="display: flex; align-items: center; gap: var(--spacing-lg);">
        <!-- Categories Dropdown -->
        <div style="position: relative;" id="categoriesDropdown">
            <button id="categoriesToggle"
                style="background: transparent; border: none; color: var(--color-text-light); cursor: pointer; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-xs); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: background var(--transition-fast);"
                onmouseover="this.style.background='var(--color-primary-light)'"
                onmouseout="this.style.background='transparent'">
                <i class="fas fa-bars"></i>
                Categories
                <i class="fas fa-chevron-down"
                    style="font-size: var(--font-size-xs); transition: transform var(--transition-fast);"
                    id="categoriesArrow"></i>
            </button>

            <!-- Dropdown Menu - DYNAMIC -->
            <div id="categoriesMenu"
                style="display: none; position: absolute; top: 100%; left: 0; min-width: 260px; background: white; border-radius: var(--radius-md); box-shadow: var(--shadow-lg); padding: var(--spacing-sm) 0; margin-top: var(--spacing-xs); z-index: var(--z-dropdown); opacity: 0; transform: translateY(-10px); transition: all var(--transition-base);">
                <div
                    style="padding: var(--spacing-xs) var(--spacing-lg); border-bottom: 1px solid var(--color-border-light);">
                    <input type="text" id="categorySearch" placeholder="Search categories..."
                        style="width: 100%; padding: 6px 12px; border: 1px solid var(--color-border-light); border-radius: var(--radius-sm); font-size: var(--font-size-sm); outline: none;">
                </div>
                <div id="categoryList">
                    @php
                        $categories = \App\Models\Category::where('is_active', true)
                            ->withCount('products')
                            ->get();
                    @endphp

                    @forelse($categories as $category)
                        <a href="{{ route('category.show', $category->slug) }}" data-category="{{ $category->slug }}"
                            style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);"
                            onmouseover="this.style.background='var(--color-off-white)'; this.style.paddingLeft='calc(var(--spacing-lg) + 8px)'"
                            onmouseout="this.style.background='transparent'; this.style.paddingLeft='var(--spacing-lg)'">
                            <i class="fas {{ $category->icon ?? 'fa-tag' }}" style="margin-right: var(--spacing-sm); width: 20px;"></i>
                            {{ $category->name }}
                            <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">
                                ({{ $category->products_count }})
                            </span>
                        </a>
                    @empty
                        <div style="padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-muted); text-align: center;">
                            No categories found
                        </div>
                    @endforelse

                    <div style="border-top: 1px solid var(--color-border-light); margin: var(--spacing-xs) 0;"></div>
                    <a href="{{ route('categories') }}"
                        style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-accent); text-decoration: none; font-weight: var(--font-weight-medium); transition: all var(--transition-fast);"
                        onmouseover="this.style.background='var(--color-off-white)'; this.style.paddingLeft='calc(var(--spacing-lg) + 8px)'"
                        onmouseout="this.style.background='transparent'; this.style.paddingLeft='var(--spacing-lg)'">
                        <i class="fas fa-arrow-right" style="margin-right: var(--spacing-sm);"></i> View All Categories
                    </a>
                </div>
            </div>
        </div>

        <!-- Wishlist -->
        <a href="{{ route('wishlist.index') }}"
            style="color: var(--color-text-light); text-decoration: none; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-xs); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: background var(--transition-fast); position: relative;"
            onmouseover="this.style.background='var(--color-primary-light)'"
            onmouseout="this.style.background='transparent'">
            <i class="fas fa-heart"></i>
            <span id="wishlistCount"
                style="position: absolute; top: -5px; right: -5px; background: var(--color-accent); color: var(--color-primary); border-radius: var(--radius-full); font-size: 10px; padding: 2px 6px; font-weight: var(--font-weight-bold);">
                {{ count(Session::get('wishlist', [])) }}
            </span>
        </a>

        <!-- Cart -->
        <button id="cartToggle" onclick="toggleCart()"
            style="background: var(--color-accent); border: none; color: var(--color-primary); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); cursor: pointer; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-sm); font-weight: var(--font-weight-medium); transition: all var(--transition-base); position: relative;">
            <i class="fas fa-shopping-cart"></i>
            <span id="cartCount"
                style="background: var(--color-primary); color: var(--color-text-light); border-radius: var(--radius-full); padding: 0 8px; font-size: 12px;">2</span>
        </button>

        <!-- Guest User Actions -->
        <div style="display: flex; align-items: center; gap: var(--spacing-sm);">
            <!-- Login Button -->
            <a href="{{route('login')}}"
                style="color: var(--color-text-light); text-decoration: none; font-size: var(--font-size-sm); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: all var(--transition-fast); display: flex; align-items: center; gap: var(--spacing-xs);"
                onmouseover="this.style.background='var(--color-primary-light)'"
                onmouseout="this.style.background='transparent'">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>

            <!-- Register Button -->
            <a href="{{ route('option') }}"
                style="background: var(--color-accent); color: var(--color-primary); padding: var(--spacing-sm) var(--spacing-lg); border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-semibold); font-size: var(--font-size-sm); transition: all var(--transition-base); display: flex; align-items: center; gap: var(--spacing-xs);"
                onmouseover="this.style.background='var(--color-accent-hover)'; this.style.transform='scale(1.05)'"
                onmouseout="this.style.background='var(--color-accent)'; this.style.transform='scale(1)'">
                <i class="fas fa-user-plus"></i> Sign Up
            </a>
        </div>
    </div>

    <!-- Mobile Menu Toggle -->
    <button id="mobileToggle"
        style="display: none; background: transparent; border: none; color: var(--color-text-light); font-size: var(--font-size-xl); cursor: pointer;">
        <i class="fas fa-bars"></i>
    </button>
</nav>

<!-- Mobile Menu -->
<div id="mobileMenu"
    style="display: none; background: var(--color-primary); padding: var(--spacing-lg); position: fixed; top: var(--header-height); left: 0; width: 100%; height: calc(100vh - var(--header-height)); z-index: var(--z-dropdown); overflow-y: auto;">
    <div style="display: flex; flex-direction: column; gap: var(--spacing-md);">
        <!-- Mobile Search -->
        <div
            style="display: flex; background: var(--color-primary-light); border-radius: var(--radius-full); overflow: hidden;">
            <input id="mobileSearchInput" type="text" placeholder="Search..."
                style="flex: 1; padding: 12px 20px; background: transparent; border: none; color: var(--color-text-light); outline: none;">
            <button id="mobileSearchBtn"
                style="padding: 12px 20px; background: var(--color-accent); border: none; color: var(--color-primary);">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Mobile Categories - DYNAMIC -->
        <div>
            <button id="mobileCategoriesToggle"
                style="width: 100%; background: var(--color-primary-light); border: none; color: var(--color-text-light); padding: var(--spacing-sm); border-radius: var(--radius-md); cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-size: var(--font-size-base);">
                <span><i class="fas fa-bars" style="margin-right: var(--spacing-sm);"></i> Categories</span>
                <i class="fas fa-chevron-down" id="mobileCategoriesArrow"
                    style="transition: transform var(--transition-fast);"></i>
            </button>
            <div id="mobileCategoriesList" style="display: none; margin-top: var(--spacing-sm);">
                @php
                    $mobileCategories = \App\Models\Category::where('is_active', true)
                        ->withCount('products')
                        ->limit(10)
                        ->get();
                @endphp

                @forelse($mobileCategories as $category)
                    <a href="{{ route('category.show', $category->slug) }}"
                        style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                        <i class="fas {{ $category->icon ?? 'fa-tag' }}" style="margin-right: var(--spacing-sm);"></i>
                        {{ $category->name }}
                        <span style="float: right; font-size: var(--font-size-xs); opacity: 0.7;">({{ $category->products_count }})</span>
                    </a>
                @empty
                    <div style="color: var(--color-text-light); padding: var(--spacing-sm); text-align: center;">
                        No categories found
                    </div>
                @endforelse

                <a href="{{ route('categories') }}"
                    style="display: block; color: var(--color-accent); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); margin-top: var(--spacing-xs); background: var(--color-primary-light); border-radius: var(--radius-md); text-align: center; font-weight: var(--font-weight-semibold);">
                    <i class="fas fa-arrow-right" style="margin-right: var(--spacing-sm);"></i> View All Categories
                </a>
            </div>
        </div>

        <a href="{{ route('wishlist.index') }}"
            style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
            <i class="fas fa-heart" style="margin-right: var(--spacing-sm);"></i> Wishlist
            <span id="mobileWishlistCount"
                style="float: right; background: var(--color-accent); color: var(--color-primary); border-radius: var(--radius-full); font-size: 10px; padding: 2px 8px; font-weight: var(--font-weight-bold);">
                {{ count(Session::get('wishlist', [])) }}
            </span>
        </a>
        <a href="/cart"
            style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
            <i class="fas fa-shopping-cart" style="margin-right: var(--spacing-sm);"></i> Cart
        </a>

        <!-- Guest Mobile Actions -->
        <div style="border-top: 1px solid var(--color-primary-light); padding-top: var(--spacing-md);">
            <a href="{{route('login')}}"
                style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
                <i class="fas fa-sign-in-alt" style="margin-right: var(--spacing-sm);"></i> Login
            </a>
            <a href="{{ route('option') }}"
                style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; background: var(--color-accent); color: var(--color-primary); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); margin-top: var(--spacing-sm); text-align: center; font-weight: var(--font-weight-semibold);">
                <i class="fas fa-user-plus" style="margin-right: var(--spacing-sm);"></i> Sign Up
            </a>
        </div>
    </div>
</div>

<!-- Cart Sidebar -->
<div id="cartSidebar"
    style="position: fixed; top: 0; right: -400px; width: 380px; height: 100vh; background: white; box-shadow: var(--shadow-xl); z-index: var(--z-cart-sidebar); transition: right var(--transition-base); padding: var(--spacing-lg); display: flex; flex-direction: column;">
    <div
        style="display: flex; justify-content: space-between; align-items: center; padding-bottom: var(--spacing-md); border-bottom: 1px solid var(--color-border-light);">
        <h3 style="font-size: var(--font-size-lg);">
            <i class="fas fa-shopping-cart" style="color: var(--color-accent);"></i> Your Cart
        </h3>
        <button onclick="toggleCart()"
            style="background: none; border: none; font-size: var(--font-size-xl); cursor: pointer;">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div id="cartItems" style="flex: 1; overflow-y: auto; padding: var(--spacing-md) 0;">
        <div id="emptyCart"
            style="text-align: center; padding: var(--spacing-2xl) 0; color: var(--color-text-muted);">
            <i class="fas fa-shopping-basket"
                style="font-size: 48px; margin-bottom: var(--spacing-md); display: block;"></i>
            <p>Your cart is empty</p>
        </div>
        <div id="cartItemsList" style="display: none;"></div>
    </div>
    <div id="cartFooter"
        style="padding-top: var(--spacing-md); border-top: 2px solid var(--color-border-light); display: none;">
        <div
            style="display: flex; justify-content: space-between; font-size: var(--font-size-lg); font-weight: var(--font-weight-bold);">
            <span>Total</span>
            <span id="cartTotal">$0.00</span>
        </div>
        <button onclick="window.location.href='/login'"
            style="width: 100%; margin-top: var(--spacing-md); background: var(--color-accent); color: var(--color-primary); border: none; padding: 12px; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-base);">
            <i class="fas fa-lock"></i> Login to Checkout
        </button>
    </div>
</div>

<!-- Overlay -->
<div id="cartOverlay"
    style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: var(--z-overlay); opacity: 0; visibility: hidden; transition: all var(--transition-base);"
    onclick="toggleCart()"></div>

<script>
    // ============================================
    // CATEGORIES DROPDOWN - UPDATED FOR DYNAMIC
    // ============================================
    document.addEventListener('DOMContentLoaded', function() {
        const categoriesToggle = document.getElementById('categoriesToggle');
        const categoriesMenu = document.getElementById('categoriesMenu');
        const categoriesArrow = document.getElementById('categoriesArrow');
        const categorySearch = document.getElementById('categorySearch');
        const categoryLinks = document.querySelectorAll('#categoryList a[data-category]');
        let isCategoriesOpen = false;

        // Toggle categories dropdown
        categoriesToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            isCategoriesOpen = !isCategoriesOpen;
            toggleCategoriesMenu(isCategoriesOpen);
        });

        function toggleCategoriesMenu(open) {
            if (open) {
                categoriesMenu.style.display = 'block';
                setTimeout(() => {
                    categoriesMenu.style.opacity = '1';
                    categoriesMenu.style.transform = 'translateY(0)';
                }, 10);
                categoriesArrow.style.transform = 'rotate(180deg)';
            } else {
                categoriesMenu.style.opacity = '0';
                categoriesMenu.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    categoriesMenu.style.display = 'none';
                }, 300);
                categoriesArrow.style.transform = 'rotate(0deg)';
            }
        }

        // Search categories
        categorySearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            categoryLinks.forEach(link => {
                const text = link.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    link.style.display = 'block';
                } else {
                    link.style.display = 'none';
                }
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('categoriesDropdown');
            if (!dropdown.contains(e.target) && isCategoriesOpen) {
                toggleCategoriesMenu(false);
                isCategoriesOpen = false;
            }
        });

        // Close dropdown on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isCategoriesOpen) {
                toggleCategoriesMenu(false);
                isCategoriesOpen = false;
            }
        });

        // ============================================
        // MOBILE MENU
        // ============================================
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileCategoriesToggle = document.getElementById('mobileCategoriesToggle');
        const mobileCategoriesList = document.getElementById('mobileCategoriesList');
        const mobileCategoriesArrow = document.getElementById('mobileCategoriesArrow');
        let isMobileMenuOpen = false;
        let isMobileCategoriesOpen = false;

        if (mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                isMobileMenuOpen = !isMobileMenuOpen;
                mobileMenu.style.display = isMobileMenuOpen ? 'block' : 'none';
                document.body.style.overflow = isMobileMenuOpen ? 'hidden' : '';
            });
        }

        if (mobileCategoriesToggle) {
            mobileCategoriesToggle.addEventListener('click', function() {
                isMobileCategoriesOpen = !isMobileCategoriesOpen;
                mobileCategoriesList.style.display = isMobileCategoriesOpen ? 'block' : 'none';
                mobileCategoriesArrow.style.transform = isMobileCategoriesOpen ? 'rotate(180deg)' : 'rotate(0deg)';
            });
        }

        // Mobile search
        const mobileSearchBtn = document.getElementById('mobileSearchBtn');
        const mobileSearchInput = document.getElementById('mobileSearchInput');

        if (mobileSearchBtn && mobileSearchInput) {
            mobileSearchBtn.addEventListener('click', function() {
                const query = mobileSearchInput.value;
                if (query.trim()) {
                    window.location.href = '/shop?search=' + encodeURIComponent(query);
                }
            });

            mobileSearchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    mobileSearchBtn.click();
                }
            });
        }

        // ============================================
        // SEARCH FUNCTIONALITY
        // ============================================
        const searchBtn = document.getElementById('searchBtn');
        const searchInput = document.getElementById('searchInput');

        if (searchBtn && searchInput) {
            searchBtn.addEventListener('click', function() {
                const query = searchInput.value;
                if (query.trim()) {
                    window.location.href = '/shop?search=' + encodeURIComponent(query);
                }
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchBtn.click();
                }
            });
        }

        // ============================================
        // CART FUNCTIONALITY
        // ============================================
        window.toggleCart = function() {
            const cart = document.getElementById('cartSidebar');
            const overlay = document.getElementById('cartOverlay');
            if (!cart || !overlay) return;

            const isOpen = cart.style.right === '0px';

            if (isOpen) {
                cart.style.right = '-400px';
                overlay.style.opacity = '0';
                overlay.style.visibility = 'hidden';
                document.body.style.overflow = '';
            } else {
                cart.style.right = '0px';
                overlay.style.opacity = '1';
                overlay.style.visibility = 'visible';
                document.body.style.overflow = 'hidden';
            }
        };

        // Close cart with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const cart = document.getElementById('cartSidebar');
                if (cart && cart.style.right === '0px') {
                    toggleCart();
                }
            }
        });

        // ============================================
        // RESPONSIVE HANDLING
        // ============================================
        function handleResponsive() {
            const mobileToggle = document.getElementById('mobileToggle');
            const searchBar = document.querySelector('nav > div:nth-child(2)');
            const guestActions = document.querySelector('.guest-actions');

            if (window.innerWidth <= 768) {
                if (mobileToggle) mobileToggle.style.display = 'block';
                if (searchBar) searchBar.style.display = 'none';
                const categoriesDropdown = document.getElementById('categoriesDropdown');
                if (categoriesDropdown) categoriesDropdown.style.display = 'none';
                if (guestActions) guestActions.style.display = 'none';
            } else {
                if (mobileToggle) mobileToggle.style.display = 'none';
                if (searchBar) searchBar.style.display = 'flex';
                const categoriesDropdown = document.getElementById('categoriesDropdown');
                if (categoriesDropdown) categoriesDropdown.style.display = 'block';
                if (guestActions) guestActions.style.display = 'flex';
                if (isMobileMenuOpen) {
                    mobileMenu.style.display = 'none';
                    isMobileMenuOpen = false;
                    document.body.style.overflow = '';
                }
            }
        }

        window.addEventListener('resize', handleResponsive);
        handleResponsive();
    });
</script>

<style>
    /* Category dropdown hover effects */
    #categoryList a:hover {
        background: var(--color-off-white);
        padding-left: calc(var(--spacing-lg) + 8px);
    }

    #categoryList a:active {
        background: var(--color-accent);
        color: var(--color-primary);
    }

    /* Cart sidebar scrollbar */
    #cartItems::-webkit-scrollbar {
        width: 4px;
    }

    #cartItems::-webkit-scrollbar-track {
        background: var(--color-off-white);
    }

    #cartItems::-webkit-scrollbar-thumb {
        background: var(--color-mid-gray);
        border-radius: var(--radius-full);
    }

    /* Mobile menu animations */
    #mobileMenu {
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        #cartSidebar {
            width: 100%;
            right: -100%;
        }
    }
</style>
