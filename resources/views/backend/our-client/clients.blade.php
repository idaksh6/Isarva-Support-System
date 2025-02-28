@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card border-0 mb-4 no-bg">
                        <div class="card-header py-3 px-0 d-flex align-items-center justify-content-between border-bottom">
                            <h3 class="fw-bold flex-fill mb-0">Clients</h3>
                            <div class="col-auto d-flex">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                        Status
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton2">
                                        <li><a class="dropdown-item" href="#">Company</a></li>
                                        <li><a class="dropdown-item" href="#">AgilSoft Tech</a></li>
                                        <li><a class="dropdown-item" href="#">Macrosoft</a></li>
                                        <li><a class="dropdown-item" href="#">Google</a></li>
                                        <li><a class="dropdown-item" href="#">Pixelwibes</a></li>
                                        <li><a class="dropdown-item" href="#">Deltasoft Tech</a></li>
                                        <li><a class="dropdown-item" href="#">Design Tech</a></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-dark ms-1" data-bs-toggle="modal" data-bs-target="#createclient">
                                    <i class="icofont-plus-circle me-2 fs-6"></i>Add Client
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Row End -->

            <div class="row g-3 row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-2 row-deck py-1 pb-4">
                @foreach ($clients as $client)
                    <div class="col">
                        <div class="card teacher-card">
                            <div class="card-body d-flex">
                                <div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
                                <img src="{{ url($client->profile_image) }}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                    <div class="about-info d-flex align-items-center mt-1 justify-content-center flex-column">
                                        <h6 class="mb-0 fw-bold d-block fs-6 mt-2">{{ $client->client_pos_in_comp}}</h6>
                                        <div class="btn-group mt-2" role="group" aria-label="Basic outlined example">
                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editclient">
                                                <i class="icofont-edit text-success"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#deleteclient">
                                                <i class="icofont-ui-delete text-danger"></i>
                                            </button>
                                        </div>  
                                    </div>
                                </div>
                                <div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
                                    <h6 class="mb-0 mt-2 fw-bold d-block fs-6">{{ $client->company_name }}</h6>
                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">{{ $client->client_name }}</span>
                                    <div class="video-setting-icon mt-3 pt-3 border-top">
                                        <p>{{ $client->description }}</p>
                                    </div>
                                    <div class="d-flex flex-wrap align-items-center ct-btn-set">
                                        <!-- <a href="{{ route('admin.app.messages') }}" class="btn btn-dark btn-sm mt-1 me-1">
                                            <i class="icofont-ui-text-chat me-2 fs-6"></i>Chat
                                        </a> -->
                                        <a href="{{ route('admin.our-client.clients-profile') }}" class="btn btn-dark btn-sm mt-1">
                                            <i class="icofont-invisible me-2 fs-6"></i>Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div><!-- End row -->

        </div><!-- End container-xxl -->
    </div><!-- End body -->

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
