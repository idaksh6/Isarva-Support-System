@extends('backend.layouts.app')

@section('title', 'Manage Employees | Isarva Support')


@section('content')



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
                                <label for="exampleFormControlInput1778" class="form-label">Employee ID<span class="required">*</span></label>
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
                                <label class="form-label">Password<span class="required">*</span></label>
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
                            <label class="form-label">Address<span class="required">*</span></label>
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
                        <label class="form-label">Employee Name<span class="required">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter the Project Name">
                        <div class="text-danger" id="edit-error-name"></div> <!-- Error container for "name" -->
                    </div>

                    <!-- Employee ID and Joining Date -->
                    <div class="row g-3 mb-3">
                        <div class="col-sm-6">
                            <label for="employee_id" class="form-label">Employee ID<span class="required">*</span></label>
                            <input type="text" class="form-control" name="employee_id" id="employee_id" placeholder="Enter Employee Id">
                            <div class="text-danger" id="edit-error-employee_id"></div> <!-- Error container for "employee_id" -->
                        </div>
                        <div class="col-sm-6">
                            <label for="joining_date" class="form-label">Joining Date<span class="required">*</span></label>
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
                            <label class="form-label">Password<span class="required">*</span></label>
                            <input type="password" class="form-control" name="password" id="emp_password" placeholder="Password" autocomplete="new-password">
                            <div class="text-danger" id="edit-error-password"></div> <!-- Error container for "password" -->
                        </div>
                    </div>

                    <!-- Email ID and Phone -->
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label">Email ID<span class="required">*</span></label>
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
                            <label class="form-label">Status<span class="required">*</span></label>
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
                            <label class="form-label">Department<span class="required">*</span></label>
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
                            <label class="form-label">Designation<span class="required">*</span></label>
                            <select class="form-select" name="designation" id="designation" aria-label="Default select Project Category">
                                <option value="1">Website Design</option>
                                <option value="2">App Development</option>
                                <option value="3">UI/UX Design</option>
                                <option value="4">HR Manager</option>
                                <option value="5">Backend Development</option>
                                <option value="6">Software Testing</option>
                                <option value="7">Marketing Analyst</option>
                                <option value="8">Quality Assurance</option>
                                <option value="9">Other</option>
                            </select>
                            <div class="text-danger" id="edit-error-designation"></div> <!-- Error container for "designation" -->
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="mb-3">
                        <label class="form-label">Role<span class="required">*</span></label>
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
                        <label class="form-label">Address<span class="required">*</span></label>
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

   <!-- Display success or error message -->
   @if (session('success'))
   <div class="alert alert-success">
       {{ session('success') }}
   </div>
   @endif 

    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row clearfix">
                    <div class="col-md-12">
                     
                       <!-- Search Bar -->
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('admin.our-employee.search') }}">
                                    <div class="input-group">
                                        <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control employee_search" placeholder="Search " aria-label="Search">
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>  


                        <div class="card border-0 mb-4 no-bg">
                            <div class="card-header py-3 px-0 d-sm-flex align-items-center  justify-content-between border-bottom">
                                <h3 class=" fw-bold flex-fill mb-0 mt-sm-0">Employee</h3>
                                <button type="button" class="btn btn-dark me-1 mt-1 w-sm-100" data-bs-toggle="modal" data-bs-target="#createemp"><i class="icofont-plus-circle me-2 fs-6"></i>Add Employee</button>
                                {{-- <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle mt-1  w-sm-100" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Status
                                    </button>
                                    <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                    <li><a class="dropdown-item" href="#">All</a></li>
                                    <li><a class="dropdown-item" href="#">Task Assign Members</a></li>
                                    <li><a class="dropdown-item" href="#">Not Assign Members</a></li>
                                    </ul>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
                 

                    {{-- @if (session()->has('flash_success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
                    <i class="bi bi-check-circle-fill me-2 text-success"></i> 
                    <span>{{ session('flash_success') }}</span>
                    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif --}}

                <div class="row g-3 row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-2 row-deck py-1 pb-4 Go-backbtn">
                    @if($employees->count() > 0)
                    @foreach($employees as $employee)
                    <div class="col">
                        <div class="card teacher-card">
                            <div class="card-body d-flex">
                                <div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
                                    <img src="{{ $employee->profile_image ? url($employee->profile_image) : url('/images/lg/avatar4.jpg') }}" 
                                    alt="Profile Picture" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                   
                                    <div class="btn-group mt-2" role="group" aria-label="Basic outlined example">
                                        <button type="button" class="btn btn-outline-secondary edit-employee-btn mt-3" data-id="{{ $employee->id }}" data-bs-toggle="modal" data-bs-target="#editemployee">
                                            <i class="icofont-edit text-success"></i>
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary delete-employee-btn mt-3 " data-id="{{ $employee->id }}" data-bs-toggle="modal" data-bs-target="#deleteemployee">
                                            <i class="icofont-ui-delete text-danger"></i>
                                        </button>
                                    </div>  

                                </div>
                                <div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
                                    <h6  class="mb-0 mt-2  fw-bold d-block fs-6">{{ $employee->name}}</h6>
                                    <span class="light-info-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-11 mb-0 mt-1">
                                        {{ $employee->designation_name ?? 'N/A' }}
                                    </span>
                                    
                                    <div class="video-setting-icon mt-3 pt-3 border-top">
                                        <div class="d-flex flex-wrap gap-2">
                                            <span class="btn btn-outline-primary btn-sm">
                                                <i class="icofont-id"></i> Employee ID: {{ $employee->employee_id ?? 'N/A' }}
                                            </span>
                                            <span class="btn btn-outline-success btn-sm">
                                                <i class="icofont-calendar"></i> Joining Date: {{ $employee->joining_date ? \Carbon\Carbon::parse($employee->joining_date)->format('d M, Y') : 'N/A' }}
                                            </span>
                                            {{-- <span class="btn btn-outline-info btn-sm">
                                                <i class="icofont-location-pin"></i> Address: {{ $employee->address ?? 'N/A' }}
                                            </span> --}}
                                        </div>
                                    </div>

                                    {{-- <a href="{{ route('admin.project.tasks') }}" class="btn btn-dark btn-sm mt-1"><i class="icofont-plus-circle me-2 fs-6"></i>Add Task</a> --}}
                                    <a href="{{ route('admin.our-employee.members-profile') }}" class="btn btn-dark btn-sm mt-2"><i class="icofont-invisible me-2 fs-6"></i>Profile</a>
                                </div>

                               
                                
                            </div>
                        </div>
                    </div>
                  
                    @endforeach
                    @else
                     <div class="col-12 text-center py-5 mx-auto">
                        <div class="no-info-card ">
                          <i class="fa fa-info-circle fa-3x text-info mb-3"></i>
                          <h4 class="mb-2">No information found</h4>
                          <p class="text-muted">Sorry, we couldn't find any employee data at this time.</p>
                          <a href="{{ route('admin.our-employee.members') }}" class="btn btn-primary mt-3">Go Back</a>
                        </div>
                      </div>
                    @endif
                </div>
            </div>
        </div>
    
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    
    <script src="{{ asset('js/template.js') }}"></script>

    <script>

        var editEmployeeRoute = "{{ route('admin.our-employee.edit-employee', ':id') }}"; // id is the placeholder for emplyoee id which is replaced further
      
    </script>

    

    
    <!-- Script to edit and update the employee values -->
    <script>
        
        $(document).ready(function () {

            // When edit button is clicked
             $('.edit-employee-btn').on('click', function () {
               
                var employeeId = $(this).data('id'); 
                console.log(employeeId);

                 // Generate the URL using the route name and employee ID
                 var url = editEmployeeRoute.replace(':id', employeeId);
                //  console.log(url);
             
                // Fetch Employee data via AJAX
                $.ajax({

                    url: url, // Use the dynamically generated URL
                    method: 'GET',
                    // data: formData,
                    success: function (response) {    // callback function that runs only if the request is successful.
                        console.log(response);
                        // Populate the modal form with the fetched data
                        $('#name').val(response.name);
                        $('#employee_id').val(response.employee_id);
                        $('#joining_date').val(response.joining_date);
                        $('#user_name').val(response.user_name);
                        $('#emp_password').val(response.password);
                        $('#email_id').val(response.email);
                        $('#phone_no').val(response.phone);
                        $('#webhook_url').val(response.webhook_url);
                        $('#status').val(response.status);
                        $('#department').val(response.department);
                        $('#designation').val(response.designation);
                        $('#role').val(response.role);
                        $('#emp_address').val(response.address);
                        $('#emp_description').val(response.description);
                        
                         // Set the form action URL for updating
                         $('#edit-employee-form').attr('action', "{{ route('admin.our-employee.update-employee', ':id') }}".replace(':id', employeeId));
                        
                          // Display the existing profile image
                        if (response.profile_image) {
                            $('#emp_current-profile-image img')
                                .attr('src', "{{ asset('') }}" + response.profile_image) // Set the image source
                                .show(); // Show the image
                        } else {
                            $('#emp_current-profile-image img').hide(); // Hide the image if no profile image exists
                        }

                    },
                    error: function (xhr) {
                        console.error('Error fetching Employee data:', xhr.responseText);
                    }

                });
            });
        });

                // When the delete button is clicked
                $('.delete-employee-btn').on('click', function () {
                    var employeeId = $(this).data('id'); // Get the client ID from the data attribute

                    // Set the form action dynamically
                    var deleteUrl = "{{ route('admin.our-employee.destroy-employee', ':id') }}"; // Route with placeholder
                    deleteUrl = deleteUrl.replace(':id', employeeId);       // Replace placeholder with actual ID

                    // Update the form action
                    $('#delete-employee-form').attr('action', deleteUrl);
                });

                // Handle form submission
                $('#delete-employee-form').on('submit', function (e) {
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
                            console.error('Error deleting employee:', xhr.responseText);
                            alert('An error occurred while deleting the employee.');
                        }
                    });
                });



                        // Employee Add Modal pop-up hidden function
                        // Handle form submission
                        $('#createEmployeeForm').on('submit', function (e) {
                            e.preventDefault(); // Prevent the default form submission

                            var form = $(this);
                            var url = form.attr('action');
                            var formData = new FormData(form[0]); // Extract all form data, including file inputs

                            // Clear previous errors
                            $('.text-danger').html('');

                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: formData,
                                processData: false, // Allow FormData to handle formatting
                                contentType: false, // Ensure correct handling of file uploads
                                success: function (response) {
                                    // Hide modal only if form submission is successful
                                    $('#createemp').modal('hide');

                                    // Show success message with SweetAlert
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Employee added successfully!',
                                        icon: 'success',
                                        confirmButtonText: 'OK'
                                    }).then(() => {
                                        window.location.href = "{{ route('admin.our-employee.members') }}";
                                    });
                                },
                                error: function (xhr) {
                                    var errors = xhr.responseJSON.errors;
                                    $.each(errors, function (key, value) {
                                        $('#error-' + key).html(value[0]); // Display validation errors
                                    });
                                }
                            });
                        });
                    


                    //----- AJAX for Employee_edit form Modal -----

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
                                // Close modal immediately
                                $('#editemployee').modal('hide');

                                // Remove modal backdrop (fixes black background issue)
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();

                                // Show success alert with proper orientation
                                Swal.fire({
                                    title: 'Success!',
                                    html: '<div style="transform: scaleX(1)">Employee has been updated!</div>',
                                    icon: 'success',
                                    timer: 2000, // 2 seconds
                                    timerProgressBar: true,
                                    showConfirmButton: false,
                                    position: 'center',
                                    willClose: () => {
                                        window.location.reload();
                                    }
                                });
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
                

            
        </script>       

    
@endsection
