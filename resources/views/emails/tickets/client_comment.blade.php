<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Client Comment Notification</title>
    <style>
        /* Reset styles for email compatibility */
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
            transition: background-color 0.3s;
        }
        
        .btn:hover {
            background-color: #1d4ed8;
        }
        
        .footer {
            text-align: center;
            padding: 25px;
            color: #64748b;
            font-size: 14px;
            background-color: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }
        
        .ticket-id {
            background-color: #dbeafe;
            color: #2563eb;
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: 600;
        }
        
        @media (max-width: 600px) {
            .email-container {
                border-radius: 0;
            }
            
            .email-header, .email-body {
                padding: 20px;
            }
            
            .email-header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>New Client Comment on Ticket <span class="ticket-id">#{{ $ticket->id }}</span></h1>
        </div>
        
        <div class="email-body">
            <div class="notification-card">
                <div class="info-item">
                    <span class="info-label">Client</span>
                    <span class="info-value">{{ $ticket->client_name }}</span>
                </div>
                
                <div class="info-item">
                    <span class="info-label">Subject</span>
                    <span class="info-value">{{ $ticket->title }}</span>
                </div>
            </div>
            
            <div>
                <span class="info-label">Comment</span>
                <div class="comment-block">
                    {{ $comment }}
                </div>
            </div>
            
            @if ($fileName)
                <div class="attachment-notice">
                    <span class="attachment-label">Attachment:</span> {{ $fileName }}
                </div>
            @endif
            
            <p style="margin: 25px 0 15px; font-size: 16px;">
                Check the ticket in your dashboard for more details.
            </p>
            
            <a href="{{ route('clientloginform') }}" class="btn">View Ticket in The Support</a>
        </div>
        
        <div class="footer">
            <p>Regards,<br><strong>Isarva Support Team</strong></p>
            <p style="margin-top: 10px; font-size: 13px; color: #94a3b8;">
                This is an automated notification. Please do not reply to this email.
            </p>
        </div>
    </div>
</body>
</html>