<!-- Modal Members-->
<?php
$date = \Carbon\Carbon::now();
?>

<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="addUserLabel">Employee Invitation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="inviteby_email">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email address"  aria-describedby="exampleInputEmail1">
                        <button class="btn btn-dark" type="button" id="button-addon2">Sent</button>
                    </div>
                </div>
                <div class="members_list">
                    <h6 class="fw-bold ">Employee </h6>
                    <ul class="list-unstyled list-group list-group-custom list-group-flush mb-0">
                        <li class="list-group-item py-3 text-center text-md-start">
                            <div class="d-flex align-items-center flex-column flex-sm-column flex-md-row">
                                <div class="no-thumbnail mb-2 mb-md-0">
                                    <img class="avatar lg rounded-circle" src="{{ url('/').'/images/xs/avatar2.jpg' }}" alt="">
                                </div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <h6 class="mb-0  fw-bold">Rachel Carr(you)</h6>
                                    <span class="text-muted">rachel.carr@gmail.com</span>
                                </div>
                                <div class="members-action">
                                    <span class="members-role ">Admin</span>
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="icofont-ui-settings  fs-6"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item py-3 text-center text-md-start">
                            <div class="d-flex align-items-center flex-column flex-sm-column flex-md-row">
                                <div class="no-thumbnail mb-2 mb-md-0">
                                    <img class="avatar lg rounded-circle" src="{{ url('/').'/images/xs/avatar3.jpg' }}" alt="">
                                </div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <h6 class="mb-0  fw-bold">Lucas Baker<a href="#" class="link-secondary ms-2">(Resend invitation)</a></h6>
                                    <span class="text-muted">lucas.baker@gmail.com</span>
                                </div>
                                <div class="members-action">
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Members
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="icofont-check-circled"></i>

                                                    <span>All operations permission</span>
                                                </a>

                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fs-6 p-2 me-1"></i>
                                                    <span>Only Invite & manage team</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="icofont-ui-settings  fs-6"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Delete Member</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item py-3 text-center text-md-start">
                            <div class="d-flex align-items-center flex-column flex-sm-column flex-md-row">
                                <div class="no-thumbnail mb-2 mb-md-0">
                                    <img class="avatar lg rounded-circle" src="{{ url('/').'/images/xs/avatar8.jpg' }}" alt="">
                                </div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <h6 class="mb-0  fw-bold">Una Coleman</h6>
                                    <span class="text-muted">una.coleman@gmail.com</span>
                                </div>
                                <div class="members-action">
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Members
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="icofont-check-circled"></i>

                                                    <span>All operations permission</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fs-6 p-2 me-1"></i>
                                                    <span>Only Invite & manage team</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <div class="btn-group">
                                            <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="icofont-ui-settings  fs-6"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Suspend member</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="icofont-not-allowed fs-6 me-2"></i>Delete Member</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Members-->
