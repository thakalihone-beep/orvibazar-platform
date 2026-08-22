<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>New Vendor Application - OrviBazar</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f8;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Arial, sans-serif;
            color: #17202a;
        }

        table {
            border-collapse: collapse;
        }

        img {
            border: 0;
            max-width: 100%;
        }

        .email-wrapper {
            width: 100%;
            padding: 40px 15px;
            background-color: #f4f6f8;
        }

        .email-container {
            width: 100%;
            max-width: 650px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 30px rgba(15, 23, 42, 0.08);
        }

        /* ================================
           HEADER
        ================================= */

        .header {
            background-color: #171717;
            padding: 32px 40px;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #ffffff;
        }

        .brand span {
            color: #60a5fa;
        }

        .header-label {
            margin-top: 24px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: #94a3b8;
        }

        .header-title {
            margin: 7px 0 0;
            color: #ffffff;
            font-size: 25px;
            line-height: 1.3;
            font-weight: 700;
        }

        .header-description {
            margin: 10px 0 0;
            color: #cbd5e1;
            font-size: 14px;
            line-height: 1.6;
        }

        /* ================================
           BODY
        ================================= */

        .body {
            padding: 38px 40px;
        }

        .intro-title {
            margin: 0 0 8px;
            font-size: 20px;
            font-weight: 700;
            color: #111827;
        }

        .intro-text {
            margin: 0 0 28px;
            font-size: 14px;
            line-height: 1.7;
            color: #64748b;
        }

        /* ================================
           STATUS
        ================================= */

        .status-box {
            margin-bottom: 28px;
            padding: 16px 18px;
            background-color: #eff6ff;
            border: 1px solid #dbeafe;
            border-radius: 10px;
        }

        .status-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: #64748b;
        }

        .status-value {
            margin-top: 5px;
            font-size: 14px;
            font-weight: 700;
            color: #2563eb;
        }

        /* ================================
           DETAILS
        ================================= */

        .section-title {
            margin: 0 0 14px;
            font-size: 14px;
            font-weight: 700;
            color: #111827;
        }

        .details {
            width: 100%;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        .detail-row {
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row:last-child {
            border-bottom: none;
        }

        .detail-label {
            width: 38%;
            padding: 14px 16px;
            background-color: #f8fafc;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            vertical-align: top;
        }

        .detail-value {
            padding: 14px 16px;
            color: #111827;
            font-size: 13px;
            vertical-align: top;
            word-break: break-word;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            background-color: #fff7ed;
            color: #c2410c;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        /* ================================
           ACTION BOX
        ================================= */

        .action-box {
            margin-top: 30px;
            padding: 22px;
            background-color: #f8fafc;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
        }

        .action-title {
            margin: 0 0 7px;
            font-size: 15px;
            font-weight: 700;
            color: #111827;
        }

        .action-text {
            margin: 0 0 18px;
            font-size: 13px;
            line-height: 1.6;
            color: #64748b;
        }

        .button {
            display: inline-block;
            padding: 12px 22px;
            background-color: #171717;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 7px;
            font-size: 13px;
            font-weight: 700;
        }

        .button:hover {
            background-color: #262626;
        }

        /* ================================
           SECURITY
        ================================= */

        .security-box {
            margin-top: 25px;
            padding: 16px 18px;
            border-left: 3px solid #2563eb;
            background-color: #f8fafc;
        }

        .security-title {
            margin: 0 0 5px;
            font-size: 12px;
            font-weight: 700;
            color: #334155;
        }

        .security-text {
            margin: 0;
            font-size: 12px;
            line-height: 1.6;
            color: #64748b;
        }

        /* ================================
           FOOTER
        ================================= */

        .footer {
            padding: 25px 40px;
            background-color: #fafafa;
            border-top: 1px solid #e5e7eb;
            text-align: center;
        }

        .footer-brand {
            margin: 0 0 7px;
            font-size: 14px;
            font-weight: 700;
            color: #334155;
        }

        .footer-text {
            margin: 4px 0;
            font-size: 11px;
            line-height: 1.6;
            color: #94a3b8;
        }

        .footer a {
            color: #2563eb;
            text-decoration: none;
        }

        /* ================================
           MOBILE
        ================================= */

        @media only screen and (max-width: 600px) {

            .email-wrapper {
                padding: 15px 10px;
            }

            .header {
                padding: 28px 24px;
            }

            .body {
                padding: 28px 22px;
            }

            .footer {
                padding: 22px;
            }

            .header-title {
                font-size: 21px;
            }

            .detail-label,
            .detail-value {
                display: block;
                width: auto;
                padding: 10px 14px;
            }

            .detail-label {
                padding-bottom: 4px;
                border-bottom: 0;
            }

            .detail-value {
                padding-top: 4px;
            }

            .button {
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td>

                <div class="email-wrapper">

                    <table class="email-container" cellpadding="0" cellspacing="0" role="presentation">

                        <!-- =====================================
                             HEADER
                        ====================================== -->

                        <tr>
                            <td class="header">

                                <div class="brand">
                                    Orvi<span>Bazar</span>
                                </div>

                                <div class="header-label">
                                    Vendor Management
                                </div>

                                <div class="header-title">
                                    New Vendor Application
                                </div>

                                <div class="header-description">
                                    A new vendor has submitted an application
                                    and is waiting for administrative review.
                                </div>

                            </td>
                        </tr>


                        <!-- =====================================
                             BODY
                        ====================================== -->

                        <tr>
                            <td class="body">

                                <h2 class="intro-title">
                                    Vendor application received
                                </h2>

                                <p class="intro-text">
                                    A new vendor has registered on OrviBazar.
                                    Please review the application details below
                                    before approving or rejecting the account.
                                </p>


                                <!-- STATUS -->

                                <div class="status-box">

                                    <div class="status-label">
                                        Application Status
                                    </div>

                                    <div class="status-value">
                                        Pending Review
                                    </div>

                                </div>


                                <!-- DETAILS -->

                                <div class="section-title">
                                    Vendor Information
                                </div>

                                <table class="details"
                                       width="100%"
                                       cellpadding="0"
                                       cellspacing="0"
                                       role="presentation">

                                    <tr class="detail-row">
                                        <td class="detail-label">
                                            Vendor Name
                                        </td>

                                        <td class="detail-value">
                                            <strong>
                                                {{ $vendor->name ?? 'N/A' }}
                                            </strong>
                                        </td>
                                    </tr>


                                    <tr class="detail-row">
                                        <td class="detail-label">
                                            Shop Name
                                        </td>

                                        <td class="detail-value">
                                            <strong>
                                                {{ $vendor->shop_name ?? 'N/A' }}
                                            </strong>
                                        </td>
                                    </tr>


                                    <tr class="detail-row">
                                        <td class="detail-label">
                                            Email Address
                                        </td>

                                        <td class="detail-value">
                                            {{ $vendor->email ?? 'N/A' }}
                                        </td>
                                    </tr>


                                    <tr class="detail-row">
                                        <td class="detail-label">
                                            Contact Number
                                        </td>

                                        <td class="detail-value">
                                            {{ $vendor->contact ?? 'N/A' }}
                                        </td>
                                    </tr>


                                    <tr class="detail-row">
                                        <td class="detail-label">
                                            PAN Number
                                        </td>

                                        <td class="detail-value">
                                            {{ $vendor->pan_no ?? 'N/A' }}
                                        </td>
                                    </tr>


                                    <tr class="detail-row">
                                        <td class="detail-label">
                                            Status
                                        </td>

                                        <td class="detail-value">
                                            <span class="status-badge">
                                                {{ ucfirst($vendor->status ?? 'pending') }}
                                            </span>
                                        </td>
                                    </tr>


                                    <tr class="detail-row">
                                        <td class="detail-label">
                                            Submitted
                                        </td>

                                        <td class="detail-value">
                                            {{ $vendor->created_at
                                                ? $vendor->created_at->format('M d, Y • h:i A')
                                                : 'N/A'
                                            }}
                                        </td>
                                    </tr>


                                    @if($vendor->description)

                                        <tr class="detail-row">

                                            <td class="detail-label">
                                                Description
                                            </td>

                                            <td class="detail-value">
                                                {{ $vendor->description }}
                                            </td>

                                        </tr>

                                    @endif

                                </table>


                                <!-- ADMIN ACTION -->

                                <div class="action-box">

                                    <p class="action-title">
                                        Review this application
                                    </p>

                                    <p class="action-text">
                                        Open the vendor management panel to
                                        review the application and take the
                                        appropriate action.
                                    </p>

                                    <a
                                        href="{{ url('/admin/vendors/' . $vendor->id . '/edit') }}"
                                        class="button"
                                    >
                                        Review Vendor Application
                                    </a>

                                </div>


                                <!-- SECURITY -->

                                <div class="security-box">

                                    <p class="security-title">
                                        Security reminder
                                    </p>

                                    <p class="security-text">
                                        Verify the vendor's information and
                                        submitted documents before approving
                                        the application. This is an automated
                                        administrative notification from
                                        OrviBazar.
                                    </p>

                                </div>

                            </td>
                        </tr>


                        <!-- =====================================
                             FOOTER
                        ====================================== -->

                        <tr>
                            <td class="footer">

                                <p class="footer-brand">
                                    OrviBazar Vendor Management
                                </p>

                                <p class="footer-text">
                                    This notification was sent automatically
                                    to the OrviBazar administration team.
                                </p>

                                <p class="footer-text">
                                    &copy; {{ date('Y') }} OrviBazar.
                                    All rights reserved.
                                </p>

                            </td>
                        </tr>

                    </table>

                </div>

            </td>
        </tr>
    </table>

</body>

</html>
