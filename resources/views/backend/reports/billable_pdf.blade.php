<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Billable/Non-Billable Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .total-label {
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Billable/Non-Billable Report</h2>
    
    <table>
        <thead>
            <tr>
                <th>Employee</th>
                <th>Date</th>
                <th>Project(P)/Ticket(T)</th>
                <th>Task</th>
                <th>Comment</th>
                <th>Task Time</th>
                <th>Billing Type</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->user->name ?? 'N/A' }}</td>
                    <td>{{ $report->created_at->format('Y-m-d') }}</td>
                    <td>{{ $report->project_name }} ({{ $report->type == 1 ? 'P' : 'T' }})</td>
                    <td>{{ $report->task_name }}</td>
                    <td>{{ $report->comments }}</td>
                    <td>{{ $report->hrs }}</td>
                    <td>
                        @switch($report->billable_type)
                            @case(0) Non-Billable @break
                            @case(1) Billable @break
                            @case(2) Internal Billable @break
                            @default Unknown
                        @endswitch
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-label">
        <b><span style="color: green;">Total Billable Hours: {{ number_format($totals['billable'], 2) }}</span>
        <span> ({{ $totals['billable'] + $totals['non_billable'] + $totals['internal_billable'] > 0 
            ? number_format($totals['billable'] / ($totals['billable'] + $totals['non_billable'] + $totals['internal_billable']) * 100, 2) 
            : 0 }}%)</span></b>
    </div>
    
    <div class="total-label">
        <b><span style="color: red;">Total Non Billable Hours: {{ number_format($totals['non_billable'], 2) }}</span>
        <span> ({{ $totals['billable'] + $totals['non_billable'] + $totals['internal_billable'] > 0 
            ? number_format($totals['non_billable'] / ($totals['billable'] + $totals['non_billable'] + $totals['internal_billable']) * 100, 2) 
            : 0 }}%)</span></b>
    </div>
    
    <div class="total-label">
        <b><span style="color: blue;">Total Internal Billable Hours: {{ number_format($totals['internal_billable'], 2) }}</span>
        <span> ({{ $totals['billable'] + $totals['non_billable'] + $totals['internal_billable'] > 0 
            ? number_format($totals['internal_billable'] / ($totals['billable'] + $totals['non_billable'] + $totals['internal_billable']) * 100, 2) 
            : 0 }}%)</span></b>
    </div>
</body>
</html>