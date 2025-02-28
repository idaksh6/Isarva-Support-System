@extends('backend.layouts.app')

@section('title', __('chang'))

@section('content')
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center mb-4">
                <div class="col">
                    <!-- Pretitle -->
                    <h1 class="h4 mt-1">Changelog</h1>
                </div>
                <div class="col-auto">
                    <a href="#" title="" class="btn btn-white border lift">Get Support</a>
                    <a href="#" title="" class="btn btn-primary border lift">Our Portfolio</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center p-5">
                            <img src="{{ url('/').'/images/change-log.svg' }}"  class="img-fluid mx-size" alt="No Data">
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="pt-2">
                                <h6 class="d-inline-block"><span class="badge bg-warning font-weight-light">v1.0.0</span></h6>
                                <span class="text-muted">&nbsp;&nbsp;&nbsp;–-- July 30, 2021</span>
                                <ul class="ms-5">
                                    <li>Initial release of my-Task! Lots more coming soon though 😁</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection