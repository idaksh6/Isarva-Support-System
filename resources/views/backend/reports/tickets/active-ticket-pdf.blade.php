<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Active Ticket Report</title>

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
    <h2 style="text-align: center;"> Active Tickets Report </h1>
    <table>
        <thead>
            <th>Sl.No</th>
            <th>Ticket</th>
            <th>Total Worked Hours</th>
            <th>Status</th>
            <th>Priority</th>
            <th>Created By</th>
            <th>Assigned To</th>
            <th>End Date</th>
            <th>Comments</th>
        </thead>
        <tbody>
            @php
                $i=1;
            @endphp
            @foreach ($tickets as $t)
            <tr>
                <td>{{$i}}</td>
                <td>{{'#'.$t->ticketId.''.$t->title}}</td>
                <td>{{$t->hrs}}</td>
                <td>{{ $status[$t->status] ?? 'Unknown' }}</td>
                <td>{{$Priority[$t->priority] ?? 'Unknown'}}</td>
                <td>{{$employees[$t->created_by] ?? 'Unknown'}}</td>
                <td>{{$employees[$t->flag_to] ?? 'Unknown'}}</td>
                <td>{{ \Carbon\Carbon::parse($t->end_date)->format('d-m-Y') }}</td>
                <td>{{$t->discussion_comments}}</td>
            </tr> 
            @php
                $i++;
            @endphp
            @endforeach
        </tbody>
    </table>
</body>
</html>