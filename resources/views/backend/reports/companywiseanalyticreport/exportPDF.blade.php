<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Analytics Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #007bff;
            padding-bottom: 15px;
        }
        
        .header h1 {
            color: #007bff;
            font-size: 24px;
            margin: 0;
            font-weight: bold;
        }
        
        .company-section {
            margin-bottom: 40px;
        }
        
        .company-title {
            background-color: #f8f9fa;
            padding: 15px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #007bff;
            border: 1px solid #dee2e6;
            margin-bottom: 20px;
        }
        
        .months-container {
            display: table;
            width: 100%;
            border-collapse: collapse;
        }
        
        .month-column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding: 0 10px;
        }
        
        .month-title {
            color: #007bff;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .chart-container {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .chart-image {
            max-width: 100%;
            height: auto;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
        
        .stats-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        .stats-table th,
        .stats-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        
        .stats-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        
        .text-success { color: #28a745; }
        .text-danger { color: #dc3545; }
        .text-primary { color: #007bff; }
        
        .summary-row {
            font-weight: bold;
            background-color: #f8f9fa;
        }
        
        .footer {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 10px;
            color: #666;
        }
        
        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 20px;
        }
    </style>
</head>
<body>
    @foreach($companyData as $companyId => $company)
        @if(!$loop->first)
            <div class="page-break"></div>
        @endif
        
        <div class="header">
            <h1>Company Analytics Report</h1>
            <p>Generated on {{ now()->format('F j, Y \a\t g:i A') }}</p>
        </div>
        
        <div class="company-section">
            <div class="company-title">
                {{ $company['name'] }}
            </div>
            
            <div class="months-container">
                <!-- Previous Month Column -->
                <div class="month-column">
                    <div class="month-title">
                        {{ $prevMonthDate->format('F Y') }}
                    </div>
                    
                    @php 
                        $prevData = $company['months'][$prevMonthDate->format('m-Y')]; 
                        $prevChartData = [
                            'billable' => $prevData['billable'],
                            'non_billable' => $prevData['non_billable'],
                            'internal_billable' => $prevData['internal_billable']
                        ];
                    @endphp
                    
                    <div class="chart-container">
                        <img src="{{ $this->generateChart($prevChartData, 'doughnut') }}" 
                             alt="Previous Month Chart" 
                             class="chart-image">
                    </div>
                    
                    <table class="stats-table">
                        <tr class="summary-row">
                            <th>Total Hours:</th>
                            <td>{{ number_format($prevData['total_hrs'], 2) }} hrs</td>
                        </tr>
                        <tr class="text-success">
                            <th>Billable:</th>
                            <td>
                                {{ number_format($prevData['billable'], 2) }} hrs
                                ({{ $prevData['total_hrs'] ? number_format($prevData['billable']/$prevData['total_hrs']*100, 2) : 0 }}%)
                            </td>
                        </tr>
                        <tr class="text-danger">
                            <th>Non-Billable:</th>
                            <td>
                                {{ number_format($prevData['non_billable'], 2) }} hrs 
                                ({{ $prevData['total_hrs'] ? number_format($prevData['non_billable']/$prevData['total_hrs']*100, 2) : 0 }}%)
                            </td>
                        </tr>
                        <tr class="text-primary">
                            <th>Internal Billable:</th>
                            <td>
                                {{ number_format($prevData['internal_billable'], 2) }} hrs
                                ({{ $prevData['total_hrs'] ? number_format($prevData['internal_billable']/$prevData['total_hrs']*100, 2) : 0 }}%)
                            </td>
                        </tr>
                    </table>
                </div>
                
                <!-- Current Month Column -->
                <div class="month-column">
                    <div class="month-title">
                        {{ $selectedDate->format('F Y') }}
                    </div>
                    
                    @php 
                        $currData = $company['months'][$selectedDate->format('m-Y')]; 
                        $currChartData = [
                            'billable' => $currData['billable'],
                            'non_billable' => $currData['non_billable'],
                            'internal_billable' => $currData['internal_billable']
                        ];
                    @endphp
                    
                    <div class="chart-container">
                        <img src="{{ $this->generateChart($currChartData, 'doughnut') }}" 
                             alt="Current Month Chart" 
                             class="chart-image">
                    </div>
                    
                    <table class="stats-table">
                        <tr class="summary-row">
                            <th>Total Hours:</th>
                            <td>{{ number_format($currData['total_hrs'], 2) }} hrs</td>
                        </tr>
                        <tr class="text-success">
                            <th>Billable:</th>
                            <td>
                                {{ number_format($currData['billable'], 2) }} hrs 
                                ({{ $currData['total_hrs'] ? number_format($currData['billable']/$currData['total_hrs']*100, 2) : 0 }}%)
                            </td>
                        </tr>
                        <tr class="text-danger">
                            <th>Non-Billable:</th>
                            <td>
                                {{ number_format($currData['non_billable'], 2) }} hrs 
                                ({{ $currData['total_hrs'] ? number_format($currData['non_billable']/$currData['total_hrs']*100, 2) : 0 }}%)
                            </td>
                        </tr>
                        <tr class="text-primary">
                            <th>Internal Billable:</th>
                            <td>
                                {{ number_format($currData['internal_billable'], 2) }} hrs 
                                ({{ $currData['total_hrs'] ? number_format($currData['internal_billable']/$currData['total_hrs']*100, 2) : 0 }}%)
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
    
    <div class="footer">
        Page <script type="text/php">
            if (isset($pdf)) {
                $pdf->page_text(520, 820, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0,0,0));
            }
        </script>
    </div>
</body>
</html>