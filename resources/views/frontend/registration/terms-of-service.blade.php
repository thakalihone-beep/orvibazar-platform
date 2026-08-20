<!-- resources/views/pages/terms-of-service.blade.php -->
@extends('layouts.app')

@section('title', 'Terms of Service - OrviBazar')

@section('content')
<div style="padding: var(--spacing-2xl) 0; background: var(--color-bg-light); min-height: 100vh;">
    <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">

        <!-- Header -->
        <div style="text-align: center; margin-bottom: var(--spacing-2xl);">
            <div style="display: inline-block; background: var(--color-off-white); padding: var(--spacing-lg); border-radius: 50%; margin-bottom: var(--spacing-md);">
                <i class="fas fa-file-contract" style="font-size: 40px; color: var(--color-primary);"></i>
            </div>
            <h1 style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-extrabold); color: var(--color-primary); margin-bottom: var(--spacing-sm);">
                Terms of Service
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
                    1. Introduction
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    Welcome to OrviBazar. By using our platform, you agree to comply with and be bound by the following terms and conditions.
                    Please read these terms carefully before using our services.
                </p>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                    These Terms of Service govern your use of the OrviBazar website, mobile application, and all related services
                    (collectively referred to as the "Platform"). By accessing or using the Platform, you agree to be bound by these terms.
                </p>
            </div>

            <!-- Account Registration -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    2. Account Registration
                </h2>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You must be at least 18 years old to create an account.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You are responsible for maintaining the confidentiality of your account credentials.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You agree to provide accurate and complete information during registration.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You are solely responsible for all activities that occur under your account.
                        </span>
                    </li>
                </ul>
            </div>

            <!-- User Conduct -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    3. User Conduct
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    You agree to use the Platform responsibly and not to:
                </p>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-times-circle" style="color: var(--color-error); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Violate any applicable laws or regulations.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-times-circle" style="color: var(--color-error); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Post or transmit any harmful, offensive, or inappropriate content.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-times-circle" style="color: var(--color-error); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Attempt to gain unauthorized access to the Platform or other users' accounts.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-times-circle" style="color: var(--color-error); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Interfere with the proper functioning of the Platform.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-times-circle" style="color: var(--color-error); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Use the Platform for any unlawful or unauthorized purpose.
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Purchases & Payments -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    4. Purchases & Payments
                </h2>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-credit-card" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            All transactions are processed securely through trusted payment gateways.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-credit-card" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Prices and availability of products are subject to change without notice.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-credit-card" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You agree to pay all charges incurred in connection with your purchases.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-credit-card" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Refunds and returns are subject to our Return Policy.
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Intellectual Property -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    5. Intellectual Property
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    All content on the Platform, including text, graphics, logos, images, and software, is the property of OrviBazar
                    and is protected by intellectual property laws.
                </p>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                    You may not reproduce, distribute, modify, or create derivative works of any content without our prior written consent.
                </p>
            </div>

            <!-- Limitation of Liability -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    6. Limitation of Liability
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                    OrviBazar is provided "as is" without warranties of any kind. We do not guarantee that the Platform will be
                    error-free or uninterrupted. To the fullest extent permitted by law, we disclaim all liability for any damages
                    arising from your use of the Platform.
                </p>
            </div>

            <!-- Termination -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    7. Termination
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    We reserve the right to suspend or terminate your account at any time for any reason, including but not limited to:
                </p>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-chevron-right" style="color: var(--color-accent);"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Violation of these Terms of Service.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-chevron-right" style="color: var(--color-accent);"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Fraudulent or illegal activities.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-chevron-right" style="color: var(--color-accent);"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Extended periods of inactivity.
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Changes to Terms -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    8. Changes to Terms
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                    We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting.
                    Your continued use of the Platform constitutes acceptance of the updated terms.
                </p>
            </div>

            <!-- Contact Information -->
            <div>
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    9. Contact Us
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    If you have any questions about these Terms of Service, please contact us:
                </p>
                <div style="background: var(--color-off-white); padding: var(--spacing-md); border-radius: var(--radius-md);">
                    <p style="margin: var(--spacing-xs) 0; display: flex; align-items: center; gap: var(--spacing-sm);">
                        <i class="fas fa-envelope" style="color: var(--color-accent);"></i>
                        <span style="color: var(--color-text-secondary);">support@orvibazar.com</span>
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
                    <i class="fas fa-check"></i> I Agree to the Terms
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
