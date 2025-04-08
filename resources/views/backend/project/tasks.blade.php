@extends('backend.layouts.app')


@section('title', __('Task Manage | Isarva Support'))

@section('content')

@php
    $tasks = $tasks ?? collect(); // Ensures $tasks is always defined
    $internalDocs = $internalDocs ?? collect(); // Ensures $internalDocs is always defined
@endphp

<style>
    /* Css for select2 */
    .select2-container .select2-selection--single {
        height: 38px;
        padding: 5px 10px;
        border-radius: 4px;
      
    }
    .select2-selection__clear{
    
        border: 0px; 
        padding-right: 20px; 
        /* background: none; */
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 4px !important;
        right: 1px;
        width: 20px;
    }
</style>

@if (session()->has('flash_success_project'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
        <i class="bi bi-check-circle-fill me-2 text-success"></i> 
        <span>{{ session('flash_success_project') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<!-- Create Project-->
<div class="modal fade" id="createproject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Create Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createProjectForm" action="{{ route('admin.project.store-project') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Client Name Dropdown -->
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Client Name<span class="required">*</span></label>
                        <select class="form-control select2"  name="client" placeholder="Select Client Name" >
                          <option value="">Select Client</option>
                            @foreach(App\Helpers\ClientHelper::getClientNames() as $id => $clientName)
                              <option value="{{ $id }}" {{ old('client') == $id ? 'selected' : '' }}>{{ $clientName }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger" id="proj-add-error-client"></div>
                    </div>
                
                    <div class="mb-3">
                         <label for="project_name" class="form-label">Project Name<span class="required">*</span></label>
                         <input type="text" class="form-control" name="project_name"  value="{{ old('create_project_name') }}" placeholder="Enter the Project Name">
                         <div class="text-danger" id="proj-add-error-project_name"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Project Category</label>
                        <select class="form-select" name="category" aria-label="Default select Project Category">
                            <option selected>none</option>
                            <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Website Design</option>
                            <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>App Development</option>
                            <option value="3" {{ old('category') == '3' ? 'selected' : '' }}>Quality Assurance</option>
                            <option value="4" {{ old('category') == '4' ? 'selected' : '' }}>Development</option>
                            <option value="5" {{ old('category') == '5' ? 'selected' : '' }}>Backend Development</option>
                            <option value="6" {{ old('category') == '6' ? 'selected' : '' }}>Software Testing</option>
                            <option value="8" {{ old('category') == '8' ? 'selected' : '' }}>Marketing</option>
                            <option value="9" {{ old('category') == '9' ? 'selected' : '' }}>UI/UX Design</option>
                            <option value="10"{{ old('category') == '10' ? 'selected' : ''}}>Other</option>
                        </select>
                        <div class="text-danger" id="proj-add-error-category"></div>
                    </div>

                    <div class="mb-3">
                        <label for="project_img" class="form-label">Project Image</label>
                        <input class="form-control" type="file" name="project_image" multiple>
                        <div class="text-danger" id="proj-add-error-project_image"></div>
                    </div>

                   <!-- Manager Dropdown -->
                    <div class="row g-3 mb-3">
                        <div class="col">
                           <label for="manager_id" class="form-label">Manager<span class="required">*</span></label>
                            <select class="form-control select2"  name="manager" >
                                <option value="">Select Manager</option>
                                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                <option value="{{ $id }}" {{ old('manager') == $id ? 'selected' : '' }}>{{ $employeeName }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="proj-add-error-manager"></div>
                        </div>
                        <div class="col">
                            <label for="team_leader" class="form-label">Team Leader<span class="required">*</span></label>
                            <select class="form-select select2" name="team_leader" aria-label="Default select Priority">
                                <option value="">Select Team Leader</option>
                                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                <option value="{{ $id }}" {{ old('manager') == $id ? 'selected' : '' }}>{{ $employeeName }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="proj-add-error-team_leader"></div>
                        </div>
                    </div>
                   
                    <div class="mb-3">
                        <label for="team_members" class="form-label">Team Members<span class="required">*</span></label>
                        <div class="dropdown">
                            <button class="form-select text-start dropdown-toggle" type="button" id="teamMembersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                               Select Team Members
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="teamMembersDropdown">
                                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                   <li>
                                      <a class="dropdown-item" href="#" onclick="selectTeamMember({{ $id }}, '{{ $employeeName }}')">
                                        {{ $employeeName }}
                                      </a>
                                    </li>
                               @endforeach
                            </ul>
                        </div>
                         <div id="selectedTeamMembers" class="mt-2 d-flex flex-wrap"></div>
                         <input type="hidden" name="team_members" id="teamMembersInput">
                         <div class="text-danger" id="proj-add-error-team_members"></div>
                     </div>


                    <div class="deadline-form">
                        <div class="row g-3 mb-3">
                            <div class="col">
                               <label  class="form-label">Project Start Date<span class="required">*</span></label>
                               <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
                               <div class="text-danger" id="error-start_date"></div>
                            </div>
                            <div class="col">
                               <label  class="form-label">Project End Date<span class="required">*</span></label>
                               <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
                               <div class="text-danger" id="proj-add-error-end_date"></div>
                               
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm">
                                <label for="formFileMultipleone" class="form-label">Department<span class="required">*</span></label>
                                <select class="form-select" name="department" aria-label="Default select Priority">
                                   <option selected>None</option>
                                   <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Web Application</option>
                                   <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>Website</option>
                                   <option value="3" {{ old('category') == '3' ? 'selected' : '' }}>Graphics</option>
                                </select>
                                <div class="text-danger" id="proj-add-error-department"></div>
                            </div>
                            <div class="col-sm">
                               <label for="formFileMultipleone" class="form-label">Status<span class="required">*</span></label>
                               <select class="form-select" name="status" aria-label="Default select Priority">
                                    <option selected>None</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Onboard</option>
                                    <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Open</option>
                                    <option value="3" {{ old('status') == '3' ? 'selected' : '' }}>Progress</option>
                                    <option value="4" {{ old('status') == '4' ? 'selected' : '' }}>Monitor</option>
                                    <option value="5" {{ old('status') == '5' ? 'selected' : '' }}>Billing</option>
                                    <option value="6" {{ old('status') == '6' ? 'selected' : '' }}>Closed</option>
                                    <option value="7" {{ old('status') == '7' ? 'selected' : '' }}>On Hold</option>
                                    <option value="8" {{ old('status') == '8' ? 'selected' : '' }}>Warranty</option>
                                </select>
                                <div class="text-danger" id="proj-add-error-status"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-sm">
                           <label for="formFileMultipleone" class="form-label">Budget</label>
                           <input type="number" name="budget" class="form-control" value="{{ old('budget') }}">
                           <div class="text-danger" id="proj-add-error-budget"></div>
                        </div>
                        <div class="col-sm">
                            <label for="formFileMultipleone" class="form-label">Priority<span class="required">*</span></label>
                            <select class="form-select" name="priority"  aria-label="Default select Priority">
                              <option selected>None</option>
                              <option value="1" {{ old('priority') == '1' ? 'selected' : '' }}>Low</option>
                              <option value="2" {{ old('priority') == '2' ? 'selected' : '' }}>Medium</option>
                              <option value="3" {{ old('priority') == '2' ? 'selected' : '' }}>High</option>
                            </select>
                            <div class="text-danger" id="proj-add-error-priority"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                       <label class="form-label">Type<span class="required">*</span></label>
                        <select class="form-select" name="type" aria-label="Default select Project Category">
                          <option selected>None</option>
                          <option value="1" {{ old('type') == '1' ? 'selected' : '' }}>External</option>
                          <option value="2" {{ old('type') == '2' ? 'selected' : '' }}>Internal</option>
                        </select>
                        <div class="text-danger" id="proj-add-error-type"></div>
                    </div>

                    <div class="mb-3">
                       <label for="estimation" class="form-label">Estimation<span class="required">*</span></label>
                       <input type="number" class="form-control" name="estimation"  value="{{ old('estimation') }}" placeholder="Enter the Project Estimation">
                       <div class="text-danger" id="proj-add-error-estimation"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Billing Company</label>
                        <select class="form-select" name="biiling_company" >
                           <option value="0">None</option>
                           <option value="1" {{ old('biiling_company') == '1' ? 'selected' : '' }}>Isarva</option>
                           <option value="2" {{ old('biiling_company') == '2' ? 'selected' : '' }}>Blue flemingo</option>
                        </select>
                        <div class="text-danger" id="proj-add-error-billing_company"></div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlTextarea78" class="form-label">Description <span class="required">*</span></label>
                        <textarea class="form-control" name="description"  placeholder="Enter the details about project" rows="3">{{ old('description') }}</textarea>
                        <div class="text-danger" id="proj-add-error-description"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                        <button type="submit" class="btn btn-primary">Create Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Project -->
@if (session()->has('flash_success_edit'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
        <i class="bi bi-check-circle-fill me-2 text-success"></i> 
        <span>{{ session('flash_success_edit') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="modal fade" id="editproject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="editprojectLabel">Edit Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editprojectform" action="{{ route('admin.project.update-project', '') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updates -->

                    <!-- Hidden field for project ID -->
                    <input type="hidden" name="project_id" id="project_id">

                    <!-- Client Name Dropdown -->
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Client Name<span class="required">*</span></label>
                        <select class="form-control select2" name="client" id="proj_client">
                            <option value="">Select Client</option>
                            @foreach(App\Helpers\ClientHelper::getClientNames() as $id => $clientName)
                                <option value="{{ $id }}">{{ $clientName }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger" id="proj-edit-error-client"></div>
                    </div>

                    <!-- Project Name -->
                    <div class="mb-3">
                        <label for="project_name" class="form-label">Project Name<span class="required">*</span></label>
                        <input type="text" class="form-control" name="project_name" id="proj_name" placeholder="Enter the Project Name">
                        <div class="text-danger" id="proj-edit-error-project_name"></div>
                    </div>

                    <!-- Project Category -->
                    <div class="mb-3">
                        <label class="form-label">Project Category</label>
                        <select class="form-select" name="category" id="proj_category">
                            <option value="">None</option>
                            <option value="1">Website Design</option>
                            <option value="2">App Development</option>
                            <option value="3">Quality Assurance</option>
                            <option value="4">Development</option>
                            <option value="5">Backend Development</option>
                            <option value="6">Software Testing</option>
                            <option value="7">Marketing</option>
                            <option value="8">UI/UX Design</option>
                            <option value="9">Other</option>
                        </select>
                        <div class="text-danger" id="proj-edit-error-category"></div>
                    </div>

                    <!-- Project Image -->
                    {{-- <div class="mb-3">
                        <label for="project_image" class="form-label">Project Image</label>
                        <input class="form-control" type="file" name="project_image" id="project_image">
                        <div class="text-danger" id="proj-edit-error-project_image"></div>
                    </div> --}}

                    <!-- Manager and Team Leader Dropdowns -->

                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="manager" class="form-label">Manager<span class="required">*</span></label>
                            <select class="form-control select2" name="manager" id="proj_manager">
                                <option value="">Select Manager</option>
                                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                    <option value="{{ $id }}">{{ $employeeName }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="proj-edit-error-manager"></div>
                        </div>
                        <div class="col">
                            <label for="team_leader" class="form-label">Team Leader<span class="required">*</span></label>
                            <select class="form-select select2" name="team_leader" id="proj_team_leader">
                                <option value="">Select Team Leader</option>
                                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                    <option value="{{ $id }}">{{ $employeeName }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="proj-edit-error-team_leader"></div>
                        </div>
                    </div>

                    
                    <!-- Team Members -->
                    <div class="mb-3">
                        <label for="team_members" class="form-label">Team Members<span class="required">*</span></label>
                        <div class="dropdown">
                            <button class="form-select text-start dropdown-toggle" type="button" id="editTeamMembersDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Select Team Members
                            </button>
                            <ul class="dropdown-menu w-100" aria-labelledby="editTeamMembersDropdown">
                                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="selectEditTeamMember({{ $id }}, '{{ $employeeName }}')">
                                            {{ $employeeName }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div id="editSelectedTeamMembers" class="mt-2 d-flex flex-wrap"></div>
                        <input type="hidden" name="team_members" id="editTeamMembersInput">
                        <div class="text-danger" id="proj-edit-error-team_members"></div>
                    </div>

                    <!-- Project Start and End Date -->
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label">Project Start Date<span class="required">*</span></label>
                            <input type="date" name="start_date" class="form-control" id="proj_start_date">
                            <div class="text-danger" id="proj-edit-error-start_date"></div>
                        </div>
                        <div class="col">
                            <label class="form-label">Project End Date<span class="required">*</span></label>
                            <input type="date" name="end_date" class="form-control" id="proj_end_date">
                            <div class="text-danger" id="proj-edit-error-end_date"></div>
                        </div>
                    </div>

                    <!-- Department and Status -->
                    <div class="row g-3 mb-3">
                        <div class="col-sm">
                            <label class="form-label">Department<span class="required">*</span></label>
                            <select class="form-select" name="department" id="proj_department">
                                <option value="">None</option>
                                <option value="1">Web Application</option>
                                <option value="2">Website</option>
                                <option value="3">Graphics</option>
                            </select>
                            <div class="text-danger" id="proj-edit-error-department"></div>
                        </div>
                        <div class="col-sm">
                            <label class="form-label">Status<span class="required">*</span></label>
                            <select class="form-select" name="status" id="proj_status">
                                <option value="">None</option>
                                <option value="1">Onboard</option>
                                <option value="2">Open</option>
                                <option value="3">Progress</option>
                                <option value="4">Monitor</option>
                                <option value="5">Billing</option>
                                <option value="6">Closed</option>
                                <option value="7">On Hold</option>
                                <option value="8">Warranty</option>
                            </select>
                            <div class="text-danger" id="proj-edit-error-status"></div>
                        </div>
                    </div>

                    <!-- Budget and Priority -->
                    <div class="row g-3 mb-3">
                        <div class="col-sm">
                            <label class="form-label">Budget</label>
                            <input type="number" name="budget" class="form-control" id="proj_budget">
                            <div class="text-danger" id="proj-edit-error-budget"></div>
                        </div>
                        <div class="col-sm">
                            <label class="form-label">Priority<span class="required">*</span></label>
                            <select class="form-select" name="priority" id="proj_priority">
                                <option value="">None</option>
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                            </select>
                            <div class="text-danger" id="proj-edit-error-priority"></div>
                        </div>
                    </div>

                    <!-- Type and Estimation -->
                    <div class="mb-3">
                        <label class="form-label">Type<span class="required">*</span></label>
                        <select class="form-select" name="type" id="proj_type">
                            <option value="">None</option>
                            <option value="1">External</option>
                            <option value="2">Internal</option>
                        </select>
                        <div class="text-danger" id="proj-edit-error-type"></div>
                    </div>

                   <!-- Estimation Field -->
                    <div class="mb-3">
                        <label class="form-label">Estimation<span class="required">*</span></label>
                        <input type="number" class="form-control" name="estimation" id="proj_estimation" placeholder="Enter the Project Estimation" readonly>
                        <div class="text-danger" id="proj-edit-error-estimation"></div>
                    </div>

                    <!-- Change Estimation Section -->
                    <div class="mb-3">
                        <label class="form-label">Change Estimation</label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-outline-success me-2" id="changeEstimationYes">Yes</button>
                            <button type="button" class="btn btn-outline-danger" id="changeEstimationNo">No</button>
                        </div>
                    </div>

                    <!-- Change Estimation Reason Field (Initially Hidden) -->
                    <div class="mb-3" id="changeEstimationReasonField" style="display: none;">
                        <label class="form-label">Change Estimation Reason<span class="required">*</span></label>
                        <textarea class="form-control" name="change_estimation_reason" id="proj_change_estimation_reason" rows="3" placeholder="Enter the reason for changing the estimation"></textarea>
                        <div class="text-danger" id="proj-edit-error-change_estimation_reason"></div>
                    </div>

                    <!-- Billing Company and Description -->
                    <div class="mb-3">
                        <label class="form-label">Billing Company</label>
                        <select class="form-select" name="biiling_company" id="proj_biiling_company">
                            <option value="0">None</option>
                            <option value="1">Isarva</option>
                            <option value="2">Blue Flemingo</option>
                        </select>
                        <div class="text-danger" id="proj-edit-error-billing_company"></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description<span class="required">*</span></label>
                        <textarea class="form-control" name="description" id="proj_description" rows="3" placeholder="Enter the details about project"></textarea>
                        <div class="text-danger" id="proj-edit-error-description"></div>
                    </div>

                      <!-- Profile Image -->
                    <div class="mb-3">
                        <label for="project_image" class="form-label">Project Image</label>
                        <input type="file" class="form-control" id="proj_image" name="project_image">
                        <div class="text-danger" id="proj-add-error-project_image"></div> <!-- Error container for "profile_image" -->
                        <!-- Display existing profile image -->
                        <div id="proj_current-profile-image" class="mt-2">
                            <img src="" alt="Project Image" class="img-thumbnail" width="100" style="display: none;">
                        </div>
                    </div>

                  <!-- Estimation Change Log Table -->
                    <div class="mb-3">
                        <h5>Estimation Change Log</h5>
                        <table class="table table-bordered" id="estimationChangeLogTable">
                            <thead>
                                <tr>
                                    <th>Changed By</th>
                                    <th>Changed From</th>
                                    <th>Changed To</th>
                                    <th>Diff</th>
                                    <th>Reason</th>
                                    <th>Changed At</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be populated dynamically via AJAX -->
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Project</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Create task-->
<div class="modal fade" id="createtask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Create Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id= "createtaskform" action="{{ route('admin.project_task.store-task') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <!-- Ensures project_id is passed along with the form submission for the task.-->
                     <!-- Ensure project_id is only included when available -->
                     @if(isset($project))
                     <input type="hidden" name="project_id" value="{{ $project->id }}">
                     @endif
                     

                    <div class="mb-3">
                        <label class="form-label">Task Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="task_name" placeholder="Enter the Task name" value="{{ old('task_name') }}" >
                        <div class="text-danger" id="task-error-task_name"></div> <!-- Error container for "name" -->
                    </div>
                   
                    <div class="mb-3">
                        <label class="form-label">Task Category</label>
                        <select class="form-select select2" name="task_category" aria-label="Default select Project Category" style="width: 100%; ">
                            <option selected>None</option>
                            <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Website Design</option>
                            <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>App Development</option>
                            <option value="3" {{ old('category') == '3' ? 'selected' : '' }}>Quality Assurance</option>
                            <option value="4" {{ old('category') == '4' ? 'selected' : '' }}>Development</option>
                            <option value="5" {{ old('category') == '5' ? 'selected' : '' }}>Backend Development</option>
                            <option value="6" {{ old('category') == '6' ? 'selected' : '' }}>Software Testing</option>
                            <option value="8" {{ old('category') == '8' ? 'selected' : '' }}>Marketing</option>
                            <option value="9" {{ old('category') == '9' ? 'selected' : '' }}>UI/UX Design</option>
                            <option value="10"{{ old('category') == '10' ? 'selected' : ''}}>Other</option>
                        </select>
                        <div class="text-danger" id="task-error-task_category"></div>
                    </div>
                    

                    <div class="mb-3">
                        <label class="form-label">Description<span class="required">*</span></label>
                        <textarea class="form-control " name="task_description" value="{{ old('task_description') }}" rows="3" placeholder="Enter the details about project"></textarea>
                        <div class="text-danger" id="task-error-task_description"></div>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="formFileMultipleone" class="form-label">Task Images & Document</label>
                        <input class="form-control" type="file" id="formFileMultipleone" multiple>
                    </div> --}}

                    
                    <div class="mb-3">
                        <label  class="form-label">Task End Date</label>
                        <input type="date" class="form-control" name="task_end_date" value="{{ old('task_end_date') }}" >
                        <div class="text-danger" id="task-error-task_end_date"></div>
                    </div>
                        
                    <div class="mb-3 mt-4">
                        <label for="assigned_for" class="form-label">Assigned For <span class="required">*</span></label>
                        <select class="form-select select2 " name="task_assigned_for" style="width: 100%; ">
                            <option value="">Select Member</option>
                            @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                <option value="{{ $id }}">{{ $employeeName }}</option>
                            @endforeach
                        </select>                        
                        <div class="text-danger" id="task-error-task_assigned_for"></div>
                    </div>

                    <!-- Estimation Field -->
                    <div class="mb-3 mt-4">
                        <label class="form-label">Estimation Hr <span class="required">*</span></label>
                        <input type="number" class="form-control" name="task_estimation_hr"  value="{{ old('task_estimation') }}" placeholder="Enter the Task Estimation" >
                        <div class="text-danger" id="task-error-task_estimation_hr"></div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                        <button type="Submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit task -->
<div class="modal fade" id="edittask" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
             <div class="modal-body">
                 <form id="editTaskForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="edit_project_id" name="project_id">
                    <input type="hidden" id="edit_task_id" name="task_id">

                    <!-- Task Name -->
                    <div class="mb-3">
                        <label for="edit_task_name" class="form-label">Task Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_task_name" name="task_name">
                        <div class="text-danger" id="task_edit-error-task_name"></div>
                    </div>

                    
                     <!-- Project Category -->
                    <div class="mb-3">
                        <label class="form-label">Task Category</label>
                        <select class="form-select select2" name="task_category" id="edit_task_category" style="width: 100%; ">
                            <option value="">None</option>
                            <option value="1">Website Design</option>
                            <option value="2">App Development</option>
                            <option value="3">Quality Assurance</option>
                            <option value="4">Development</option>
                            <option value="5">Backend Development</option>
                            <option value="6">Software Testing</option>
                            <option value="7">Marketing</option>
                            <option value="8">UI/UX Design</option>
                            <option value="9">Other</option>
                        </select>
                        <div class="text-danger" id="task_edit-error-task_category"></div>
                    </div>

                      <!-- Description -->
                      <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_task_description" name="task_description" rows="3"></textarea>
                        <div class="text-danger" id="task_edit-error-task_description"></div>
                    </div>

                

                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="edit_end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="edit_task_end_date" name="task_end_date">
                        <div class="text-danger" id="task_edit-error-task_end_date"></div>
                    </div>
                    
                        <!-- Assigned To -->

                        <div class="mb-3">
                            <label for="edit_assigned_to" class="form-label">Assigned For <span class="text-danger">*</span></label>
                            <select class="form-select select2" name="task_assigned_for" id="edit_task_assigned_for" style="width: 100%; ">
                                <option value="">Select Employee</option>
                                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                    <option value="{{ $id }}">{{ $employeeName }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="task_edit-error-task_assigned_for"></div>
                        </div>
    
                      <!-- Estimation Field -->
                    <div class="mb-3 mt-4">
                        <label class="form-label">Estimation Hr <span class="required">*</span></label>
                        <input type="number" class="form-control" name="task_estimation_hr" id="edit_task_estimation" placeholder="Enter the Task Estimation" >
                        <div class="text-danger" id="task_edit-error-task_estimation_hr"></div>
                    </div>   

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Task</button>
                    </div> 
                </form> 
            </div>
        </div>
    </div>
</div>


    
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">

                <!-- First Row: Project Details -->
                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                    <div class="w-100 ">
                        <h5 class="mb-0 projectlists">
                            <strong>{{ $project->client_name ?? 'N/A' }}</strong> -
                            <strong>{{ $project->project_name }}</strong> -
                            <span class="badge bg-{{ $project->getStatusClass() }}">{{ $project->status_name }}</span> -
                            {{-- <strong>{{ \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}</strong> --}}
                            <div class="progress-container progrsbar" style="height: 23px;">
                                <!-- Date Range Inside Progress Bar -->
                                <div class="date-range">{{ $project->formatted_date_range }}</div>
        
                                <!-- Progress Bar -->
                                <div class="progress-bar-manage" style="width: {{ $project->progress }}%; background-color: {{ $project->is_overdue ? 'red' : 'blue' }};"></div>
                            </div>
                        </h5>
                    </div>
                    <div class="editaddbtn">
                        <a href="#" class="btn btn-primary edit-project-btn" data-id="{{ $project->id }}" data-bs-toggle="modal" data-bs-target="#editproject">Edit Project</a>
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createproject">+ Add Project</a>
                    </div>
                </div>

                <!-- Grey Separator Line -->
                <div class="my-2" style="border-bottom: 3px solid #ccc;"></div>

                <!-- Second Row: Project Description -->
                <div class="p-3 bg-white rounded shadow-sm">
                    <p class="mb-0">{{ $project->description }}</p>
                </div>
                
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Task Management</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#createtask">
                                    <i class="icofont-plus-circle me-2 fs-6"></i>Create Task
                                </button>
                                {{-- <button type="button" class="btn btn-success btn-set-task w-sm-100 ms-2" data-bs-toggle="modal" data-bs-target="#editTask">
                                    <i class="icofont-edit me-2 fs-6"></i>Edit Task
                                </button> --}}
                            </div>
                        </div>
                        
                    </div>
                </div> <!-- Row end  -->

            
                <!-- Tab Navigation -->
                <div class="d-flex gap-3 mt-3">
                    <button class="btn btn-outline-primary d-flex align-items-center" id="showTasks">
                        <i class="icofont-tasks me-2"></i> Tasks
                    </button>
                    <button class="btn btn-outline-primary d-flex align-items-center" id="showInternalDocs">
                        <i class="icofont-file-document me-2"></i> Internal Docs
                    </button>
                 
                    <button class="btn btn-outline-primary d-flex align-items-center" id="showAssets">
                        <i class="icofont-folder me-2"></i> Assets
                    </button>

                    <button class="btn btn-outline-primary d-flex align-items-center" id="showWorkedHrs">
                        <i class="icofont-clock-time me-2"></i> WorkedHrs
                    </button>
                    
                    <button class="btn btn-outline-primary d-flex align-items-center" id="showAdditionHr">
                        <i class="icofont-plus-circle me-2"></i> Add.Hrs
                    </button>
                    
                </div>


                <!-- Sections (Initially Hidden) -->
                <div class="mt-3">

                   <!-- Internal Docs Section -->
                    <div id="internalDocsSection" class="tab-content shadow-sm p-3 rounded bg-white" style="display: none;">
                       <h5 class="fw-bold mb-3">Internal Docs</h5>


                    @if (session()->has('flash_success_docs'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
                            <i class="bi bi-check-circle-fill me-2 text-success"></i> 
                            <span>{{ session('flash_success_docs') }}</span>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                       <!-- Form to submit internal docs -->
                        <form id="internalDocsForm" action="{{ route('admin.internal-docs.store') }}" method="POST">
                            @csrf
                            <!-- Hidden input for project_id -->
                            <input type="hidden" name="project_id" value="{{ $project->id ?? '' }}">


                            <div class="table-responsive">
                                <table class="table table-bordered" id="internalDocsTable">
                                    <thead>
                                        <tr>
                                            <th>Si.No</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Link</th>
                                            <th>Comments</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!-- Display Existing Internal Docs -->
                                        @php $count = 1; @endphp
                                        @foreach($internalDocs as $doc)
                                            <tr>
                                                <!-- Si.No and Hidden ID in the same <td> -->
                                                <td>
                                                    {{ $count }}
                                                    <input type="hidden" name="id[]" value="{{ $doc->id }}">
                                                </td>
                                                <td><input type="date" class="form-control" name="date[]" value="{{ \Carbon\Carbon::parse($doc->date)->format('Y-m-d') }}"></td>
                                                <td><input type="text" class="form-control" name="title[]" value="{{ $doc->title }}"></td>
                                                <td><input type="text" class="form-control" name="link[]" value="{{ $doc->link }}"></td>
                                                <td><input type="text" class="form-control" name="comments[]" value="{{ $doc->comments }}"></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                                    <button type="button" class="btn btn-danger btn-sm remove-row">-</button>
                                                </td>
                                            </tr>
                                            @php $count++; @endphp
                                        @endforeach
                                        <!-- Add New Row (If no existing records) -->
                                        @if($count === 1)
                                            <tr>
                                                <!-- Si.No and Hidden ID in the same <td> -->
                                                <td>
                                                    1
                                                    <input type="hidden" name="id[]" value="">
                                                </td>
                                                <td><input type="date" class="form-control" name="date[]"></td>
                                                <td><input type="text" class="form-control" name="title[]"></td>
                                                <td><input type="text" class="form-control" name="link[]"></td>
                                                <td><input type="text" class="form-control" name="comments[]"></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" id="saveInternalDocs" class="btn btn-primary mt-3">Save Changes</button>
                        </form>
                    </div>
                </div>




              
                    <!-- Assets Section -->
                    <div id="assetsSection" class="tab-content shadow-sm p-3 rounded bg-white"  style="display:none;">
                        @if (session()->has('flash_success_asset'))
                            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
                               <i class="bi bi-check-circle-fill me-2 text-success"></i> 
                              <span>{{ session('flash_success_asset') }}</span>
                              <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    
                                        
                        <h5 class="fw-bold mb-3">Assets</h5>
                    
                        <!-- File Upload Section -->
                        <form action="{{ route('admin.task-asset.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id ?? '' }}">
                    
                            <!-- Custom File Upload UI -->
                            <div class="file-upload-container text-center p-4 border rounded-3 shadow-sm" style="background: #f9f9f9;">
                                <label class="btn btn-primary position-relative">
                                    <i class="icofont-upload"></i> Select Files
                                    <input type="file" name="assets[]" multiple hidden id="fileInput">
                                </label>
                                
                                <!-- Selected File List -->
                                <div id="selectedFiles" class="mt-3 text-start">
                                    <p class="text-muted">No files selected</p>
                                </div>
                            </div>
                    
                            <button type="submit" class="btn btn-success mt-3">Upload</button>
                        </form>
                    
                        <!-- Display Uploaded Files -->
                        <div class="mt-4">
                            <h5>Uploaded Files</h5>
                            <div class="row">
                                @foreach($assets as $file)
                                    <div class="col-md-3 mb-4">
                                        <div class="card shadow-sm">
                                            @if($file->is_image == 1)
                                                <img src="{{ asset('storage/images/taskasset_files/' . basename($file->image_path)) }}" class="card-img-top" alt="{{ $file->filename }}" style="height: 150px; object-fit: cover;">
                                            @else
                                                <div class="text-center p-4">
                                                    <i class="icofont-file-pdf display-4 text-danger"></i>
                                                    <p class="small text-truncate mt-2">{{ $file->filename }}</p>
                                                </div>
                                            @endif
                                            <div class="card-body text-center">
                                                <p class="card-text small">{{ $file->filename }}</p>
                                                <a href="{{ asset('storage/images/taskasset_files/' . basename($file->image_path)) }}" class="btn btn-sm btn-outline-primary" download>
                                                    <i class="icofont-download"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    


                   <!-- Worked Hrs Section -->
                    <div id="workedHrsSection" class="tab-content shadow-sm p-3 rounded bg-white"  style="display:none;">
                        <h5>Worked Hours</h5>

                        @if($workedHours->isNotEmpty())
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>SI.No</th>
                                        <th>Employee</th>
                                        <th>Spent Hrs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $totalHours = 0; @endphp
                                    @foreach($workedHours as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->employee }}</td>
                                            <td>{{ $item->spent_hrs }}</td>
                                        </tr>
                                        @php $totalHours += $item->spent_hrs; @endphp
                                    @endforeach
                                    <tr>
                                        <td colspan="2"><strong style="color:red;">Total Hrs</strong></td>
                                        <td><strong>{{ $totalHours }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <p class="text-danger">No worked hours found for this project.</p>
                        @endif

                          <!--  New Container Section for Hours Summary -->
                        <div class="hours-summary">
                            <!--  First Row - Estimated Hours -->
                            <div class="estimated-hours">
                                <h3 class="esthrs">Estimated Hours : <span>{{ $estimatedHours }}</span></h3>
                            </div>

                            <!-- Second Row - Spent Days -->
                            <div class="spent-days">
                                <h1 class="spentdays">Spent Days : <span>{{ $spentDays }}</span></h1>
                            </div>

                            <!-- Third Row - Total Hours Remaining/Overflow -->
                            <div class="total-hours {{ $statusColor }}">
                                <h4 class="totalhrs">Total <span>{{ $remainingHours }}</span> hours {{ $statusText }}</h4>
                            </div>
                        </div>

                    </div>


                  <!-- Additional Hr section -->
                    <div id="additionHrSection" class="tab-content shadow-sm p-3 rounded bg-white" style="display: none;">
                        <form id="additionalHrsForm">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="additionalHrsTable">
                                    <thead>
                                        <tr>
                                            <th width="5%">SI.No</th>
                                            <th width="15%">Date</th>
                                            <th width="25%">Description</th>
                                            <th width="10%">Hrs</th>
                                            <th width="30%">Comments</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Initial empty row -->
                                        <tr>
                                            <td>1</td>
                                            <td><input type="date" class="form-control" name="additional_hrs[0][date]" required></td>
                                            <td><input type="text" class="form-control" name="additional_hrs[0][description]" required></td>
                                            <td><input type="number" step="0.01" class="form-control" name="additional_hrs[0][hrs]" required></td>
                                            <td><input type="text" class="form-control" name="additional_hrs[0][comments]"></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success add-row">
                                                    <i class="icofont-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Save Additional Hours</button>
                            </div>
                        </form>
                    </div>

                  
                        
                <div id="taskSection" class="tab-content shadow-sm p-3 rounded bg-white">
                    <h5 class="fw-bold mb-3">Project Task section</h5>

                    
                    <div class="col-lg-12 col-md-12 flex-column">
                         


                        <div class="task-card">
                            <div class="row taskboard g-3 py-xxl-4">
                                <!-- In Progress -->
                                <div class="col-xxl-4" data-status="1">
                                    <h6 class="fw-bold py-3 mb-0">In Progress</h6>
                                    <ol class="dd-list">
                                        @if(isset($tasksByStatus[1]) && count($tasksByStatus[1]) > 0)
                                            @foreach ($tasksByStatus[1] as $task)
                                                <li class="task-item" data-id="{{ $task->id }}">
                                                    <div class="dd-handle edit-task-btn" 
                                                         data-id="{{ $task->id }}" 
                                                         data-project-id="{{ $task->project_id }}" 
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#edittask"
                                                         style=" border-bottom: 2px solid #ffc107 !important;">
                                                        <div class="task-info d-flex align-items-center gap-3 justify-content-between">
                                                            <h6 class="light-success-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">
                                                                {{ $task->task_name }}
                                                            </h6>
                                                            <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                                <div class="avatar-list avatar-list-stacked m-0">
                                                                    <img class="avatar rounded-circle small-avt" src="{{ url('/images/xs/avatar2.jpg') }}" alt="">
                                                                    <img class="avatar rounded-circle small-avt" src="{{ url('/images/xs/avatar1.jpg') }}" alt="">
                                                                </div>
                                                                <span class="badge bg-warning text-end mt-2">{{ $task->taskCategoryName }}</span>
                                                            </div>
                                                        </div>
                                                        <p class="py-2 mb-0">{{ $task->description }}</p>
                                                        <div class="tikit-info row g-3 align-items-center">
                                                            <div class="col-sm">
                                                                <ul class="d-flex list-unstyled align-items-center flex-wrap">
                                                                    <li class="me-2">
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="icofont-flag"></i>
                                                                            <span class="ms-1">{{ $task->formatted_end_date }}</span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm text-end">
                                                                <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small">
                                                                    {{ $task->assignedUser->name ?? 'N/A' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <div class="empty-state">
                                                <p class="notask_drag">No tasks available</p>
                                            </div>
                                        @endif
                                    </ol>
                                </div>
                        
                                <!-- Needs Review -->
                                <div class="col-xxl-4" data-status="2">
                                    <h6 class="fw-bold py-3 mb-0">Needs Review</h6>
                                    <ol class="dd-list">
                                        @if(isset($tasksByStatus[2]) && count($tasksByStatus[2]) > 0)
                                            @foreach ($tasksByStatus[2] as $task)
                                                <li class="task-item" data-id="{{ $task->id }}">
                                                    <div class="dd-handle  edit-task-btn" 
                                                         data-id="{{ $task->id }}" 
                                                         data-project-id="{{ $task->project_id }}" 
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#edittask"
                                                         style="border-bottom: 2px solid #FFAA8A !important">
                                                        <div class="task-info d-flex align-items-center gap-3 justify-content-between">
                                                            <h6 class="light-success-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">
                                                                {{ $task->task_name }}
                                                            </h6>
                                                            <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                                <div class="avatar-list avatar-list-stacked m-0">
                                                                    <img class="avatar rounded-circle small-avt" src="{{ url('/images/xs/avatar2.jpg') }}" alt="">
                                                                    <img class="avatar rounded-circle small-avt" src="{{ url('/images/xs/avatar1.jpg') }}" alt="">
                                                                </div>
                                                                <span class="badge bg-warning text-end mt-2">{{ $task->taskCategoryName }}</span>
                                                            </div>
                                                        </div>
                                                        <p class="py-2 mb-0">{{ $task->description }}</p>
                                                        <div class="tikit-info row g-3 align-items-center">
                                                            <div class="col-sm">
                                                                <ul class="d-flex list-unstyled align-items-center flex-wrap">
                                                                    <li class="me-2">
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="icofont-flag"></i>
                                                                            <span class="ms-1">{{ $task->formatted_end_date }}</span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm text-end">
                                                                <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small">
                                                                    {{ $task->assignedUser->name ?? 'N/A' }}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <div class="empty-state">
                                                <p class="notask_drag">No tasks available</p>
                                            </div>
                                        @endif
                                    </ol>
                                </div>
                        
                                <!-- Completed -->
                                <div class="col-xxl-4" data-status="3">
                                    <h6 class="fw-bold py-3 mb-0">Completed</h6>
                                    <ol class="dd-list">
                                        @if(isset($tasksByStatus[3]) && count($tasksByStatus[3]) > 0)
                                            @foreach ($tasksByStatus[3] as $task)
                                                <li class="task-item" data-id="{{ $task->id }}">
                                                    <div class="dd-handle  edit-task-btn" 
                                                         data-id="{{ $task->id }}" 
                                                         data-project-id="{{ $task->project_id }}" 
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#edittask"
                                                         style="border-bottom: 2px solid #28a745 !important">
                                                        <div class="task-info d-flex align-items-center gap-3 justify-content-between">
                                                            <h6 class="light-success-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">
                                                                {{ $task->task_name }}
                                                            </h6>
                                                            <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                                <div class="avatar-list avatar-list-stacked m-0">
                                                                    <img class="avatar rounded-circle small-avt" src="{{ url('/images/xs/avatar2.jpg') }}" alt="">
                                                                    <img class="avatar rounded-circle small-avt" src="{{ url('/images/xs/avatar1.jpg') }}" alt="">
                                                                </div>
                                                                <span class="badge bg-warning text-end mt-2">{{ $task->taskCategoryName }}</span>
                                                            </div>
                                                        </div>
                                                        <p class="py-2 mb-0">{{ $task->description }}</p>
                                                        <div class="tikit-info row g-3 align-items-center">
                                                            <div class="col-sm">
                                                                <ul class="d-flex list-unstyled align-items-center flex-wrap">
                                                                    <li class="me-2">
                                                                        <div class="d-flex align-items-center">
                                                                            <i class="icofont-flag"></i>
                                                                            <span class="ms-1">{{ $task->formatted_end_date }}</span>
                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm text-end">
                                                                <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small">
                                                                    {{ $task->assignedUser->name ?? 'N/A' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <div class="empty-state">
                                                <p class="notask_drag">No tasks available</p>
                                            </div>
                                        @endif
                                    </ol>
                                </div>
                            </div>
                        </div>
       
                    </div>
                </div>
            
            </div>
         </div> <!-- div body end -->
    </div>

         <!-- SCRIPT for working of edit and create task model -->
        <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
        <script src="{{ asset('js/template.js') }}"></script>
        <script src = "{{ asset('js/jquery-3.6.0.min.js')}}"> </script> <!-- jQuery  -->
        <script src="{{ asset('js/jquery-ui.min.js')}}"></script>  <!-- jQuery UI (Required for Sortable)  -->
        <link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}"> <!-- jQuery UI (Required for Sortable)  --> 
        <script src = " {{ asset('js/sweetalert2@11.js')}}"></script>
 
        <script src ="{{ asset('js/select2.min.js')}}"></script>

          

<script>

    $(document).ready(function() {
        console.log("jQuery Version:", jQuery.fn.jquery);  // Debugging
        console.log("jQuery UI Version:", $.ui);  // Debugging

        // Check if .sortable() is available
        if ($.fn.sortable) {
            $(".sortable").sortable();
        } else {
            console.error("jQuery UI Sortable is not available!");
        }
    });


    console.log("jQuery Version:", jQuery.fn.jquery);
    console.log("jQuery UI Version:", $.ui);
    console.log("Sortable Available:", !!$.fn.sortable);
</script>


<script>
    var editTaskRoute = "{{ route('admin.task.edit', ':id') }}"; // id is the placeholder for emplyoee id which is replaced further
    
    // Select2 for task and Project
    $(document).ready(function () {
        $('#createtask').on('shown.bs.modal', function () {
            $(this).find('.select2').select2({
                dropdownParent: $('#createtask')
            });
        });
    });

    $('#edittask').on('shown.bs.modal', function () {
            $(this).find('.select2').select2({
                dropdownParent: $('#edittask')
            });
        });

    $('#createproject').on('shown.bs.modal', function () {
            $(this).find('.select2').select2({
                dropdownParent: $('#createproject')
                    });
            });
             

    $('#editproject').on('shown.bs.modal', function () {
            $(this).find('.select2').select2({
                     dropdownParent: $('#editproject')
                });
            });

</script>


<script>
                    

               //  Script to edit and update the Project values
               var editProjectRoute = "{{ route('admin.project.edit-project', ':id') }}"; // id is the placeholder for Project id which is replaced further
                $(document).ready(function () {

                    // When edit button is clicked
                    $('.edit-project-btn').on('click', function () {
                    
                        var projectId = $(this).data('id'); 
                        console.log(projectId);

                        // Generate the URL using the route name and Project ID
                        var url = editProjectRoute.replace(':id', projectId);
                        //  console.log(url);
                    
                        // Fetch Employee data via AJAX
                        $.ajax({

                            url: url, // Use the dynamically generated URL
                            method: 'GET',
                            success: function (response) {    // callback function that runs only if the request is successful.
                                console.log(response);
                                // Populate the modal form with the fetched data from db column
                                $('#proj_client').val(response.client);
                                $('#proj_name').val(response.project_name);
                                $('#proj_category').val(response.category);
                                $('#project_image').val(response.project_image);
                                $('#proj_manager').val(response.manager);
                                $('#proj_team_leader').val(response.team_leader);
                                // $('#teamMembersInput').val(response.team_members);
                                $('#proj_start_date').val(response.start_date);
                                $('#proj_end_date').val(response.end_date);
                                $('#proj_department').val(response.department);
                                $('#proj_status').val(response.status);
                                $('#proj_budget').val(response.budget);
                                $('#proj_priority').val(response.priority);
                                $('#proj_type').val(response.type);
                                $('#proj_estimation').val(response.estimation);
                                $('#proj_biiling_company').val(response.biiling_company);
                                $('#proj_description').val(response.description);
                                
                                console.log("Team Members from Response:", response.team_members);
                                prefillEditTeamMembers(response.team_members);

                                // Set the form action URL for updating
                                $('#editprojectform').attr('action', "{{ route('admin.project.update-project', ':id') }}".replace(':id', projectId));
                                
                                // Display the existing profile image
                                if (response.profile_image) {
                                    $('#proj_current-profile-image img')
                                        .attr('src', "{{ asset('') }}" + response.profile_image) // Set the image source
                                        .show(); // Show the image
                                } else {
                                    $('#proj_current-profile-image img').hide(); // Hide the image if no profile image exists
                                }

                                // Dynamically populate the Estimation Change Log table
                                populateEstimationChangeLogTable(response.estimation_change_logs);

                            },
                            error: function (xhr) {
                                console.error('Error fetching Project data:', xhr.responseText);
                            }

                        });
                    });
                });

                 
                     //----- AJAX for Project Add Modal validation form---
                 
                    $('#createProjectForm').on('submit', function (e) {
                        e.preventDefault(); // Prevent the default form submission

                        var form = $(this);
                        var url = form.attr('action');
                        var formData = new FormData(form[0]); // By passing form[0] (the raw DOM element) to the FormData constructor, FormData  extract all the data from the form, including input type="text",<select>:

                        // Clear previous errors
                        $('.text-danger').html('');

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            processData: false, //tell jQuery not to process the data, so that FormData can handle the formatting itself. This allows files to be sent correctly without any interference.
                            contentType: false, // for the proper handling of file uploads, 
                            success: function (response) {
                            
                            // If the form is successfully submitted, close the modal and redirect
                           
                            $('#createproject').modal('hide');
                            Swal.fire({
                                    title: 'Success!',
                                    text: 'Project added successfully!',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href.reload();
                                });
                         },
                            error: function (xhr) {
                                // If there are validation errors, display them below each field
                                // var errors = xhr.responseJSON.errors;
                                // $.each(errors, function (key, value) {
                                //     $('#proj-add-error-' + key).html(value[0]); // Display the first error message
                                // });

                                if (xhr.responseJSON && xhr.responseJSON.errors) {
                                    var errors = xhr.responseJSON.errors;
                                    $.each(errors, function (key, value) {
                                        $('#proj-add-error-' + key).html(value[0]); // Display the first error message
                                    });
                                } else {
                                    console.error('An unexpected error occurred:', xhr.responseText);
                                    alert('An unexpected error occurred. Please check the console for details.');
                                }
                            }
                        });
                    });

            // Task edit AJAX code
            $(document).ready(function () {
                // When edit button is clicked
                $('.edit-task-btn').on('click', function () {
                    var taskId = $(this).data('id');
                    var url = editTaskRoute.replace(':id', taskId);

                    // Fetch Task data via AJAX
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function (response) {
                            console.log('AJAX Response:', response); // Debugging

                            // Access the nested 'task' object in the response
                            var task = response.task;

                            // Debugging: Check the values of project_id and task_id
                            console.log('Project ID:', task.project_id);
                            console.log('Task ID:', task.id);

                            // Set the hidden fields
                            $('#edit_project_id').val(task.project_id);
                            $('#edit_task_id').val(task.id);

                            // Debugging: Verify the hidden fields are set correctly
                            console.log('Form Project ID:', $('#edit_project_id').val());
                            console.log('Form Task ID:', $('#edit_task_id').val());

                            // Populate other form fields
                            $('#edit_task_name').val(task.task_name ?? '');
                            $('#edit_task_category').val(task.task_category ?? '').trigger('change');
                            $('#edit_task_description').val(task.description ?? '');

                            // Format the date to 'yyyy-MM-dd'
                            var endDate = new Date(task.end_date).toISOString().split('T')[0];
                            $('#edit_task_end_date').val(endDate); // Set the formatted date

                            $('#edit_task_assigned_for').val(task.task_assigned_for).trigger('change');
                            $('#edit_task_estimation').val(task.estimation_hrs ?? '');

                            // Set the form action URL for updating
                            $('#editTaskForm').attr('action', "{{ route('admin.task.update', ':id') }}".replace(':id', task.id));

                            // Ensure modal is shown after data is set
                            $('#edittask').modal('show');
                        },
                        error: function (xhr) {
                            console.error('Error fetching task data:', xhr.responseText);
                        }
                    });
                });

                // Handle task edit form submission validation section
                $('#editTaskForm').on('submit', function (e) {
                    e.preventDefault(); // Prevent default form submission

                    // Debugging: Log the form action URL
                    console.log('Form Action URL:', $(this).attr('action'));

                    // Debugging: Log the form data
                    var formData = $(this).serialize();
                    console.log('Form Data:', formData);

                    // Submit the form via AJAX
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'PUT',
                        data: formData,
                        success: function (response) {
                            console.log('Task updated successfully:', response);
                            // Handle success (e.g., close modal, show success message)

                            
                            // Show SweetAlert2 pop-up
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Task updated successfully!',
                                showConfirmButton: false,
                                timer: 2000 // Auto-close after 2 seconds
                            });

                            // Close the edit modal
                            $('#edittask').modal('hide');

                            // Optionally, reload the page to reflect changes
                            setTimeout(function () {
                                location.reload();
                            }, 2000); // Reload after 2 seconds

                            $('#edittask').modal('hide');
                            // location.reload(); // Reload the page to reflect changes
                        },
                        error: function (xhr) {
                            console.error('Error updating task:', xhr.responseText);
                            // Handle error (e.g., show error message)
                        }
                    });
                });
            });
            



        // JS to Display selected file under assets
        document.getElementById('fileInput').addEventListener('change', function(event) {
                const fileList = event.target.files;
                const fileDisplay = document.getElementById('selectedFiles');
                
                if (fileList.length > 0) {
                    let output = '<ul class="list-group mt-2">';
                    for (let i = 0; i < fileList.length; i++) {
                        output += `<li class="list-group-item d-flex justify-content-between align-items-center">
                            ${fileList[i].name}
                            <span class="badge bg-secondary">${(fileList[i].size / 1024).toFixed(1)} KB</span>
                        </li>`;
                    }
                    output += '</ul>';
                    fileDisplay.innerHTML = output;
                } else {
                    fileDisplay.innerHTML = '<p class="text-muted">No files selected</p>';
                }
            });
            
            console.log(jQuery.fn.jquery);

            //  JS For tab switch for internal docs, assets etc section
            document.addEventListener("DOMContentLoaded", function () {
                let table = document.getElementById("internalDocsTable").getElementsByTagName("tbody")[0];

                let taskBtn = document.getElementById("showTasks");
                let internalDocsBtn = document.getElementById("showInternalDocs");
                let assetsBtn = document.getElementById("showAssets");
                let workedhrsbtn = document.getElementById("showWorkedHrs");
                let additionalhrbtn = document.getElementById("showAdditionHr");  // Semicolon added here

                let taskSection = document.getElementById("taskSection");
                let internalDocsSection = document.getElementById("internalDocsSection");
                let assetsSection = document.getElementById("assetsSection");
                let workedHrsSection = document.getElementById("workedHrsSection");
                let additionHrSection = document.getElementById("additionHrSection");

                // Ensure Task section is visible by default
                taskSection.style.display = "block";
                internalDocsSection.style.display = "none";
                assetsSection.style.display = "none";
                workedHrsSection.style.display = "none";
                additionHrSection.style.display = "none";

                // Tab click event listeners
                taskBtn.addEventListener("click", function () {
                    taskSection.style.display = "block";
                    internalDocsSection.style.display = "none";
                    assetsSection.style.display = "none";
                    workedHrsSection.style.display = "none";
                    additionHrSection.style.display = "none";
                });

                internalDocsBtn.addEventListener("click", function () {
                    internalDocsSection.style.display = "block";
                    taskSection.style.display = "none";
                    assetsSection.style.display = "none";
                    workedHrsSection.style.display = "none";
                    additionHrSection.style.display = "none";
                });

                assetsBtn.addEventListener("click", function () {
                    assetsSection.style.display = "block";
                    taskSection.style.display = "none";
                    internalDocsSection.style.display = "none";
                    workedHrsSection.style.display = "none";
                    additionHrSection.style.display = "none";
                });

                workedhrsbtn.addEventListener("click", function () {
                    workedHrsSection.style.display = "block";
                    taskSection.style.display = "none";
                    internalDocsSection.style.display = "none";
                    assetsSection.style.display = "none";
                    additionHrSection.style.display = "none";
                });   
                
                additionalhrbtn.addEventListener("click", function () {
                    additionHrSection.style.display = "block";
                    taskSection.style.display = "none";
                    internalDocsSection.style.display = "none";
                    assetsSection.style.display = "none";
                    workedHrsSection.style.display = "none";
                });         
        
                // Function to get the next row index correctly
                    function getRowIndex() {
                        return table.getElementsByTagName("tr").length + 1;
                    }

                    // Function to add a new row dynamically
                    function addNewRow() {
                    const rowCount = table.getElementsByTagName("tr").length + 1;

                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td>
                            ${rowCount}
                            <input type="hidden" name="id[]" value="">
                        </td>
                        <td><input type="date" class="form-control" name="date[]"></td>
                        <td><input type="text" class="form-control" name="title[]"></td>
                        <td><input type="text" class="form-control" name="link[]"></td>
                        <td><input type="text" class="form-control" name="comments[]"></td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm add-row">+</button>
                            <button type="button" class="btn btn-danger btn-sm remove-row">-</button>
                        </td>
                    `;
                    table.appendChild(newRow);
                    updateRowNumbers();
                    }

                    function removeRow(event) {
                        const row = event.target.closest("tr");
                        if (table.rows.length > 1) {
                            row.remove();
                            updateRowNumbers();
                        }
                    }

                    function updateRowNumbers() {
                        const rows = table.getElementsByTagName("tr");
                        for (let i = 0; i < rows.length; i++) {
                            rows[i].getElementsByTagName("td")[0].childNodes[0].textContent = i + 1;
                        }
                    }

                    table.addEventListener("click", function (event) {
                        if (event.target.classList.contains("add-row")) {
                            addNewRow();
                        } else if (event.target.classList.contains("remove-row")) {
                            removeRow(event);
                        }
                    });

                });


                    //  Test Case Drag and DROP JS
                    $(document).ready(function() {
                    console.log("Script loaded!"); // Check if this appears in the console

                    $('.dd-list').sortable({
                        connectWith: '.dd-list',
                        items: '> .task-item',
                        update: function(event, ui) {
                            var taskId = ui.item.data('id');
                            var newStatus = ui.item.closest('.col-xxl-4').data('status');

                            console.log('Task ID:', taskId);
                            console.log('New Status:', newStatus);

                            $.ajax({
                                url: "{{ route('admin.task.updateStatus') }}",
                                method: 'POST',
                                data: {
                                    task_id: taskId,
                                    status: newStatus,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    console.log('Task status updated successfully');
                                    console.log(response);

                                    // Hide/show empty state message
                                    var list = ui.item.closest('.dd-list');
                                    if (list.find('.task-item').length > 0) {
                                        list.find('.empty-state').hide();
                                    } else {
                                        list.find('.empty-state').show();
                                    }
                                },
                                error: function(xhr) {
                                    console.log('Error updating task status');
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    });
                });

     
                //----- AJAX for Task Add Modal form to show validation error---
                $(document).ready(function () {
                    // Handle form submission
                    $('#createtaskform').on('submit', function (e) {
                        e.preventDefault(); // Prevent default form submission

                        var form = $(this);
                        var url = form.attr('action');
                        var formData = new FormData(form[0]); // Capture all form data

                        // Clear previous errors
                        $('.text-danger').html('');

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            processData: false, // Prevent jQuery from processing the data
                            contentType: false, // Prevent jQuery from setting content type
                            success: function (response) {
                              
                                $('#createtask').modal('hide');

                                  // Show success message with SweetAlert
                                  Swal.fire({
                                        title: 'Success!',
                                        text: 'Task added successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        // Redirect using Laravel's route() helper
                                        window.location.href = "{{ route('admin.tasks.byProject', ':id') }}".replace(':id', projectId);
                                    });

                                // Get project ID from form input
                                var projectId = $('#createtaskform').find('input[name="project_id"]').val();

                                // // Redirect using Laravel's route() helper
                                // window.location.href = "{{ route('admin.tasks.byProject', ':id') }}".replace(':id', projectId);
                            },
                            error: function (xhr) {
                                // Handle validation errors
                                if (xhr.responseJSON && xhr.responseJSON.errors) {
                                    var errors = xhr.responseJSON.errors;
                                    $.each(errors, function (key, value) {
                                        $('#task-error-' + key).html(value[0]); // Correct error display // Show first error message under respective field
                                    });
                                } else {
                                    console.error('Unexpected error:', xhr.responseText);
                                    alert('An unexpected error occurred. Please check the console.');
                                }
                            }
                        });
                    });
                });

                    //----- AJAX for Task-edit Validation form Modal -----

                    $(document).ready(function () {
                    // Handle form submission
                    $('#editTaskForm').on('submit', function (e) {
                        e.preventDefault(); // Prevent default form submission

                        // Clear previous error messages
                        $('.text-danger').text('');

                        // Submit the form via AJAX
                        $.ajax({
                            url: $(this).attr('action'),
                            method: 'PUT',
                            data: $(this).serialize(),
                            success: function (response) {
                                // console.log('Task updated successfully:', response);

                                // Close the edit modal
                                $('#edittask').modal('hide');

                                // Optionally, reload the page to reflect changes
                                setTimeout(function () {
                                    location.reload();
                                }, 2000); // Reload after 2 seconds
                            },
                            error: function (xhr) {
                                console.error('Error updating task:', xhr.responseText);

                                // Handle validation errors
                                if (xhr.status === 422) {
                                    var errors = xhr.responseJSON.errors;

                                    // Loop through the errors and display them in the form
                                    $.each(errors, function (field, messages) {
                                        var errorField = $('#task_edit-error-' + field);
                                        if (errorField.length) {
                                            errorField.text(messages[0]); // Display the first error message
                                        }
                                    });
                                } else {
                                    // Handle other errors (e.g., server errors)
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'An error occurred while updating the task.',
                                    });
                                }
                            }
                        });
                    });
                });



                 // JS/AJAX FOR PROJECT ADD/EDIT -- 
     
            $(document).ready(function () {

                // When edit button is clicked
                $('.edit-project-btn').on('click', function () {
                
                    var projectId = $(this).data('id'); 
                    console.log(projectId);

                    // Generate the URL using the route name and Project ID
                    var url = editProjectRoute.replace(':id', projectId);
                    //  console.log(url);
                
                    // Fetch Employee data via AJAX
                    $.ajax({

                        url: url, // Use the dynamically generated URL
                        method: 'GET',
                        success: function (response) {    // callback function that runs only if the request is successful.
                            console.log(response);
                            // Populate the modal form with the fetched data from db column
                            $('#proj_client').val(response.client);
                            $('#proj_name').val(response.project_name);
                            $('#proj_category').val(response.category);
                            $('#project_image').val(response.project_image);
                            $('#proj_manager').val(response.manager);
                            $('#proj_team_leader').val(response.team_leader);
                            // $('#teamMembersInput').val(response.team_members);
                            $('#proj_start_date').val(response.start_date);
                            $('#proj_end_date').val(response.end_date);
                            $('#proj_department').val(response.department);
                            $('#proj_status').val(response.status);
                            $('#proj_budget').val(response.budget);
                            $('#proj_priority').val(response.priority);
                            $('#proj_type').val(response.type);
                            $('#proj_estimation').val(response.estimation);
                            $('#proj_biiling_company').val(response.biiling_company);
                            $('#proj_description').val(response.description);
                            
                            console.log("Team Members from Response:", response.team_members);
                            prefillEditTeamMembers(response.team_members);

                            // Set the form action URL for updating
                            $('#editprojectform').attr('action', "{{ route('admin.project.update-project', ':id') }}".replace(':id', projectId));
                            
                            // Display the existing profile image
                            if (response.profile_image) {
                                $('#proj_current-profile-image img')
                                    .attr('src', "{{ asset('') }}" + response.profile_image) // Set the image source
                                    .show(); // Show the image
                            } else {
                                $('#proj_current-profile-image img').hide(); // Hide the image if no profile image exists
                            }

                            // Dynamically populate the Estimation Change Log table
                            populateEstimationChangeLogTable(response.estimation_change_logs);

                        },
                        error: function (xhr) {
                            console.error('Error fetching Project data:', xhr.responseText);
                        }

                    });
                });
            });
         

        
        // Function to populate the Estimation Change Log table
        function populateEstimationChangeLogTable(logs) {
        var tbody = $('#estimationChangeLogTable tbody');
        tbody.empty(); // Clear the existing rows

                if (logs && logs.length > 0) {
                    logs.forEach(function (log) {
                        var changedByName = log.changed_by ? log.changed_by.name : 'N/A'; // Access the changedBy user's name
                        var row = `
                            <tr>
                                <td>${changedByName}</td>
                                <td>${log.changed_from}</td>
                                <td>${log.changed_to}</td>
                                <td>${log.diff}</td>
                                <td>${log.reason || 'N/A'}</td>
                                <td>${log.created_at}</td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                } else {
                    // If no logs are found, display a message
                    tbody.append(`
                        <tr>
                            <td colspan="6" class="text-center">No estimation change logs found.</td>
                        </tr>
                    `);
                }
            }

                   
                    // JS for Project team_member section
                    let selectedTeamMembers = {}; // Store selected members

                    function selectTeamMember(id, name) {
                        if (!selectedTeamMembers[id]) {     // If the member is not already selected, the code inside the block runs.
                            selectedTeamMembers[id] = name;  // Adds the Selected Member to the Object

                            let tag = document.createElement("div"); // Creates a New HTML <div> Element:This <div> will be used to display the selected team member in the UI as a badge.
                            tag.className = "badge bg-primary me-2 mb-2 p-2 d-flex align-items-center";

                            // Displays the selected member's name.
                            tag.innerHTML = `${name} <span class="ms-2 text-white" style="cursor:pointer;" onclick="removeTeamMember(${id}, this)">❌</span>`;
                            tag.setAttribute("data-id", id);

                            document.getElementById("selectedTeamMembers").appendChild(tag);
                            updateTeamMembersInput();   // Calls a Function to Update the Hidden Input Field
                        }
                    }

                    function removeTeamMember(id, element) {
                        delete selectedTeamMembers[id]; // Remove from object
                        element.parentElement.remove(); // Remove badge
                        updateTeamMembersInput();
                    }

                    function updateTeamMembersInput() {
                        document.getElementById("teamMembersInput").value = Object.keys(selectedTeamMembers).join(",");
                    }



                    // JS for Edit Project team_member section
                    let editSelectedTeamMembers = {}; // Store selected members for edit form

                    // Function to select a team member in the edit form
                    function selectEditTeamMember(id, name) {
                    console.log(`Selecting team member: ID=${id}, Name=${name}`);
                    if (!editSelectedTeamMembers[id]) {
                        editSelectedTeamMembers[id] = name;
                        let tag = document.createElement("div");
                        tag.className = "badge bg-primary me-2 mb-2 p-2 d-flex align-items-center";
                        tag.innerHTML = `${name} <span class="ms-2 text-white" style="cursor:pointer;" onclick="removeEditTeamMember(${id}, this)">❌</span>`;
                        tag.setAttribute("data-id", id);
                        document.getElementById("editSelectedTeamMembers").appendChild(tag);
                        updateEditTeamMembersInput();
                    } else {
                        console.log(`Team member ${id} already selected.`);
                    }
                } 



                    // Function to remove a team member in the edit form
                    function removeEditTeamMember(id, element) {
                        delete editSelectedTeamMembers[id]; // Remove from object
                        element.parentElement.remove(); // Remove badge
                        updateEditTeamMembersInput();
                    }

                        // Function to update the hidden input field in the edit form
                        function updateEditTeamMembersInput() {
                            document.getElementById("editTeamMembersInput").value = Object.keys(editSelectedTeamMembers).join(",");
                        }

                        // Function to pre-fill team members in the edit form
                        function prefillEditTeamMembers(teamMembers) {
                            $("#editSelectedTeamMembers").empty(); // Clear previous selections
                            editSelectedTeamMembers = {}; // Reset object

                            if (Array.isArray(teamMembers)) {
                                teamMembers.forEach(member => {
                                    selectEditTeamMember(member.id, member.name);
                                });
                            } else {
                                console.warn("Invalid team members data:", teamMembers);
                            }
                        }



                 // JS To handle the Yes/No button logic and make the estimation field editable when Yes is clicked.
                  $(document).ready(function () {
                    // First part - Yes/No button logic for estimation field 
                    $('#changeEstimationYes').on('click', function () {
                        $('#proj_estimation').prop('readonly', false); // Make estimation field editable
                        $('#changeEstimationReasonField').show(); // Show the change estimation reason field
                    });

                    $('#changeEstimationNo').on('click', function () {
                        $('#proj_estimation').prop('readonly', true); // Make estimation field read-only
                        $('#changeEstimationReasonField').hide(); // Hide the change estimation reason field
                    });


              
                 
                   
                      // Additional Hr js section
                        $('#showAdditionHr').click(function() {  // Load data when Additional Hours tab is clicked
                        loadAdditionalHours();
                    });

                    // Add row functionality
                    $(document).on('click', '.add-row', function() {
                        let table = $('#additionalHrsTable tbody');
                        let rowCount = table.find('tr').length;
                        let newRow = `
                            <tr>
                                <td>${rowCount + 1}</td>
                                <td><input type="date" class="form-control" name="additional_hrs[${rowCount}][date]" required></td>
                                <td><input type="text" class="form-control" name="additional_hrs[${rowCount}][description]" required></td>
                                <td><input type="number" step="0.01" class="form-control" name="additional_hrs[${rowCount}][hrs]" required></td>
                                <td><input type="text" class="form-control" name="additional_hrs[${rowCount}][comments]"></td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-success add-row">
                                        <i class="icofont-plus"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger remove-row">
                                        <i class="icofont-minus"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                        table.append(newRow);
                    });

                    // Remove row functionality
                    $(document).on('click', '.remove-row', function() {
                        if ($('#additionalHrsTable tbody tr').length > 1) {
                            $(this).closest('tr').remove();
                            reindexRows();
                        } else {
                            Swal.fire('Warning', 'You must keep at least one row', 'warning');
                        }
                    });

                    // Form submission
                    $('#additionalHrsForm').on('submit', function(e) {
                        e.preventDefault();
                        
                        // Add this to see what's being sent
                        console.log("Form data:", $(this).serialize());
                        
                        $.ajax({
                            url: "{{ route('admin.project.additional-hrs.store') }}",
                            method: "POST",
                            data: $(this).serialize(),
                            success: function(response) {
                                console.log("Success response:", response);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success!',
                                    text: response.message,
                                });
                                loadAdditionalHours();
                            },
                            error: function(xhr) {
                                console.log("Error response:", xhr.responseJSON);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error!',
                                    text: xhr.responseJSON.message || 'Something went wrong!',
                                });
                            }
                        });
                    });

                    function loadAdditionalHours() {
                        let projectId = "{{ $project->id }}";
                        $.ajax({
                            url: "{{ route('admin.project.additional-hrs.index', ':id') }}".replace(':id', projectId),
                            method: "GET",
                            success: function(response) {
                                let tableBody = $('#additionalHrsTable tbody');
                                tableBody.empty();
                                
                                if (response.length > 0) {
                                    response.forEach((item, index) => {
                                        let dateValue = item.date ? item.date : '';
                                        let row = `
                                            <tr>
                                                <td>${index + 1}</td>
                                                <td>
                                                    <input type="hidden" name="additional_hrs[${index}][id]" value="${item.id}">
                                                    <input type="date" class="form-control" name="additional_hrs[${index}][date]" value="${dateValue}" required>
                                                </td>
                                                <td><input type="text" class="form-control" name="additional_hrs[${index}][description]" value="${item.description}" required></td>
                                                <td><input type="number" step="0.01" class="form-control" name="additional_hrs[${index}][hrs]" value="${item.hrs}" required></td>
                                                <td><input type="text" class="form-control" name="additional_hrs[${index}][comments]" value="${item.comments || ''}"></td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-success add-row">
                                                        <i class="icofont-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-danger remove-row">
                                                        <i class="icofont-minus"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        `;
                                        tableBody.append(row);
                                    });
                                } else {
                                    tableBody.append(`
                                        <tr>
                                            <td>1</td>
                                            <td><input type="date" class="form-control" name="additional_hrs[0][date]" required></td>
                                            <td><input type="text" class="form-control" name="additional_hrs[0][description]" required></td>
                                            <td><input type="number" step="0.01" class="form-control" name="additional_hrs[0][hrs]" required></td>
                                            <td><input type="text" class="form-control" name="additional_hrs[0][comments]"></td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-success add-row">
                                                    <i class="icofont-plus"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    `);
                                }
                            },
                            error: function(xhr) {
                                console.error('Error loading additional hours:', xhr);
                            }
                        });
                    }

                    // Helper function to reindex rows
                    function reindexRows() {
                        $('#additionalHrsTable tbody tr').each(function(index) {
                            $(this).find('td:first').text(index + 1);
                            $(this).find('input').each(function() {
                                let name = $(this).attr('name').replace(/\[\d+\]/, '[' + index + ']');
                                $(this).attr('name', name);
                            });
                        });
                    }
                });

           
  
</script>
              

           
            
@endsection
