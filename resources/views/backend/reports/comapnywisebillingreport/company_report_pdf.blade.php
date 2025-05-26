<!DOCTYPE html>
<html>
<head>
    <title>Company Wise Billing Report</title>
    <style>
        body { 
            font-family: Arial, sans-serif;
            font
            -size: 10pt; /* Slightly smaller font for landscape */
        }
        .header { 
            text-align: center; 
            margin-bottom: 15px;
        }

        .header h1 { 
            font-size: 14pt; 
            margin-bottom: 5px;
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 15px;
            font-size: 9pt; /* Smaller font for table */
        }

        th, td { 
            border: 1px solid #ddd; 
            padding: 4px; 
            text-align: left;
        }

        th { 
            background-color: #343a40; 
            color: white; 
            font-weight: bold;
        }

        .summary { 
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .summary-item { 
            margin-bottom: 5px; 
            font-size: 20px;
            width: 30%;
        }

        .billable { color: green; font-weight: bold; }
        .non-billable { color: red; font-weight: bold; }
        .internal { color: blue; font-weight: bold; }
        .page-break {
            page-break-after: always;
        }

        .report-title {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .report-subtitle {
            font-size: 12pt;
            margin-bottom: 5px;
        }

        .employee-info {
            font-size: 11pt;
            margin-bottom: 10px;
            color: #555;
        }

        .generated-info {
            font-size: 9pt;
            color: #777;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        @if(isset($employeeData))
            <div class="employee-info">
                Employee: {{ $employeeData['name'] }} (ID: {{ $employeeData['id'] }})
            </div>
        @endif
        
        <div class="report-title">
            {{ $reportType }}
        </div>
        
        <div class="report-subtitle">
            Company Wise Billing Report
            @if($startDate && $endDate)
                from {{ $startDate }} to {{ $endDate }}
            @elseif($startDate)
                from {{ $startDate }}
            @elseif($endDate)
                until {{ $endDate }}
            @endif
        </div>
        
        <div class="generated-info">
            Generated on: {{ now()->format('d-M-Y h:i A') }}
        </div>
    </div>


    <table>
        <thead>
            <tr>
                <th width="5%">SI.NO</th>
                <th width="15%">Employee</th>
                <th width="8%">Date</th>
                <th width="15%">Project(P)/Ticket(T)</th>
                <th width="15%">Task</th>
                <th width="15%">Comment</th>
                <th width="7%">Task Time</th>
                <th width="10%">Billing Type</th>
                <th width="10%">Billing Company</th>
            </tr>
        </thead>
        <tbody>
            @forelse($results as $index => $row)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $row->user->name ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->created_at)->format('d-m-Y') }}</td>
                    <td>{{ $row->project_name }} ({{ $row->type == 1 ? 'P' : 'T' }})</td>
                    <td>{{ $row->task_name }}</td>
                    <td>{{ $row->comments }}</td>
                    <td>{{ $row->hrs }}</td>
                    <td>{{ $row->billable_type_text }}</td>
                    <td>{{ $row->billing_company_name ?? 'N/A' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">No records found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <div class="summary-item billable">
            <strong>Billable:</strong> {{ $billable }} hrs ({{ $billablePercent }}%)
        </div>
        <div class="summary-item non-billable">
            <strong>Non-Billable:</strong> {{ $nonBillable }} hrs ({{ $nonBillablePercent }}%)
        </div>
        <div class="summary-item internal">
            <strong>Internal Billable:</strong> {{ $internalBillable }} hrs ({{ $internalPercent }}%)
        </div>
    </div>
</body>
</html>