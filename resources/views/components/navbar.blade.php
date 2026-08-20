{{-- <!-- resources/views/components/navbar.blade.php -->
<nav style="background: var(--color-bg-header); color: var(--color-text-light); padding: 0 var(--container-padding); height: var(--header-height); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: var(--z-header); box-shadow: var(--shadow-md);">

    <!-- Logo -->
    <a href="#" style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-text-light); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-sm);">
        <i class="fas fa-store" style="color: var(--color-accent);"></i>
        OrviBazar
    </a>

    <!-- Search Bar -->
    <div style="flex: 1; max-width: 500px; margin: 0 var(--spacing-xl); display: flex; align-items: center; background: var(--color-primary-light); border-radius: var(--radius-full); overflow: hidden; transition: all var(--transition-base);">
        <input id="searchInput" type="text" placeholder="Search products..." style="flex: 1; padding: 10px 20px; background: transparent; border: none; color: var(--color-text-light); font-size: var(--font-size-sm); outline: none;">
        <button id="searchBtn" style="padding: 10px 20px; background: var(--color-accent); border: none; color: var(--color-primary); cursor: pointer; transition: background var(--transition-fast);">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Navigation Links -->
    <div style="display: flex; align-items: center; gap: var(--spacing-lg);">
        <!-- Categories Dropdown -->
        <div style="position: relative;" id="categoriesDropdown">
            <button id="categoriesToggle" style="background: transparent; border: none; color: var(--color-text-light); cursor: pointer; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-xs); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: background var(--transition-fast);" onmouseover="this.style.background='var(--color-primary-light)'" onmouseout="this.style.background='transparent'">
                <i class="fas fa-bars"></i>
                Categories
                <i class="fas fa-chevron-down" style="font-size: var(--font-size-xs); transition: transform var(--transition-fast);" id="categoriesArrow"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="categoriesMenu" style="display: none; position: absolute; top: 100%; left: 0; min-width: 260px; background: white; border-radius: var(--radius-md); box-shadow: var(--shadow-lg); padding: var(--spacing-sm) 0; margin-top: var(--spacing-xs); z-index: var(--z-dropdown); opacity: 0; transform: translateY(-10px); transition: all var(--transition-base);">
                <div style="padding: var(--spacing-xs) var(--spacing-lg); border-bottom: 1px solid var(--color-border-light);">
                    <input type="text" id="categorySearch" placeholder="Search categories..." style="width: 100%; padding: 6px 12px; border: 1px solid var(--color-border-light); border-radius: var(--radius-sm); font-size: var(--font-size-sm); outline: none;">
                </div>
                <div id="categoryList">
                    <a href="#" data-category="electronics" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-laptop" style="margin-right: var(--spacing-sm); width: 20px;"></i> Electronics <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(234)</span>
                    </a>
                    <a href="#" data-category="fashion" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-tshirt" style="margin-right: var(--spacing-sm); width: 20px;"></i> Fashion <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(156)</span>
                    </a>
                    <a href="#" data-category="home" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-home" style="margin-right: var(--spacing-sm); width: 20px;"></i> Home & Living <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(89)</span>
                    </a>
                    <a href="#" data-category="beauty" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-spa" style="margin-right: var(--spacing-sm); width: 20px;"></i> Beauty <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(67)</span>
                    </a>
                    <a href="#" data-category="sports" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-dumbbell" style="margin-right: var(--spacing-sm); width: 20px;"></i> Sports <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(45)</span>
                    </a>
                    <a href="#" data-category="books" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-book" style="margin-right: var(--spacing-sm); width: 20px;"></i> Books <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(123)</span>
                    </a>
                    <a href="#" data-category="toys" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-gamepad" style="margin-right: var(--spacing-sm); width: 20px;"></i> Toys & Games <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(78)</span>
                    </a>
                    <a href="#" data-category="automotive" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-car" style="margin-right: var(--spacing-sm); width: 20px;"></i> Automotive <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(34)</span>
                    </a>
                    <div style="border-top: 1px solid var(--color-border-light); margin: var(--spacing-xs) 0;"></div>
                    <a href="#" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-accent); text-decoration: none; font-weight: var(--font-weight-medium); transition: all var(--transition-fast);">
                        <i class="fas fa-arrow-right" style="margin-right: var(--spacing-sm);"></i> View All Categories
                    </a>
                </div>
            </div>
        </div>

        <!-- Wishlist -->
        <a href="#" style="color: var(--color-text-light); text-decoration: none; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-xs); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: background var(--transition-fast); position: relative;" onmouseover="this.style.background='var(--color-primary-light)'" onmouseout="this.style.background='transparent'">
            <i class="fas fa-heart"></i>
            <span id="wishlistCount" style="position: absolute; top: -5px; right: -5px; background: var(--color-accent); color: var(--color-primary); border-radius: var(--radius-full); font-size: 10px; padding: 2px 6px; font-weight: var(--font-weight-bold);">3</span>
        </a>

        <!-- Cart -->
        <button id="cartToggle" onclick="toggleCart()" style="background: var(--color-accent); border: none; color: var(--color-primary); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); cursor: pointer; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-sm); font-weight: var(--font-weight-medium); transition: all var(--transition-base); position: relative;">
            <i class="fas fa-shopping-cart"></i>
            <span id="cartCount" style="background: var(--color-primary); color: var(--color-text-light); border-radius: var(--radius-full); padding: 0 8px; font-size: 12px;">2</span>
        </button>

        <!-- User -->
        <div style="position: relative;" id="userDropdown">
            <button id="userToggle" style="background: transparent; border: none; color: var(--color-text-light); cursor: pointer; display: flex; align-items: center; gap: var(--spacing-sm); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: background var(--transition-fast);" onmouseover="this.style.background='var(--color-primary-light)'" onmouseout="this.style.background='transparent'">
                <i class="fas fa-user-circle" style="font-size: var(--font-size-xl);"></i>
                <span style="font-size: var(--font-size-sm);">Account</span>
                <i class="fas fa-chevron-down" style="font-size: var(--font-size-xs); transition: transform var(--transition-fast);" id="userArrow"></i>
            </button>

            <!-- User Dropdown Menu -->
            <div id="userMenu" style="display: none; position: absolute; top: 100%; right: 0; min-width: 220px; background: white; border-radius: var(--radius-md); box-shadow: var(--shadow-lg); padding: var(--spacing-sm) 0; margin-top: var(--spacing-xs); z-index: var(--z-dropdown); opacity: 0; transform: translateY(-10px); transition: all var(--transition-base);">
                <a href="#" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: background var(--transition-fast);">
                    <i class="fas fa-user" style="margin-right: var(--spacing-sm); width: 20px;"></i> My Profile
                </a>
                <a href="#" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: background var(--transition-fast);">
                    <i class="fas fa-box" style="margin-right: var(--spacing-sm); width: 20px;"></i> My Orders
                </a>
                <a href="#" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: background var(--transition-fast);">
                    <i class="fas fa-heart" style="margin-right: var(--spacing-sm); width: 20px;"></i> Wishlist
                </a>
                <a href="#" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: background var(--transition-fast);">
                    <i class="fas fa-map-marker-alt" style="margin-right: var(--spacing-sm); width: 20px;"></i> Addresses
                </a>
                <div style="border-top: 1px solid var(--color-border-light); margin: var(--spacing-xs) 0;"></div>
                <a href="#" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-error); text-decoration: none; transition: background var(--transition-fast);">
                    <i class="fas fa-sign-out-alt" style="margin-right: var(--spacing-sm); width: 20px;"></i> Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Toggle -->
    <button id="mobileToggle" style="display: none; background: transparent; border: none; color: var(--color-text-light); font-size: var(--font-size-xl); cursor: pointer;">
        <i class="fas fa-bars"></i>
    </button>
