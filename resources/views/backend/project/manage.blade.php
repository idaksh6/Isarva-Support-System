@extends('backend.layouts.app')

@section('title', 'Manage Projetcs | Isarva Support')

@section('content')




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
                        <select class="form-control"  name="client" placeholder="Select Client Name" >
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
                            <select class="form-control"  name="manager" >
                                <option value="">Select Manager</option>
                                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                <option value="{{ $id }}" {{ old('manager') == $id ? 'selected' : '' }}>{{ $employeeName }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="proj-add-error-manager"></div>
                        </div>
                        <div class="col">
                            <label for="team_leader" class="form-label">Team Leader<span class="required">*</span></label>
                            <select class="form-select" name="team_leader" aria-label="Default select Priority">
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
                        <select class="form-control" name="client" id="proj_client">
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
                            <select class="form-control" name="manager" id="proj_manager">
                                <option value="">Select Manager</option>
                                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                    <option value="{{ $id }}">{{ $employeeName }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="proj-edit-error-manager"></div>
                        </div>
                        <div class="col">
                            <label for="team_leader" class="form-label">Team Leader<span class="required">*</span></label>
                            <select class="form-select" name="team_leader" id="proj_team_leader">
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


<!-- Modal  Delete Folder/ File-->
<div class="modal fade" id="deleteproject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="deleteprojectLabel"> Delete item Permanently?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center flex-column d-flex">
                <i class="icofont-ui-delete text-danger display-2 text-center mt-2"></i>
                <p class="mt-4 fs-5 text-center">You can only delete this item Permanently</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- Add a form for the delete action -->
                <form id="delete-project-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger color-fff">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>


    <div class="container-fluid">
            
        <div class="search-container mb-3">
            <div class="search-header">
                <span><i class="fa fa-search"></i> Search Project Filters</span>
            </div>
            <!-- Search Form -->
            <form action="{{ route('admin.project.manage') }}" method="GET">
                <!-- Basic Search Row -->
                <div class="row mb-3 mt-4">
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
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>




        <!-- Total Projects Card -->
        <div class=" mb-3 d-flex justify-content-between align-items-center">
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
            
            <!--  toggle buttons for table and card view -->
    
            <div class="view-toggle-container">
                <div class="toggle-switch">
                    <input type="radio" id="table-view" name="view-toggle" class="toggle-input" value="table" checked>
                    <label for="table-view" class="toggle-label">
                        <i class="icofont-table"></i>
                        <span>Table View</span>
                    </label>
            
                    <input type="radio" id="card-view" name="view-toggle" class="toggle-input" value="cards">
                    <label for="card-view" class="toggle-label">
                        <i class="icofont-card"></i>
                        <span>Card View</span>
                    </label>
                    
                    <span class="toggle-slider"></span>
                </div>
            </div>
        
        </div>

        <div id="tableView" class="{{ $viewType === 'table' ? '' : 'd-none' }}">
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
                                <th>Actions</th>
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
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                        <button type="button" class="btn btn-outline-secondary edit-project-btn" data-id="{{ $project->id }}" data-bs-toggle="modal" data-bs-target="#editproject">
                                            <i class="icofont-edit text-success"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary delete-project-btn" data-id="{{ $project->id }}" data-bs-toggle="modal" data-bs-target="#deleteproject">
                                            <i class="icofont-ui-delete text-danger"></i>
                                        </button>
                                    </div>
                                </td>
                                {{-- <td>{{ $project->project_name }}</td> --}}
                                <td>
                                    <a href="{{ route('admin.tasks.byProject', ['id' => $project->id]) }}" class="d-block text-decoration-none fw-bold text-primary">
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
                    {{-- <div class="d-flex justify-content-center mt-4">
                        {{ $projectsmanage->links() }}
                    </div> --}}
                    <!-- Pagination - Table View -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $projectsmanage->appends(['view' => 'table'])->links() }}
                    </div>

                
                @endif
            </div>
        </div>
        
        <div id="cardsView" class="{{ $viewType === 'cards' ? '' : 'd-none' }}">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 flex-column">
                    <div class="tab-content mt-4">
                        <div class="tab-pane fade show active" id="All-list">
                            <div class="row g-3 gy-5 py-3 row-deck">
                            
                                @foreach($projects as $project) 
                    
                            
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    
                                    <div class="card">
                                        {{-- <a href="{{ route('admin.tasks.byProject', ['id' => $project->id]) }}" class=" text-decoration-none"> --}}
                                        <div class="card-body">
                                                <div class="d-flex align-items-center justify-content-between mt-5">
                                                    <div class="lesson_name">
                                                        <div class="project-block light-orange-bg">
                                                            {{-- @if ($project->project_image)
                                                                <img 
                                                                    src="{{ asset('storage/' . $project->project_image) }}" 
                                                                    alt="Project Image" 
                                                                    class="project-image" 
                                                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                                                                >
                                                                <i class="icofont-dashboard-web fallback-icon" style="display: none;"></i>
                                                            @else
                                                                <i class="icofont-dashboard-web"></i>
                                                            @endif --}}
                                                            <i class="icofont-dashboard-web"></i>
                                                        </div>
                                                        {{-- <span class="small text-muted project_name fw-bold">{{ $project->project_name }}</span> --}}
                                                        <a href="{{ route('admin.tasks.byProject', ['id' => $project->id]) }}" class="d-block text-decoration-none">
                                                            <span class="small text-muted project_name fw-bold">{{ $project->project_name }}</span>
                                                        </a>
                                                        
                                                        <h6 class="mb-0 fw-bold fs-6 mb-2">{{ $project->category_name }}</h6>
                                                    </div>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <button type="button" class="btn btn-outline-secondary edit-project-btn" data-id="{{ $project->id }}" data-bs-toggle="modal" data-bs-target="#editproject">
                                                            <i class="icofont-edit text-success"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-outline-secondary delete-project-btn" data-id="{{ $project->id }}" data-bs-toggle="modal" data-bs-target="#deleteproject">
                                                            <i class="icofont-ui-delete text-danger"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            {{-- <div class="d-flex align-items-center">
                                                <div class="avatar-list avatar-list-stacked pt-2">
                                                    <img class="avatar rounded-circle sm" src="{{  url('/').'/images/xs/avatar2.jpg' }}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{  url('/').'/images/xs/avatar1.jpg' }}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{  url('/').'/images/xs/avatar3.jpg' }}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{  url('/').'/images/xs/avatar4.jpg' }}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{  url('/').'/images/xs/avatar8.jpg' }}" alt="">
                                                    <span class="avatar rounded-circle text-center pointer sm" data-bs-toggle="modal" data-bs-target="#addUser"><i class="icofont-ui-add"></i></span>
                                                </div>
                                            </div> --}}
                                            <div class="row g-2 pt-4">

                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-group-students "></i>
                                                        <span class="ms-2">{{ $project->team_members_count }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-sand-clock"></i>
                                                        <span class="ms-2">{{ $project->project_duration }}</span>
                                                    </div>
                                                </div>
                                            
                                                {{-- <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-ui-text-chat"></i>
                                                        <span class="ms-2">10</span>
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-paper-clip"></i>
                                                        <span class="ms-2">5 Attach</span>
                                                    </div>
                                                </div> --}}

                                            </div>
                                            <div class="dividers-block"></div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h4 class="small fw-bold mb-0">Progress</h4>
                                                <span class="small light-danger-bg  p-1 rounded"><i class="icofont-ui-clock"></i> {!! $project->days_left !!}</span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary ms-1" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary ms-1" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        {{-- </a> --}}
                                    </div>
                                    
                                </div>
                        
                            
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pagination - Card View -->
            <div class="d-flex justify-content-center mt-4">
                {{ $projectsmanage->appends(['view' => 'cards'])->links() }}
            </div>
        </div>
    </div>
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    {{-- <script src="{{ asset("js/jquery-3.6.0.min.js")}}"></script> --}}

    <script src="{{ asset('js/template.js') }}"></script>

   {{-- @section('scripts')
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


 @endsection --}}


 
     
    <script>
  

                $(document).ready(function() {     // JavaScript for Toggling Advanced Search
                // Toggle advanced search panels
                $('#toggleAdvancedSearch').click(function() {
                    $('#advancedSearchPanels').toggle();
                    $(this).html(function() {
                        return $('#advancedSearchPanels').is(':visible') 
                            ? ' Hide Advanced Search' 
                            : ' Advanced Search';
                    });
                });

                // To open and close the search box 
                $('#toggleAdvancedSearch').click(function() {
                    $('#advancedSearchPanels').toggleClass('show');
                    $(this).html($('#advancedSearchPanels').hasClass('show') ? 'Hide Advanced Search' : 'Advanced Search');
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
                // // View toggle functionality (jQuery version)
                // $('.view-toggle').on('click', function() {
                // $('.view-toggle').removeClass('active');
                // $(this).addClass('active');
                
                // var viewType = $(this).data('view');
                
                // // Toggle views
                // $('#tableView').toggleClass('d-none', viewType !== 'table');
                // $('#cardsView').toggleClass('d-none', viewType !== 'cards');
                
                // // Update URL with view type
                // var url = new URL(window.location);
                // url.searchParams.set('view', viewType);
                // window.history.pushState({}, '', url);
                // });

                    $(document).ready(function() {
                    $('.toggle-input').change(function() {
                        const viewType = $(this).val();     //  Gets the value ('table' or 'cards') from the clicked radio button
                        $('.toggle-label').removeClass('active');   //  Update Active State Styling
                        $(this).next('.toggle-label').addClass('active');
                        
                        $('#tableView').toggleClass('d-none', viewType !== 'table');  // Shows table view if viewType is 'table' (d-none removed) and hides table if view is not table
                        $('#cardsView').toggleClass('d-none', viewType !== 'cards');
                        
                        // Update URL
                        const url = new URL(window.location);  // Creates a URL object from current page URL
                        url.searchParams.set('view', viewType); // Sets/updates the 'view' parameter in the URL
                        window.history.pushState({}, '', url);  //  Updates browser history without reloading the page
                    });
                    
                    // Initialize based on current view
                    const urlParams = new URLSearchParams(window.location.search); //Gets all URL query parameters
                    const currentView = urlParams.get('view') || 'table'; // Checks for 'view' parameter, defaults to 'table' if not found
                    $(`#${currentView}-view`).prop('checked', true).trigger('change'); // Finds the corresponding radio button (#table-view or #cards-view) Sets it to checked
                });
           

            
                    // Project Section AJAX Add/Edit/Delete 
                    var editProjectRoute = "{{ route('admin.project.edit-project', ':id') }}"; // id is the placeholder for Project id which is replaced further
 
                    // Script to edit and update the Project values 
                   

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

                    // When the delete button is clicked
                    $('.delete-project-btn').on('click', function () {
                    var projectId = $(this).data('id'); // Get the client ID from the data attribute

                    // Set the form action dynamically
                    var deleteUrl = "{{ route('admin.project.destroy-project', ':id') }}"; 

                    deleteUrl = deleteUrl.replace(':id', projectId);   // Replace placeholder with actual ID

                    // Update the form action
                    $('#delete-project-form').attr('action', deleteUrl);
                    });

                    // Handle form submission
                    $('#delete-project-form').on('submit', function (e) {
                        e.preventDefault(); // Prevent the default form submission

                        var form = $(this);
                        var url = form.attr('action');

                        // Send the delete request via AJAX
                        $.ajax({
                            url: url,
                            method: 'POST', // Use POST method (Laravel handles DELETE via method spoofing)
                            data: form.serialize(), // Serialize the form data
                            success: function (response) {
                                if (response.success) {
                                    // Show a success message
                                    alert(response.message);

                                    // Optionally, reload the page or remove the deleted client from the list
                                    location.reload(); // Reload the page to reflect the changes
                                }
                            },
                            error: function (xhr) {
                                console.error('Error deleting project:', xhr.responseText);
                                alert('An error occurred while deleting the project.');
                            }
                        });
                    });



                    
                  //----- AJAX for Project Add Modal form---
              
                    // Handle form submission
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
                                alert('Project added successfully!'); // Show success message
                                $('#createproject').modal('hide');
                                window.location.href = "{{ route('admin.project.index') }}";
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

                     //----- AJAX for Project-edit form Modal -----

              
                    // Handle edit form submission
                    $('#editprojectform').on('submit', function (e) {
                        e.preventDefault(); // Prevent the default form submission

                        var form = $(this);
                        var url = form.attr('action');  // specifies the URL where the form data will be sent when the form is submitted. 
                        var formData = new FormData(form[0]); // Include file uploads

                        // Clear previous errors
                        $('.text-danger').html('');

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function (response) {
                                // If the form is successfully submitted, show a success message and close the modal
                                alert('Project updated successfully!'); // Show success message
                                $('#editproject').modal('hide'); // Close the modal
                                window.location.reload(); // Reload the page to reflect changes
                            },
                            error: function (xhr) {
                                // Log the error response to the console
                                console.log(xhr.responseJSON);

                                // If there are validation errors, display them below each field
                                var errors = xhr.responseJSON.errors;
                                if (errors) {
                                    $.each(errors, function (key, value) {
                                        $('#proj-edit-error-' + key).html(value[0]); // Display the first error message
                                    });
                                }
                            } 
                        });
                    });

                      // JS To handle the Yes/No button logic and make the estimation field editable when Yes is clicked.
                    $('#changeEstimationYes').on('click', function () {
                            $('#proj_estimation').prop('readonly', false); // Make estimation field editable
                            $('#changeEstimationReasonField').show(); // Show the change estimation reason field
                        });

                        // Handle "No" button click
                        $('#changeEstimationNo').on('click', function () {
                            $('#proj_estimation').prop('readonly', true); // Make estimation field read-only
                            $('#changeEstimationReasonField').hide(); // Hide the change estimation reason field
                        });
                    
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




            
    </script>
   
@endsection
