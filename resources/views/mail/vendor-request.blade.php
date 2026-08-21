<!-- resources/views/mail/vendor_request.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Vendor Registration Request</title>
    <style>
        /* Email-specific styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
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
            border-bottom: 4px solid #e8a838;
        }

        .email-header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }

        .email-header p {
            color: #e8a838;
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
            border-bottom: 2px solid #e8a838;
            padding-bottom: 10px;
        }

        .vendor-details {
            background: #f8f8f8;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }

        .detail-row {
            display: flex;
            padding: 8px 0;
            border-bottom: 1px solid #e8e8e8;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            font-weight: 600;
            width: 140px;
            color: #555555;
            flex-shrink: 0;
        }

        .detail-value {
            color: #1a1a1a;
            flex: 1;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            background: #f39c12;
            color: #ffffff;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            margin: 25px 0 20px 0;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
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
        }

        .btn-primary:hover {
            background: #2d2d2d;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .btn-accent {
            background: #e8a838;
            color: #1a1a1a;
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
        }

        .btn-outline:hover {
            background: #1a1a1a;
            color: #ffffff;
        }

        .admin-note {
            background: #fff3cd;
            border-left: 4px solid #f39c12;
            padding: 15px 20px;
            border-radius: 4px;
            margin: 20px 0;
        }

        .admin-note p {
            margin: 0;
            color: #856404;
            font-size: 14px;
        }

        .admin-note i {
            margin-right: 8px;
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

        .divider {
            height: 1px;
            background: #e8e8e8;
            margin: 20px 0;
        }

        @media (max-width: 480px) {
            .email-body {
                padding: 20px;
            }

            .detail-row {
                flex-direction: column;
                padding: 12px 0;
            }

            .detail-label {
                width: 100%;
                margin-bottom: 4px;
            }

            .action-buttons {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                text-align: center;
            }

            .email-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-container">

            <!-- Email Header -->
            <div class="email-header">
                <div class="logo-text">Orvi<span>Bazar</span></div>
                <h1>New Vendor Registration Request</h1>
                <p>Action Required: Review Vendor Application</p>
            </div>

            <!-- Email Body -->
            <div class="email-body">

                <h2>📋 Vendor Application Details</h2>

                <p style="color: #555; margin-bottom: 20px;">
                    A new vendor has submitted a registration request. Please review the details below and take appropriate action.
                </p>

                <!-- Vendor Details -->
                <div class="vendor-details">
                    <div class="detail-row">
                        <span class="detail-label">Vendor Name</span>
                        <span class="detail-value"><strong>{{ $vendor->name ?? 'N/A' }}</strong></span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Shop Name</span>
                        <span class="detail-value"><strong>{{ $vendor->shop_name ?? 'N/A' }}</strong></span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Email Address</span>
                        <span class="detail-value">{{ $vendor->email ?? 'N/A' }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Contact Number</span>
                        <span class="detail-value">{{ $vendor->contact ?? 'N/A' }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">PAN Number</span>
                        <span class="detail-value">{{ $vendor->pan_no ?? 'N/A' }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Status</span>
                        <span class="detail-value">
                            <span class="status-badge">{{ $vendor->status ?? 'Pending' }}</span>
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Submitted On</span>
                        <span class="detail-value">{{ $vendor->created_at ? $vendor->created_at->format('F d, Y h:i A') : 'N/A' }}</span>
                    </div>

                    @if($vendor->description)
                        <div class="detail-row">
                            <span class="detail-label">Shop Description</span>
                            <span class="detail-value">{{ $vendor->description }}</span>
                        </div>
                    @endif
                </div>

                <!-- Admin Note -->
                <div class="admin-note">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        <strong>Action Required:</strong> Please review this vendor application and either approve or reject it.
                        This vendor is currently awaiting approval and cannot start selling until their account is activated.
                    </p>
                </div>

                <!-- Admin Dashboard -->
                <div style="text-align: center;">
                    <a href="{{ route('filament.admin.pages.dashboard') }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> Open Admin Dashboard
                    </a>
                </div>

                <div class="divider"></div>

                <!-- Additional Info -->
                <div style="background: #f8f8f8; padding: 15px; border-radius: 6px;">
                    <p style="margin: 0; font-size: 13px; color: #555;">
                        <i class="fas fa-shield-alt" style="color: #e8a838;"></i>
                        <strong>Security Note:</strong> This is an automated notification. Please verify the vendor's identity and
                        documents before approving their application.
                    </p>
                </div>
            </div>

            <!-- Footer -->
            <div class="footer">
                <p>
                    <strong>OrviBazar</strong> - Vendor Management System
                </p>
                <p>
                    &copy; {{ date('Y') }} OrviBazar. All rights reserved.
                </p>
                <p style="font-size: 12px; color: #999;">
                    This email was sent to the admin team for vendor approval.
                    If you have any questions, please contact the support team.
                </p>
                <p style="margin-top: 10px;">
                    <a href="{{ route('filament.admin.pages.dashboard') }}">Go to Admin Dashboard</a>
                </p>
            </div>

        </div>
    </div>
</body>
</html>