</nav>

<!-- Mobile Menu -->
<div id="mobileMenu" style="display: none; background: var(--color-primary); padding: var(--spacing-lg); position: fixed; top: var(--header-height); left: 0; width: 100%; height: calc(100vh - var(--header-height)); z-index: var(--z-dropdown); overflow-y: auto;">
    <div style="display: flex; flex-direction: column; gap: var(--spacing-md);">
        <!-- Mobile Search -->
        <div style="display: flex; background: var(--color-primary-light); border-radius: var(--radius-full); overflow: hidden;">
            <input id="mobileSearchInput" type="text" placeholder="Search..." style="flex: 1; padding: 12px 20px; background: transparent; border: none; color: var(--color-text-light); outline: none;">
            <button id="mobileSearchBtn" style="padding: 12px 20px; background: var(--color-accent); border: none; color: var(--color-primary);">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Mobile Categories -->
        <div>
            <button id="mobileCategoriesToggle" style="width: 100%; background: var(--color-primary-light); border: none; color: var(--color-text-light); padding: var(--spacing-sm); border-radius: var(--radius-md); cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-size: var(--font-size-base);">
                <span><i class="fas fa-bars" style="margin-right: var(--spacing-sm);"></i> Categories</span>
                <i class="fas fa-chevron-down" id="mobileCategoriesArrow" style="transition: transform var(--transition-fast);"></i>
            </button>
            <div id="mobileCategoriesList" style="display: none; margin-top: var(--spacing-sm);">
                <a href="#" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-laptop" style="margin-right: var(--spacing-sm);"></i> Electronics
                </a>
                <a href="#" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-tshirt" style="margin-right: var(--spacing-sm);"></i> Fashion
                </a>
                <a href="#" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-home" style="margin-right: var(--spacing-sm);"></i> Home & Living
                </a>
                <a href="#" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-spa" style="margin-right: var(--spacing-sm);"></i> Beauty
                </a>
                <a href="#" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md);">
                    <i class="fas fa-arrow-right" style="margin-right: var(--spacing-sm);"></i> View All
                </a>
            </div>
        </div>

        <a href="#" style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
            <i class="fas fa-heart" style="margin-right: var(--spacing-sm);"></i> Wishlist
        </a>
        <a href="#" style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
            <i class="fas fa-shopping-cart" style="margin-right: var(--spacing-sm);"></i> Cart
        </a>
        <a href="#" style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
            <i class="fas fa-user" style="margin-right: var(--spacing-sm);"></i> Profile
        </a>
        <a href="#" style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
            <i class="fas fa-box" style="margin-right: var(--spacing-sm);"></i> Orders
        </a>
        <a href="#" style="color: var(--color-error); text-decoration: none; padding: var(--spacing-sm) 0;">
            <i class="fas fa-sign-out-alt" style="margin-right: var(--spacing-sm);"></i> Logout
        </a>
    </div>
</div>

<!-- Cart Sidebar -->
<div id="cartSidebar" style="position: fixed; top: 0; right: -400px; width: 380px; height: 100vh; background: white; box-shadow: var(--shadow-xl); z-index: var(--z-cart-sidebar); transition: right var(--transition-base); padding: var(--spacing-lg); display: flex; flex-direction: column;">
    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: var(--spacing-md); border-bottom: 1px solid var(--color-border-light);">
        <h3 style="font-size: var(--font-size-lg);">
            <i class="fas fa-shopping-cart" style="color: var(--color-accent);"></i> Your Cart
        </h3>
        <button onclick="toggleCart()" style="background: none; border: none; font-size: var(--font-size-xl); cursor: pointer;">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div id="cartItems" style="flex: 1; overflow-y: auto; padding: var(--spacing-md) 0;">
        <!-- Cart items will be dynamically rendered here -->
        <div id="emptyCart" style="text-align: center; padding: var(--spacing-2xl) 0; color: var(--color-text-muted);">
            <i class="fas fa-shopping-basket" style="font-size: 48px; margin-bottom: var(--spacing-md); display: block;"></i>
            <p>Your cart is empty</p>
        </div>
        <div id="cartItemsList" style="display: none;"></div>
    </div>
    <div id="cartFooter" style="padding-top: var(--spacing-md); border-top: 2px solid var(--color-border-light); display: none;">
        <div style="display: flex; justify-content: space-between; font-size: var(--font-size-lg); font-weight: var(--font-weight-bold);">
            <span>Total</span>
            <span id="cartTotal">$0.00</span>
        </div>
        <button onclick="alert('Proceeding to checkout...')" style="width: 100%; margin-top: var(--spacing-md); background: var(--color-accent); color: var(--color-primary); border: none; padding: 12px; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-base);">
            <i class="fas fa-lock"></i> Proceed to Checkout
        </button>
    </div>
</div>

<!-- Overlay -->
<div id="cartOverlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: var(--z-overlay); opacity: 0; visibility: hidden; transition: all var(--transition-base);" onclick="toggleCart()"></div>

<script>
// ============================================
// CATEGORIES DROPDOWN
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

    // Category link click
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.dataset.category;
            alert(`Filtering products by: ${category}`);
            toggleCategoriesMenu(false);
            isCategoriesOpen = false;
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
// USER DROPDOWN
// ============================================
    const userToggle = document.getElementById('userToggle');
    const userMenu = document.getElementById('userMenu');
    const userArrow = document.getElementById('userArrow');
    let isUserOpen = false;

    userToggle.addEventListener('click', function(e) {
        e.stopPropagation();
        isUserOpen = !isUserOpen;
        toggleUserMenu(isUserOpen);
    });

    function toggleUserMenu(open) {
        if (open) {
            userMenu.style.display = 'block';
            setTimeout(() => {
                userMenu.style.opacity = '1';
                userMenu.style.transform = 'translateY(0)';
            }, 10);
            userArrow.style.transform = 'rotate(180deg)';
        } else {
            userMenu.style.opacity = '0';
            userMenu.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                userMenu.style.display = 'none';
            }, 300);
            userArrow.style.transform = 'rotate(0deg)';
        }
    }

    document.addEventListener('click', function(e) {
        const dropdown = document.getElementById('userDropdown');
        if (!dropdown.contains(e.target) && isUserOpen) {
            toggleUserMenu(false);
            isUserOpen = false;
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

    mobileToggle.addEventListener('click', function() {
        isMobileMenuOpen = !isMobileMenuOpen;
        mobileMenu.style.display = isMobileMenuOpen ? 'block' : 'none';
        document.body.style.overflow = isMobileMenuOpen ? 'hidden' : '';
    });

    mobileCategoriesToggle.addEventListener('click', function() {
        isMobileCategoriesOpen = !isMobileCategoriesOpen;
        mobileCategoriesList.style.display = isMobileCategoriesOpen ? 'block' : 'none';
        mobileCategoriesArrow.style.transform = isMobileCategoriesOpen ? 'rotate(180deg)' : 'rotate(0deg)';
    });

    // Mobile search
    document.getElementById('mobileSearchBtn').addEventListener('click', function() {
        const query = document.getElementById('mobileSearchInput').value;
        if (query.trim()) {
            alert(`Searching for: ${query}`);
        }
    });

    document.getElementById('mobileSearchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('mobileSearchBtn').click();
        }
    });

// ============================================
// SEARCH FUNCTIONALITY
// ============================================
    document.getElementById('searchBtn').addEventListener('click', function() {
        const query = document.getElementById('searchInput').value;
        if (query.trim()) {
            alert(`Searching for: ${query}`);
        }
    });

    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('searchBtn').click();
        }
    });

// ============================================
// CART FUNCTIONALITY
// ============================================
    window.toggleCart = function() {
        const cart = document.getElementById('cartSidebar');
        const overlay = document.getElementById('cartOverlay');
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

    // Cart counter update
    function updateCartCount(count) {
        document.getElementById('cartCount').textContent = count;
    }

    // Add to cart function
    window.addToCart = function(productId, productName, price) {
        // Simulate adding to cart
        const currentCount = parseInt(document.getElementById('cartCount').textContent) || 0;
        updateCartCount(currentCount + 1);
        alert(`Added "${productName}" to cart! Price: $${price}`);
        // Here you would typically call your cart API
    };

    // Close cart with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const cart = document.getElementById('cartSidebar');
            if (cart.style.right === '0px') {
                toggleCart();
            }
        }
    });

// ============================================
// WISHLIST FUNCTIONALITY
// ============================================
    // Add to wishlist
    document.querySelectorAll('.add-to-wishlist').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const count = document.getElementById('wishlistCount');
            const currentCount = parseInt(count.textContent) || 0;
            count.textContent = currentCount + 1;
            this.style.color = 'var(--color-accent)';
            alert('Added to wishlist!');
        });
    });

