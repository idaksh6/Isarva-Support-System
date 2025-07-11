<!-- Body: Header -->
<div class="header">
    <nav class="navbar py-4">
        <div class="container-xxl mainhedercontainer" style="
    background-color: #484c7f;
    color: white;
    border-radius: 5px;
    padding: 5px 10px 5px 10px;
    max-width:100%">
 
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

</style>
        
            <!-- header rightbar icon -->
            <div class="h-right d-flex align-items-center justify-content-between mr-5 mr-lg-0 order-1 w-100">

                <div class="globalsearch">
                    <!-- Global Project Search Form -->
                    <form action="{{ route('admin.project.manage') }}" method="GET" class="d-flex align-items-center" id="globalProjectSearch">
                        <div class="input-group me-2" style="width: 180px;">
                            <input type="text" class="" style="font-size: small;" name="global_project_name" id="headerProjectName" 
                                placeholder="Search by project name" value="{{ request('global_project_name') }}">
                        </div>
                        <div class="input-group me-2" style="width: 180px;">
                            <input type="text" class="" style="font-size: small;" name="global_project_id" id="headerProjectId" 
                                placeholder="Search by project ID" value="{{ request('global_project_id') }}">
                        </div>
                    </form>
                     
                    <!-- Ticket ID Search Form -->
                    <form action="{{ route('admin.ticket.ticket-view') }}" method="GET" class="d-flex align-items-center ms-2" id="ticketIdSearch">
                        <div class="input-group" style="width: 180px;">
                            <input type="text" class="" style="font-size: small;" name="ticket_id" id="headerTicketId" 
                                placeholder="Search by ticket ID">
                            <input type="hidden" name="q" id="ticketSearchQuery">
                        </div>
                    </form>
                   
                </div>
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
                 
   
                <!-- Year and Month Filters -->
                @if(request()->routeIs('admin.project') || request()->is('admin.project'))
                <div class="d-flex align-items-center ms-auto me-3" style="height: 50%;">
                    <div class="filter-container d-flex align-items-center gap-3" style="height: 100%;">
                        <div class="filter-item d-flex align-items-center">
                            <label for="yearFilter" class="form-label me-2 mb-0">Year:</label>
                            <select id="yearFilter" class="form-select">
                                @for ($year = date('Y'); $year >= 2020; $year--)
                                    <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                
                        <div class="filter-item d-flex align-items-center">
                            <label for="monthFilter" class="form-label me-2 mb-0">Month:</label>
                            <select id="monthFilter" class="form-select">
                                @for ($month = 1; $month <= 12; $month++)
                                    <option value="{{ $month }}" {{ $month == date('m') ? 'selected' : '' }}>
                                        {{ date('F', mktime(0, 0, 0, $month, 10)) }}
                                    </option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                @endif


                <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                    <div class="u-info me-2">
                        <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">  {{Auth::user()->name}}</span></p>
                        <small> Profile</small>
                    </div>
                    {{-- <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button"  data-bs-toggle="dropdown" data-bs-display="static">
                        <img class="avatar lg rounded-circle img-thumbnail" src="{{ url('/').'/images/profile_av.png' }}" alt="profile">
                    </a> --}}
                    <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                        <img class="avatar lg rounded-circle img-thumbnail" 
                             src="{{ EmployeeHelper::getProfileImage() }}" 
                             alt="profile">
                    </a>
                    <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                     
                     <div class="card border-0 w280">
                            <div class="card-body pb-0">
                                <div class="d-flex py-1">
                                    {{-- <img class="avatar rounded-circle" src="{{ url('/').'/images/profile_av.png' }}" alt="profile"> --}}
                                    <div class="flex-fill ms-3">
                                        <p class="mb-0"><span class="font-weight-bold">ADMIN</span></p>
                                        <small class="">{{ Auth::check() ? Auth::user()->email : 'Guest' }}</small>
                                    </div>
                                </div>
                                
                                <div><hr class="dropdown-divider border-dark"></div>
                            </div>
                            <div class="list-group m-2 ">
                                {{-- <a href="{{ route('admin.project.tasks') }}" class="list-group-item list-group-item-action border-0 "><i class="icofont-tasks fs-5 me-3"></i>My Task</a> --}}
                                @if(auth()->user()->role == 1)
                                    <a href="{{ route('admin.our-employee.members') }}" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-user-group fs-6 me-3"></i>Members</a>
                                    {{-- <a href="{{ route('frontend.auth.logout') }}" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-6 me-3"></i>Signout</a> --}}
                                    <div><hr class="dropdown-divider border-dark"></div>
                                @endif
                                {{-- <a href="{{route('admin.authentication.signup')}}" class="list-group-item list-group-item-action border-0 "><i class="icofont-contact-add fs-5 me-3"></i>Add personal account</a> --}}
                                <a href="{{ route('frontend.auth.logout') }}" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-6 me-3"></i>Signout</a>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the form and input elements
        const form = document.getElementById('globalProjectSearch');
        const projectNameInput = document.getElementById('headerProjectName');
        const projectIdInput = document.getElementById('headerProjectId');

         // Ticket ID search form handling
        const ticketForm = document.getElementById('ticketIdSearch');
        const ticketIdInput = document.getElementById('headerTicketId');
        const ticketSearchQuery = document.getElementById('ticketSearchQuery');
        
        // Function to submit form when Enter is pressed
        function handleEnterKey(event) {
            if (event.key === 'Enter') {
                // Only submit if at least one field has value
                if (projectNameInput.value.trim() || projectIdInput.value.trim()) {
                    form.submit();
                }
            }
        }

           // Function to handle ticket ID search
            function handleTicketEnterKey(event) {
                if (event.key === 'Enter') {
                    const ticketId = ticketIdInput.value.trim();
                    if (ticketId) {
                        // Set the value for the 'q' parameter which your controller uses
                        ticketSearchQuery.value = ticketId;
                        ticketForm.submit();
                    }
                }
            }
        
        // Add event listeners to inputs
        projectNameInput.addEventListener('keypress', handleEnterKey);
        projectIdInput.addEventListener('keypress', handleEnterKey);
        ticketIdInput.addEventListener('keypress', handleTicketEnterKey);

         // Optional: Focus the ticket ID field when clicking on it
        ticketIdInput.addEventListener('click', function() {
            this.select();
            });
        });
</script>
{{-- @include('backend.layouts.common-oppup') --}}

{{-- @include('backend.layouts.common-oppup', ['clients' => $clients]) --}}