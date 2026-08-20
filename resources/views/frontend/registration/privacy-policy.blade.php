<!-- resources/views/pages/privacy-policy.blade.php -->
@extends('layouts.app')

@section('title', 'Privacy Policy - OrviBazar')

@section('content')
<div style="padding: var(--spacing-2xl) 0; background: var(--color-bg-light); min-height: 100vh;">
    <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">

        <!-- Header -->
        <div style="text-align: center; margin-bottom: var(--spacing-2xl);">
            <div style="display: inline-block; background: var(--color-off-white); padding: var(--spacing-lg); border-radius: 50%; margin-bottom: var(--spacing-md);">
                <i class="fas fa-shield-alt" style="font-size: 40px; color: var(--color-primary);"></i>
            </div>
            <h1 style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-extrabold); color: var(--color-primary); margin-bottom: var(--spacing-sm);">
                Privacy Policy
            </h1>
            <p style="color: var(--color-text-muted); font-size: var(--font-size-sm);">
                Last Updated: {{ date('F d, Y') }}
            </p>
        </div>

        <!-- Content -->
        <div style="max-width: 900px; margin: 0 auto; background: white; border-radius: var(--radius-2xl); padding: var(--spacing-2xl); box-shadow: var(--shadow-sm);">

            <!-- Introduction -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    Your Privacy Matters
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                    At OrviBazar, we take your privacy seriously. This Privacy Policy explains how we collect, use, disclose,
                    and safeguard your information when you use our platform. Please read this policy carefully.
                </p>
            </div>

            <!-- Information We Collect -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    1. Information We Collect
                </h2>

                <h3 style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); color: var(--color-primary); margin: var(--spacing-md) 0 var(--spacing-sm);">
                    Personal Information
                </h3>
                <ul style="list-style: none; padding: 0; margin-bottom: var(--spacing-md);">
                    <li style="padding: var(--spacing-xs) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-user" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary);">Name and contact information (email, phone number, address)</span>
                    </li>
                    <li style="padding: var(--spacing-xs) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-id-card" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary);">Account credentials and profile information</span>
                    </li>
                    <li style="padding: var(--spacing-xs) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-credit-card" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary);">Payment information (processed securely by third-party gateways)</span>
                    </li>
                </ul>

                <h3 style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); color: var(--color-primary); margin: var(--spacing-md) 0 var(--spacing-sm);">
                    Usage Data
                </h3>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-xs) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-chart-line" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary);">Pages visited, products viewed, and search queries</span>
                    </li>
                    <li style="padding: var(--spacing-xs) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-clock" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary);">Time spent on the Platform and interaction patterns</span>
                    </li>
                    <li style="padding: var(--spacing-xs) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-mobile-alt" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary);">Device information and IP address</span>
                    </li>
                </ul>
            </div>

            <!-- How We Use Information -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    2. How We Use Your Information
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    We use the information we collect to:
                </p>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Provide, maintain, and improve our services
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Process transactions and send order confirmations
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Personalize your experience and recommend products
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Send marketing communications (with your consent)
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Detect and prevent fraudulent activities
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Data Security -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    3. Data Security
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    We implement appropriate technical and organizational measures to protect your personal information against
                    unauthorized access, alteration, disclosure, or destruction.
                </p>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-md);">
                    <div style="background: var(--color-off-white); padding: var(--spacing-md); border-radius: var(--radius-md); text-align: center;">
                        <i class="fas fa-lock" style="font-size: 28px; color: var(--color-accent);"></i>
                        <p style="font-size: var(--font-size-sm); color: var(--color-text-secondary); margin-top: var(--spacing-xs);">SSL Encryption</p>
                    </div>
                    <div style="background: var(--color-off-white); padding: var(--spacing-md); border-radius: var(--radius-md); text-align: center;">
                        <i class="fas fa-server" style="font-size: 28px; color: var(--color-accent);"></i>
                        <p style="font-size: var(--font-size-sm); color: var(--color-text-secondary); margin-top: var(--spacing-xs);">Secure Servers</p>
                    </div>
                    <div style="background: var(--color-off-white); padding: var(--spacing-md); border-radius: var(--radius-md); text-align: center;">
                        <i class="fas fa-shield-alt" style="font-size: 28px; color: var(--color-accent);"></i>
                        <p style="font-size: var(--font-size-sm); color: var(--color-text-secondary); margin-top: var(--spacing-xs);">Data Protection</p>
                    </div>
                    <div style="background: var(--color-off-white); padding: var(--spacing-md); border-radius: var(--radius-md); text-align: center;">
                        <i class="fas fa-user-shield" style="font-size: 28px; color: var(--color-accent);"></i>
                        <p style="font-size: var(--font-size-sm); color: var(--color-text-secondary); margin-top: var(--spacing-xs);">Access Control</p>
                    </div>
                </div>
            </div>

            <!-- Cookies -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    4. Cookies
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    We use cookies and similar tracking technologies to enhance your experience on our Platform. You can control
                    cookie preferences through your browser settings.
                </p>
                <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap;">
                    <span style="padding: 4px 12px; background: var(--color-off-white); border-radius: var(--radius-full); font-size: var(--font-size-xs); color: var(--color-text-secondary);">Essential Cookies</span>
                    <span style="padding: 4px 12px; background: var(--color-off-white); border-radius: var(--radius-full); font-size: var(--font-size-xs); color: var(--color-text-secondary);">Functional Cookies</span>
                    <span style="padding: 4px 12px; background: var(--color-off-white); border-radius: var(--radius-full); font-size: var(--font-size-xs); color: var(--color-text-secondary);">Analytics Cookies</span>
                    <span style="padding: 4px 12px; background: var(--color-off-white); border-radius: var(--radius-full); font-size: var(--font-size-xs); color: var(--color-text-secondary);">Marketing Cookies</span>
                </div>
            </div>

            <!-- Third-Party Services -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    5. Third-Party Services
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    We may share your information with third-party service providers who assist us in operating our Platform,
                    conducting our business, or serving our users. These services include:
                </p>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-xs) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-credit-card" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary);">Payment processors</span>
                    </li>
                    <li style="padding: var(--spacing-xs) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-truck" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary);">Shipping and delivery services</span>
                    </li>
                    <li style="padding: var(--spacing-xs) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-chart-bar" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary);">Analytics and marketing providers</span>
                    </li>
                </ul>
            </div>

            <!-- Your Rights -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    6. Your Rights
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    You have the right to:
                </p>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Access and request a copy of your personal data
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Request correction or deletion of your data
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Opt-out of marketing communications
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Withdraw consent at any time
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Contact Information -->
            <div>
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    7. Contact Us
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    If you have any questions about this Privacy Policy, please contact us:
                </p>
                <div style="background: var(--color-off-white); padding: var(--spacing-md); border-radius: var(--radius-md);">
                    <p style="margin: var(--spacing-xs) 0; display: flex; align-items: center; gap: var(--spacing-sm);">
                        <i class="fas fa-envelope" style="color: var(--color-accent);"></i>
                        <span style="color: var(--color-text-secondary);">privacy@orvibazar.com</span>
                    </p>
                    <p style="margin: var(--spacing-xs) 0; display: flex; align-items: center; gap: var(--spacing-sm);">
                        <i class="fas fa-phone" style="color: var(--color-accent);"></i>
                        <span style="color: var(--color-text-secondary);">+1 234 567 8900</span>
                    </p>
                </div>
            </div>

            <!-- Accept Button -->
            <div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-xl); border-top: 1px solid var(--color-border-light); text-align: center;">
                <a href="/register" style="display: inline-block; padding: 14px 48px; background: var(--color-primary); color: white; border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-semibold); transition: all var(--transition-fast);">
                    <i class="fas fa-check"></i> I Accept the Privacy Policy
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
