@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row clearfix g-3">
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
            
            
            
            <!-- Ticket Count section -->
            <div class="card">
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
                                        <h6 class="mb-0">Flagged Tickets</h6>
                                        <span class="text-white">{{ $flaggedTickets}}</span> 
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
