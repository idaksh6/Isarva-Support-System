@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">
<!-- Search Panel -->
<form action="{{ route('admin.project.manage') }}" method="GET">
    <div class="row mb-3">
        <div class="col-md-4">
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
        <div class="col-md-4">
            <label for="assigned_to" class="form-label">Assigned To</label>
            <select class="form-control" name="assigned_to" id="assigned_to">
                <option value="">Select Manager</option>
                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                    <option value="{{ $id }}" {{ request('assigned_to') == $id ? 'selected' : '' }}>{{ $employeeName }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="department" class="form-label">Department</label>
            <select class="form-select" name="department" id="projectmanage_department">
                <option value="None">None</option>
                <option value="1" {{ request('department') == '1' ? 'selected' : '' }}>Web Application</option>
                <option value="2" {{ request('department') == '2' ? 'selected' : '' }}>Website</option>
                <option value="3" {{ request('department') == '3' ? 'selected' : '' }}>Graphics</option>
            </select>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12 text-end">
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
        </div>
    </div>
</form>


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
   
@endsection
