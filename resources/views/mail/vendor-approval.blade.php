<!-- resources/views/mail/vendor-approval.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Account Approved - OrviBazar</title>
    <style>
        /* Email-specific styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .email-container {
            background: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .email-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            padding: 30px 40px;
            text-align: center;
            border-bottom: 4px solid #2ecc71;
        }

        .email-header .success-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 70px;
            height: 70px;
            background: #2ecc71;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .email-header .success-icon i {
            font-size: 32px;
            color: #ffffff;
        }

        .email-header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }

        .email-header p {
            color: #2ecc71;
            font-size: 14px;
            margin: 8px 0 0 0;
            opacity: 0.9;
        }

        .email-body {
            padding: 40px;
        }

        .email-body h2 {
            color: #1a1a1a;
            font-size: 20px;
            margin-top: 0;
            border-bottom: 2px solid #2ecc71;
            padding-bottom: 10px;
        }

        .greeting {
            font-size: 18px;
            color: #1a1a1a;
            margin-bottom: 10px;
        }

        .greeting strong {
            color: #1a1a1a;
        }

        .welcome-message {
            background: #f8f8f8;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .welcome-message p {
            margin: 0;
            color: #555555;
        }

        .credentials-box {
            background: #f0fdf4;
            border: 2px solid #2ecc71;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .credentials-box .credential-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #d4edda;
        }

        .credentials-box .credential-row:last-child {
            border-bottom: none;
        }

        .credentials-box .credential-label {
            font-weight: 600;
            width: 120px;
            color: #1a1a1a;
            flex-shrink: 0;
        }

        .credentials-box .credential-value {
            color: #1a1a1a;
            flex: 1;
            font-weight: 500;
            word-break: break-all;
        }

        .credentials-box .credential-value.password {
            background: #ffffff;
            padding: 2px 10px;
            border-radius: 4px;
            font-family: monospace;
            font-size: 14px;
            letter-spacing: 1px;
        }

        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #f39c12;
            padding: 15px 20px;
            border-radius: 4px;
            margin: 20px 0;
        }

        .warning-box p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }

        .warning-box i {
            margin-right: 8px;
            color: #f39c12;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin: 25px 0 20px 0;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 28px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-primary {
            background: #1a1a1a;
            color: #ffffff;
            flex: 1;
        }

        .btn-primary:hover {
            background: #2d2d2d;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .btn-accent {
            background: #e8a838;
            color: #1a1a1a;
            flex: 1;
        }

        .btn-accent:hover {
            background: #f0c04a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(232,168,56,0.3);
        }

        .btn-outline {
            background: transparent;
            color: #1a1a1a;
            border: 2px solid #1a1a1a;
            flex: 1;
        }

        .btn-outline:hover {
            background: #1a1a1a;
            color: #ffffff;
        }

        .features-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin: 20px 0;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            background: #f8f8f8;
            border-radius: 6px;
        }

        .feature-item i {
            color: #2ecc71;
            font-size: 18px;
        }

        .feature-item span {
            font-size: 14px;
            color: #555555;
        }

        .divider {
            height: 1px;
            background: #e8e8e8;
            margin: 20px 0;
        }

        .footer {
            padding: 20px 40px;
            background: #f8f8f8;
            text-align: center;
            border-top: 1px solid #e8e8e8;
        }

        .footer p {
            margin: 4px 0;
            font-size: 13px;
            color: #777777;
        }

        .footer a {
            color: #1a1a1a;
            text-decoration: none;
            font-weight: 600;
        }

        .footer a:hover {
            color: #e8a838;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 800;
            color: #ffffff;
            letter-spacing: 2px;
        }

        .logo-text span {
            color: #e8a838;
        }

        .shop-details {
            background: #f8f8f8;
            border-radius: 8px;
            padding: 15px 20px;
            margin: 15px 0;
        }

        .shop-details .detail-row {
            display: flex;
            padding: 4px 0;
        }

        .shop-details .detail-label {
            font-weight: 600;
            width: 100px;
            color: #555555;
            flex-shrink: 0;
        }

        .shop-details .detail-value {
            color: #1a1a1a;
            flex: 1;
        }

        @media (max-width: 480px) {
            .email-body {
                padding: 20px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .credentials-box .credential-row {
                flex-direction: column;
                padding: 10px 0;
            }

            .credentials-box .credential-label {
                width: 100%;
                margin-bottom: 4px;
            }

            .features-list {
                grid-template-columns: 1fr;
            }

            .email-header h1 {
                font-size: 20px;
            }

            .shop-details .detail-row {
                flex-direction: column;
            }

            .shop-details .detail-label {
                width: 100%;
            }
        }

        /* Fallback for email clients that don't support grid */
        .features-list-fallback {
            display: table;
            width: 100%;
        }

        .features-list-fallback .feature-item {
            display: table-cell;
            width: 50%;
            padding: 12px;
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">

            <!-- Email Header -->
            <div class="email-header">
                <div class="logo-text">Orvi<span>Bazar</span></div>
                <div style="margin: 15px 0;">
                    <div class="success-icon">
                        <i class="fas fa-check"></i>
                    </div>
                </div>
                <h1>Congratulations! 🎉</h1>
                <p>Your Vendor Account Has Been Approved</p>
            </div>

            <!-- Email Body -->
            <div class="email-body">

                <!-- Greeting -->
                <div class="greeting">
                    Dear <strong>{{ $vendor->name ?? 'Vendor' }}</strong>,
                </div>

                <p style="color: #555555; margin-bottom: 20px;">
                    We are excited to inform you that your vendor application has been <strong style="color: #2ecc71;">approved</strong>!
                    Welcome to the OrviBazar family. Your shop is now live and ready to start selling.
                </p>

                <!-- Shop Details -->
                <h2>🏪 Your Shop Details</h2>
                <div class="shop-details">
                    <div class="detail-row">
                        <span class="detail-label">Shop Name</span>
                        <span class="detail-value"><strong>{{ $vendor->shop_name ?? 'N/A' }}</strong></span>
                    </div>
                    <div class="detail-row">
                        <span class="detail-label">Marketplace</span>
                        <span class="detail-value">
                            <a href="{{ route('home') }}" style="color: #1a1a1a; text-decoration: none; font-weight: 600;">
                                {{ route('home') }}
                            </a>
                        </span>
                    </div>
                    {{-- <div class="detail-row">
                        <span class="detail-label">Vendor ID</span>
                        <span class="detail-value">#{{ $vendor->id ?? 'N/A' }}</span>
                    </div> --}}
                    <div class="detail-row">
                        <span class="detail-label">Approved On</span>
                        <span class="detail-value">{{ $vendor->approved_at ? $vendor->approved_at->format('F d, Y') : now()->format('F d, Y') }}</span>
                    </div>
                </div>

                <!-- Login Credentials -->
                <h2>🔑 Your Login Credentials</h2>
                <div class="credentials-box">
                    <div class="credential-row">
                        <span class="credential-label">Email</span>
                        <span class="credential-value">{{ $vendor->email ?? 'N/A' }}</span>
                    </div>
                    <div class="credential-row">
                        <span class="credential-label">Password</span>
                        <span class="credential-value password">{{ $password ?? 'N/A' }}</span>
                    </div>
                    <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid #d4edda;">
                        <p style="margin: 0; font-size: 13px; color: #555555;">
                            <i class="fas fa-info-circle" style="color: #2ecc71;"></i>
                            <strong>Note:</strong> Please change your password after your first login for security reasons.
                        </p>
                    </div>
                </div>

                <!-- Security Warning -->
                <div class="warning-box">
                    <p>
                        <i class="fas fa-exclamation-triangle"></i>
                        <strong>Important:</strong> Please keep your credentials secure and do not share them with anyone.
                        OrviBazar will never ask for your password via email or phone.
                    </p>
                </div>

                <!-- What You Can Do Next -->
                <h2>🚀 What You Can Do Next</h2>
                <div class="features-list">
                    <div class="feature-item">
                        <i class="fas fa-box"></i>
                        <span>Add Your Products</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-edit"></i>
                        <span>Customize Your Shop</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-line"></i>
                        <span>Track Sales & Analytics</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-credit-card"></i>
                        <span>Manage Payments</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-users"></i>
                        <span>Connect with Customers</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-cog"></i>
                        <span>Configure Settings</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="text-align: center; margin-top: 25px;">
                    <p style="color: #555555; margin-bottom: 15px; font-weight: 600;">
                        Get Started Now:
                    </p>
                    <div class="action-buttons">
                        <a href="{{ url("/vendor")}}" class="btn btn-primary">
                            <i class="fas fa-sign-in-alt"></i> Login to Dashboard
                        </a>
                        <a href="{{ url("/vendor/product") }}" class="btn btn-accent">
                            <i class="fas fa-rocket"></i> Go to Dashboard
                        </a>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Support Information -->
                <div style="background: #f8f8f8; padding: 15px; border-radius: 6px; margin-top: 20px;">
                    <p style="margin: 0; font-size: 13px; color: #555555;">
                        <i class="fas fa-headset" style="color: #e8a838;"></i>
                        <strong>Need Help?</strong> Our support team is here to help you get started.
                        Contact us at <a href="mailto:support@orvibazar.com" style="color: #1a1a1a; text-decoration: none; font-weight: 600;">support@orvibazar.com</a>
                        or call <a href="tel:+12345678900" style="color: #1a1a1a; text-decoration: none; font-weight: 600;">+1 234 567 8900</a>
                    </p>
                </div>

                <!-- Quick Tips -->
                <div style="background: #e8f5e9; border-radius: 6px; padding: 15px; margin-top: 15px;">
                    <p style="margin: 0; font-size: 13px; color: #2e7d32;">
                        <i class="fas fa-lightbulb" style="color: #f39c12;"></i>
                        <strong>Quick Tip:</strong> Start by adding your first 5 products. Shops with products sell 3x faster!
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>
                    <strong>OrviBazar</strong> - Your Trusted Marketplace
                </p>
                <p>
                    &copy; {{ date('Y') }} OrviBazar. All rights reserved.
                </p>
                <p style="font-size: 12px; color: #999;">
                    This is a system-generated email. Please do not reply to this email.
                    If you have any questions, contact our support team.
                </p>
                <p style="margin-top: 10px;">
                    <a href="{{ url("/vendor") }}">Vendor Dashboard</a>
                    &nbsp;|&nbsp;
                    <a href="{{ route('home') }}">Support Center</a>
                    &nbsp;|&nbsp;
                    <a href="{{ route('home') }}">Getting Started Guide</a>
                </p>
            </div>

        </div>
    </div>
</body>
</html>
