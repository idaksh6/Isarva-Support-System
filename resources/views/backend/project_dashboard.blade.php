@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')

<style>

@media(max-width:423px){

    .pending_renwalclass{

        font-size: 15px !important;
    }

    .urgent-count{

        font-size: 10px !important;
    }
}

@media(max-width:367px){

    .pending_renwalclass{

        font-size: 11px !important;
    }

    .urgent-count{

        font-size: 8px !important;
    }
}


</style>
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

{{-- <link rel="stylesheet" href="{{ asset('css/all.min.css')}}">  --}}

<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row clearfix g-3">

{{--                                 
                    <!-- Compact Urgent Renewals Panel -->
                    @if(count($urgentRenewals) > 0)
                    <div class="col-12 mb-3">
                        <div class="urgent-renewals-panel">
                            <div class="urgent-header">
                                <div class="urgent-icon">
                                    <i class="fas fa-clock-rotate-left fa-spin"></i>
                                </div>
                                <div class="urgent-title">
                                    <h5><i class="fas fa-bell-on me-2"></i> PENDING RENEWALS</h5>
                                </div>
                                <div class="urgent-count-container">
                                    <span class="badge urgent-count">{{ count($urgentRenewals) }} URGENT</span>
                                </div>
                            </div>
                            <div class="urgent-items">
                                @foreach($urgentRenewals as $renewal)
                                <a href="{{ route('admin.renewals.edit', $renewal->id) }}" class="urgent-item">
                                    <div class="item-icon">
                                        @switch($renewal->service_type)
                                            @case('domain') <i class="fas fa-globe-americas"></i> @break
                                            @case('hosting') <i class="fas fa-database"></i> @break
                                            @default <i class="fas fa-cubes"></i>
                                        @endswitch
                                    </div>
                                    <div class="item-details">
                                        <strong>{{ $renewal->service_name }}</strong>
                                        <div class="service-info">
                                            <span class="service-type">{{ ucfirst($renewal->service_type) }}</span>
                                            <span class="project-name">{{ $renewal->project_name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                    <div class="item-timer">
                                        <div class="timer-count days-counter">{{ \Carbon\Carbon::parse($renewal->expiry_date)->diffInDays() }}</div>
                                        <small>DAYS LEFT</small>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endif --}}

                    {{-- @if(count($urgentRenewals) > 0)
            <div class="col-12 mb-3">
                <div class="urgent-renewals-panel">
                    <div class="urgent-header">
                        <div class="urgent-icon">
                            <i class="fas fa-clock-rotate-left fa-spin"></i>
                        </div>
                        <div class="urgent-title">
                            <h5><i class="fas fa-bell-on me-2"></i> PENDING RENEWALS</h5>
                        </div>
                        <div class="urgent-count-container">
                            <span class="badge urgent-count">{{ count($urgentRenewals) }} URGENT</span>
                        </div>
                    </div>
                    <div class="urgent-items">
                        @foreach($urgentRenewals as $renewal)
                        <a href="{{ route('admin.renewals.edit', $renewal->id) }}" class="urgent-item">
                            <div class="item-icon">
                                @switch($renewal->service_type)
                                    @case('domain') <i class="fas fa-globe-americas"></i> @break
                                    @case('hosting') <i class="fas fa-database"></i> @break
                                    @default <i class="fas fa-cubes"></i>
                                @endswitch
                            </div>
                            <div class="item-details">
                                <strong>{{ $renewal->service_name }}</strong>
                                <div class="service-info">
                                    <span class="service-type">{{ ucfirst($renewal->service_type) }}</span>
                                    <span class="project-name">{{ $renewal->project_name ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <div class="item-timer">
                                <div class="timer-count days-counter">{{ \Carbon\Carbon::parse($renewal->expiry_date)->diffInDays() }}</div>
                                <small>DAYS LEFT</small>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif --}}

            @if(count($urgentServices) > 0)
            <div class="col-12 mb-3">
                <div class="urgent-renewals-panel">
                    <div class="urgent-header">
                        <div class="urgent-icon">
                            <i class="fas fa-clock-rotate-left fa-spin"></i>
                        </div>
                        <div class="urgent-title">
                            <h5 class="pending_renwalclass"><i class="fas fa-bell-on me-2"></i> PENDING RENEWALS</h5>
                        </div>
                        <div class="urgent-count-container">
                            <span class="badge urgent-count">{{ count($urgentServices) }} URGENT</span>
                        </div>
                    </div>
                    <div class="urgent-items">
                        @foreach($urgentServices as $service)
                        <a href="{{ route('admin.renewals.edit', $service->id) }}" class="urgent-item">
                            <div class="item-icon">
                                @switch($service->service_type)
                                    @case('domain') <i class="fas fa-globe-americas"></i> @break
                                    @case('hosting') <i class="fas fa-database"></i> @break
                                    @default <i class="fas fa-cubes"></i>
                                @endswitch
                            </div>
                            <div class="item-details">
                                <strong>{{ $service->service_name }}</strong>
                                <div class="service-info">
                                    <span class="service-type">{{ ucfirst($service->service_type) }}</span>
                                    <span class="project-name">{{ $service->project_name ?? 'N/A' }}</span>
                                </div>
                            </div>
                            {{-- <div class="item-timer">
                                <div class="timer-count days-counter">{{ $service->days_left }}</div>
                                <small>DAYS LEFT</small>
                            </div> --}}
                            <div class="item-timer">
                                <div class="timer-count days-counter @if($service->days_left < 0) text-danger @endif">
                                    {{ ($service->days_left) }}
                                </div>
                                <small class="@if($service->days_left < 0) text-danger @endif">
                                    @if($service->days_left < 0)
                                        DAYS CROSSED
                                    @elseif($service->days_left == 0)
                                        EXPIRES TODAY
                                    @else
                                        DAYS LEFT
                                    @endif
                                </small>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif


            
            <div class=" col-md-12">

                <div class="row g-3 row-deck">

                    <div class="col-md-6 col-lg-6 col-xl-12">

                        <div class="card">

                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">

                                <h6 class="mb-0 fw-bold ">Billable, Non Billable and Internal Billable of 6 Month</h6>

                            </div>

                            <div class="card-body">

                                <div class="mt-3" id="six-month-cart"></div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-xl-8 col-lg-12 col-md-12 flex-column">
                <div class="row g-3">



                    
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Billable Hours (Last 1 Year)</h6>
                            </div>
                            <div class="card-body">
                                <div class="ac-line-transparent" id="lastYearChart"></div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>

            <div class="col-xl-4 col-lg-12 col-md-12">
                <div class="row g-3 row-deck">
                    <div class="col-md-6 col-lg-6 col-xl-12">
                        <div class="card">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Billable, Non Billable and Internal Billable Statistics in Hrs</h6>
                            </div>
                            <div class="card-body">
                                <div class="mt-3" id="apex-MainCategories"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
       
                 <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Quick on Projects</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4">
                            <!-- Total Projects -->
                            <div class="col">
                                <a href="{{ route('admin.project.manage') }}" class="card-link">
                                    <div class="card bg-primary h-100">
                                        <div class="card-body text-white d-flex align-items-center">
                                            <i class="icofont-data fs-3"></i>
                                            <div class="d-flex flex-column ms-3">
                                                <h6 class="mb-0">Total Projects</h6>
                                                <span class="text-white">{{ $totalProjects }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Open Projects -->
                            <div class="col">
                                <a href="{{ route('admin.project.manage', ['status' => 2]) }}" class="card-link">
                                    <div class="card bg-success h-100">
                                        <div class="card-body text-white d-flex align-items-center">
                                            <i class="icofont-chart-flow fs-3"></i>
                                            <div class="d-flex flex-column ms-3">
                                                <h6 class="mb-0">Open Projects</h6>
                                                <span class="text-white">{{ $openProjects }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- Closed Projects -->
                            <div class="col">
                                <a href="{{ route('admin.project.manage', ['status' => 6]) }}" class="card-link">
                                    <div class="card bg-danger h-100">
                                        <div class="card-body text-white d-flex align-items-center">
                                            <i class="icofont-chart-flow-2 fs-3"></i>
                                            <div class="d-flex flex-column ms-3">
                                                <h6 class="mb-0">Closed Projects</h6>
                                                <span class="text-white">{{ $closedProjects }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <!-- OnHold Projects -->
                            <div class="col">
                                <a href="{{ route('admin.project.manage', ['status' => 7]) }}" class="card-link">
                                    <div class="card bg-warning h-100">
                                        <div class="card-body text-white d-flex align-items-center">
                                            <i class="icofont-tasks fs-3"></i>
                                            <div class="d-flex flex-column ms-3">
                                                <h6 class="mb-0">OnHold Projects</h6>
                                                <span class="text-white">{{ $OnHoldProjects }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                            
            <!-- Ticket Count section -->
            {{-- <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick on Tickets</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4">
                        <div class="col">
                            <div class="card bg-danger">
                                <div class="card-body text-white d-flex align-items-center">
                                    <i class="icofont-flag fs-3"></i>
                                    <div class="d-flex flex-column ms-3">
                                        <h6 class="mb-0">Total Tickets</h6>
                                        <span class="text-white">{{ $ticketCounts['total'] }}</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-success">
                                <div class="card-body text-white d-flex align-items-center">
                                    <i class="icofont-live-support fs-3"></i>
                                    <div class="d-flex flex-column ms-3">
                                        <h6 class="mb-0">Active Tickets</h6>
                                        <span class="text-white">{{$activeTickets}}</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-primary">
                                <div class="card-body text-white d-flex align-items-center">
                                    <i class="icofont-ui-message fs-3"></i>
                                    <div class="d-flex flex-column ms-3">
                                        <h6 class="mb-0">Open Tickets</h6>
                                        <span class="text-white">{{ $openTickets }}</span> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card bg-warning">
                                <div class="card-body text-white d-flex align-items-center">
                                    <i class="icofont-clock-time fs-3"></i>
                                    <div class="d-flex flex-column ms-3">
                                        <h6 class="mb-0">OnHold Tickets</h6>
                                        <span class="text-white">{{ $onHoldTickets }}</span> 
                                    </div>
                                </div>
                            </div>
                        </div>             
                    </div>
                </div>
            </div> --}}
            <!-- Ticket Count section -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Quick on Tickets</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-4">
                        <!-- Total Tickets -->
                        <div class="col">
                            <a href="{{ route('admin.ticket.ticket-view') }}" class="card-link">
                                <div class="card bg-danger h-100">
                                    <div class="card-body text-white d-flex align-items-center">
                                        <i class="icofont-flag fs-3"></i>
                                        <div class="d-flex flex-column ms-3">
                                            <h6 class="mb-0">Total Tickets</h6>
                                            <span class="text-white">5</span> 
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Active Tickets -->
                        <div class="col">
                            <a href="{{ route('admin.ticket.ticket-view', [
                            'q' => '',
                                'month_year' => '',
                                'assignedTo' => '',
                                'department' => '',
                                'priority' => '',
                                'status' => 8
                            ]) }}" class="card-link">
                                <div class="card bg-success h-100">
                                    <div class="card-body text-white d-flex align-items-center">
                                        <i class="icofont-live-support fs-3"></i>
                                        <div class="d-flex flex-column ms-3">
                                            <h6 class="mb-0">Active Tickets</h6>
                                            <span class="text-white">{{ $activeTickets }}</span> 
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Open Tickets -->
                        <div class="col">
                        <a href="{{ route('admin.ticket.ticket-view', [
                            'q' => '',
                                'month_year' => '',
                                'assignedTo' => '',
                                'department' => '',
                                'priority' => '',
                                'status' => 1
                            ]) }}" class="card-link">
                                <div class="card bg-primary h-100">
                                    <div class="card-body text-white d-flex align-items-center">
                                        <i class="icofont-ui-message fs-3"></i>
                                        <div class="d-flex flex-column ms-3">
                                            <h6 class="mb-0">Open Tickets</h6>
                                            <span class="text-white">{{ $openTickets }}</span> 
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <!-- OnHold Tickets -->
                        <div class="col">
                            <a href="{{ route('admin.ticket.ticket-view', [
                                'q' => '',
                                'month_year' => '',
                                'assignedTo' => '',
                                'department' => '',
                                'priority' => '',
                                'status' => 3
                            ]) }}" class="card-link">
                                <div class="card bg-warning h-100">
                                    <div class="card-body text-white d-flex align-items-center">
                                        <i class="icofont-clock-time fs-3"></i>
                                        <div class="d-flex flex-column ms-3">
                                            <h6 class="mb-0">OnHold Tickets</h6>
                                            <span class="text-white">{{ $onHoldTickets }}</span> 
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>             
                    </div>
                </div>
            </div>
        </div>             
    </div>
</div>
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script> 
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/page/hr.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>

    
    
@endsection