<div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="addUserLabel">Employee Invitation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="inviteby_email">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email address"  aria-describedby="exampleInputEmail1">
                        <button class="btn btn-dark" type="button" id="button-addon2">Sent</button>
                    </div>
                </div>
                <div class="members_list">
                    <h6 class="fw-bold ">Employee </h6>
                    <ul class="list-unstyled list-group list-group-custom list-group-flush mb-0">
                        <li class="list-group-item py-3 text-center text-md-start">
                            <div class="d-flex align-items-center flex-column flex-sm-column flex-md-row">
                                <div class="no-thumbnail mb-2 mb-md-0">
                                    <img class="avatar lg rounded-circle" src="{{ url('/').'/images/xs/avatar2.jpg' }}" alt="">
                                </div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <h6 class="mb-0  fw-bold">Rachel Carr(you)</h6>
                                    <span class="text-muted">rachel.carr@gmail.com</span>
                                </div>
                                <div class="members-action">
                                    <span class="members-role ">Admin</span>
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="icofont-ui-settings  fs-6"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item py-3 text-center text-md-start">
                            <div class="d-flex align-items-center flex-column flex-sm-column flex-md-row">
                                <div class="no-thumbnail mb-2 mb-md-0">
                                    <img class="avatar lg rounded-circle" src="{{ url('/').'/images/xs/avatar3.jpg' }}" alt="">
                                </div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <h6 class="mb-0  fw-bold">Lucas Baker<a href="#" class="link-secondary ms-2">(Resend invitation)</a></h6>
                                    <span class="text-muted">lucas.baker@gmail.com</span>
                                </div>
                                <div class="members-action">
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Members
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="icofont-check-circled"></i>

                                                    <span>All operations permission</span>
                                                </a>

                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fs-6 p-2 me-1"></i>
                                                    <span>Only Invite & manage team</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="icofont-ui-settings  fs-6"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Delete Member</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item py-3 text-center text-md-start">
                            <div class="d-flex align-items-center flex-column flex-sm-column flex-md-row">
                                <div class="no-thumbnail mb-2 mb-md-0">
                                    <img class="avatar lg rounded-circle" src="{{ url('/').'/images/xs/avatar8.jpg' }}" alt="">
                                </div>
                                <div class="flex-fill ms-3 text-truncate">
                                    <h6 class="mb-0  fw-bold">Una Coleman</h6>
                                    <span class="text-muted">una.coleman@gmail.com</span>
                                </div>
                                <div class="members-action">
                                    <div class="btn-group">
                                        <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Members
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="icofont-check-circled"></i>

                                                    <span>All operations permission</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="fs-6 p-2 me-1"></i>
                                                    <span>Only Invite & manage team</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <div class="btn-group">
                                            <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="icofont-ui-settings  fs-6"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li><a class="dropdown-item" href="#"><i class="icofont-ui-password fs-6 me-2"></i>ResetPassword</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="icofont-chart-line fs-6 me-2"></i>ActivityReport</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Suspend member</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="icofont-not-allowed fs-6 me-2"></i>Delete Member</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Project-->
{{-- <div class="modal fade" id="createproject" tabindex="-1" aria-hidden="true">
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
</div> --}}
{{-- 
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
                    </div> --}}

                    <!-- Project Image -->
                    {{-- <div class="mb-3">
                        <label for="project_image" class="form-label">Project Image</label>
                        <input class="form-control" type="file" name="project_image" id="project_image">
                        <div class="text-danger" id="proj-edit-error-project_image"></div>
                    </div> --}}

                    <!-- Manager and Team Leader Dropdowns -->

                    {{-- <div class="row g-3 mb-3">
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
</div> --}}

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
                        <select class="form-select" name="task_category" aria-label="Default select Project Category">
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
                        <textarea class="form-control" name="task_description" value="{{ old('task_description') }}" rows="3" placeholder="Enter the details about project"></textarea>
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
                        <select class="form-select" name="task_assigned_for">
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
                        <select class="form-select" name="task_category" id="edit_task_category">
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
                            <select class="form-select" name="task_assigned_for" id="edit_task_assigned_for">
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


<!-- Modal  Remove Task-->
<div class="modal fade" id="dremovetask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="dremovetaskLabel"> Remove From Task?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center flex-column d-flex">
                <i class="icofont-ui-rate-remove text-danger display-2 text-center mt-2"></i>
                <p class="mt-4 fs-5 text-center">You can Remove only From Task</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger color-fff">Remove</button>
            </div>
        </div>
    </div>
</div>

<!-- Send sheet-->
<div class="modal fade" id="sendsheet" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="sendsheetLabel"> Sheets Sent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label  class="form-label">Email address</label>
                    <input type="email" class="form-control"  placeholder="name@example.com">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                <button type="submit" class="btn btn-primary">sent</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Tickit-->
{{-- <div class="modal fade" id="tickadd" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Tickit Add</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="sub" class="form-label">Subject</label>
                <input type="text" class="form-control" id="sub">
            </div>
            <div class="deadline-form">
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col">
                        <label  class="form-label">Assign Name</label>
                        <input type="text" class="form-control" >
                        </div>
                        <div class="col">
                        <label  class="form-label">Creted Date</label>
                        <input type="date" class="form-control" >
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-3">
                <label  class="form-label">Status</label>
                <select class="form-select">
                    <option selected>In Progress</option>
                    <option value="1">Completed</option>
                    <option value="2">Wating</option>
                    <option value="3">Decline</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="submit" class="btn btn-primary">sent</button>
        </div>
    </div>
    </div>
</div>

<!-- Edit Tickit-->
<div class="modal fade" id="edittickit" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="edittickitLabel"> Tickit Edit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="sub1" class="form-label">Subject</label>
                <input type="text" class="form-control" id="sub1" value="punching time not proper">
            </div>
            <div class="deadline-form">
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col">
                        <label for="depone11" class="form-label">Assign Name</label>
                        <input type="text" class="form-control" id="depone11" value="Victor Rampling">
                        </div>
                        <div class="col">
                        <label for="deptwo56" class="form-label">Creted Date</label>
                        <input type="date" class="form-control" id="deptwo56" value="2021-02-25">
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-3">
                <label  class="form-label">Status</label>
                <select class="form-select">
                    <option selected>Completed</option>
                    <option value="1">In Progress</option>
                    <option value="2">Wating</option>
                    <option value="3">Decline</option>
                </select>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="submit" class="btn btn-primary">sent</button>
        </div>
    </div>
    </div>
</div> --}}

<!-- Create Client-->
<div class="modal fade" id="createclient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createclientform" action="{{ route('admin.our-client.store-client') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Client Name<span class="required">*</span></label>
                        <input type="text" class="form-control" name="client_name" placeholder="Enter the Client Name" >
                        <div class="text-danger" id="clientadd_error-client_name"></div> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Name<span class="required">*</span></label>
                        <input type="text" class="form-control" name="company_name" placeholder="Enter Client Company" >
                        <div class="text-danger" id="clientadd_error-company_name"></div> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Client Designation in Company</label>
                        <input type="text" class="form-control" name="client_pos_in_comp" placeholder="Enter the client's designation in the company (e.g., CEO, Manager)">
                        <div class="text-danger" id="clientadd_error-client_pos_in_comp"></div> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile Image</label>
                        <input class="form-control" type="file" name="profile_image">
                        <div class="text-danger" id="clientadd_error-profile_image"></div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label">User Name</label>
                            <input type="text" class="form-control" name="username" placeholder="User Name" >
                            <div class="text-danger" id="clientadd_error-username"></div>
                        </div>
                        <div class="col">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" >
                            <div class="text-danger" id="clientadd_error-password"></div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label">Email ID</label>
                            <input type="email" class="form-control" name="email" placeholder="Email ID" >
                            <div class="text-danger" id="clientadd_error-email"></div>
                        </div>
                        <div class="col">
                            <label class="form-label">Phone<span class="required">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone Number" >
                            <div class="text-danger" id="clientadd_error-phone"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description (optional)</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Add any extra details about the client"></textarea>
                        
                    </div> 
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Client-->
@if (session()->has('flash_success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
        <i class="bi bi-check-circle-fill me-2 text-success"></i> 
        <span>{{ session('flash_success') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="modal fade" id="editclient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="createprojectlLabelone">Edit Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-client-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Client Name</label>
                        <input type="text" class="form-control" id="client_name" name="client_name">
                        <div class="text-danger" id="client-edit-error-client_name"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Client Designation in Company</label>
                        <input type="text" class="form-control" id="client_pos_in_comp" name="client_pos_in_comp" placeholder="Enter the client's designation in the company (e.g., CEO, Manager)">
                        <div class="text-danger" id="client-edit-error-client_pos_in_comp"></div>
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name">
                        <div class="text-danger" id="client-edit-error-company_name"></div>
                    </div>
                    <div class="deadline-form">
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="username" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="username" name="username">
                                <div class="text-danger" id="client-edit-error-username"></div>
                            </div>
                            <div class="col">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password">
                            
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="email" class="form-label">Email ID</label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div class="text-danger" id="client-edit-error-email"></div>
                            </div>
                            <div class="col">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                                <div class="text-danger" id="client-edit-error-phone"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (optional)</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                        <!-- Display existing profile image -->
                        <div id="current-profile-image" class="mt-2">
                            <img src="" alt="Profile Image" class="img-thumbnail" width="100" style="display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Delete Confirmation -->
<div class="modal fade" id="deleteclient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="deleteprojectLabel">Delete Item Permanently?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center flex-column d-flex">
                <i class="icofont-ui-delete text-danger display-2 text-center mt-2"></i>
                <p class="mt-4 fs-5 text-center">You can only delete this item permanently.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- Add a form for the delete action -->
                <form id="delete-client-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger color-fff">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Create Employee-->
<div class="modal fade" id="createemp" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Open"></button>
            </div>
            <div class="modal-body">
                <form id="createEmployeeForm" action="{{ route('admin.our-employee.store-employee') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Employee Name -->
                    <div class="mb-3">
                        <label class="form-label">Employee Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="name" placeholder="Enter the New Employee name" value="{{ old('name') }}" >
                        <div class="text-danger" id="error-name"></div> <!-- Error container for "name" -->
                    </div>

                    <!-- Employee Profile Image -->
                    <div class="mb-3">
                        <label for="formFileMultipleoneone" class="form-label">Employee Profile</label>
                        <input class="form-control" type="file" name="profile_image" id="formFileMultipleoneone">
                        <div class="text-danger" id="error-profile_image"></div> <!-- Error container for "profile_image" -->
                    </div>

                    <!-- Employee ID and Joining Date -->
                    <div class="deadline-form">
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label for="exampleFormControlInput1778" class="form-label">Employee ID</label>
                                <input type="text" class="form-control" name="employee_id" id="exampleFormControlInput1778" value="{{ old('employee_id') }}" placeholder="Enter Employee Id">
                                <div class="text-danger" id="error-employee_id"></div> <!-- Error container for "employee_id" -->
                            </div>
                            <div class="col-sm-6">
                                <label for="exampleFormControlInput2778" class="form-label">Joining Date<span class="required">*</span></label>
                                <input type="date" class="form-control" name="joining_date" id="exampleFormControlInput2778" value="{{ old('joining_date') }}">
                                <div class="text-danger" id="error-joining_date"></div> <!-- Error container for "joining_date" -->
                            </div>
                        </div>

                        <!-- User Name and Password -->
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="exampleFormControlInput177" class="form-label">User Name</label>
                                <input type="text" class="form-control" name="user_name" id="exampleFormControlInput177" value="{{ old('user_name') }}" placeholder="User Name" autocomplete="off">
                                <div class="text-danger" id="error-user_name"></div> <!-- Error container for "user_name" -->
                            </div>
                            <div class="col">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" autocomplete="new-password">
                                <div class="text-danger" id="error-password"></div> <!-- Error container for "password" -->
                            </div>
                        </div>

                        <!-- Email ID and Phone -->
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label class="form-label">Email ID</label>
                                <input type="email" class="form-control" name="email_id" value="{{ old('email_id') }}" placeholder="User Name">
                                <div class="text-danger" id="error-email_id"></div> <!-- Error container for "email_id" -->
                            </div>
                            <div class="col">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="">
                                <div class="text-danger" id="error-phone"></div> <!-- Error container for "phone" -->
                            </div>
                        </div>

                        <!-- Webhook URL and Status -->
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6">
                                <label class="form-label">Webhook URL</label>
                                <input type="text" class="form-control" name="webhook_url" value="{{ old('webhook_url') }}" placeholder="">
                                <div class="text-danger" id="error-webhook_url"></div> <!-- Error container for "webhook_url" -->
                            </div>
                            <div class="col">
                                <label class="form-label">Status<span class="required">*</span></label>
                                <select class="form-select" name="status" aria-label="Default select status Category">
                                    <option value="" selected>None</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="2" {{ old('status') == 2 ? 'selected' : '' }}>Blocked</option>
                                </select>
                                <div class="text-danger" id="error-status"></div> <!-- Error container for "status" -->
                            </div>
                        </div>

                        <!-- Department and Designation -->
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label class="form-label">Department<span class="required">*</span></label>
                                <select class="form-select" name="department" aria-label="Default select Project Category">
                                    <option value="" selected>None</option>
                                    <option value="1" {{ old('department') == 1 ? 'selected' : '' }}>Front-end</option>
                                    <option value="2" {{ old('department') == 2 ? 'selected' : '' }}>Back-end</option>
                                    <option value="3" {{ old('department') == 3 ? 'selected' : '' }}>Internship</option>
                                    <option value="4" {{ old('department') == 4 ? 'selected' : '' }}>It Management</option>
                                    <option value="5" {{ old('department') == 5 ? 'selected' : '' }}>Marketing</option>
                                </select>
                                <div class="text-danger" id="error-department"></div> <!-- Error container for "department" -->
                            </div>
                            <div class="col">
                                <label class="form-label">Designation<span class="required">*</span></label>
                                <select class="form-select" name="designation" aria-label="Default select Project Category">
                                    <option value="" selected>None</option>
                                    <option value="1" {{ old('designation') == 1 ? 'selected' : '' }}>Website Design</option>
                                    <option value="2" {{ old('designation') == 2 ? 'selected' : '' }}>App Development</option>
                                    <option value="3" {{ old('designation') == 3 ? 'selected' : '' }}>UI/UX Design</option>
                                    <option value="4" {{ old('designation') == 4 ? 'selected' : '' }}>HR Manager</option>
                                    <option value="5" {{ old('designation') == 5 ? 'selected' : '' }}>Backend Development</option>
                                    <option value="6" {{ old('designation') == 6 ? 'selected' : '' }}>Software Testing</option>
                                    <option value="7" {{ old('designation') == 7 ? 'selected' : '' }}>Marketing</option>
                                    <option value="8" {{ old('designation') == 8 ? 'selected' : '' }}>Quality Assurance</option>
                                    <option value="9" {{ old('designation') == 9 ? 'selected' : '' }}>Other</option>
                                </select>
                                <div class="text-danger" id="error-designation"></div> <!-- Error container for "designation" -->
                            </div>
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label class="form-label">Role<span class="required">*</span></label>
                            <select class="form-select" name="role" aria-label="Default select Role Category">
                                <option value="" selected>None</option>
                                <option value="1" {{ old('role') == 1 ? 'selected' : '' }}>Admin</option>
                                <option value="2" {{ old('role') == 2 ? 'selected' : '' }}>Staff</option>
                                <option value="3" {{ old('role') == 3 ? 'selected' : '' }}>Supervisor</option>
                                <option value="4" {{ old('role') == 4 ? 'selected' : '' }}>Client</option>
                            </select>
                            <div class="text-danger" id="error-role"></div> <!-- Error container for "role" -->
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" name="address" placeholder="">{{ old('address') }}</textarea>
                            <div class="text-danger" id="error-address"></div> <!-- Error container for "address" -->
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea78" class="form-label">Description (optional)</label>
                            <textarea class="form-control" id="exampleFormControlTextarea78" name="description" rows="3" placeholder="Add any extra details about the request">{{ old('description') }}</textarea>
                            <div class="text-danger" id="error-description"></div> <!-- Error container for "description" -->
                        </div>
                    </div>

                    <!-- Form Buttons -->
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                        <button type="submit" class="btn btn-primary">Save Employee</button>
                    </div>
                </form>
            </div>      
        </div>  
    </div>
</div>


<!-- Edit Employee Modal -->
<div class="modal fade" id="editemployee" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-employee-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Employee Name -->
                    <div class="mb-3">
                        <label class="form-label">Employee Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter the Project Name">
                        <div class="text-danger" id="edit-error-name"></div> <!-- Error container for "name" -->
                    </div>

                    <!-- Employee ID and Joining Date -->
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="employee_id" class="form-label">Employee ID</label>
                            <input type="text" class="form-control" name="employee_id" id="employee_id" placeholder="Enter Employee Id">
                            <div class="text-danger" id="edit-error-employee_id"></div> <!-- Error container for "employee_id" -->
                        </div>
                        <div class="col-sm-6">
                            <label for="joining_date" class="form-label">Joining Date</label>
                            <input type="date" class="form-control" name="joining_date" id="joining_date">
                            <div class="text-danger" id="edit-error-joining_date"></div> <!-- Error container for "joining_date" -->
                        </div>
                    </div>

                    <!-- User Name and Password -->
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="user_name" class="form-label">User Name</label>
                            <input type="text" class="form-control" name="user_name" id="user_name" placeholder="User Name" autocomplete="off">
                            <div class="text-danger" id="edit-error-user_name"></div> <!-- Error container for "user_name" -->
                        </div>
                        <div class="col">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="emp_password" placeholder="Password" autocomplete="new-password">
                            <div class="text-danger" id="edit-error-password"></div> <!-- Error container for "password" -->
                        </div>
                    </div>

                    <!-- Email ID and Phone -->
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label">Email ID</label>
                            <input type="email" class="form-control" name="email_id" id="email_id" placeholder="User Name">
                            <div class="text-danger" id="edit-error-email_id"></div> <!-- Error container for "email_id" -->
                        </div>
                        <div class="col">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone_no" placeholder="">
                            <div class="text-danger" id="edit-error-phone"></div> <!-- Error container for "phone" -->
                        </div>
                    </div>

                    <!-- Webhook URL and Status -->
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label class="form-label">Webhook URL</label>
                            <input type="text" class="form-control" name="webhook_url" id="webhook_url" placeholder="">
                            <div class="text-danger" id="edit-error-webhook_url"></div> <!-- Error container for "webhook_url" -->
                        </div>
                        <div class="col">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" aria-label="Default select status Category">
                                <option value="1">Active</option>
                                <option value="2">Blocked</option>
                            </select>
                            <div class="text-danger" id="edit-error-status"></div> <!-- Error container for "status" -->
                        </div>
                    </div>

                    <!-- Department and Designation -->
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label">Department</label>
                            <select class="form-select" name="department" id="department" aria-label="Default select Project Category">
                                <option value="1">Front-end</option>
                                <option value="2">Back-end</option>
                                <option value="3">Internship</option>
                                <option value="4">It Management</option>
                                <option value="5">Marketing</option>
                            </select>
                            <div class="text-danger" id="edit-error-department"></div> <!-- Error container for "department" -->
                        </div>
                        <div class="col">
                            <label class="form-label">Designation</label>
                            <select class="form-select" name="designation" id="designation" aria-label="Default select Project Category">
                                <option value="1">Website Design</option>
                                <option value="2">App Development</option>
                                <option value="3">UI/UX Design</option>
                                <option value="4">Development</option>
                                <option value="5">Backend Development</option>
                                <option value="6">Software Testing</option>
                                <option value="7">Marketing</option>
                                <option value="8">SEO</option>
                                <option value="9">Other</option>
                            </select>
                            <div class="text-danger" id="edit-error-designation"></div> <!-- Error container for "designation" -->
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select class="form-select" name="role" id="role" aria-label="Default select Role Category">
                            <option value="1">Admin</option>
                            <option value="2">Staff</option>
                            <option value="3">Supervisor</option>
                            <option value="4">Client</option>
                        </select>
                        <div class="text-danger" id="edit-error-role"></div> <!-- Error container for "role" -->
                    </div>

                    <!-- Address -->
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <textarea class="form-control" name="address" id="emp_address" placeholder=""></textarea>
                        <div class="text-danger" id="edit-error-address"></div> <!-- Error container for "address" -->
                    </div>

                    <!-- Description -->
                    <div class="mb-3">          
                        <label for="description" class="form-label">Description (optional)</label>
                        <textarea class="form-control" id="emp_description" name="description" rows="3" placeholder="Add any extra details about the request"></textarea>
                    </div>

                    <!-- Profile Image -->
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="emp_profile_image" name="profile_image">
                        <div class="text-danger" id="edit-error-profile_image"></div> <!-- Error container for "profile_image" -->
                        <!-- Display existing profile image -->
                        <div id="emp_current-profile-image" class="mt-2">
                            <img src="" alt="Profile Image" class="img-thumbnail" width="100" style="display: none;">
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Delete Confirmation of Employee-->
<div class="modal fade" id="deleteemployee" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="deleteprojectLabel">Delete Item Permanently?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center flex-column d-flex">
                <i class="icofont-ui-delete text-danger display-2 text-center mt-2"></i>
                <p class="mt-4 fs-5 text-center">You can only delete this item permanently.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- Add a form for the delete action -->
                <form id="delete-employee-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger color-fff">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Holiday-->
<div class="modal fade" id="addholiday" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="addholidayLabel"> Add Holidays</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label  class="form-label">Holiday Name</label>
                <input type="email" class="form-control"  placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput2778" class="form-label">Holiday Date</label>
                <input type="date" class="form-control" id="exampleFormControlInput2778">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </div>
    </div>
</div>

<!-- Edit Holiday-->
<div class="modal fade" id="editholiday" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="editholidayLabel">Edit Holidays</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInputname" class="form-label">Holiday Name</label>
                <input type="email" class="form-control" id="exampleFormControlInputname" value="Republic Day">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput0243" class="form-label">Holiday Date</label>
                <input type="date" class="form-control" id="exampleFormControlInput0243" value="2021-01-26">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </div>
</div>

<!-- Edit Attendance-->
<div class="modal fade" id="editattendance" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="editattendanceLabel"> Edit Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Select Person</label>
                    <select class="form-select" id="person">
                        <option selected value="0" >Joan Dyer</option>
                        <option value="1">Ryan Randall</option>
                        <option value="2">Phil Glover</option>
                        <option value="3">Victor Rampling</option>
                        <option value="4">Sally Graham</option>
                        <option value="5">Robert Anderson</option>
                        <option value="6">Ryan Stewart</option>
                    </select>
                </div>
                <div class="deadline-form">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12">
                            <label for="datepickerdedass" class="form-label">Select Date</label>
                            <input type="input" value="{{'31-'.$date->subMonth()->format('m').'-'.date('Y')}}" class="form-control" id="datepickerdedass">
                            </div>
                            <div class="col-sm-12">
                                <label class="form-label">Attendance Type</label>
                                <select class="form-select" id="present">
                                    <option value="0" selected>Full Day Present</option>
                                    <option value="1">Half Day Present</option>
                                    <option value="2">Full Day Absence</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea78d" class="form-label">Edit Reason</label>
                    <textarea class="form-control" id="exampleFormControlTextarea78d" rows="3"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                <button type="submit" onclick="addAttendance($('#person').find(':selected').val(), $('#present').find(':selected').val())" class="btn btn-primary">Save</button>
            </div>
        </div>
        </div>
</div>

<!-- Leave Add-->
<div class="modal fade" id="leaveadd" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="leaveaddLabel"> Leave Add</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label">Select Leave type</label>
                <select class="form-select">
                    <option selected>Medical Leave</option>
                    <option value="1">Casual Leave</option>
                    <option value="2">Maternity Leave</option>
                </select>
            </div>
            <div class="deadline-form">
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                        <label class="form-label">Leave From Date</label>
                        <input type="date" class="form-control">
                        </div>
                        <div class="col-sm-6">
                        <label for="datepickerdedoneddsd" class="form-label">Leave to Date</label>
                        <input type="date" class="form-control" id="datepickerdedoneddsd">
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea78d" class="form-label">Leave Reason</label>
                <textarea class="form-control" id="exampleFormControlTextarea78d" rows="3"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="submit" class="btn btn-primary">sent</button>
        </div>
    </div>
    </div>
</div>

    <!-- Leave Approve-->
<div class="modal fade" id="leaveapprove" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="dremovetaskLabel"> Leave Approve</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body justify-content-center flex-column d-flex">
            <i class="icofont-simple-smile text-success display-2 text-center mt-2"></i>
            <p class="mt-4 fs-5 text-center">Leave Approve Successfully</p>
        </div>
    </div>
    </div>
</div> 

    <!-- Leave Reject-->
<div class="modal fade" id="leavereject" tabindex="-1"  aria-hidden="true"> 
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="leaverejectLabel"> Leave Reject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center flex-column d-flex">
                <i class="icofont-sad text-danger display-2 text-center mt-2"></i>
                <p class="mt-4 fs-5 text-center">Leave Reject</p>
            </div>
        </div>
    </div>
</div>

<!-- Add Department-->
<div class="modal fade" id="depadd" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="depaddLabel"> Department Add</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput1111" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput1111">
            </div>
            <div class="deadline-form">
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                        <label  class="form-label">Department Head</label>
                        <input type="text" class="form-control" >
                        </div>
                        <div class="col-sm-6">
                        <label  class="form-label">Employee UnderWork</label>
                        <input type="text" class="form-control" >
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </div>
    </div>
</div>

<!-- Edit Department-->
<div class="modal fade" id="depedit" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="depeditLabel"> Department Edit</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput11111" class="form-label">Department Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput11111" value="Web Development"> 
            </div>
            <div class="deadline-form">
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                        <label class="form-label">Department Head</label>
                        <select class="form-select">
                            <option selected>Joan Dyer</option>
                            <option value="1">Ryan Randall</option>
                            <option value="2">Phil Glover</option>
                            <option value="3">Victor Rampling</option>
                            <option value="4">Sally Graham</option>
                        </select>
                        </div>
                        <div class="col-sm-6">
                        <label for="deptwo48" class="form-label">Employee UnderWork</label>
                        <input type="text" class="form-control" id="deptwo48" value="40">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </div>
</div> 

<!-- Add Expence-->
<div class="modal fade" id="expadd" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="expaddLabel"> Add Expenses</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="item" class="form-label">Item</label>
                <input type="text" class="form-control" id="item">
            </div>
            <div class="deadline-form">
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                        <label  class="form-label">Order By</label>
                        <input type="text" class="form-control" >
                        </div>
                        <div class="col-sm-6">
                        <label for="abc" class="form-label">Date</label>
                        <input type="date" class="form-control" id="abc">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label  class="form-label">From</label>
                            <input type="text" class="form-control" >
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option selected>In Progress</option>
                                <option value="1">Completed</option>
                                <option value="2">Wating</option>
                                <option value="3">Decline</option>
                            </select>
                        </div>
                        </div>
                </form>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Add</button>
        </div>
    </div>
    </div>
</div>

<!-- Edit Expence-->
<div class="modal fade" id="expedit" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="expeditLabel"> Edit Expenses</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="item1" class="form-label">Item</label>
                <input type="text" class="form-control" id="item1" value="Internet Payment"> 
            </div>
            <div class="deadline-form">
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                        <label  class="form-label">Order By</label>
                        <select class="form-select">
                            <option selected>Joan Dyer</option>
                            <option value="1">Ryan Randall</option>
                            <option value="2">Phil Glover</option>
                            <option value="3">Victor Rampling</option>
                            <option value="4">Sally Graham</option>
                        </select>
                        </div>
                        <div class="col-sm-6">
                        <label for="abc1" class="form-label">Date</label>
                        <input type="date" class="form-control" id="abc1" value="2021-03-12">
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="deptwo1" class="form-label">From</label>
                            <input type="text" class="form-control" id="deptwo1" value="Airtel Portal">
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Status</label>
                            <select class="form-select">
                                <option selected>In Progress</option>
                                <option value="1">Completed</option>
                                <option value="2">Wating</option>
                                <option value="3">Decline</option>
                            </select>
                        </div>
                        </div>
                </form>
            </div>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </div>
    </div>
</div>

<!-- Add Event-->
<div class="modal fade" id="addevent" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title  fw-bold" id="eventaddLabel">Add Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label for="exampleFormControlInput99" class="form-label">Event Name</label>
                <input type="text" class="form-control" id="exampleFormControlInput99">
            </div>
            <div class="mb-3">
                <label for="formFileMultipleone" class="form-label">Event Images</label>
                <input class="form-control" type="file" id="formFileMultipleone">
            </div>
            <div class="deadline-form">
                <form>
                    <div class="row g-3 mb-3">
                        <div class="col">
                        <label  class="form-label">Event Start Date</label>
                        <input type="date" class="form-control" >
                        </div>
                        <div class="col">
                        <label  class="form-label">Event End Date</label>
                        <input type="date" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea78" class="form-label">Event Description (optional)</label>
                <textarea class="form-control" id="exampleFormControlTextarea78" rows="3" placeholder="Add any extra details about the request"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            <button type="button" class="btn btn-primary">Create</button>
        </div>
    </div>
    </div>
</div>

<!-- Edit Employee Personal Info-->
<div class="modal fade" id="edit1" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="edit1Label"> Personal Informations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="deadline-form">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label  class="form-label">Nationality</label>
                                <input type="text" class="form-control"  value="Indian"> 
                            </div>
                            <div class="col">
                                <label  class="form-label">Religion</label>
                                <input type="text" class="form-control"  value="Hindu"> 
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                        <div class="col">
                            <label  class="form-label">Marital Status</label>
                            <input type="text" class="form-control"  value="Married">
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput2770" class="form-label">Passport No</label>
                            <input type="text" class="form-control" id="exampleFormControlInput2770" value="5468953210">
                        </div>
                        </div> 
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label  class="form-label">Emergency Contact</label>
                                <input type="text" class="form-control"  value="7468953210">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                <button type="button" class="btn btn-primary">Create</button>
            </div> 
        </div>  
    </div>
</div>

<!-- Edit Bank Personal Info-->
<div class="modal fade" id="edit2" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="edit2Label"> Bank information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="deadline-form">
                    <form>
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="exampleFormControlInput8775" class="form-label">Bank Name</label>
                                <input type="text" class="form-control" id="exampleFormControlInput8775" value="Kotak"> 
                            </div>
                            <div class="col">
                                <label  class="form-label">Account No.</label>
                                <input type="text" class="form-control" id="exampleFormControlInput9775" value="5436874596325486"> 
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                        <div class="col">
                            <label for="exampleFormControlInput97775" class="form-label">IFSC Code</label>
                            <input type="text" class="form-control" id="exampleFormControlInput97775" value="Kotak000021">
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput27705" class="form-label">Pan No</label>
                            <input type="text" class="form-control" id="exampleFormControlInput27705" value="ACQPF6584L">
                        </div>
                        </div> 
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label for="exampleFormControlInput47775" class="form-label">UPI Id</label>
                                <input type="text" class="form-control" id="exampleFormControlInput47775" value="454812kotak@upi">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                <button type="button" class="btn btn-primary">Create</button>
            </div> 
        </div>  
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

            // Client form validation code
             $(document).ready(function () {
                // Handle form submission
                $('#createclientform').on('submit', function (e) {
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
                            // alert('Employee added successfully!'); // Show success message
                            $('#createemp').modal('hide');
                            window.location.href = "{{ route('admin.our-employee.members') }}";
                        },
                        error: function (xhr) {
                            // If there are validation errors, display them below each field
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                $('#clientadd_error-' + key).html(value[0]); // Display the first error message
                            });
                        }
                    });
                });
            });

      //----- AJAX for Client-edit form Modal validation -----

    $(document).ready(function () {
        // Handle edit form submission
        $('#edit-client-form').on('submit', function (e) {
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
                    alert('Client updated successfully!'); // Show success message
                    $('#editclient').modal('hide'); // Close the modal
                    window.location.reload(); // Reload the page to reflect changes
                },
                error: function (xhr) {
                    // Log the error response to the console
                    console.log(xhr.responseJSON);

                    // If there are validation errors, display them below each field
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function (key, value) {
                            $('#client-edit-error-' + key).html(value[0]); // Display the first error message
                        });
                    }
                } 
            });
        });
    });

    // Employee Add Modal pop-up hidden function
    $(document).ready(function () {
        // Handle form submission
        $('#createEmployeeForm').on('submit', function (e) {
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
                    alert('Employee added successfully!'); // Show success message
                    $('#createemp').modal('hide');
                    window.location.href = "{{ route('admin.our-employee.members') }}";
                },
                error: function (xhr) {
                    // If there are validation errors, display them below each field
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        $('#error-' + key).html(value[0]); // Display the first error message
                    });
                }
            });
        });
    });

    //----- AJAX for Employee_edit form Modal -----

    $(document).ready(function () {
        // Handle edit form submission
        $('#edit-employee-form').on('submit', function (e) {
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
                    alert('Employee updated successfully!'); // Show success message
                    $('#editemployee').modal('hide'); // Close the modal
                    window.location.reload(); // Reload the page to reflect changes
                },
                error: function (xhr) {
                    // Log the error response to the console
                    console.log(xhr.responseJSON);

                    // If there are validation errors, display them below each field
                    var errors = xhr.responseJSON.errors;
                    if (errors) {
                        $.each(errors, function (key, value) {
                            $('#edit-error-' + key).html(value[0]); // Display the first error message
                        });
                    }
                } 
            });
        });
    });

    //----- AJAX for Project Add Modal form---
    $(document).ready(function () {
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
    });

    //----- AJAX for Project-edit form Modal -----

    $(document).ready(function () {
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
                    alert('Task added successfully!');
                    $('#createtask').modal('hide');

                    // Get project ID from form input
                    var projectId = $('#createtaskform').find('input[name="project_id"]').val();

                    // Redirect using Laravel's route() helper
                    window.location.href = "{{ route('admin.tasks.byProject', ':id') }}".replace(':id', projectId);
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


  
</script>

<script>
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
        // Handle "Yes" button click
        $('#changeEstimationYes').on('click', function () {
            $('#proj_estimation').prop('readonly', false); // Make estimation field editable
            $('#changeEstimationReasonField').show(); // Show the change estimation reason field
        });

        // Handle "No" button click
        $('#changeEstimationNo').on('click', function () {
            $('#proj_estimation').prop('readonly', true); // Make estimation field read-only
            $('#changeEstimationReasonField').hide(); // Hide the change estimation reason field
        });
    });

   
</script>



