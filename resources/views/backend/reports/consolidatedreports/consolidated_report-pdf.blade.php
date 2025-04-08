<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Consolidated Daily Report</title>
    <style>
        body {
             font-family: DejaVu Sans, sans-serif; 
             font-size: 10px; 
            }

        .heading_color { 
            background-color: #f2f2f2; font-weight: bold; 
        }

        .department-color {
             background-color: #f5f5f5; font-weight: bold; padding: 5px; 
            }

        .total { 
            font-weight: bold; background-color: #e6f7ff;
         }

        .billable_color { 
            color: green; 
            font-weight: bold
        }

        .non_billable_color { 
            color: red;
            font-weight: bold
         }

        .internal_billable_color { 
            color: blue; 
            font-weight: bold
        }

        table {
             width: 100%; border-collapse: collapse; margin-bottom: 10px; 
            }

        th, td {
             border: 1px solid #ddd; padding: 5px; text-align: left;
             }

        .timesheethead th { 
            background-color: #f2f2f2; font-weight: bold; 
        }

        .consolreporttbl tbody tr td{
            /* border-color: rgb(221, 221, 221) !important; */
            border-color: brown !important;
            font-size: 15px;

            }

            .consolreporttbl tr th{
                /* border-color: rgb(221, 221, 221) !important; */
                border-color: brown !important;
            
                
            }

        
        .timesheetbill { 
            color: #4CAF50; 
        }

        .timesheetnonbill {
             color: #f44336; 
         }

        .timesheetinternbill { 
            color: #2196F3; 
        }

        .totalconslrpt{

            text-align: center !important;
            color: rgb(70, 69, 116) !important;
        }

        .department-color {
            color: rgb(70, 69, 116) !important;
            background-color: rgb(240, 248, 255) !important;
            font-weight: bold;
            font-size: 20px;
            padding: 8px;
            text-align: center !important;
         }

         .timesheetbill{

            font-size: 18px !important; 
            color: green !important; 
            font-weight: 700 !important;
        }

        .timesheetnonbill{

            font-size: 18px;
            color: red !important; 
            font-weight: 700 !important;
        }

        .timesheetinternbill{

            font-size: 18px;
            color: blue !important; 
            font-weight: 700 !important;
        }

        
        .consolreporttbl tr td{
            border-color: rgb(221, 221, 221) !important;
            font-size: 15px;
            
        }

        .timesheet_table .timesheethead th{

          font-size: 16px;
        }

        .timesheet_table{
            margin-top: 20px !important;
        }

        .consolreporttbl tr th{

           font-size: 15px !important;
        }

    </style>
