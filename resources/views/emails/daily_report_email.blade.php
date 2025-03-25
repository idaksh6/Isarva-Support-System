<!DOCTYPE html>
<html>
<head>
    <title>Daily Report Submission</title>
<style>
   
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .overall-status {
        font-size: 18px;
        font-weight: bold;
        margin-top: 20px;
    }

    .overall-status-label {
        color: red;
    }

    .overall-status-value {
        color: blue;
    }

    tfoot td {
        font-size: 20px;
        border: 1px solid #ddd;
        padding: 8px;
        background-color: #f2f2f2;
    }


</style>

   
</head>
<body>
    <h2>Daily Report Submission</h2>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>Task</th>
                <th>Comments</th>
                <th>Spent Hrs</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>Project:</strong> {{ $data->project_name }}<br>
                        <strong>Task:</strong> {{ $data->task_name }}
                    </td>
                    <td>{{ $data->comments }}</td> <!-- Comments from si_daily_report_fields -->
                    <td>{{ $data->hrs }}</td> <!-- Hrs from si_daily_report_fields -->
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total Hours</td>
                <td><strong>{{ $totalTime }}</strong></td> <!-- Dynamic total time -->
            </tr>
        </tfoot>
    </table>

    <!-- Overall Status outside the table -->
    <div class="overall-status">
        <span class="overall-status-label">Overall Status:</span>
        <span class="overall-status-value">{{ $overallStatus }}</span>
    </div>
</body>
</html>