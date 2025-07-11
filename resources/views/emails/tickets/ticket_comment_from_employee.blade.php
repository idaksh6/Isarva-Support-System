<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Client Comment Notification</title>
    <style>
        body, table, td, div, p {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        body {
            background-color: #f5f7fa;
            color: #333333;
            padding: 20px 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .email-header {
            background-color: #2563eb;
            color: white;
            padding: 25px 30px;
            text-align: center;
        }

        .email-header h1 {
            font-size: 24px;
            font-weight: 600;
            margin: 0;
        }

        .email-body {
            padding: 30px;
        }

        .notification-card {
            background-color: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 20px;
            border-radius: 4px;
            margin-bottom: 25px;
        }

        .info-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .info-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #4b5563;
            display: block;
            margin-bottom: 5px;
        }

        .info-value {
            color: #1e293b;
            font-size: 16px;
        }

        .comment-block {
            background-color: #eff6ff;
            border-radius: 6px;
            padding: 18px;
            margin: 20px 0;
            font-style: italic;
            color: #334155;
            border-left: 3px solid #93c5fd;
        }

        .attachment-notice {
            background-color: #f0fdf4;
            padding: 15px;
            border-radius: 6px;
            margin: 20px 0;
            border-left: 3px solid #34d399;
        }

        .attachment-label {
            font-weight: 600;
            color: #047857;
        }

        .btn {
            display: inline-block;
            background-color: #2563eb;
            color: white !important;
            text-decoration: none;
            padding: 12px 25px;
            border-radius: 6px;
            font-weight: 500;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>New Comment on Your Ticket</h1>
        </div>
        <div class="email-body">
            <div class="notification-card">
                <div class="info-item">
                    <span class="info-label">Ticket Title:</span>
                    <span class="info-value">{{ $ticket->title ?? 'N/A' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Ticket ID:</span>
                    <span class="info-value">#{{ $ticket->id }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Commented By:</span>
                    <span class="info-value">{{ $user->name ?? 'Employee' }}</span>
                </div>
            </div>

            <div class="comment-block">
                "{{ $comment }}"
            </div>

            @if(!empty($fileName))
            <div class="attachment-notice">
                <div class="attachment-label">An attachment is included with this comment.</div>
                <div class="info-value">{{ $fileName }}</div>
            </div>
            @endif

            <a href="{{ route('clientloginform') }}" class="btn" target="_blank">View Ticket</a>
        </div>
    </div>
</body>
</html>
