@extends('backend.layouts.app')

@section('title', __('Billable-NonBillable Report | Isarva Support'))

@section('content')


{{-- 
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            <h5>Search Filters</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.billable_nonbillable_report') }}" method="GET">
                <div class="row">
                    <!-- Start Date -->
                    <div class="col-md-3">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" value="{{ now()->subDay()->toDateString() }}">
                    </div>

                    <!-- End Date -->
                    <div class="col-md-3">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" value="{{ now()->toDateString() }}">
                    </div>

                    <!-- Employee Dropdown -->
                    <div class="col-md-3">
                        <label for="employee">Employee:</label>
                        <select id="employee" name="employee" class="form-control">
                            <option value="">Select Employee</option>
                            @foreach($employees as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Project/Ticket Dropdown -->
                    <div class="col-md-3">
                        <label for="project_ticket">Project/Ticket:</label>
                        <select id="project_ticket" name="project_ticket" class="form-control">
                            <option value="none">None</option>
                            <option value="project">Project</option>
                            <option value="ticket">Ticket</option>
                        </select>
                    </div>
                </div>

                <!-- Select Project/Ticket Field -->
                <div class="row mt-3" id="select_project_field" style="display: none;">
                    <div class="col-md-3">
                        <label id="select_label" for="select_project">Select Project:</label>
                        <select id="select_project" name="select_project" class="form-control">
                            <option value="">Select</option>
                            @foreach($projects as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Billing Type -->
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="billing_type">Billing Type:</label>
                        <select id="billing_type" name="billing_type" class="form-control">
                            <option value="none">None</option>
                            <option value="billable">Billable</option>
                            <option value="nonbillable">Non-Billable</option>
                            <option value="internal_billable">Internal Billable</option>
                        </select>
                    </div>
                </div>

                <!-- Search Button -->
                <div class="row mt-3">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> --}}
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-primary text-white">
            <h5>Search Filters</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.billable_nonbillable_report') }}" method="GET">
                <div class="row">
                 
                    <!-- Start Date -->
                    <div class="col-md-3">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" 
                            value="{{ request('start_date', now()->subDay()->toDateString()) }}">
                    </div>

                    <!-- End Date -->
                    <div class="col-md-3">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" 
                            value="{{ request('end_date', now()->toDateString()) }}">
                    </div>

                    <!-- Employee Dropdown (Searchable) -->
                    <div class="col-md-3">
                        <label for="employee">Employee:</label>
                        <select id="employee" name="employee" class="form-control select2">
                            <option value="">Select Employee</option>
                            @foreach($employees as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Project/Ticket Dropdown -->
                    <div class="col-md-3">
                        <label for="project_ticket">Project/Ticket:</label>
                        <select id="project_ticket" name="project_ticket" class="form-control select2">
                            <option value="none">None</option>
                            <option value="project">Project</option>
                            <option value="ticket">Ticket</option>
                        </select>
                    </div>
                </div>

                <!-- Select Project/Ticket Field -->
                <div class="row mt-3" id="select_project_field" style="display: none;">
                    <div class="col-md-3">
                        <label id="select_label" for="select_project">Select Project:</label>
                        <select id="select_project" name="select_project" class="form-control select2">
                            <option value="">Select</option>
                            @foreach($projects as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Billing Type -->
                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="billing_type">Billing Type:</label>
                        <select id="billing_type" name="billing_type" class="form-control select2">
                            <option value="none" {{ request('billing_type') == 'none' ? 'selected' : '' }}>None</option>
                            <option value="0" {{ request('billing_type') == '0' ? 'selected' : '' }}>Non-Billable</option>
                            <option value="1" {{ request('billing_type') == '1' ? 'selected' : '' }}>Billable</option>
                            <option value="2" {{ request('billing_type') == '2' ? 'selected' : '' }}>Internal Billable</option>
                        </select>
                    </div>
                </div>

                <!-- Search Button -->
                <div class="row mt-3">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@if($reports->count() > 0)

        <div class="container mt-4">
    
                <div class="card-body ">
                    <button id="exportPdf" class="btn btn-success btn-lg">
                        <i class="fas fa-file-pdf"></i> Export to PDF
                    </button>
                </div>
          
        </div>


    <table class="table table-bordered mt-4">
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
                    <td>{{ $report->billable_type_text }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <tr>
        <td class="total-label">
            <b><span style="color: green; font-size: 24px;">Total Billable Hours: {{ number_format($totals['billable'], 2) }}</span>
            <span> ({{ $totals['billable'] + $totals['non_billable'] + $totals['internal_billable'] > 0 
                ? number_format($totals['billable'] / ($totals['billable'] + $totals['non_billable'] + $totals['internal_billable']) * 100, 2) 
                : 0 }}%)</span></b>
        </td>
    </tr>
    <br/>
    
    <tr>
        <td class="total-label">
            <b><span style="color: red; font-size: 24px;">Total Non Billable Hours: {{ number_format($totals['non_billable'], 2) }}</span>
            <span> ({{ $totals['billable'] + $totals['non_billable'] + $totals['internal_billable'] > 0 
                ? number_format($totals['non_billable'] / ($totals['billable'] + $totals['non_billable'] + $totals['internal_billable']) * 100, 2) 
                : 0 }}%)</span></b>
        </td>
    </tr>
    <br />
    
    <tr>
        <td class="total-label">
            <b><span style="color: blue; font-size: 24px;">Total Internal Billable Hours: {{ number_format($totals['internal_billable'], 2) }}</span>
            <span> ({{ $totals['billable'] + $totals['non_billable'] + $totals['internal_billable'] > 0 
                ? number_format($totals['internal_billable'] / ($totals['billable'] + $totals['non_billable'] + $totals['internal_billable']) * 100, 2) 
                : 0 }}%)</span></b>
        </td>
    </tr>

    @elseif(request()->hasAny(['start_date', 'end_date', 'employee', 'project_ticket', 'select_project', 'billing_type']))
    <p class="mt-4 text-center text-danger">No info found</p>
    @endif
    <!-- Pagination Links -->
    <!-- Display pagination links -->
   
    @if(method_exists($reports, 'appends'))
        {{ $reports->appends(request()->query())->links() }}
    @endif
 
    <!-- Jquery Page Js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>

    <!-- Include Select2 Library -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


    <script>
        // $(document).ready(function() {
        //     $('#project_ticket').change(function() {
        //         var selectedValue = $(this).val();
        //         if (selectedValue === 'project') {
        //             $('#select_label').text('Select Project:');
        //             $('#select_project').html(`@foreach($projects as $id => $name) <option value="{{ $id }}">{{ $name }}</option> @endforeach`);
        //             $('#select_project_field').show();
        //         } else if (selectedValue === 'ticket') {
        //             $('#select_label').text('Select Ticket:');
        //             $('#select_project').html('<option value="1">Ticket 1</option><option value="2">Ticket 2</option>');
        //             $('#select_project_field').show();
        //         } else {
        //             $('#select_project_field').hide();
        //         }
        //     });
        // });
        </script>

<script>
    $(document).ready(function() {
        // Initialize all select2 elements
        $('.select2').select2({
            width: '100%',
            placeholder: "Select an option",
            allowClear: true
        });

        // Handle dynamic change for Project/Ticket field
        $('#project_ticket').change(function() {
            var selectedValue = $(this).val();
            if (selectedValue === 'project') {
                $('#select_label').text('Select Project:');
                var options = `<option value="">Select</option>
                    @foreach($projects as $id => $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach`;
                $('#select_project').html(options);
                $('#select_project_field').show();
                $('#select_project').select2({ width: '100%' });
            } else if (selectedValue === 'ticket') {
                $('#select_label').text('Select Ticket:');
                var options = `<option value="">Select</option>
                    <option value="Ticket 1">Ticket 1</option>
                    <option value="Ticket 2">Ticket 2</option>`;
                $('#select_project').html(options);
                $('#select_project_field').show();
                $('#select_project').select2({ width: '100%' });
            } else {
                $('#select_project_field').hide();
            }
        });
    });
            // JS to trigger the PDF EXPORT
            document.getElementById('exportPdf').addEventListener('click', function() {
            // Get all current filter values
            const startDate = document.getElementById('start_date').value;
            const endDate = document.getElementById('end_date').value;
            const employee = document.getElementById('employee').value;
            const projectTicket = document.getElementById('project_ticket').value;
            const selectProject = document.getElementById('select_project').value;
            const billingType = document.getElementById('billing_type').value;
            
            // Build the URL with all current filters
            let url = '{{ route("admin.export.billable.pdf") }}' + 
                '?start_date=' + encodeURIComponent(startDate) +
                '&end_date=' + encodeURIComponent(endDate) +
                '&employee=' + encodeURIComponent(employee) +
                '&project_ticket=' + encodeURIComponent(projectTicket) +
                '&select_project=' + encodeURIComponent(selectProject) +
                '&billing_type=' + encodeURIComponent(billingType);
            
            // Open the URL to trigger the download
            window.location.href = url;
        });

</script>
    
@endsection