// ============================================
// RESPONSIVE HANDLING
// ============================================
    function handleResponsive() {
        const mobileToggle = document.getElementById('mobileToggle');
        const navbarLinks = document.querySelector('nav > div:last-child');
        const searchBar = document.querySelector('nav > div:nth-child(2)');

        if (window.innerWidth <= 768) {
            mobileToggle.style.display = 'block';
            searchBar.style.display = 'none';
            // Hide some nav items on mobile
            document.querySelectorAll('#categoriesDropdown, #userDropdown').forEach(el => {
                el.style.display = 'none';
            });
        } else {
            mobileToggle.style.display = 'none';
            searchBar.style.display = 'flex';
            document.querySelectorAll('#categoriesDropdown, #userDropdown').forEach(el => {
                el.style.display = 'block';
            });
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

// ============================================
// ADDITIONAL HELPER FUNCTIONS
// ============================================
// Quantity selector handlers
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.quantity-selector').forEach(selector => {
        const input = selector.querySelector('.qty-input');
        const minusBtn = selector.querySelector('.qty-minus');
        const plusBtn = selector.querySelector('.qty-plus');

        if (minusBtn) {
            minusBtn.addEventListener('click', function() {
                let val = parseInt(input.value) || 1;
                if (val > 1) {
                    input.value = val - 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
        }

        if (plusBtn) {
            plusBtn.addEventListener('click', function() {
                let val = parseInt(input.value) || 1;
                if (val < 99) {
                    input.value = val + 1;
                    input.dispatchEvent(new Event('change'));
                }
            });
        }

        input.addEventListener('change', function() {
            let val = parseInt(this.value) || 1;
            if (val < 1) val = 1;
            if (val > 99) val = 99;
            this.value = val;
        });
    });
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

    /* User dropdown hover effects */
    #userMenu a:hover {
        background: var(--color-off-white);
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
</style> --}}


<!-- resources/views/components/navbar.blade.php -->
<nav style="background: var(--color-bg-header); color: var(--color-text-light); padding: 0 var(--container-padding); height: var(--header-height); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: var(--z-header); box-shadow: var(--shadow-md);">

    <!-- Logo -->
    <a href="/" style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-text-light); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-sm);">
        <i class="fas fa-store" style="color: var(--color-accent);"></i>
        OrviBazar
    </a>

    <!-- Search Bar -->
    <div style="flex: 1; max-width: 500px; margin: 0 var(--spacing-xl); display: flex; align-items: center; background: var(--color-primary-light); border-radius: var(--radius-full); overflow: hidden; transition: all var(--transition-base);">
        <input id="searchInput" type="text" placeholder="Search products..." style="flex: 1; padding: 10px 20px; background: transparent; border: none; color: var(--color-text-light); font-size: var(--font-size-sm); outline: none;">
        <button id="searchBtn" style="padding: 10px 20px; background: var(--color-accent); border: none; color: var(--color-primary); cursor: pointer; transition: background var(--transition-fast);">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Navigation Links -->
    <div style="display: flex; align-items: center; gap: var(--spacing-lg);">
        <!-- Categories Dropdown -->
        <div style="position: relative;" id="categoriesDropdown">
            <button id="categoriesToggle" style="background: transparent; border: none; color: var(--color-text-light); cursor: pointer; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-xs); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: background var(--transition-fast);" onmouseover="this.style.background='var(--color-primary-light)'" onmouseout="this.style.background='transparent'">
                <i class="fas fa-bars"></i>
                Categories
                <i class="fas fa-chevron-down" style="font-size: var(--font-size-xs); transition: transform var(--transition-fast);" id="categoriesArrow"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="categoriesMenu" style="display: none; position: absolute; top: 100%; left: 0; min-width: 260px; background: white; border-radius: var(--radius-md); box-shadow: var(--shadow-lg); padding: var(--spacing-sm) 0; margin-top: var(--spacing-xs); z-index: var(--z-dropdown); opacity: 0; transform: translateY(-10px); transition: all var(--transition-base);">
                <div style="padding: var(--spacing-xs) var(--spacing-lg); border-bottom: 1px solid var(--color-border-light);">
                    <input type="text" id="categorySearch" placeholder="Search categories..." style="width: 100%; padding: 6px 12px; border: 1px solid var(--color-border-light); border-radius: var(--radius-sm); font-size: var(--font-size-sm); outline: none;">
                </div>
                <div id="categoryList">
                    <a href="/category/electronics" data-category="electronics" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-laptop" style="margin-right: var(--spacing-sm); width: 20px;"></i> Electronics <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(234)</span>
                    </a>
                    <a href="/category/fashion" data-category="fashion" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-tshirt" style="margin-right: var(--spacing-sm); width: 20px;"></i> Fashion <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(156)</span>
                    </a>
                    <a href="/category/home" data-category="home" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-home" style="margin-right: var(--spacing-sm); width: 20px;"></i> Home & Living <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(89)</span>
                    </a>
                    <a href="/category/beauty" data-category="beauty" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-spa" style="margin-right: var(--spacing-sm); width: 20px;"></i> Beauty <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(67)</span>
                    </a>
                    <a href="/category/sports" data-category="sports" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-dumbbell" style="margin-right: var(--spacing-sm); width: 20px;"></i> Sports <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(45)</span>
                    </a>
                    <a href="/category/books" data-category="books" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-book" style="margin-right: var(--spacing-sm); width: 20px;"></i> Books <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(123)</span>
                    </a>
                    <a href="/category/toys" data-category="toys" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-gamepad" style="margin-right: var(--spacing-sm); width: 20px;"></i> Toys & Games <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(78)</span>
                    </a>
                    <a href="/category/automotive" data-category="automotive" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fas fa-car" style="margin-right: var(--spacing-sm); width: 20px;"></i> Automotive <span style="float: right; color: var(--color-text-muted); font-size: var(--font-size-xs);">(34)</span>
                    </a>
                    <div style="border-top: 1px solid var(--color-border-light); margin: var(--spacing-xs) 0;"></div>
                    <a href="/categories" style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-accent); text-decoration: none; font-weight: var(--font-weight-medium); transition: all var(--transition-fast);">
                        <i class="fas fa-arrow-right" style="margin-right: var(--spacing-sm);"></i> View All Categories
                    </a>
                </div>
            </div>
        </div>

        <!-- Wishlist -->
        <a href="/wishlist" style="color: var(--color-text-light); text-decoration: none; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-xs); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: background var(--transition-fast); position: relative;" onmouseover="this.style.background='var(--color-primary-light)'" onmouseout="this.style.background='transparent'">
            <i class="fas fa-heart"></i>
            <span id="wishlistCount" style="position: absolute; top: -5px; right: -5px; background: var(--color-accent); color: var(--color-primary); border-radius: var(--radius-full); font-size: 10px; padding: 2px 6px; font-weight: var(--font-weight-bold);">3</span>
        </a>

        <!-- Cart -->
        <button id="cartToggle" onclick="toggleCart()" style="background: var(--color-accent); border: none; color: var(--color-primary); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); cursor: pointer; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-sm); font-weight: var(--font-weight-medium); transition: all var(--transition-base); position: relative;">
            <i class="fas fa-shopping-cart"></i>
            <span id="cartCount" style="background: var(--color-primary); color: var(--color-text-light); border-radius: var(--radius-full); padding: 0 8px; font-size: 12px;">2</span>
        </button>

        <!-- Guest User Actions -->
        <div style="display: flex; align-items: center; gap: var(--spacing-sm);">
            <!-- Login Button -->
            <a href="/login" style="color: var(--color-text-light); text-decoration: none; font-size: var(--font-size-sm); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: all var(--transition-fast); display: flex; align-items: center; gap: var(--spacing-xs);" onmouseover="this.style.background='var(--color-primary-light)'" onmouseout="this.style.background='transparent'">
                <i class="fas fa-sign-in-alt"></i> Login
            </a>

            <!-- Register Button -->
            <a href="{{route('option')}}" style="background: var(--color-accent); color: var(--color-primary); padding: var(--spacing-sm) var(--spacing-lg); border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-semibold); font-size: var(--font-size-sm); transition: all var(--transition-base); display: flex; align-items: center; gap: var(--spacing-xs);" onmouseover="this.style.background='var(--color-accent-hover)'; this.style.transform='scale(1.05)'" onmouseout="this.style.background='var(--color-accent)'; this.style.transform='scale(1)'">
                <i class="fas fa-user-plus"></i> Sign Up
            </a>
        </div>
    </div>

    <!-- Mobile Menu Toggle -->
    <button id="mobileToggle" style="display: none; background: transparent; border: none; color: var(--color-text-light); font-size: var(--font-size-xl); cursor: pointer;">
        <i class="fas fa-bars"></i>
    </button>
