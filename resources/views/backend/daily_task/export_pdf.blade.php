<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            page-break-inside: auto;
        }
        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: rgb(72, 76, 127);
            color: white;
        }
        tr.odd-row {
            background-color: #e0e0e0;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
        }
        .bg-warning { background-color: #ffc107; color: #000; }
        .bg-secondary { background-color: #6c757d; color: #fff; }
        .bg-info { background-color: #17a2b8; color: #000; }
        .bg-primary { background-color: rgb(72, 76, 127); color: #fff; }
        .bg-success { background-color: #28a745; color: #fff; }
        .bg-light { background-color: #f8f9fa; color: #000; }
        .bg-danger { background-color: #dc3545; color: #fff; }
        .bg-dark { background-color: #343a40; color: #fff; }
        .bg-pink { background-color: #f8d7da !important; color: #721c24 !important; }
        
        /* For repeating header on each page */
        thead { display: table-header-group; }
        tfoot { display: table-row-group; }
        tr { page-break-inside: avoid; }
    </style>
</head>
<body>

<h2 style="text-align: center; margin-bottom: 20px;">Today's Daily Task - {{ \Carbon\Carbon::now()->format('l, d-m-Y') }}</h2>

<table>
    <thead>
        <tr>
            <th>SI.NO</th>
            <th>Employee Name</th>
            <th>Project (P) / Ticket (T)</th>
            <th>Description</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @php $serial = 1; @endphp
        @foreach($tasks as $group)
            @php
                $rowspan = count($group);
                $isOddSerial = $serial % 2 !== 0;
                $remainingRows = $rowspan;
                $currentPageRows = 0;
            @endphp
            
            @foreach($group as $index => $task)
                @if($index == 0)
                    <tr class="{{ $isOddSerial ? 'odd-row' : '' }}">
                        <td rowspan="{{ $rowspan }}">{{ $serial }}</td>
                        <td rowspan="{{ $rowspan }}">{{ $task->user->name ?? 'Unknown' }}</td>
                        <td>{{ $task->type == 1 ? $task->project_ticket_name . ' (P)' : ($task->type == 2 ? $task->project_ticket_name . ' (T)' : '-') }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{!! $task->status_badge !!}</td>
                    </tr>
                @else
                    <tr class="{{ $isOddSerial ? 'odd-row' : '' }}">
                        <td>{{ $task->type == 1 ? $task->project_ticket_name . ' (P)' : ($task->type == 2 ? $task->project_ticket_name . ' (T)' : '-') }}</td>
                        <td>{{ $task->description }}</td>
                        <td>{!! $task->status_badge !!}</td>
                    </tr>
                @endif
            @endforeach
            @php $serial++; @endphp
        @endforeach
     
    </tbody>
</table>

</body>
</html>