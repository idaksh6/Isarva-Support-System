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
        font-size: 24px;
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

    thead{
        color: white;
    }

    table thead tr th{

        background-color: green !important;
    }

    .billing-summary {
        margin: 15px 0;
        font-size: 20px;
    }

    .billing-row {
        margin-bottom: 8px;
    }

    .billing-label {
        display: inline-block;
        width: fit-content;
        font-weight: bold;
    }

    .billing-value {
        display: inline-block;
        min-width: 60px;
       
    }

   /* Color coding for billing types */
    .billable-row .billing-label {
        color: green; /* Green */
        font-weight: bold;
    }

    .billable-row .billing-value {
        color: green; 
        font-weight: bold;
    }

    .non-billable-row .billing-label {
        color: red; 
        font-weight: bold;
    }
    .non-billable-row .billing-value {
        color: red; 
        font-weight: bold;
    }

    .internal-billable-row .billing-label {
        color: blue; 
        font-weight: bold;
    }
    .internal-billable-row .billing-value {
        color: blue;
        font-weight: bold;
    }


</style>

   
</head>
<body>

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
                        @if($data->type == 1) <!-- Project -->
                            <strong>Project:</strong> {{ $data->project_name }}<br>
                            <strong>Task:</strong> {{ $data->task_name }}
                        @elseif($data->type == 2) <!-- Ticket -->
                            <strong>Ticket:</strong> {{ $data->project_name }} 
                        @endif
                    </td>
                    <td>{{ $data->comments }}</td>
                    <td>{{ $data->hrs }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">Total Hours</td>
                <td><strong>{{ $totalTime }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <!-- Billing Summary with color coding -->
    <div class="billing-summary">
        <div class="billing-row billable-row">
            <span class="billing-label">Billable Hrs:</span>
            <span class="billing-value">{{ $billableHrs }}</span>
        </div>
        <div class="billing-row non-billable-row">
            <span class="billing-label">Non Billable Hrs:</span>
            <span class="billing-value">{{ $nonBillableHrs }}</span>
        </div>
        <div class="billing-row internal-billable-row">
            <span class="billing-label">Internal Billable Hrs:</span>
            <span class="billing-value">{{ $internalBillableHrs }}</span>
        </div>
    </div>

    <!-- Overall Status -->
    <div class="overall-status">
        <span class="overall-status-label">Overall Status:</span>
        <span class="overall-status-value">{{ $overallStatus }}</span>
    </div>
</body>
</html>