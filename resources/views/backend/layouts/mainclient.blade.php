
<!doctype html>
<html class="no-js " lang="en">

<head>
 
    <meta charset="utf-8">
    {{-- for TASk Drag and drop status  --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 admin template and web Application ui kit.">
    {{-- <title>:: My-Task::</title>
    <link rel="icon" href="{{ asset('/favicon.ico')}}" type="image/x-icon"> <!-- Favicon--> --}}

    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('isarvafavicon.png') }}">
    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/responsive.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/nestable/jquery-nestable.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/fullcalendar/main.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/plugins/prism/prism.css') }}" />

    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">

    <!-- Style for project.index.blade field -->
    <link rel="stylesheet" href=" {{ asset('css/project-index.css') }}">

    <!-- Style for members manage page -->
    <link rel="stylesheet" href=" {{ asset('css/member.css') }}">

    <!-- Style for client section -->
    <link rel="stylesheet" href="{{ asset('css/client_index.css') }}">

    <!-- Style for Task Manage Page -->
    <link rel="stylesheet" href="{{ asset('css/task_manage.css') }}">
    
    <link rel="stylesheet" href="{{ asset('assets/my-task.style.min.css') }}">

    <!-- Css for project Manage section -->
    <link rel="stylesheet" href="{{ asset('css/manage.css')}}">

      <!-- Css for Daily Report section -->
    <link rel="stylesheet" href="{{ asset('css/add_dailyreport.css')}}">

    <!-- Sweet Alert library -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

    <script src="{{ asset('sweetalaertcdn/sweetalert2@11.js') }}"></script>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include jQuery UI CSS -->
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
      
    <!-- Consolidated Report CSS-->
    <link rel="stylesheet" href="{{ asset('css/consolidated_report.css')}}">

     <link rel="stylesheet" href="{{ asset('css/dashboard.css')}}">
    
    <!-- Include jQuery UI JS -->
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('css/daily_task.css')}}">

    <link rel="stylesheet" href="{{ asset('css/backupmodule.css')}}">


    <link rel="stylesheet" href="{{ asset('css/renewal.css')}}">

    <link rel="stylesheet" href="{{ asset('css/project_dashboard.css')}}">

    <link rel="stylesheet" href="{{ asset('css/ticket_detail.css')}}">


        
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    
<style>

 a{

    text-decoration: none ;
 }
</style>

    
    {{-- select 2  --}}
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/select2.min.css') }}">
</head>
<body>

<div id="mytask-layout" class="theme-indigo">
    <!-- sidebar -->
    @include('backend.includes.client_sidebar')

    <!-- main body area -->
    <div class="main px-lg-4 px-md-4">

        <!-- Body: Header -->
        {{-- @include('backend.includes.header') --}}

        @include('backend.includes.client_header')
        <!-- Body: Body -->
        @yield('content')

        <!-- Modal Members-->
        {{-- <div class="modal fade" id="addUser" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="addUserLabel">Invite Friend's</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="inviteby_email">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Members Invite" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-dark" type="button" id="button-addon2">Members Invite</button>
                        </div>
                    </div>
                    <div class="members_list">
                        <h6 class="fw-bold ">Members of My-Task</h6>
                        <ul class="list-unstyled list-group list-group-custom list-group-flush mb-0">
                            <li class="list-group-item py-3 text-center text-md-start">
                                <div class="d-flex align-items-center flex-column flex-sm-column flex-md-row">
                                    <div class="no-thumbnail mb-2 mb-md-0">
                                        <img class="avatar lg rounded-circle" src="/images/xs/avatar2.jpg" alt="">
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
                                            <ul class="dropdown-menu">
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
                                        <img class="avatar lg rounded-circle" src="assets/images/xs/avatar3.jpg" alt="">
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
                                            <ul class="dropdown-menu">
                                              <li>
                                                  <a class="dropdown-item" href="#">
                                                    <i class="icofont-check-circled"></i>
                                                        Member
                                                    <span>Can view, edit, delete, comment on and save files</span>
                                                   </a>

                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fs-6 p-2 me-1"></i>
                                                            Admin
                                                        <span>Member, but can invite and manage team members</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="icofont-ui-settings  fs-6"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                              <li><a class="dropdown-item" href="#"><i class="icofont-delete-alt fs-6 me-2"></i>Delete Member</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item py-3 text-center text-md-start">
                                <div class="d-flex align-items-center flex-column flex-sm-column flex-md-row">
                                    <div class="no-thumbnail mb-2 mb-md-0">
                                        <img class="avatar lg rounded-circle" src="assets/images/xs/avatar8.jpg" alt="">
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
                                            <ul class="dropdown-menu">
                                              <li>
                                                  <a class="dropdown-item" href="#">
                                                    <i class="icofont-check-circled"></i>
                                                        Member
                                                    <span>Can view, edit, delete, comment on and save files</span>
                                                   </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fs-6 p-2 me-1"></i>
                                                            Admin
                                                        <span>Member, but can invite and manage team members</span>
                                                       </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="btn-group">
                                            <div class="btn-group">
                                                <button type="button" class="btn bg-transparent dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="icofont-ui-settings  fs-6"></i>
                                                </button>
                                                <ul class="dropdown-menu">
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
        </div> --}}
    </div>
</div>
</body>

<script src="{{ asset('assets/plugins/fullcalendar/main.min.js') }}"></script>
<script src="{{ asset('assets/plugins/prism/prism.js') }}"></script>
<script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>



    <!-- Bootstrap JS Bundle with Popper  for client profile view  -->
            {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Optional: DataTables -->
            <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}

{{-- <script src="{{ asset('assets/plugins/bootstrap/bootstrap.bundle.min.js')}}"></script> --}}
@stack('before-scripts')

<script>

$(document).ready(function() {
    $('.sidebar-mini-btn').click(function() {
        $(this).toggleClass('sidebar-mini');
    });

    var toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');
    $(toggleSwitch).on('change',function() {
        if(toggleSwitch.checked == true) {
            $('body').attr('data-theme', 'dark');
        }else{
            $('body').attr('data-theme', 'light');
        }
    });
    
    var togglertlSwitch = document.querySelector('.theme-rtl input[type="checkbox"]');
    $(togglertlSwitch).on('change',function() {
        if(togglertlSwitch.checked == true) {
            $('body').addClass( 'rtl_mode');
        }else{
            $('body').removeClass( 'rtl_mode');
        }
    });
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/6051a040f7ce18270930e55a/1f0vdjvfu';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
    // cSidebar overflow daynamic height
    
    overFlowDynamic();

    $(window).resize(function(){
        overFlowDynamic();
    });

    function overFlowDynamic(){ 
        var sideheight=$(".sidebar.sidebar-mini").height() + 48;
        
        if(sideheight <= 760) {  
            $(".sidebar.sidebar-mini").css( "overflow", "scroll");  
        }
        else{
            $(".sidebar.sidebar-mini").css( "overflow", "visible"); 
        }
    }
});





</script>
@stack('after-scripts')
</html>
