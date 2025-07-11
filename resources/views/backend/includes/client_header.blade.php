<!-- Body: Header -->
<div class="header">
    <nav class="navbar py-4">
        <div class="container-xxl mainhedercontainer" style="
    background-color: #484c7f;
    color: white;
    border-radius: 5px;
    padding: 5px 10px 5px 10px;">
 
<style>

.globalsearch {
    display: flex;
    align-items: center;
}

#ticketIdSearch {
    margin-left: 10px;
    border-left: 1px solid #ddd;
    padding-left: 10px;
}

 .password-toggle {

            position: absolute;
            top: 71%;
            right: 1rem;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #aaa;
            z-index: 2;
            transition: color 0.3s ease;
        }

</style>
        
            <!-- header rightbar icon -->
            <div class="h-right d-flex align-items-center justify-content-between mr-5 mr-lg-0 order-1 w-100">

                {{-- <div class="d-flex">
                    <a class="nav-link text-primary collapsed" href="{{ route('admin.help') }}" title="Get Help">
                        <i class="icofont-info-square fs-5"></i>
                    </a>
                    <div class="avatar-list avatar-list-stacked px-3">
                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar2.jpg' }}" alt="">
                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar1.jpg' }}" alt="">
                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar3.jpg' }}" alt="">
                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar4.jpg' }}" alt="">
                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar7.jpg' }}" alt="">
                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar8.jpg' }}" alt="">
                        <span class="avatar rounded-circle text-center pointer" data-bs-toggle="modal" data-bs-target="#addUser"><i class="icofont-ui-add"></i></span>
                    </div>
                </div> --}}
                <div class="dropdown notifications zindex-popover">
                    {{-- <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="icofont-alarm fs-5"></i>
                        <span class="pulse-ring"></span>
                    </a> --}}
                    <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-sm-end p-0 m-0">
                        <div class="card border-0 w380">
                            <div class="card-header border-0 p-3">
                                <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                    <span>Notifications</span>
                                    <span class="badge text-white">11</span>
                                </h5>
                            </div>
                            <div class="tab-content card-body">
                                <div class="tab-pane fade show active">
                                    <ul class="list-unstyled list mb-0">
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar1.jpg' }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Dylan Hunter</span> <small>2MIN</small></p>
                                                    <span class="">Added  2021-02-19 my-Task ui/ux Design <span class="badge bg-success">Review</span></span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <div class="avatar rounded-circle no-thumbnail">DF</div>
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Diane Fisher</span> <small>13MIN</small></p>
                                                    <span class="">Task added Get Started with Fast Cad project</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar3.jpg' }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Andrea Gill</span> <small>1HR</small></p>
                                                    <span class="">Quality Assurance Task Completed</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar5.jpg' }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Diane Fisher</span> <small>13MIN</small></p>
                                                    <span class="">Add New Project for App Developemnt</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2 mb-1 border-bottom">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar6.jpg' }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Andrea Gill</span> <small>1HR</small></p>
                                                    <span class="">Add Timesheet For Rhinestone project</span>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="py-2">
                                            <a href="javascript:void(0);" class="d-flex">
                                                <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar7.jpg' }}" alt="">
                                                <div class="flex-fill ms-2">
                                                    <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Zoe Wright</span> <small class="">1DAY</small></p>
                                                    <span class="">Add Calander Event</span>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <a class="card-footer text-center border-top-0" href="#"> View all notifications</a>
                        </div>
                    </div>
                </div>
                 


                <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                    <div class="u-info me-2">
                        {{-- <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">  {{session('client_name')}}</span></p> --}}
                         <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">  {{ Auth::guard('client')->user()->client_name }} </span></p>
                        <small> Profile</small>
                    </div>
                    <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button"  data-bs-toggle="dropdown" data-bs-display="static">
                        {{-- <img class="avatar lg rounded-circle img-thumbnail" src="{{  url('/images/xs/avatar1.jpg')  }}" alt="profile"> --}}
                          <img class="avatar lg rounded-circle img-thumbnail" src="{{ Auth::guard('client')->user()->profile_image ?? url('/images/xs/avatar1.jpg') }}" alt="profile">
                    </a>
                    {{-- <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                        <img class="avatar lg rounded-circle img-thumbnail" 
                             src="{{ EmployeeHelper::getProfileImage() }}" 
                             alt="profile">
                    </a> --}}
                    <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                     
                        <div class="card border-0 w280">
                            <div class="card-body pb-0">
                                <div class="d-flex py-1">
                                    {{-- <img class="avatar rounded-circle" src="{{ url('/').'/images/profile_av.png' }}" alt="profile"> --}}
                                    <div class="flex-fill ms-3">
                                        <p class="mb-0"><span class="font-weight-bold">CLIENT</span></p>
                                        {{-- <small class="">{{  session('client_email') }}</small> --}}
                                         <small class="">{{ Auth::guard('client')->user()->email_id }}</small>
                                    </div>
                                </div>
                                
                                <div><hr class="dropdown-divider border-dark"></div>
                            </div>
                            <div class="list-group m-2 ">
                                {{-- <a href="{{ route('admin.project.tasks') }}" class="list-group-item list-group-item-action border-0 "><i class="icofont-tasks fs-5 me-3"></i>My Task</a> --}}
                             
                                <a href="#" class="list-group-item list-group-item-action border-0"  data-bs-toggle="modal" data-bs-target="#profileModal"><i class="icofont-user"></i>  View Profile</a>
                                    {{-- <a href="{{ route('frontend.auth.logout') }}" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-6 me-3"></i>Signout</a> --}}
                                <div><hr class="dropdown-divider border-dark"></div>
                          
                                {{-- <a href="{{route('admin.authentication.signup')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-contact-add fs-5 me-3"></i>Add personal account</a> --}}
                                <a href="{{ route('client.logout') }}" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-6 me-3"></i>Signout</a>
                                <!-- In your dropdown -->
                               

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- menu toggler -->
            <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                <span class="fa fa-bars" style="color: white;"></span>
            </button>

            <!-- main menu Search-->
            {{-- <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 "> --}}
                <div class="input-group flex-nowrap input-group-lg">
                    {{-- <button type="button" class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></button>
                    <input type="search" class="form-control" placeholder="Search" aria-label="search" aria-describedby="addon-wrapping">
                    <button type="button" class="input-group-text add-member-top" id="addon-wrappingone" data-bs-toggle="modal" data-bs-target="#addUser"><i class="fa fa-plus"></i></button> --}}
                </div>
            {{-- </div> --}}

        </div>
    </nav>
</div>


<!-- Profile Modal (optional) -->
<form method="POST" action="{{ route('client.update_password') }}">
@csrf
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profileModalLabel">Client Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-user-circle fa-5x text-primary"></i>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Client Name</label>
                            <input type="text" class="form-control" value="{{ Auth::guard('client')->user()->client_name }}" readonly>
                        </div>

                        <div class="mb-3 position-relative">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newclieninput_password" name="new_password" required placeholder="Enter new password">

                            <!-- Eye Icon -->
                            <span class="password-toggle" id="clientnew_togglePassword">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>

                        <!-- Add more client details here if needed -->
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update Password</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
            </div>
        </div>
    </div>
</form>                       

<script>
    const togglePassword = document.getElementById('clientnew_togglePassword');
    const passwordField = document.getElementById('newclieninput_password');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle the eye / eye-slash icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>