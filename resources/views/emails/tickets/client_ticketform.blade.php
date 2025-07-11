<!DOCTYPE html>
<html>
<head>
    <title>New Client Support Ticket</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
             background: #f7f7f7; padding: 20px; 
            }
        .container {
             background: #fff; 
            padding: 30px;
             border-radius: 8px; 
             box-shadow: 0 2px 8px rgba(0,0,0,0.1); 
            }
        h2 { 
            color: #2c3e50; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }

        th, td { 
            text-align: left; 
            padding: 8px; 
            border-bottom: 1px solid #ddd; 
        }
        th {
             background-color: #f1f1f1;
             }
        .footer { 
            margin-top: 30px; font-size: 12px; color: #777; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>New Client Support Ticket Submitted</h2>
        <table>
            <tr>
                <th>Client Name</th>
                <td>{{ $data['client_name'] }}</td>
            </tr>
            <tr>
                <th>Email Address</th>
                <td>{{ $data['email'] }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $data['phone'] }}</td>
            </tr>
            @if(!empty($data['name']))
            <tr>
                <th>Domain Name</th>
                <td>{{ $data['name'] }}</td>
            </tr>
            @endif
            <tr>
                <th>Subject</th>
                <td>{{ $data['subject'] }}</td>
            </tr>
            <tr>
                <th>Issue Type</th>
                <td>{{ $data['type'] }}</td>
            </tr>
            <tr>
                <th>Message</th>
                <td>{{ $data['message'] }}</td>
            </tr>
        </table>

        @if(!empty($data['attachment']))
        <p><strong>Attached File:</strong> {{ $data['attachment'] }}</p>
        @endif

        <div class="footer">
            You are receiving this because a client submitted a new support request on your platform.
        </div>
    </div>
</body>
</html>
