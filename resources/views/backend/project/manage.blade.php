@extends('backend.layouts.app')

@section('content')


<div class="container-fluid">
        
    <div class="search-container">
        <!-- Search Form -->
        <form action="{{ route('admin.project.manage') }}" method="GET">
            <!-- Basic Search Row -->
            <div class="row mb-3">
                <div class="col-md-4">
                
                    <div class="input-group">
                        <input type="text" class="form-control project_search" name="project_name" id="project_name" 
                            placeholder="Search by project name" value="{{ request('project_name') }}">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> </button>
                    </div>
                </div>
                <div class="col-md-4 d-flex  gap-4">
                    <button type="button" class="advancebtn" id="toggleAdvancedSearch">
                       Advanced Search
                    </button>

                    <button type="button" class="btn btn-secondary  resetbtn" id="resetSearch">
                        <i class="fa fa-refresh"></i> Reset
                    </button>
                    
                </div>
            </div>
     
         
           <!-- Advanced Search Panels (initially hidden) -->
            <div id="advancedSearchPanels" style="display: none;">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="projectmanage_status">
                            <option value="None">None</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Onboard</option>
                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Open</option>
                            <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Progress</option>
                            <option value="4" {{ request('status') == '4' ? 'selected' : '' }}>Monitor</option>
                            <option value="5" {{ request('status') == '5' ? 'selected' : '' }}>Billing</option>
                            <option value="6" {{ request('status') == '6' ? 'selected' : '' }}>Closed</option>
                            <option value="7" {{ request('status') == '7' ? 'selected' : '' }}>On Hold</option>
                            <option value="8" {{ request('status') == '8' ? 'selected' : '' }}>Warranty</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="assigned_to" class="form-label">Assigned To</label>
                        <select class="form-control" name="assigned_to" id="assigned_to">
                            <option value="">Select Manager</option>
                            @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                <option value="{{ $id }}" {{ request('assigned_to') == $id ? 'selected' : '' }}>{{ $employeeName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="department" class="form-label">Department</label>
                        <select class="form-select" name="department" id="projectmanage_department">
                            <option value="None">None</option>
                            <option value="1" {{ request('department') == '1' ? 'selected' : '' }}>Web Application</option>
                            <option value="2" {{ request('department') == '2' ? 'selected' : '' }}>Website</option>
                            <option value="3" {{ request('department') == '3' ? 'selected' : '' }}>Graphics</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="month" class="form-label">Month</label>
                        <select class="form-select" name="month" id="month">
                            <option value="None">None</option>
                            <option value="1" {{ request('month') == '1' ? 'selected' : '' }}>January</option>
                            <option value="2" {{ request('month') == '2' ? 'selected' : '' }}>February</option>
                            <option value="3" {{ request('month') == '3' ? 'selected' : '' }}>March</option>
                            <option value="4" {{ request('month') == '4' ? 'selected' : '' }}>April</option>
                            <option value="5" {{ request('month') == '5' ? 'selected' : '' }}>May</option>
                            <option value="6" {{ request('month') == '6' ? 'selected' : '' }}>June</option>
                            <option value="7" {{ request('month') == '7' ? 'selected' : '' }}>July</option>
                            <option value="8" {{ request('month') == '8' ? 'selected' : '' }}>August</option>
                            <option value="9" {{ request('month') == '9' ? 'selected' : '' }}>September</option>
                            <option value="10" {{ request('month') == '10' ? 'selected' : '' }}>October</option>
                            <option value="11" {{ request('month') == '11' ? 'selected' : '' }}>November</option>
                            <option value="12" {{ request('month') == '12' ? 'selected' : '' }}>December</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="year" class="form-label">Year</label>
                        <select class="form-select" name="year" id="year">
                            <option value="None">None</option>
                            @php
                                $currentYear = date('Y');
                                $startYear = 2020; // You can adjust this start year as needed
                            @endphp
                            @for($year = $currentYear; $year >= $startYear; $year--)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                    </div>
                </div>
            </div>
        </div>




    <!-- Total Projects Card -->
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="icon-box bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                        <i class="icofont-dashboard-web fs-5"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Projects</h6>
                        <h5 class="fw-bold text-dark mb-0" id="totalProjects">{{ $totalProjectscount }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Project Table -->
    <div class="">
        @if($projectsmanage->isEmpty())
            <div class="col-12 text-center py-5">
                <div class="no-info-card mx-auto">
                    <i class="fa fa-info-circle fa-3x text-info mb-3"></i>
                    <h4 class="mb-2">No information found</h4>
                    <p class="text-muted">Sorry, we couldn't find any project data at this time.</p>
                    <a href="{{ route('admin.project.manage') }}" class="btn btn-primary mt-3">Go Back</a>
                </div>
            </div>
        @else
            <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Start Date</th>
                        <th class="text-center">Status</th>
                        <th>Priority</th>
                        <th>Department</th>
                        <th>Project Manager</th>
                        <th>Timeline</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projectsmanage as $project)
                    <tr>
                        {{-- <td>{{ $project->project_name }}</td> --}}
                        <td>
                            <a href="{{ route('admin.tasks.byProject', ['id' => $project->id]) }}" class="d-block text-decoration-none text-primary">
                                #{{ $project->id }} - {{ $project->project_name }}
                            </a>
                        </td>
                        <td>{{ $project->client_name ?? 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }} </br>
                            <span class="badge bg-secondary">
                                +{{ \Carbon\Carbon::parse($project->start_date)->diffInDays(today()) }} days
                            </span>
                        </td>
                        <td class="text-center">
                            <span class="status-box status-{{ strtolower(str_replace(' ', '_', $project->status_name)) }}">
                                {{ $project->status_name }}
                            </span>                
                        <td>
                            <span class="badge priority-{{ strtolower($project->priority_name) }}">
                                {{ strtoupper($project->priority_name) }}
                            </span>
                        </td>
                        <td>
                            <span class="department-box department-{{ strtolower(str_replace(' ', '_', $project->department_name)) }}">
                                {{ strtoupper($project->department_name) }}
                            </span>
                            {{-- {{ $project->department_name }} --}}
                        </td>
                        <td>{{ $project->manager_name ?? 'N/A' }}</td>

                        <td>
                            <div class="project-timeline">
                                <!-- Progress Bar Container -->
                                <div class="progress-container">
                                    <!-- Date Range Inside Progress Bar -->
                                    <div class="date-range">{{ $project->formatted_date_range }}</div>
            
                                    <!-- Progress Bar -->
                                    <div class="progress-bar-manage" style="width: {{ $project->progress }}%; background-color: {{ $project->is_overdue ? 'red' : 'blue' }};"></div>
                                </div>
            
                                <!-- Days Left Indicator -->
                                <div class="days-left" style="background-color: {{ $project->days_left_color }};">
                                    {{ $project->days_left_text }}
                                </div>
                            </div>
                        </td>
                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-4">
                {{ $projectsmanage->links() }}
            </div>

        
        @endif
    </div>

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>

    <script src="{{ asset('js/template.js') }}"></script>

   @section('scripts')
    <!-- Load jQuery first -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <!-- Then DataTables -->
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>


    <!-- Add DataTable initialization -->
    <script>
        $(document).ready(function() {
            
            $('#myProjectTable').DataTable({
                responsive: true,
                ordering: true,
                searching: true,
                paging: true,
                language: {
                    paginate: {
                        previous: '<i class="fa fa-angle-left"></i>',
                        next: '<i class="fa fa-angle-right"></i>'
                    }
                }
            });
        });

        
    </script>


 @endsection


 
      <!-- JavaScript for Toggling Advanced Search -->
      <script>
            $(document).ready(function() {
            // Toggle advanced search panels
            $('#toggleAdvancedSearch').click(function() {
                $('#advancedSearchPanels').toggle();
                $(this).html(function() {
                    return $('#advancedSearchPanels').is(':visible') 
                        ? ' Hide Advanced Search' 
                        : ' Advanced Search';
                });
            });

            // Show advanced search panels if any advanced filter is already selected
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('status') && urlParams.get('status') !== 'None' || 
            urlParams.has('assigned_to') || 
            urlParams.has('department') && urlParams.get('department') !== 'None' ||
            urlParams.has('month') && urlParams.get('month') !== 'None' ||
            urlParams.has('year') && urlParams.get('year') !== 'None') {
                $('#advancedSearchPanels').show();
                $('#toggleAdvancedSearch').html('<i class="fa fa-cog"></i> Hide Advanced Search');
            }

             // Reset all search fields
            $('#resetSearch').click(function() {
                // Clear all input/select values
                $('input[name="project_name"]').val('');
                $('select[name="status"]').val('None');
                $('select[name="assigned_to"]').val('');
                $('select[name="department"]').val('None');
                $('select[name="month"]').val('None');
                $('select[name="year"]').val('None');
                
                // Submit the form (which will redirect to clean URL)
                window.location.href = "{{ route('admin.project.manage') }}";
            });
        });
    </script>
   
@endsection
