<!-- resources/views/components/footer.blade.php -->
<footer style="background: var(--color-bg-footer); color: var(--color-text-light); padding: var(--spacing-3xl) 0 var(--spacing-lg); margin-top: var(--spacing-3xl);">
    <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">

        <!-- Footer Grid -->
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--spacing-2xl); margin-bottom: var(--spacing-2xl);">

            <!-- Brand Column -->
            <div>
                <h3 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-md);">
                    <i class="fas fa-store" style="color: var(--color-accent);"></i> OrviBazar
                </h3>
                <p style="color: var(--color-text-muted); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    Your one-stop shop for quality products at affordable prices.
                    Shop with confidence and enjoy a seamless shopping experience.
                </p>
                <div style="display: flex; gap: var(--spacing-sm);">
                    <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: var(--color-primary-light); border-radius: var(--radius-full); color: var(--color-text-light); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: var(--color-primary-light); border-radius: var(--radius-full); color: var(--color-text-light); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: var(--color-primary-light); border-radius: var(--radius-full); color: var(--color-text-light); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px; background: var(--color-primary-light); border-radius: var(--radius-full); color: var(--color-text-light); text-decoration: none; transition: all var(--transition-fast);">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-md);">Quick Links</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: var(--spacing-sm);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">
                            <i class="fas fa-chevron-right" style="font-size: 10px; margin-right: var(--spacing-xs);"></i> About Us
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-sm);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">
                            <i class="fas fa-chevron-right" style="font-size: 10px; margin-right: var(--spacing-xs);"></i> Contact
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-sm);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">
                            <i class="fas fa-chevron-right" style="font-size: 10px; margin-right: var(--spacing-xs);"></i> FAQ
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-sm);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">
                            <i class="fas fa-chevron-right" style="font-size: 10px; margin-right: var(--spacing-xs);"></i> Blog
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h4 style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-md);">Customer Service</h4>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: var(--spacing-sm);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">
                            <i class="fas fa-chevron-right" style="font-size: 10px; margin-right: var(--spacing-xs);"></i> Returns Policy
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-sm);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">
                            <i class="fas fa-chevron-right" style="font-size: 10px; margin-right: var(--spacing-xs);"></i> Shipping Info
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-sm);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">
                            <i class="fas fa-chevron-right" style="font-size: 10px; margin-right: var(--spacing-xs);"></i> Privacy Policy
                        </a>
                    </li>
                    <li style="margin-bottom: var(--spacing-sm);">
                        <a href="#" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">
                            <i class="fas fa-chevron-right" style="font-size: 10px; margin-right: var(--spacing-xs);"></i> Terms & Conditions
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-md);">Newsletter</h4>
                <p style="color: var(--color-text-muted); margin-bottom: var(--spacing-md);">
                    Subscribe to get special offers, free giveaways, and exclusive deals.
                </p>
                <form action="#" method="POST" style="display: flex; gap: var(--spacing-sm);">
                    <input type="email" placeholder="Your email" required style="flex: 1; padding: 10px 14px; background: var(--color-primary-light); border: 1px solid var(--color-border); border-radius: var(--radius-md); color: var(--color-text-light); font-size: var(--font-size-sm);">
                    <button type="submit" style="background: var(--color-accent); color: var(--color-primary); border: none; padding: 10px 16px; border-radius: var(--radius-md); font-weight: var(--font-weight-semibold); cursor: pointer; transition: all var(--transition-fast); white-space: nowrap;">
                        <i class="fas fa-paper-plane"></i> Subscribe
                    </button>
                </form>
                <p style="color: var(--color-text-muted); font-size: var(--font-size-xs); margin-top: var(--spacing-sm);">
                    <i class="fas fa-lock" style="margin-right: var(--spacing-xs);"></i> We respect your privacy
                </p>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div style="border-top: 1px solid var(--color-border); padding-top: var(--spacing-lg); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: var(--spacing-md);">
            <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin: 0;">
                &copy; {{ date('Y') }} OrviBazar. All rights reserved.
            </p>
            <div style="display: flex; gap: var(--spacing-md); align-items: center;">
                <span style="color: var(--color-text-muted); font-size: var(--font-size-xs);">We accept:</span>
                <i class="fab fa-cc-visa" style="font-size: var(--font-size-xl); color: var(--color-text-muted);"></i>
                <i class="fab fa-cc-mastercard" style="font-size: var(--font-size-xl); color: var(--color-text-muted);"></i>
                <i class="fab fa-cc-paypal" style="font-size: var(--font-size-xl); color: var(--color-text-muted);"></i>
                <i class="fab fa-cc-amex" style="font-size: var(--font-size-xl); color: var(--color-text-muted);"></i>
                <i class="fas fa-mobile-alt" style="font-size: var(--font-size-xl); color: var(--color-text-muted);"></i>
            </div>
        </div>
    </div>
</footer>

<style>
    footer a:hover {
        color: var(--color-accent) !important;
    }
    footer .social-icons a:hover {
        background: var(--color-accent) !important;
        color: var(--color-primary) !important;
        transform: translateY(-2px);
    }
    footer .newsletter-btn:hover {
        transform: scale(1.05);
        box-shadow: var(--shadow-glow);
    }
</style>
