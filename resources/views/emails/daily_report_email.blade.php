<!DOCTYPE html>
<html>
<head>
    <title>Daily Report Submission</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Daily Report Submission</h2>

    <table>
        <thead>
            <tr>
                <th>SI.NO</th>
                <th>Task</th>
                <th>Comments</th>
                <th>Spent Hrs</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['task_name'] ?? 'N/A' }}</td>
                    <td>{{ $data['comments'] ?? 'N/A' }}</td>
                    <td>{{ $data['hrs'] ?? '0' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
