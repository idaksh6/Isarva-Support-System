@if(Request::segment(2) != 'ui-components') 
<div class="sidebar px-4 py-4 py-md-5 me-0">
    <div class="d-flex flex-column h-100">
        <a href="" class="mb-0 brand-icon">
            {{-- <span class="logo-icon">
                <svg  width="35" height="35" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                </svg>
            </span> --}}
            <span class="logo-icon">
                <img src="{{ asset('isarvafavicon.png') }}" width="35" height="35" alt="Icon">
            </span>
            <span class="logo-text">Isarva-Support</span>
        </a>
        <!-- Menu: main ul -->

  
      
        <ul class="menu-list flex-grow-1 mt-3">
 
        

             <!-- Project sidebar -->
            {{-- <li><a class="m-link {{ Request::segment(2) == 'project' ? 'active' : '' }}"   href=" ">   <i class="icofont-briefcase"></i>  <span>Projects</span></a></li> --}}
          
          
            <li><a class="m-link {{ Request::segment(2) == 'ticket' ? 'active' : '' }}"   href="{{ route('client.ticket_view')}}">  <i class="icofont-ticket"></i>  <span>Tickets </span></a></li>


            
        </ul> 
   

     
        
        <!-- Menu: menu collepce btn -->
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
</div>
@endif
@if(Request::segment(2) == 'ui-components')
<div class="sidebar px-4 py-2 py-md-4 me-0">
    <div class="d-flex flex-column h-100">
        <a href="{{route('admin.dashboard')}}" class="mb-0 brand-icon">
            <span class="logo-icon">
                <svg  width="35" height="35" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                </svg>
            </span>
            <span class="logo-text">my-Task</span>
        </a>
        <!-- Menu: main ul -->
        <ul class="menu-list flex-grow-1 mt-3">
 
             
            <li><a class="m-link " href="{{route('admin.dashboard')}}"><i class="icofont-ui-home"></i><span>Home</span></a></li>
            <li class="collapsed">
                <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-Authentication" href=""><i
                        class="icofont-ui-lock"></i> <span>Authentication</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu collapse" id="menu-Authentication">
                    <li><a class="ms-link" href="{{route('admin.authentication.signin')}}"><span>Sign in</span></a></li>
                    <li><a class="ms-link" href="{{route('admin.authentication.signup')}}"><span>Sign up</span></a></li>
                    <li><a class="ms-link" href="{{route('admin.authentication.password-reset')}}"><span>Password reset</span></a></li>
                    <li><a class="ms-link" href="{{route('admin.authentication.two-step-authentication')}}"><span>2-Step Authentication</span></a></li>
                    <li><a class="ms-link" href="{{route('admin.authentication.bad-request')}}"><span>404</span></a></li>
                </ul>
            </li>
            <li><a class="m-link {{ (Request::segment(3) == 'stater-page') ? 'active' : '' }}" href="{{route('admin.ui-components.index')}}"><i class="icofont-code"></i> <span>Stater page</span></a></li>
            <li class="{{ (Request::segment(2) == 'ui-components' && Request::segment(3) != 'stater-page') ? '' : ' collapsed' }}">
                <a class="m-link {{ (Request::segment(2) == 'ui-components' && Request::segment(3) != 'stater-page') ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-Components" href=""><i
                        class="icofont-paint"></i> <span>UI Components</span> <span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                <!-- Menu: Sub menu ul -->
                <ul class="sub-menu {{ (Request::segment(2) == 'ui-components' && Request::segment(3) != 'stater-page') ? 'collapsed show' : 'collapse' }}" id="menu-Components"
                >
                    <li><a class="ms-link {{ (Request::segment(3) == 'alerts') ? 'active' : '' }}" href="{{route('admin.ui-components.alerts')}}"><span>Alerts</span> </a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'badge') ? 'active' : '' }}" href="{{route('admin.ui-components.badge')}}"><span>Badge</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'breadcrumb') ? 'active' : '' }}" href="{{route('admin.ui-components.breadcrumb')}}"><span>Breadcrumb</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'buttons') ? 'active' : '' }}" href="{{route('admin.ui-components.buttons')}}"><span>Buttons</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'card') ? 'active' : '' }}" href="{{route('admin.ui-components.card')}}"><span>Card</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'carousel') ? 'active' : '' }}" href="{{route('admin.ui-components.carousel')}}"><span>Carousel</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'collapse') ? 'active' : '' }}" href="{{route('admin.ui-components.collapse')}}"><span>Collapse</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'dropdowns') ? 'active' : '' }}" href="{{route('admin.ui-components.dropdowns')}}"><span>Dropdowns</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'list') ? 'active' : '' }}" href="{{route('admin.ui-components.list')}}"><span>List</span> group</a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'modal') ? 'active' : '' }}" href="{{route('admin.ui-components.modal')}}"><span>Modal</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'navs') ? 'active' : '' }}" href="{{route('admin.ui-components.navs')}}"><span>Navs</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'navbar') ? 'active' : '' }}" href="{{route('admin.ui-components.navbar')}}"><span>Navbar</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'pagination') ? 'active' : '' }}" href="{{route('admin.ui-components.pagination')}}"><span>Pagination</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'popovers') ? 'active' : '' }}" href="{{route('admin.ui-components.popovers')}}"><span>Popovers</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'progress') ? 'active' : '' }}" href="{{route('admin.ui-components.progress')}}"><span>Progress</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'scrollspy') ? 'active' : '' }}" href="{{route('admin.ui-components.scrollspy')}}"><span>Scrollspy</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'spinners') ? 'active' : '' }}" href="{{route('admin.ui-components.spinners')}}"><span>Spinners</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'toasts') ? 'active' : '' }}" href="{{route('admin.ui-components.toasts')}}"><span>Toasts</span></a></li>
                    <li><a class="ms-link {{ (Request::segment(3) == 'tooltips') ? 'active' : '' }}" href="{{route('admin.ui-components.tooltips')}}"><span>Tooltips</span></a></li>
                </ul>
            </li>
            <li><a class="m-link" href="{{route('admin.document')}}"><i class="icofont-law-document"></i>
                    <span>Documentation</span></a></li>
            <li><a class="m-link" href="{{route('admin.changelog')}}"><i class="icofont-edit"></i> <span>Changelog</span> <span
                        class="badge rounded-pill ms-auto">v1.0.0</span></a></li>
        </ul>

        <!-- Theme: Switch Theme -->
        <ul class="list-unstyled mb-0">
            <li class="d-flex align-items-center justify-content-center">
                <div class="form-check form-switch theme-switch">
                    <input class="form-check-input" type="checkbox" id="theme-switch">
                    <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                </div>
            </li>
            <li class="d-flex align-items-center justify-content-center">
                <div class="form-check form-switch theme-rtl">
                    <input class="form-check-input" type="checkbox" id="theme-rtl">
                    <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                </div>
            </li>
        </ul>
        <!-- Menu: menu collepce btn -->
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
    </div>
@endif