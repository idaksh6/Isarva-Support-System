@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="card border-0 mb-4 no-bg">
                            <div class="card-header py-3 px-0 d-flex align-items-center  justify-content-between border-bottom">
                                <h3 class=" fw-bold flex-fill mb-0">Employee Profile</h3>
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
                <div class="row g-3">
                    <div class="col-xl-8 col-lg-12 col-md-12">
                        <div class="card teacher-card  mb-3">
                            <div class="card-body  d-flex teacher-fulldeatil">
                                <div class="profile-teacher pe-xl-4 pe-md-2 pe-sm-4 pe-0 text-center w220 mx-sm-0 mx-auto">
                                    <a href="#">
                                        <img src="{{url('/').'/images/lg/avatar3.jpg'}}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                    </a>
                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                        <h6 class="mb-0 fw-bold d-block fs-6">Web Developer</h6>
                                        <span class="text-muted small">Employee Id : 00001</span>
                                    </div>
                                </div>
                                <div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">
                                    <h6  class="mb-0 mt-2  fw-bold d-block fs-6">Luke Short</h6>
                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">Web Designer</span>
                                    <p class="mt-2 small">The purpose of lorem ipsum is to create a natural looking block of text (sentence, paragraph, page, etc.) that doesn't distract from the layout. A practice not without controversy</p>
                                    <div class="row g-2 pt-2">
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-ui-touch-phone"></i>
                                                <span class="ms-2 small">202-555-0174 </span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-email"></i>
                                                <span class="ms-2 small">LukeShortn@gmail.com</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-birthday-cake"></i>
                                                <span class="ms-2 small">19/03/1980</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-5">
                                            <div class="d-flex align-items-center">
                                                <i class="icofont-address-book"></i>
                                                <span class="ms-2 small">2734  West Fork Street,EASTON 02334.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6 class="fw-bold  py-3 mb-3">Current Work Project</h6>
                        <div class="teachercourse-list">
                            <div class="row g-3 gy-5 py-3 row-deck">
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mt-5">
                                                <div class="lesson_name">
                                                    <div class="project-block light-info-bg">
                                                        <i class="icofont-paint"></i>
                                                    </div>
                                                    <span class="small text-muted project_name fw-bold"> Social Geek Made </span>
                                                    <h6 class="mb-0 fw-bold  fs-6  mb-2">UI/UX Design</h6>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-list avatar-list-stacked pt-2">
                                                    <img class="avatar rounded-circle sm" src="{{url('/').'/images/xs/avatar2.jpg'}}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{url('/').'/images/xs/avatar1.jpg'}}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{url('/').'/images/xs/avatar3.jpg'}}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{url('/').'/images/xs/avatar4.jpg'}}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{url('/').'/images/xs/avatar8.jpg'}}" alt="">
                                                </div>
                                            </div>
                                            <div class="row g-2 pt-4">
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-paper-clip"></i>
                                                        <span class="ms-2">5 Attach</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-sand-clock"></i>
                                                        <span class="ms-2">4 Month</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-group-students "></i>
                                                        <span class="ms-2">5 Members</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-ui-text-chat"></i>
                                                        <span class="ms-2">10</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dividers-block"></div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h4 class="small fw-bold mb-0">Progress</h4>
                                                <span class="small light-danger-bg  p-1 rounded"><i class="icofont-ui-clock"></i> 35 Days Left</span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary ms-1" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary ms-1" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mt-5">
                                                <div class="lesson_name">
                                                    <div class="project-block bg-lightgreen">
                                                        <i class="icofont-vector-path"></i>
                                                    </div>
                                                    <span class="small text-muted project_name fw-bold"> Practice to Perfect </span>
                                                    <h6 class="mb-0 fw-bold  fs-6  mb-2">Website Design</h6>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-list avatar-list-stacked pt-2">
                                                    <img class="avatar rounded-circle sm" src="{{url('/').'/images/xs/avatar2.jpg'}}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{url('/').'/images/xs/avatar1.jpg'}}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{url('/').'/images/xs/avatar3.jpg'}}" alt="">
                                                    <img class="avatar rounded-circle sm" src="{{url('/').'/images/xs/avatar4.jpg'}}" alt="">
                                                </div>
                                            </div>
                                            <div class="row g-2 pt-4">
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-paper-clip"></i>
                                                        <span class="ms-2">4 Attach</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-sand-clock"></i>
                                                        <span class="ms-2">1 Month</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-group-students "></i>
                                                        <span class="ms-2">4 Members</span>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex align-items-center">
                                                        <i class="icofont-ui-text-chat"></i>
                                                        <span class="ms-2">3</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dividers-block"></div>
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <h4 class="small fw-bold mb-0">Progress</h4>
                                                <span class="small light-danger-bg  p-1 rounded"><i class="icofont-ui-clock"></i> 15 Days Left</span>
                                            </div>
                                            <div class="progress" style="height: 8px;">
                                                <div class="progress-bar bg-secondary" role="progressbar" style="width: 25%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary ms-1" role="progressbar" style="width: 25%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                                <div class="progress-bar bg-secondary ms-1" role="progressbar" style="width: 39%" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between">
                                        <h6 class="mb-0 fw-bold ">Personal Informations</h6>
                                        <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#edit1"><i class="icofont-edit text-primary fs-6"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6"> 
                                                    <span class="fw-bold">Nationality</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">Indian</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6"> 
                                                    <span class="fw-bold">Religion</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">Hindu</span>
                                                </div>
                                             </li>
                                             <li class="row flex-wrap mb-3">
                                                <div class="col-6"> 
                                                    <span class="fw-bold">Marital Status</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">Married</span>
                                                </div>
                                             </li>
                                             <li class="row flex-wrap mb-3">
                                                <div class="col-6"> 
                                                    <span class="fw-bold">Passport No.</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">5468953210</span>
                                                </div>
                                             </li>
                                             <li class="row flex-wrap">
                                                <div class="col-6"> 
                                                    <span class="fw-bold">Emergency Contact</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">7468953210</span>
                                                </div>
                                             </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between">
                                        <h6 class="mb-0 fw-bold ">Bank information</h6>
                                        <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#edit2"><i class="icofont-edit text-primary fs-6"></i></button>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6"> 
                                                    <span class="fw-bold">Bank Name</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">Kotak</span>
                                                </div>
                                            </li>
                                            <li class="row flex-wrap mb-3">
                                                <div class="col-6"> 
                                                    <span class="fw-bold">Account No.</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">5436874596325486</span>
                                                </div>
                                             </li>
                                             <li class="row flex-wrap mb-3">
                                                <div class="col-6"> 
                                                    <span class="fw-bold">IFSC Code</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">Kotak000021</span>
                                                </div>
                                             </li>
                                             <li class="row flex-wrap mb-3">
                                                <div class="col-6"> 
                                                    <span class="fw-bold">Pan No</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">ACQPF6584L</span>
                                                </div>
                                             </li>
                                             <li class="row flex-wrap">
                                                <div class="col-6"> 
                                                    <span class="fw-bold">UPI Id</span>
                                                </div>
                                                <div class="col-6">
                                                    <span class="text-muted">454812kotak@upi</span>
                                                </div>
                                             </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12">
                        <div class="card mb-3">
                            <div class="card-header py-3">
                                <h6 class="mb-0 fw-bold ">Current Task</h6>
                            </div>
                            <div class="card-body">
                                <div class="planned_task client_task">
                                    <div class="dd" data-plugin="nestable">
                                        <ol class="dd-list">
                                            <li class="dd-item mb-3">
                                                <div class="dd-handle">
                                                    <div class="task-info d-flex align-items-center justify-content-between">
                                                        <h6 class="light-info-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">UI/UX Design</h6>
                                                        <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                            <div class="avatar-list avatar-list-stacked m-0">
                                                                <img class="avatar rounded-circle small-avt sm" src="{{url('/').'/images/xs/avatar2.jpg'}}" alt="">
                                                                <img class="avatar rounded-circle small-avt sm" src="{{url('/').'/images/xs/avatar1.jpg'}}" alt="">
                                                            </div>
                                                            <span class="badge bg-warning text-end mt-1">Inprogress</span>
                                                        </div>
                                                    </div>
                                                    <p class="py-2 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id
                                                        nec scelerisque massa.</p>
                                                    <div class="tikit-info row g-3 align-items-center">
                                                        <div class="col-sm">
                                                        </div>
                                                        <div class="col-sm text-end">
                                                            <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small"> Social Geek Made </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </li>
                                            <li class="dd-item">
                                                <div class="dd-handle">
                                                    <div class="task-info d-flex align-items-center justify-content-between">
                                                        <h6 class="bg-lightgreen py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">Website Design
                                                        </h6>
                                                        <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                            <div class="avatar-list avatar-list-stacked m-0">
                                                                <img class="avatar rounded-circle small-avt sm" src="{{url('/').'/images/xs/avatar7.jpg'}}" alt="">
                                                            </div>
                                                            <span class="badge bg-danger text-end mt-1">Review</span>
                                                        </div>
                                                    </div>
                                                    <p class="py-2 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id
                                                        nec scelerisque massa.</p>
                                                    <div class="tikit-info row g-3 align-items-center">
                                                        <div class="col-sm">
                                                        </div>
                                                        <div class="col-sm text-end">
                                                            <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small"> Practice to Perfect </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header py-3">
                                <h6 class="mb-0 fw-bold ">Experience</h6>
                            </div>
                            <div class="card-body">
                                <div class="timeline-item ti-danger border-bottom ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">PW</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Pixel Wibes</strong></div>
                                            <span class="d-flex text-muted">Jan 2016 - Present (5 years 2 months)</span>
                                        </div>
                                    </div>
                                </div> <!-- timeline item end  -->
                                <div class="timeline-item ti-info border-bottom ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">CC</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Crest Coder</strong></div>
                                            <span class="d-flex text-muted">Dec 2015 - 2016 (1 years)</span>
                                        </div>
                                    </div>
                                </div> <!-- timeline item end  -->
                                <div class="timeline-item ti-success  ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-lavender-purple">MW</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>Morning Wibe</strong></div>
                                            <span class="d-flex text-muted">Nov 2014 - 2015 (1 years)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="timeline-item ti-danger border-bottom ms-2">
                                    <div class="d-flex">
                                        <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">FF</span>
                                        <div class="flex-fill ms-3">
                                            <div class="mb-1"><strong>FebiFlue</strong></div>
                                            <span class="d-flex text-muted">Jan 2010 - 2009 (1 years)</span>
                                        </div>
                                    </div>
                                </div> <!-- timeline item end  -->
                            </div>
                        </div>
                    </div>
                </div><!-- Row End -->
               
            </div>
        </div>
    
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