</nav>

<!-- Mobile Menu -->
<div id="mobileMenu" style="display: none; background: var(--color-primary); padding: var(--spacing-lg); position: fixed; top: var(--header-height); left: 0; width: 100%; height: calc(100vh - var(--header-height)); z-index: var(--z-dropdown); overflow-y: auto;">
    <div style="display: flex; flex-direction: column; gap: var(--spacing-md);">
        <!-- Mobile Search -->
        <div style="display: flex; background: var(--color-primary-light); border-radius: var(--radius-full); overflow: hidden;">
            <input id="mobileSearchInput" type="text" placeholder="Search..." style="flex: 1; padding: 12px 20px; background: transparent; border: none; color: var(--color-text-light); outline: none;">
            <button id="mobileSearchBtn" style="padding: 12px 20px; background: var(--color-accent); border: none; color: var(--color-primary);">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Mobile Categories -->
        <div>
            <button id="mobileCategoriesToggle" style="width: 100%; background: var(--color-primary-light); border: none; color: var(--color-text-light); padding: var(--spacing-sm); border-radius: var(--radius-md); cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-size: var(--font-size-base);">
                <span><i class="fas fa-bars" style="margin-right: var(--spacing-sm);"></i> Categories</span>
                <i class="fas fa-chevron-down" id="mobileCategoriesArrow" style="transition: transform var(--transition-fast);"></i>
            </button>
            <div id="mobileCategoriesList" style="display: none; margin-top: var(--spacing-sm);">
                <a href="/category/electronics" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-laptop" style="margin-right: var(--spacing-sm);"></i> Electronics
                </a>
                <a href="/category/fashion" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-tshirt" style="margin-right: var(--spacing-sm);"></i> Fashion
                </a>
                <a href="/category/home" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-home" style="margin-right: var(--spacing-sm);"></i> Home & Living
                </a>
                <a href="/category/beauty" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-spa" style="margin-right: var(--spacing-sm);"></i> Beauty
                </a>
                <a href="/category/sports" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-dumbbell" style="margin-right: var(--spacing-sm);"></i> Sports
                </a>
                <a href="/category/books" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-book" style="margin-right: var(--spacing-sm);"></i> Books
                </a>
                <a href="/categories" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md);">
                    <i class="fas fa-arrow-right" style="margin-right: var(--spacing-sm);"></i> View All
                </a>
            </div>
        </div>

        <a href="/wishlist" style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
            <i class="fas fa-heart" style="margin-right: var(--spacing-sm);"></i> Wishlist
        </a>
        <a href="/cart" style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
            <i class="fas fa-shopping-cart" style="margin-right: var(--spacing-sm);"></i> Cart
        </a>

        <!-- Guest Mobile Actions -->
        <div style="border-top: 1px solid var(--color-primary-light); padding-top: var(--spacing-md);">
            <a href="/login" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
                <i class="fas fa-sign-in-alt" style="margin-right: var(--spacing-sm);"></i> Login
            </a>
            <a href="{{route('option')}}" style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; background: var(--color-accent); color: var(--color-primary); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); margin-top: var(--spacing-sm); text-align: center; font-weight: var(--font-weight-semibold);">
                <i class="fas fa-user-plus" style="margin-right: var(--spacing-sm);"></i> Sign Up
            </a>
        </div>
    </div>
