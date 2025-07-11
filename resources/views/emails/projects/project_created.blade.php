<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Project Created</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .header {
            background-color: #484c7f;
            color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            background-color: #fff;
        }
        .content p {
            margin: 10px 0;
        }
        .highlight-box {
            background-color: #ffe9d5;
            border-left: 6px solid #e67e22;
            padding: 16px;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .highlight-text {
            color: #e67e22;
            font-weight: bold;
        }
        .project-title {
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }
        .separator {
            border-top: 1px solid #ccc;
            margin: 10px 0 0 0;
        }
        .logo {
            text-align: center;
            margin-bottom: 15px;
        }
        .logo img {
            max-height: 60px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">

        <!-- Logo -->
        {{-- <div class="logo">
        <img src="https://isarvait.com/wp-content/uploads/2024/08/Favicon.png" alt="Isarva Logo">

        </div> --}}

   <!-- Header with Logo and Title -->
    {{-- <div class="header">
        <img src="https://isarvait.com/wp-content/uploads/2024/08/Favicon.png" alt="Isarva Logo" style="max-height: 40px;">
        <h2 style="margin: 0; flex: 1; text-align: center;">New Project Created</h2>
        <div style="width: 40px;"><!-- Spacer to balance logo --></div>
    </div> --}}
    <!-- Email-safe Header -->
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #484c7f; border-radius: 5px 5px 0 0;">
        <tr>
            <!-- Logo Cell (Left) -->
            <td style="padding: 10px; width: 50px;">
                <img src="https://isarvait.com/wp-content/uploads/2024/08/Favicon.png" alt="Isarva Logo" style="max-height: 40px;">
            </td>

            <!-- Title Cell (Center) -->
            <td align="center" style="padding: 10px;">
                <h2 style="margin: 0; font-family: Arial, sans-serif; color: #ffffff;">New Project Created</h2>
            </td>

            <!-- Right Spacer Cell (same width as logo for balance) -->
            <td style="width: 50px;">&nbsp;</td>
        </tr>
    </table>


        <div class="content">
            <p><strong>Dear Team,</strong></p>
            <p>A new project has been created with the following details:</p>

            <!-- Highlighted Estimation and Project Name -->
            <div class="highlight-box">
                <div class="project-title">Project Name: {{ $project_name }}</div>
                <div class="separator"></div>
                Estimation Hours: <span class="highlight-text">{{ $estimation }} hours</span>
            </div>

            <p><strong>Client Name:</strong> {{ $client_name }}</p>
            <p><strong>Project Category:</strong> {{ $category_name }}</p>
            <p><strong>Created By:</strong> {{ $created_by }}</p>
            <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($start_date)->format('d-m-Y') }}</p>
            <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($end_date)->format('d-m-Y') }}</p>
            <p><strong>Type:</strong> {{ $type }}</p>
            <p><strong>Billing Company:</strong> {{ $billing_company }}</p>
            <p><strong>Description:</strong> {{ $description }}</p>
        </div>

        <div class="footer">
            <p>This is an automated notification. Please do not reply directly to this email.</p>
            <p>&copy; {{ date('Y') }} Isarva. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
