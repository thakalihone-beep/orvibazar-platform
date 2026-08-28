<footer style="background: var(--color-bg-footer); color: var(--color-text-light); padding: var(--spacing-2xl) 0; margin-top: auto;">
    <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: var(--spacing-xl);">
            <!-- Company Info -->
            <div>
                <h3 style="color: var(--color-accent); margin-bottom: var(--spacing-md); font-size: var(--font-size-lg);">
                    <i class="fas fa-store" style="margin-right: var(--spacing-sm);"></i>
                    OrviBazar
                </h3>
                <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); line-height: var(--line-height-loose);">
                    Your trusted online marketplace for quality products.
                </p>
                <div style="display: flex; gap: var(--spacing-md); margin-top: var(--spacing-md);">
                    <a href="#" style="color: var(--color-text-muted); transition: color var(--transition-fast);"
                        onmouseover="this.style.color='var(--color-accent)'"
                        onmouseout="this.style.color='var(--color-text-muted)'">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" style="color: var(--color-text-muted); transition: color var(--transition-fast);"
                        onmouseover="this.style.color='var(--color-accent)'"
                        onmouseout="this.style.color='var(--color-text-muted)'">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" style="color: var(--color-text-muted); transition: color var(--transition-fast);"
                        onmouseover="this.style.color='var(--color-accent)'"
                        onmouseout="this.style.color='var(--color-text-muted)'">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" style="color: var(--color-text-muted); transition: color var(--transition-fast);"
                        onmouseover="this.style.color='var(--color-accent)'"
                        onmouseout="this.style.color='var(--color-text-muted)'">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 style="color: white; margin-bottom: var(--spacing-md); font-size: var(--font-size-base);">Quick Links</h4>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: var(--spacing-xs);">
                        <a href="{{ route('shop') }}" style="color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: color var(--transition-fast);"
                            onmouseover="this.style.color='var(--color-accent)'"
                            onmouseout="this.style.color='var(--color-text-muted)'">
                            Shop
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-xs);">
                        <a href="{{ route('categories') }}" style="color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: color var(--transition-fast);"
                            onmouseover="this.style.color='var(--color-accent)'"
                            onmouseout="this.style.color='var(--color-text-muted)'">
                            Categories
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-xs);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: color var(--transition-fast);"
                            onmouseover="this.style.color='var(--color-accent)'"
                            onmouseout="this.style.color='var(--color-text-muted)'">
                            About Us
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-xs);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: color var(--transition-fast);"
                            onmouseover="this.style.color='var(--color-accent)'"
                            onmouseout="this.style.color='var(--color-text-muted)'">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 style="color: white; margin-bottom: var(--spacing-md); font-size: var(--font-size-base);">Support</h4>
                <ul style="list-style: none; padding: 0;">
                    <li style="margin-bottom: var(--spacing-xs);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: color var(--transition-fast);"
                            onmouseover="this.style.color='var(--color-accent)'"
                            onmouseout="this.style.color='var(--color-text-muted)'">
                            Help Center
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-xs);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: color var(--transition-fast);"
                            onmouseover="this.style.color='var(--color-accent)'"
                            onmouseout="this.style.color='var(--color-text-muted)'">
                            Returns Policy
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-xs);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: color var(--transition-fast);"
                            onmouseover="this.style.color='var(--color-accent)'"
                            onmouseout="this.style.color='var(--color-text-muted)'">
                            Privacy Policy
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-xs);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: color var(--transition-fast);"
                            onmouseover="this.style.color='var(--color-accent)'"
                            onmouseout="this.style.color='var(--color-text-muted)'">
                            Terms & Conditions
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 style="color: white; margin-bottom: var(--spacing-md); font-size: var(--font-size-base);">Newsletter</h4>
                <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin-bottom: var(--spacing-md);">
                    Subscribe to get updates and offers.
                </p>
                <form style="display: flex; gap: var(--spacing-sm);">
                    <input type="email" placeholder="Your email" required
                        style="flex: 1; padding: 10px 14px; border: 1px solid var(--color-primary-light); border-radius: var(--radius-md); background: var(--color-primary-light); color: var(--color-text-light); font-size: var(--font-size-sm); outline: none;">
                    <button type="submit"
                        style="background: var(--color-accent); color: var(--color-primary); border: none; padding: 10px 20px; border-radius: var(--radius-md); cursor: pointer; font-weight: var(--font-weight-bold); transition: all var(--transition-fast);"
                        onmouseover="this.style.background='var(--color-accent-hover)'; this.style.transform='scale(1.05)'"
                        onmouseout="this.style.background='var(--color-accent)'; this.style.transform='scale(1)'">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

        <!-- Copyright -->
        <div style="border-top: 1px solid var(--color-primary-light); margin-top: var(--spacing-xl); padding-top: var(--spacing-lg); text-align: center; color: var(--color-text-muted); font-size: var(--font-size-xs);">
            <p>&copy; {{ date('Y') }} OrviBazar. All rights reserved.</p>
        </div>
    </div>
</footer>