</div>

<!-- Cart Sidebar -->
<div id="cartSidebar" style="position: fixed; top: 0; right: -400px; width: 380px; height: 100vh; background: white; box-shadow: var(--shadow-xl); z-index: var(--z-cart-sidebar); transition: right var(--transition-base); padding: var(--spacing-lg); display: flex; flex-direction: column;">
    <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: var(--spacing-md); border-bottom: 1px solid var(--color-border-light);">
        <h3 style="font-size: var(--font-size-lg);">
            <i class="fas fa-shopping-cart" style="color: var(--color-accent);"></i> Your Cart
        </h3>
        <button onclick="toggleCart()" style="background: none; border: none; font-size: var(--font-size-xl); cursor: pointer;">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div id="cartItems" style="flex: 1; overflow-y: auto; padding: var(--spacing-md) 0;">
        <!-- Cart items will be dynamically rendered here -->
        <div id="emptyCart" style="text-align: center; padding: var(--spacing-2xl) 0; color: var(--color-text-muted);">
            <i class="fas fa-shopping-basket" style="font-size: 48px; margin-bottom: var(--spacing-md); display: block;"></i>
            <p>Your cart is empty</p>
        </div>
        <div id="cartItemsList" style="display: none;"></div>
    </div>
    <div id="cartFooter" style="padding-top: var(--spacing-md); border-top: 2px solid var(--color-border-light); display: none;">
        <div style="display: flex; justify-content: space-between; font-size: var(--font-size-lg); font-weight: var(--font-weight-bold);">
            <span>Total</span>
            <span id="cartTotal">$0.00</span>
        </div>
        <button onclick="window.location.href='/login'" style="width: 100%; margin-top: var(--spacing-md); background: var(--color-accent); color: var(--color-primary); border: none; padding: 12px; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-base);">
            <i class="fas fa-lock"></i> Login to Checkout
        </button>
    </div>
