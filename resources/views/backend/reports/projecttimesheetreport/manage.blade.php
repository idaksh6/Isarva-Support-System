@extends('backend.layouts.app')

@section('title', 'Manage Projetcs | Isarva Support')

@section('content')
{{-- 
<style>

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 40px;
    user-select: none;
    -webkit-user-select: none;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #444;
    line-height: 36px;
}

    .text-danger { 
        font-weight: bold; 
    }

    .text-success { 
        font-weight: bold; 
    }


    /* @media (min-width: 1400px) {
    .container-xxl, .container-xl, .container-lg, .container-md, .container-sm, .container {
        max-width: 100% !important;
    }
} */

</style> --}}

<style>
    /* Make Select2 match normal inputs in responsive layouts */
    .select2-container {
        width: 100% !important;
    }

    .select2-container .select2-selection--single {
        height: 40px;
        display: flex;
        align-items: center;
        padding: 6px 12px;
    }

    .select2-selection__rendered {
        font-size: 14px;
        line-height: 28px;
        padding-left: 0;
    }

    /* Optional: Style tweaks for form layout on smaller screens */
    @media (max-width: 768px) {
        .card-body {
            padding: 1rem;
        }

        .form-label {
            font-size: 14px;
        }

        .btn {
            width: 100%;
        }
    }

    .text-danger, .text-success {
        font-weight: bold;
    }

    @media(max-width: 768px){

        .timesheettable{

            margin: 0 20px;
        }
    }
</style>
{{-- <div class="container mt-4 m-0">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Project Timesheet Report</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.project_timesheet_report') }}" method="GET"> 
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="employee" class="form-label">Employee</label>
                     
                        <select name="employee_id" id="employee" class="form-control select2">
                            <option value="">-- Select Employee --</option>
                            @foreach($employees as $id => $name)
                                <option value="{{ $id }}" {{ request('employee_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                    </div>

                    <div class="col-md-6">
                        <label for="project" class="form-label">Project</label>
                        <select name="project_id" id="project" class="form-control select2">
                            <option value="">-- Select Project --</option>
                            @foreach($projects as $id => $name)
                                <option value="{{ $id }}" {{ request('project_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="text-start">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}

<div class="container-fluid mt-4 px-3"> {{-- fluid for full-width, px-3 for padding --}}
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Project Timesheet Report</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.project_timesheet_report') }}" method="GET">
                <div class="row g-3 row-cols-1 row-cols-md-2">
                    <div class="col">
                        <label for="employee" class="form-label">Employee</label>
                        <select name="employee_id" id="employee" class="form-control select2 w-100">
                            <option value="">-- Select Employee --</option>
                            @foreach($employees as $id => $name)
                                <option value="{{ $id }}" {{ request('employee_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label for="project" class="form-label">Project</label>
                        <select name="project_id" id="project" class="form-control select2 w-100">
                            <option value="">-- Select Project --</option>
                            @foreach($projects as $id => $name)
                                <option value="{{ $id }}" {{ request('project_id') == $id ? 'selected' : '' }}>
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3 text-start">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>
    </div>
</div>




{{-- @if(isset($finalData) && count($finalData) > 0) --}}
{{-- @if(isset($paginatedFinalData) && $paginatedFinalData->count() > 0) --}}
@if($hasSearch && isset($paginatedFinalData) && $paginatedFinalData->count() > 0)

    {{-- ✅ Export Button --}}
    <form action="{{ route('admin.project_timesheet_export_pdf') }}" method="GET" class="mt-4">
        <input type="hidden" name="employee_id" value="{{ request('employee_id') }}">
        <input type="hidden" name="project_id" value="{{ request('project_id') }}">
        <button type="submit" class="btn dailytskexprtbtn export-pdf-btn">
            <i class="icofont-file-pdf"></i> Export as PDF
        </button>
    </form>
    
    <div class="table-responsive mt-4 timesheettable">
        <table class="table table-bordered table-striped">
            <thead >
                <tr>
                    <th>SI No</th>
                    <th>Project</th>
                    <th>Project Owner</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>Project Deadline</th>
                    <th>Total BL Hrs</th>
                    <th>Total Non BL Hrs</th>
                    <th>Total Int BL Hrs</th>
                    <th>Manager Allocated Hrs</th>
                    <th>Remaining Hrs</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach($finalData as $index => $data) --}}
                @foreach($paginatedFinalData as $index => $data)

                    <tr>
                        {{-- <td>{{ $index + 1 }}</td> --}}
                        <td>{{ ($paginatedFinalData->currentPage() - 1) * $paginatedFinalData->perPage() + $loop->iteration }}</td>

                        <td>{{ $data['project_name'] }}</td>
                        <td>{{ $data['project_owner'] }}</td>
                        {{-- <td>{{ $data['status'] }}</td> --}}
                        <td class="text-center">
                            <span class="status-box status-{{ \Illuminate\Support\Str::slug(strtolower($data['status']), '_') }}">
                                {{ $data['status'] }}
                            </span>
                        </td>

                        <td>{{ \Carbon\Carbon::parse($data['start_date'])->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($data['end_date'])->format('d-m-Y') }}</td>
                        <td>{{ $data['total_bl'] }}</td>
                        <td>{{ $data['total_non_bl'] }}</td>
                        <td>{{ $data['total_int_bl'] }}</td>
                        <td>{{ $data['allocated_hrs'] }}</td>
                        <td>
                            <span class="{{ $data['remaining_hrs'] < 0 ? 'text-danger' : 'text-success' }}">
                                {{ $data['remaining_hrs'] < 0 ? $data['remaining_hrs'] : '+' . $data['remaining_hrs'] }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $paginatedFinalData->withQueryString()->links() }}
        </div>

    </div>
    
@elseif($hasSearch)
    <div class="alert alert-warning mt-4">No data found for the selected filters.</div>
@endif
<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>


<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

     // Focus for select2 search
    $(document).on('select2:open', function (e) {
    const focusableFields = ['project_id', 'employee_id'];
    if (focusableFields.includes(e.target.name)) {
            const searchField = document.querySelector('.select2-container--open .select2-search__field');
            if (searchField) {
                searchField.focus();
            }
        }
    });
</script>


@endsection

