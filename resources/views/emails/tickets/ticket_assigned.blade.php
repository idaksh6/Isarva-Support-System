<!DOCTYPE html>
<html>
<head>
    <title>New Ticket Assignment Notification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            color: #2c3e50;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
        }
        .ticket-info {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .ticket-info p {
            margin: 5px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #7f8c8d;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>New Ticket Assignment</h2>
    </div>
    
    <p>Hii,</p>
    
    <p>You have been assigned a new support ticket that requires your attention.</p>
    
    <div class="ticket-info">
        <p><strong>Assigned by:</strong> {{ $assignedByName }}</p>
        <p><strong>Ticket ID:</strong> #{{ $ticketId }}</p>
        <p><strong>Title:</strong> {{ $ticketTitle }}</p>
        
    </div>
    
    <p>Please review and take appropriate action on this ticket at your earliest convenience.</p>
    
    <a href="{{ route('login') }}" class="button" style="color:white;">View Ticket</a>
    
    <div class="footer">
        <p>Best regards,<br>
        <strong>Support Team</strong></p>
        
        <p style="font-size: 0.8em; margin-top: 20px;">
            This is an automated notification. Please do not reply to this email.
        </p>
    </div>
</body>
</html>