</div>

<!-- Overlay -->
<div id="cartOverlay" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: var(--z-overlay); opacity: 0; visibility: hidden; transition: all var(--transition-base);" onclick="toggleCart()"></div>

<script>
// ============================================
// CATEGORIES DROPDOWN
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

    // Category link click
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.dataset.category;
            alert(`Filtering products by: ${category}`);
            toggleCategoriesMenu(false);
            isCategoriesOpen = false;
            // Redirect to category page
            window.location.href = this.href;
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

    mobileToggle.addEventListener('click', function() {
        isMobileMenuOpen = !isMobileMenuOpen;
        mobileMenu.style.display = isMobileMenuOpen ? 'block' : 'none';
        document.body.style.overflow = isMobileMenuOpen ? 'hidden' : '';
    });

    mobileCategoriesToggle.addEventListener('click', function() {
        isMobileCategoriesOpen = !isMobileCategoriesOpen;
        mobileCategoriesList.style.display = isMobileCategoriesOpen ? 'block' : 'none';
        mobileCategoriesArrow.style.transform = isMobileCategoriesOpen ? 'rotate(180deg)' : 'rotate(0deg)';
    });

    // Mobile search
    document.getElementById('mobileSearchBtn').addEventListener('click', function() {
        const query = document.getElementById('mobileSearchInput').value;
        if (query.trim()) {
            alert(`Searching for: ${query}`);
        }
    });

    document.getElementById('mobileSearchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('mobileSearchBtn').click();
        }
    });

// ============================================
// SEARCH FUNCTIONALITY
// ============================================
    document.getElementById('searchBtn').addEventListener('click', function() {
        const query = document.getElementById('searchInput').value;
        if (query.trim()) {
            alert(`Searching for: ${query}`);
        }
    });

    document.getElementById('searchInput').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            document.getElementById('searchBtn').click();
        }
    });

// ============================================
// CART FUNCTIONALITY
// ============================================
    window.toggleCart = function() {
        const cart = document.getElementById('cartSidebar');
        const overlay = document.getElementById('cartOverlay');
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

    // Cart counter update
    function updateCartCount(count) {
        document.getElementById('cartCount').textContent = count;
    }

    // Add to cart function
    window.addToCart = function(productId, productName, price) {
        // Simulate adding to cart
        const currentCount = parseInt(document.getElementById('cartCount').textContent) || 0;
        updateCartCount(currentCount + 1);
        alert(`Added "${productName}" to cart! Price: $${price}`);
        // Here you would typically call your cart API
    };

    // Close cart with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const cart = document.getElementById('cartSidebar');
            if (cart.style.right === '0px') {
                toggleCart();
            }
        }
    });

// ============================================
// WISHLIST FUNCTIONALITY
// ============================================
    // Add to wishlist
    document.querySelectorAll('.add-to-wishlist, .wishlist-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // Check if user is logged in (you can add auth check here)
            // For guest, redirect to login
            if (this.closest('.product-card') || this.closest('a[href="/wishlist"]')) {
                const count = document.getElementById('wishlistCount');
                const currentCount = parseInt(count.textContent) || 0;
                count.textContent = currentCount + 1;
                alert('Please login to add to wishlist!');
                window.location.href = '/login';
            }
        });
    });

// ============================================
// RESPONSIVE HANDLING
// ============================================
    function handleResponsive() {
        const mobileToggle = document.getElementById('mobileToggle');
        const searchBar = document.querySelector('nav > div:nth-child(2)');

        if (window.innerWidth <= 768) {
            mobileToggle.style.display = 'block';
            searchBar.style.display = 'none';
            // Hide some nav items on mobile
            document.querySelectorAll('#categoriesDropdown, .guest-actions').forEach(el => {
                el.style.display = 'none';
            });
        } else {
            mobileToggle.style.display = 'none';
            searchBar.style.display = 'flex';
            document.querySelectorAll('#categoriesDropdown, .guest-actions').forEach(el => {
                el.style.display = 'block';
            });
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

// ============================================
// TOAST NOTIFICATION SYSTEM
// ============================================
function showToast(type, message) {
    // Remove existing toast if any
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) {
        existingToast.remove();
    }

    // Create toast element
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
`;
document.head.appendChild(styleSheet);
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
