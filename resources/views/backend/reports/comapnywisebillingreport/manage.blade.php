@extends('backend.layouts.app')

@section('title', 'Compnay wise billing Report | Isarva Support')

@section('content')


<style>

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 34px;
    position: absolute;
    top: 5px !important;
    right: 1px;
    width: 20px;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 33px !important;
    /* height: 27px; */
}

.select2-container--default .select2-selection--single .select2-selection__clear {
    cursor: pointer;
    float: right;
    font-weight: bold;
    height: 32px !important;
    margin-right: 20px;
    padding-right: 0px;
}

.select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 1px solid #aaa;
    border-radius: 4px;
    height: 38px !important;
}

.mainbillablecontainer{

    max-width: none !important;
}

.cwbill{

    color: green !important;
    font-size: 24px;
    font-weight: bold;
}

.cwnonbill{

    color: red !important;
    font-size: 24px;
     font-weight: bold;
}

.cwinternalbill{

    color: blue !important;
    font-size: 24px;
     font-weight: bold;
}

@media(min-width:1630px){

    .companywisemaincontinr{

     max-width: 95%;
}

}

</style>

<div class="container mt-4 companywisemaincontinr">
    <div class="card shadow-sm rounded">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Search - Company Wise Billing Report</h5>
        </div>
        <div class="card-body">
           <form action="{{ route('admin.companywise_billingreport') }}" method="GET">
                <div class="row">
                 
                    <!-- Start Date -->
                    <div class="col-md-3">
                        <label for="start_date">Start Date:</label>
                        <input type="date" id="start_date" name="start_date" class="form-control" 
                            value="{{ request()->has('start_date') ? request('start_date') : now()->subDay()->toDateString() }}">
                    </div>

                    <!-- End Date -->
                    <div class="col-md-3">
                        <label for="end_date">End Date:</label>
                        <input type="date" id="end_date" name="end_date" class="form-control" 
                            value="{{ request()->has('end_date') ? request('end_date') : now()->toDateString() }}">
                    </div>

                    <!-- Employee Dropdown (Searchable) -->
                    <div class="col-md-3">
                        <label for="employee">Employee:</label>
                        <select id="employee" name="employee" class="form-control select2">
                            <option value="">Select Employee</option>
                            @foreach($employees as $id => $name)
                                <option value="{{ $id }}" {{ request('employee') == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Project/Ticket Dropdown -->
                    <div class="col-md-3">
                        <label for="project_ticket">Project/Ticket:</label>
                        <select id="project_ticket" name="project_ticket" class="form-control select2">
                            <option value="none">None</option>
                            {{-- <option value="1">Project</option>
                            <option value="2">Ticket</option> --}}
                            <option value="1" {{ request('project_ticket') == '1' ? 'selected' : '' }}>Project</option>
                            <option value="2" {{ request('project_ticket') == '2' ? 'selected' : '' }}>Ticket</option>

                        </select>
                    </div>
                </div>

              

                <!-- Second Row - Dynamic Project/Ticket Selector and Billing Type -->
                <div class="row mt-3">
                    <!-- Dynamic Project/Ticket Selector (will appear in same row when visible) -->
                    <div class="col-md-3" id="select_project_field" style="display: none;">
                        <label id="select_label" for="select_project">Select:</label>
                        <select id="select_project" name="select_project" class="form-control select2">
                            <option value="">Select</option>
                            @if(request('project_ticket') == '1')
                                @foreach($projects as $id => $name)
                                    <option value="{{ $id }}" {{ request('select_project') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            @elseif(request('project_ticket') == '2')
                                @foreach($tickets as $id => $title)
                                    <option value="{{ $id }}" {{ request('select_project') == $id ? 'selected' : '' }}>{{ $title }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Billing Type (always visible, moves left when project/ticket appears) -->
                    <div class="col-md-3" id="billing_type_field">
                        <label for="billing_type">Billing Type:</label>
                        <select id="billing_type" name="billing_type" class="form-control select2">
                            <option value="none" {{ request('billing_type') == 'none' ? 'selected' : '' }}>None</option>
                            @foreach($biilingtype as $key => $value)
                                <option value="{{ $key }}" {{ request('billing_type') == (string)$key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    {{-- <div class="col-md-3">
                        <label class="form-label">Billing Company</label>
                        <select name="billing_company" class="form-select inputprojectbox">
                            <option value="all">All Companies</option>
                            <option value="none">None/Not Specified</option>
                            @foreach($billingCompanies as $id => $name)
                                <option value="{{ $id }}" {{ request('billing_company') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="col-md-3">
                        <label class="form-label">Billing Company</label>
                        <select name="billing_company" class="form-select inputprojectbox select2">
                            <option value="all" {{ !request()->has('billing_company') || request('billing_company') == 'all' ? 'selected' : '' }}>
                                All Companies
                            </option>
                            <option value="none" {{ request('billing_company') == 'none' ? 'selected' : '' }}>
                                None/Not Specified
                            </option>
                            @foreach($billingCompanies as $id => $name)
                                <option value="{{ $id }}" {{ request('billing_company') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                        
                    </div>
                   {{-- <div class="col-md-3">
                        <label class="form-label">Billing Company</label>
                        <select class="form-select inputprojectbox" name="billing_company">
                            <option value="">All Companies</option>  <!-- Changed from "Select Company" -->
                            <option value="not_available" {{ request('billing_company') == 'not_available' ? 'selected' : '' }}>
                                NOT AVAILABLE
                            </option>
                            @foreach($billingCompanies as $key => $value)
                                <option value="{{ $key }}" {{ request('billing_company') == $key ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                        <div class="text-danger" id="proj-add-error-billing_company"></div>
                    </div> --}}
                </div>

                <!-- Search Button -->
                <div class="row mt-3">
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <button type="button" id="resetFilters" class="btn btn-secondary">Reset</button>
                     
                    </div>          
                </div>
            </form>


            @if(request()->has('start_date') && request()->has('end_date'))

                <div class="mt-3">
                    <form action="{{ route('admin.company-report.exportPdf') }}" method="GET" id="comapnywisepdfExportForm" class="d-flex align-items-center gap-2">
                         <!-- Add hidden inputs for all filter parameters -->
                            @if(request()->has('start_date'))
                                <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                            @endif
                            @if(request()->has('end_date'))
                                <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                            @endif
                            @if(request()->has('employee'))
                                <input type="hidden" name="employee" value="{{ request('employee') }}">
                            @endif
                            @if(request()->has('project_ticket'))
                                <input type="hidden" name="project_ticket" value="{{ request('project_ticket') }}">
                            @endif
                            @if(request()->has('select_project'))
                                <input type="hidden" name="select_project" value="{{ request('select_project') }}">
                            @endif
                            @if(request()->has('billing_type'))
                                <input type="hidden" name="billing_type" value="{{ request('billing_type') }}">
                            @endif
                            @if(request()->has('billing_company'))
                                <input type="hidden" name="billing_company" value="{{ request('billing_company') }}">
                            @endif
                                        
                        <button type="submit" class="btn dailytskexprtbtn export-pdf-btn">
                            <i class="icofont-file-pdf"></i> Export PDF
                        </button>

                     
                    </form>
                </div>
                
 
                <div class="table-responsive mt-4">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-dark text-white">
                            <tr>
                                {{-- <th>SI.NO</th> --}}
                                <th>Employee</th>
                                <th>Date</th>
                                <th>Project(P)/Ticket(T)</th>
                                <th>Task</th>
                                <th>Comment</th>
                                <th>Task Time</th>
                                <th>Billing Type</th>
                                <th>Billing Company</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $index => $row)
                                <tr>
                                    {{-- <td>{{ $index + 1 }}</td> --}}
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
                </div>

                <div class="mt-4">
                    
                    <ul class="list-group">
                        <li class="list-group-item cwbill">
                            <strong>Billable:</strong> {{ $billable }} hrs ({{ $billablePercent }}%)
                        </li>
                        <li class="list-group-item cwnonbill">
                            <strong>Non-Billable:</strong> {{ $nonBillable }} hrs ({{ $nonBillablePercent }}%)
                        </li>
                        <li class="list-group-item cwinternalbill">
                            <strong>Internal Billable:</strong> {{ $internalBillable }} hrs ({{ $internalPercent }}%)
                        </li>
                        {{-- <li class="list-group-item">
                            <strong>Total Hours:</strong> {{ $total }} hrs
                        </li> --}}
                    </ul>
                </div>

                <div class="d-flex justify-content-center mt-3">
                   {{ $results->appends(request()->query())->links() }}
                </div>


            @endif

        </div>
    </div>
</div>


<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>


<script>
         $(document).ready(function() {
        // Handle reset button click
        $('#resetFilters').click(function(e) {
            e.preventDefault(); // Prevent any default behavior
            
            // Reset form values
            $('form')[0].reset();
            
            // Reset Select2 dropdowns
            $('.select2').val(null).trigger('change');
            
            // Reset date fields to default values
            $('#start_date').val('{{ now()->subDay()->toDateString() }}');
            $('#end_date').val('{{ now()->toDateString() }}');
            
            // Hide project/ticket selector if visible
            $('#select_project_field').hide();
            
            // Redirect to clean URL without parameters
            window.location.href = "{{ route('admin.companywise_billingreport') }}";
        });


        // Initialize all select2 elements
            $('.select2').select2({
                width: '100%',
                placeholder: "Select an option",
                allowClear: true
               
            });

        // Focus for select2 search
        $(document).on('select2:open', function (e) {
        const focusableFields = ['employee', 'project_ticket', 'select_project', 'billing_company']; // name attribute
        if (focusableFields.includes(e.target.name)) {
                const searchField = document.querySelector('.select2-container--open .select2-search__field');
                if (searchField) {
                    searchField.focus();
                }
            }
        });

     
           

      // Handle dynamic change for Project/Ticket field
        $('#project_ticket').change(function() {
            var selectedValue = $(this).val();
            var currentSelected = $('#select_project').val();
            
            if (selectedValue === '1') {
                $('#select_label').text('Select Project:');
                var options = `<option value="">Select</option>
                    @foreach($projects as $id => $name)
                        <option value="{{ $id }}" ${currentSelected == '{{ $id }}' ? 'selected' : ''}>{{ $name }}</option>
                    @endforeach`;
                $('#select_project').html(options);
                $('#select_project_field').show();
            } else if (selectedValue === '2') {
                $('#select_label').text('Select Ticket:');
                var options = `<option value="">Select</option>
                    @foreach($tickets as $id => $title)
                        <option value="{{ $id }}" ${currentSelected == '{{ $id }}' ? 'selected' : ''}>{{ $title }}</option>
                    @endforeach`;
                $('#select_project').html(options);
                $('#select_project_field').show();
            } else {
                $('#select_project_field').hide();
            }
            
                $('#select_project').select2({ 
                    width: '100%',
                    placeholder: "Select an option",
                    allowClear: true
                }).val(currentSelected).trigger('change');
            });
            
            // Set initial values from request
            $('#project_ticket').val('{{ request("project_ticket", "none") }}').trigger('change');
            @if(request('select_project'))
                $('#select_project').val('{{ request("select_project") }}').trigger('change');
            @endif

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

            // Reset to defaults when form is reset
            $('button[type="reset"]').on('click', function() {
                $('input[type="date"]').each(function() {
                    $(this).val($(this).data('original'));
                });
            });


           // Reset all search fields
              $('#companywiseresetSearch').click(function() {
                // Reset all inputs and selects properly
                $('input[name="start_date"]').val('');
                $('input[name="end_date"]').val('');
                $('select[name="employee"]').val('').trigger('change');
                $('select[name="project_ticket"]').val('').trigger('change');
                $('select[name="select_project"]').val('').trigger('change');
                $('select[name="billing_type"]').val('none').trigger('change');
                $('select[name="billing_company"]').val('all').trigger('change');

                // Redirect to base URL without query params
                window.location.href = "{{ route('admin.companywise_billingreport') }}";
            });

        });

</script>

@endsection