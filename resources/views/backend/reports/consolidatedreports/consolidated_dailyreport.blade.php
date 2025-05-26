@extends('backend.layouts.app')

@section('title', 'Consolidated DailyReport | Isarva Support')

@section('content')
     
<style>
    .total-summary-container {
        border: 1px solid #dee2e6;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .total-summary-container h5 {
        margin-bottom: 0;
        font-size: 16px;
    }
    
    @media (max-width: 768px) {
        .total-summary-container .col-md-4 {
            margin-bottom: 10px;
        }
    }




    .total-summary-container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            margin: 40px auto;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s ease;
            font-family: 'Arial', sans-serif;
        }

        .row {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        /* Common Styling for Columns */
        .col-md-4 {
            flex: 1;
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            margin: 0 10px;
            transition: all 0.3s ease;
            color: white;
            font-size: 18px;
            font-weight: 600;
        }

        /* Specific Colors for Each Section */
        .billable_color_fin {
            background-color: #4caf50; /* Green */
        }

        .non_billable_color_fin {
            background-color: #f44336; /* Red */
        }

        .internal_billable_color_fin {
            background-color: blue; /* Orange */
        }

        /* Hover Effect for Columns */
        .col-md-4:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        /* Styling for Text (H5) */
        .total-summary-container h5 {
            margin: 0;
            font-size: 15px;
            font-weight: 600;
            padding: 20px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .total-summary-container {
                flex-direction: column;
                align-items: stretch;
            }

            .col-md-4 {
                margin: 10px 0;
            }
        }

        @media(max-width: 768px){
         
            .consolreporttbl{

                margin:10px;
                
            }

            .consolreporttbl tr td {

                font-size: 11px;
            }

            th.heading_color {

                font-size: 11px !important;
            }

            .timesheet_table .timesheethead th {

                font-size: 11px;
            }

            
            .timesheetbill {
                font-size: 11px  !important;
                
            }

            .timesheetnonbill {

                font-size: 11px;
               
            }

            .timesheetinternbill {

                font-size: 11px;
               
            }

        }
</style>
    <div class="search-container">
    
        <form method="GET" action="{{ route('admin.consolidated_dailyreport') }}" id="searchForm">
            <div class="row">
                <div class="col-md-6">
                    <div class="date-field">
                        <label for="start-date">Start Date:</label>
                        <input type="date" id="start-date" name="start_date" 
                        value="{{ request()->has('start_date') ? request('start_date') : now()->subDay()->toDateString() }}"
                        class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="date-field">
                        <label for="end-date">End Date:</label>
                        <input type="date" id="end-date" name="end_date" 
                        value="{{ request()->has('end_date') ? request('end_date') : now()->toDateString() }}"
                        class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <div class="table-container" id="resultsContainer" style="{{ request()->has('start_date') ? '' : 'display: none;' }}">
        @if(request()->has('start_date'))
        <!-- Export PDF -->
        <div class="container mt-4 m-0">
        
            <div class="card-body ">
                <button id="exportPdf" class="btn btn-success btn-lg">
                    <i class="fas fa-file-pdf"></i> Export to PDF
                </button>
            </div>
        
        </div>

       <!-- Toal Hrs calculation --> 
        <div class="total-summary-container mt-4 mb-4 p-3" style="background-color: #f8f9fa; border-radius: 5px;">
            <div class="row">
                @php
                    // Calculate grand totals across all departments
                    $totalBillable = $departmentData['backend']['totals']['billable'] + 
                                    $departmentData['frontend']['totals']['billable'] + 
                                    $departmentData['internship']['totals']['billable'];
                    
                    $totalNonBillable = $departmentData['backend']['totals']['non_billable'] + 
                                    $departmentData['frontend']['totals']['non_billable'] + 
                                    $departmentData['internship']['totals']['non_billable'];
                    
                    $totalInternal = $departmentData['backend']['totals']['internal'] + 
                                $departmentData['frontend']['totals']['internal'] + 
                                $departmentData['internship']['totals']['internal'];
                    
                    $grandTotal = $totalBillable + $totalNonBillable + $totalInternal;
                    $grandTotal = $grandTotal > 0 ? $grandTotal : 1; // Avoid division by zero
                @endphp
                
                <div class="col-md-4 text-center">
                    <h5 class="font-weight-bold billable_color_fin">
                        Billable Hrs: {{ number_format($totalBillable, 2) }}Hrs ({{ number_format(($totalBillable / $grandTotal) * 100, 2) }}%)
                    </h5>
                </div>
                
                <div class="col-md-4 text-center">
                    <h5 class="font-weight-bold non_billable_color_fin">
                        Non Billable Hrs: {{ number_format($totalNonBillable, 2) }}Hrs ({{ number_format(($totalNonBillable / $grandTotal) * 100, 2) }}%)
                    </h5>
                </div>
                
                <div class="col-md-4 text-center">
                    <h5 class="font-weight-bold internal_billable_color_fin">
                        Internal Billable Hrs: {{ number_format($totalInternal, 2) }}Hrs ({{ number_format(($totalInternal / $grandTotal) * 100, 2) }}%)
                    </h5>
                </div>
            </div>
        </div>

        
        @if(count($departmentData['backend']['employees']) > 0 || 
        count($departmentData['frontend']['employees']) > 0 || 
        count($departmentData['internship']['employees']) > 0)
            <div class="table-responsive">
                <table class="table table-bordered report-table consolreporttbl">
                    <thead>
                        <tr>
                            <th class="heading_color">SL NO</th>
                            <th class="heading_color">EMPLOYEE NAME</th>
                            <th class="heading_color">BILLABLE HRS (%)</th>
                            <th class="heading_color">NON BILLABLE HRS(%)</th>
                            <th class="heading_color" style="text-align: left;">INTERNAL BILLABLE HRS(%)</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach(['backend', 'frontend', 'internship'] as $dept)
                            @if(count($departmentData[$dept]['employees']) > 0)
                                <!-- Department Header Row -->
                                <tr>
                                    <td colspan="5" class="department-color">
                                        <strong >{{ $departmentData[$dept]['name'] }}</strong>
                                    </td>
                                </tr>
                                
                                <!-- Employee Rows -->
                                @foreach($departmentData[$dept]['employees'] as $data)
                                    <tr>
                                        <td>{{ $data['si_no'] }}.</td>
                                        <td>{{ $data['employee_name'] }}</td>
                                        <td>{{ number_format($data['billable_hrs'], 2) }} ({{ number_format($data['billable_percent'], 2) }}%)</td>
                                        <td>{{ number_format($data['non_billable_hrs'], 2) }} ({{ number_format($data['non_billable_percent'], 2) }}%)</td>
                                        <td style="text-align: left;">{{ number_format($data['internal_hrs'], 2) }} ({{ number_format($data['internal_percent'], 2) }}%)</td>
                                    </tr>
                                @endforeach
                                
                                <!-- Department Total Row -->
                                @php
                                    $deptTotal = $departmentData[$dept]['totals'];
                                    $deptBase = $deptTotal['billable'] + $deptTotal['non_billable'] + $deptTotal['internal'];
                                    $deptBase = $deptBase > 0 ? $deptBase : 1;
                                @endphp
                                <tr>
                                    <td colspan="2" class="totalconslrpt"><strong>Total</strong></td>
                                    <td class="billable_color">{{ number_format($deptTotal['billable'], 2) }} ({{ number_format(($deptTotal['billable'] / $deptBase) * 100, 2) }}%)</td>
                                    <td class="non_billable_color">{{ number_format($deptTotal['non_billable'], 2) }} ({{ number_format(($deptTotal['non_billable'] / $deptBase) * 100, 2) }}%)</td>
                                    <td class="internal_billable_color">{{ number_format($deptTotal['internal'], 2) }} ({{ number_format(($deptTotal['internal'] / $deptBase) * 100, 2) }}%)</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

                <div class="table-responsive">
                    <table class="table table-bordered timesheet_table">
                        <tbody>
                            <tr class="timesheethead">
                                <th>PROJECTWISE</th>
                                <th>HOURS</th>
                                <th>%</th>
                                <th>TICKETWISE</th>
                                <th style="text-align: left;">HOURS</th>
                                <th>%</th>
                            </tr>
                        </tbody>
                        <tbody>
                            <tr>
                                <td class="font-weight-bold billable_color_fin timesheetbill" >Billable</td>
                                <td class="font-weight-bold billable_color_fin timesheetbill"  >{{ number_format($totals['project_billable'], 2) }}</td>
                                <td class="font-weight-bold billable_color_fin timesheetbill" >{{ $totals['project_billable'] > 0 ? number_format(($totals['project_billable'] / $totals['project_total']) * 100, 2) : '0.00' }}%</td>
                                <td class="font-weight-bold billable_color_fin timesheetbill" >Billable</td>
                                <td class="font-weight-bold billable_color_fin timesheetbill" style=" text-align: left; ">{{ number_format($totals['ticket_billable'], 2) }}</td>
                                <td class="font-weight-bold billable_color_fin timesheetbill" >{{ $totals['ticket_billable'] > 0 ? number_format(($totals['ticket_billable'] / $totals['ticket_total']) * 100, 2) : '0.00' }}%</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold non_billable_color_fin  timesheetnonbill" >Non Billable</td>
                                <td class="font-weight-bold non_billable_color_fin timesheetnonbill">{{ number_format($totals['project_non_billable'], 2) }}</td>
                                <td class="font-weight-bold non_billable_color_fin timesheetnonbill">{{ $totals['project_non_billable'] > 0 ? number_format(($totals['project_non_billable'] / $totals['project_total']) * 100, 2) : '0.00' }}%</td>
                                <td class="font-weight-bold non_billable_color_fin timesheetnonbill" >Non Billable</td>
                                <td class="font-weight-bold non_billable_color_fin timesheetnonbill" style="text-align: left; ">{{ number_format($totals['ticket_non_billable'], 2) }}</td>
                                <td class="font-weight-bold non_billable_color_fin timesheetnonbill">{{ $totals['ticket_non_billable'] > 0 ? number_format(($totals['ticket_non_billable'] / $totals['ticket_total']) * 100, 2) : '0.00' }}%</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill" >Internal Billable</td>
                                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill" >{{ number_format($totals['project_internal'], 2) }}</td>
                                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill" >{{ $totals['project_internal'] > 0 ? number_format(($totals['project_internal'] / $totals['project_total']) * 100, 2) : '0.00' }}%</td>
                                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill" >Internal Billable</td>
                                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill" style=" text-align: left;">{{ number_format($totals['ticket_internal'], 2) }}</td>
                                <td class="font-weight-bold internal_billable_color_fin timesheetinternbill" >{{ $totals['ticket_internal'] > 0 ? number_format(($totals['ticket_internal'] / $totals['ticket_total']) * 100, 2) : '0.00' }}%</td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold totalconslrpt" style="font-size: 22px;"><strong>Total</strong></td>
                                <td class="font-weight-bold" style="font-size: 22px;">{{ number_format($totals['project_total'], 2) }}</td>
                                <td colspan="2"></td>
                                <td  class="font-weight-bold" style="font-size: 22px;">{{ number_format($totals['ticket_total'], 2) }}</td>
                            </tr>
                        </tbody>

                        
                    </table>
                </div>

            @else
                <div class="no-data">No data found for the selected date range</div>
            @endif
        @endif
    </div>

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>


    <script>
                $(document).ready(function() {
                // Handle date input clearing
                $('input[type="date"]').each(function() {
                    // Store original default values
                    const originalValue = $(this).val();
                    $(this).data('original', originalValue);
                    
                    $(this).on('change', function() {
                        if (!this.value) {
                            // If cleared, set to empty string
                            $(this).val('');
                        }
                    });
                });

                    // Export to PDF
                    $('#exportPdf').on('click', function() {
                        // Get current form data
                        const formData = $('#searchForm').serialize();
                        
                        // Open export URL with current search parameters
                        window.location.href = "{{ route('admin.consolidated_report.export') }}?" + formData;
                    });
                    
                // Reset to defaults when form is reset
                $('button[type="reset"]').on('click', function() {
                    $('input[type="date"]').each(function() {
                        $(this).val($(this).data('original'));
                    });
                });
            });
    </script>


 
@endsection