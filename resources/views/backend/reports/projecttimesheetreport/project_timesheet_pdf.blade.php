```blade
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $reportTitle }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20mm;
        }

        h2 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }

        /* Set specific column widths */
        th:nth-child(1), td:nth-child(1) { /* SI No */
            width: 5%;
        }

        th:nth-child(2), td:nth-child(2) { /* Project */
            width: 20%;
            text-align: left;
        }

        th:nth-child(3), td:nth-child(3) { /* Project Owner */
            width: 15%;
            text-align: left;
        }

        th:nth-child(4), td:nth-child(4) { /* Status */
            width: 10%;
        }

        th:nth-child(5), td:nth-child(5) { /* Start Date */
            width: 10%;
        }

        th:nth-child(6), td:nth-child(6) { /* Project Deadline */
            width: 10%;
        }

        th:nth-child(7), td:nth-child(7) { /* Total BL Hrs */
            width: 8%;
        }

        th:nth-child(8), td:nth-child(8) { /* Total Non BL Hrs */
            width: 8%;
        }

        th:nth-child(9), td:nth-child(9) { /* Total Int BL Hrs */
            width: 8%;
        }

        th:nth-child(10), td:nth-child(10) { /* Manager Allocated Hrs */
            width: 8%;
        }

        th:nth-child(11), td:nth-child(11) { /* Remaining Hrs */
            width: 8%;
        }

        .text-danger {
            color: #dc3545;
            font-weight: bold;
        }

        .text-success {
            color: #28a745;
            font-weight: bold;
        }

        .status-box {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: bold;
            color: #fff;
        }

        .status-onboard {
            background-color: rgb(241, 152, 40); /* Orange */
        }

        .status-open {
            background-color: red; /* Red */
        }

        .status-progress {
            background-color: green; /* Green */
        }

        .status-monitor {
            background-color: blue; /* Blue */
        }

        .status-billing {
            background-color: rgb(0, 192, 239); /* Cyan */
        }

        .status-closed {
            background-color: gray; /* Gray */
        }

        .status-on_hold {
            background-color: rgb(193, 61, 61); /* Dark Red */
        }

        .status-warranty {
            background-color: purple; /* Purple */
        }

        .status-waiting_for_client_response {
            background-color: #3d405b; /* Dark Blue */
        }
    </style>
</head>
<body>
    <h2>{{ $reportTitle }}</h2>
    <div class="subtitle">{{ $exportDate }}</div>

    <table>
        <thead>
            <tr>
                <th>SI No</th>
                <th>Project</th>
                <th>Project Owner</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>Project Deadline</th>
                <th>Total BL Hrs</th>
                <th>Total Non BL Hrs</th>
                <th>Total Int BL Hrs</th>
                <th>Manager Allocated Hrs</th>
                <th>Remaining Hrs</th>
            </tr>
        </thead>
        <tbody>
            @foreach($finalData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['project_name'] }}</td>
                    <td>{{ $data['project_owner'] }}</td>
                    <td>
                        <span class="status-box status-{{ \Illuminate\Support\Str::slug(strtolower($data['status']), '_') }}">
                            {{ $data['status'] }}
                        </span>
                    </td>
                    <td>{{ \Carbon\Carbon::parse($data['start_date'])->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data['end_date'])->format('d-m-Y') }}</td>
                    <td>{{ $data['total_bl'] }}</td>
                    <td>{{ $data['total_non_bl'] }}</td>
                    <td>{{ $data['total_int_bl'] }}</td>
                    <td>{{ $data['allocated_hrs'] }}</td>
                    <td>
                        <span class="{{ $data['remaining_hrs'] < 0 ? 'text-danger' : 'text-success' }}">
                            {{ $data['remaining_hrs'] < 0 ? $data['remaining_hrs'] : '+' . $data['remaining_hrs'] }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