</head>
<body>
    <h2 style="text-align: center; font-weight: bold;">Consolidated Daily Report</h2>

        <p style="text-align: center; font-size: 15px; color: #2196F3;">
            @if($startDate && $endDate)
                Date Range: {{ date('d-m-Y', strtotime($startDate)) }} to {{ date('d-m-Y', strtotime($endDate)) }}
            @else
                All Records
            @endif
        </p>
  

    <table class="report-table consolreporttbl">
        <thead>
            <tr>
                <th class="heading_color">SL NO</th>
                <th class="heading_color">EMPLOYEE NAME</th>
                <th class="heading_color">BILLABLE HRS (%)</th>
                <th class="heading_color">NON BILLABLE HRS(%)</th>
                <th class="heading_color">INTERNAL BILLABLE HRS(%)</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach(['backend', 'frontend', 'internship'] as $dept)
                @if(count($departmentData[$dept]['employees']) > 0)
                    <!-- Department Header Row -->
                    <tr>
                        <td colspan="5" class="department-color">
                            <strong>{{ $departmentData[$dept]['name'] }}</strong>
                        </td>
                    </tr>
                    
                    <!-- Employee Rows -->
                    @foreach($departmentData[$dept]['employees'] as $data)
                        <tr>
                            <td>{{ $data['si_no'] }}.</td>
                            <td>{{ $data['employee_name'] }}</td>
                            <td>{{ number_format($data['billable_hrs'], 2) }} ({{ number_format($data['billable_percent'], 2) }}%)</td>
                            <td>{{ number_format($data['non_billable_hrs'], 2) }} ({{ number_format($data['non_billable_percent'], 2) }}%)</td>
                            <td>{{ number_format($data['internal_hrs'], 2) }} ({{ number_format($data['internal_percent'], 2) }}%)</td>
                        </tr>
                    @endforeach
                    
                    <!-- Department Total Row -->
                    <tr>
                        <td colspan="2" class="totalconslrpt"><strong>Total</strong></td>
                        <td class="billable_color">{{ number_format($departmentData[$dept]['totals']['billable'], 2) }} ({{ number_format($departmentData[$dept]['total_row']['billable_percent'], 2) }}%)</td>
                        <td class="non_billable_color">{{ number_format($departmentData[$dept]['totals']['non_billable'], 2) }} ({{ number_format($departmentData[$dept]['total_row']['non_billable_percent'], 2) }}%)</td>
                        <td class="internal_billable_color">{{ number_format($departmentData[$dept]['totals']['internal'], 2) }} ({{ number_format($departmentData[$dept]['total_row']['internal_percent'], 2) }}%)</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <table class="table table-bordered timesheet_table">
        <tbody>
            <tr class="timesheethead">
                <th>PROJECTWISE</th>
                <th>HOURS</th>
                <th>%</th>
                <th>TICKETWISE</th>
                <th>HOURS</th>
                <th>%</th>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td class="font-weight-bold billable_color_fin timesheetbill">Billable</td>
                <td class="font-weight-bold billable_color_fin timesheetbill">{{ number_format($totals['project_billable'], 2) }}</td>
                <td class="font-weight-bold billable_color_fin timesheetbill">{{ $totals['project_billable'] > 0 ? number_format(($totals['project_billable'] / $totals['project_total']) * 100, 2) : '0.00' }}%</td>
                <td class="font-weight-bold billable_color_fin timesheetbill">Billable</td>
                <td class="font-weight-bold billable_color_fin timesheetbill">{{ number_format($totals['ticket_billable'], 2) }}</td>
                <td class="font-weight-bold billable_color_fin timesheetbill">{{ $totals['ticket_billable'] > 0 ? number_format(($totals['ticket_billable'] / $totals['ticket_total']) * 100, 2) : '0.00' }}%</td>
            </tr>
            <tr>
                <td class="font-weight-bold non_billable_color_fin timesheetnonbill">Non Billable</td>
                <td class="font-weight-bold non_billable_color_fin timesheetnonbill">{{ number_format($totals['project_non_billable'], 2) }}</td>
                <td class="font-weight-bold non_billable_color_fin timesheetnonbill">{{ $totals['project_non_billable'] > 0 ? number_format(($totals['project_non_billable'] / $totals['project_total']) * 100, 2) : '0.00' }}%</td>
                <td class="font-weight-bold non_billable_color_fin timesheetnonbill">Non Billable</td>
                <td class="font-weight-bold non_billable_color_fin timesheetnonbill">{{ number_format($totals['ticket_non_billable'], 2) }}</td>
                <td class="font-weight-bold non_billable_color_fin timesheetnonbill">{{ $totals['ticket_non_billable'] > 0 ? number_format(($totals['ticket_non_billable'] / $totals['ticket_total']) * 100, 2) : '0.00' }}%</td>
            </tr>
            <tr>
                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill">Internal Billable</td>
                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill">{{ number_format($totals['project_internal'], 2) }}</td>
                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill">{{ $totals['project_internal'] > 0 ? number_format(($totals['project_internal'] / $totals['project_total']) * 100, 2) : '0.00' }}%</td>
                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill">Internal Billable</td>
                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill">{{ number_format($totals['ticket_internal'], 2) }}</td>
                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill">{{ $totals['ticket_internal'] > 0 ? number_format(($totals['ticket_internal'] / $totals['ticket_total']) * 100, 2) : '0.00' }}%</td>
            </tr>
            <tr>
                <td class="font-weight-bold totalconslrpt" style="font-size: 22px"><strong>Total</strong></td>
                <td class="font-weight-bold" style="font-size: 22px">{{ number_format($totals['project_total'], 2) }}</td>
                <td colspan="2"></td>
                <td colspan="2" class="font-weight-bold" style="font-size: 22px">{{ number_format($totals['ticket_total'], 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>