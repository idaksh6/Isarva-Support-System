@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Reviews</h3>
                            <div class="col-auto d-flex">
                                <div class="dropdown px-2">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort By
                                    </button>
                                    <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                        <li><a class="dropdown-item" href="#">Most Recent</a></li>
                                        <li><a class="dropdown-item" href="#">Positive First</a></li>
                                        <li><a class="dropdown-item" href="#">Negative First</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- Row end  -->
                <div class="row clearfix g-3">
                  <div class="col-sm-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row clearfix g-3">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="feedback-info sticky-top">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h2 class=" display-6 fw-bold mb-0">4.5</h2>
                                                    <small class="text-muted">based on 1,032 ratings</small>
                                                    <div class="d-flex align-items-center">
                                                        <span class="mb-2 me-3">
                                                            <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                            <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                            <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                            <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                            <a href="#" class="rating-link active"><i class="bi bi-star-half text-warning"></i></a>
                                                        </span>
                                                    </div>
                                                    <div class="progress-count mt-2">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <h6 class="mb-0 fw-bold d-flex align-items-center">5<i class="bi bi-star-fill text-warning ms-1 small-11 pb-1"></i></h6>
                                                            <span class="small text-muted">661</span>
                                                        </div>
                                                        <div class="progress" style="height: 10px;">
                                                            <div class="progress-bar light-success-bg" role="progressbar" style="width: 92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="progress-count mt-2">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <h6 class="mb-0 fw-bold d-flex align-items-center">4<i class="bi bi-star-fill text-warning ms-1 small-11 pb-1"></i></h6>
                                                            <span class="small text-muted">237</span>
                                                        </div>
                                                        <div class="progress" style="height: 10px;">
                                                            <div class="progress-bar bg-info-light" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="progress-count mt-2">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <h6 class="mb-0 fw-bold d-flex align-items-center">3<i class="bi bi-star-fill text-warning ms-1 small-11 pb-1"></i></h6>
                                                            <span class="small text-muted">76</span>
                                                        </div>
                                                        <div class="progress" style="height: 10px;">
                                                            <div class="progress-bar bg-lightyellow" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="progress-count mt-2">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <h6 class="mb-0 fw-bold d-flex align-items-center">2<i class="bi bi-star-fill text-warning ms-1 small-11 pb-1"></i></h6>
                                                            <span class="small text-muted">19</span>
                                                        </div>
                                                        <div class="progress" style="height: 10px;">
                                                            <div class="progress-bar light-danger-bg " role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="progress-count mt-2">
                                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                                            <h6 class="mb-0 fw-bold d-flex align-items-center">1<i class="bi bi-star-fill text-warning ms-1 small-11 pb-1"></i></h6>
                                                            <span class="small text-muted">39</span>
                                                        </div>
                                                        <div class="progress" style="height: 10px;">
                                                            <div class="progress-bar bg-careys-pink" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="customer-like mt-5">
                                                        <h6 class="mb-0 fw-bold ">What Customers Like</h6>
                                                        <ul class="list-group mt-3">
                                                            <li class="list-group-item d-flex">
                                                                <div class="number border-end pe-2 fw-bold">
                                                                    <strong class="color-light-success">1</strong>
                                                                </div>
                                                                <div class="cs-text flex-fill ps-2">
                                                                    <span>Fun Factor</span>
                                                                </div>
                                                                <div class="vote-text">
                                                                    <span class="text-muted">72 votes</span>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="number border-end pe-2 fw-bold">
                                                                    <strong class="color-light-success">2</strong>
                                                                </div>
                                                                <div class="cs-text flex-fill ps-2">
                                                                    <span>Great Value</span>
                                                                </div>
                                                                <div class="vote-text">
                                                                    <span class="text-muted">52 votes</span>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="number border-end pe-2 fw-bold">
                                                                    <strong class="color-light-success">3</strong>
                                                                </div>
                                                                <div class="cs-text flex-fill ps-2">
                                                                    <span>My Task</span>
                                                                </div>
                                                                <div class="vote-text">
                                                                    <span class="text-muted">35 votes</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="customer-like mt-5">
                                                        <h6 class="mb-0 fw-bold ">What Need Improvement</h6>
                                                        <ul class="list-group mt-3">
                                                            <li class="list-group-item d-flex">
                                                                <div class="number border-end pe-2 fw-bold">
                                                                    <strong class="color-careys-pink">1</strong>
                                                                </div>
                                                                <div class="cs-text flex-fill ps-2">
                                                                    <span>Value for Money</span>
                                                                </div>
                                                                <div class="vote-text">
                                                                    <span class="text-muted">12 votes</span>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="number border-end pe-2 fw-bold">
                                                                    <strong class="color-careys-pink">2</strong>
                                                                </div>
                                                                <div class="cs-text flex-fill ps-2">
                                                                    <span>Customer service</span>
                                                                </div>
                                                                <div class="vote-text">
                                                                    <span class="text-muted">8 votes</span>
                                                                </div>
                                                            </li>
                                                            <li class="list-group-item d-flex">
                                                                <div class="number border-end pe-2 fw-bold">
                                                                    <strong class="color-careys-pink">3</strong>
                                                                </div>
                                                                <div class="cs-text flex-fill ps-2">
                                                                    <span>Loding Item</span>
                                                                </div>
                                                                <div class="vote-text">
                                                                    <span class="text-muted">2 votes</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-8 col-md-12">
                                        <ul class="list-unstyled mb-4">
                                            <li class="card mb-2">
                                                <div class="card-body p-lg-4 p-3">
                                                    <div class="d-flex mb-3 pb-3 border-bottom flex-wrap">
                                                        <img class="avatar rounded-circle" src="{{ URL('/').'/images/xs/avatar4.jpg' }}" alt="">
                                                        <div class="flex-fill ms-3 text-truncate">
                                                            <h6 class="mb-0"><span>Peter Allan</span> <span class="text-muted small">1050 Followers</span></h6>
                                                            <span class="text-muted">3 hours ago</span>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <span class="mb-2 me-3">
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-half text-warning"></i></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item-post">
                                                        <h6 class="">The standard Lorem Ipsum passage, used since the 1500s</h6>
                                                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                                        <div class="mb-2 mt-4 text-end">
                                                            <a class="me-lg-2 me-1 btn btn-primary btn-sm" href="#"><i class="fa fa-thumbs-up"></i> <span class="d-none d-sm-none d-md-inline">Like (105)</span></a>
                                                            <a class="me-lg-2 me-1 btn btn-primary btn-sm" href="#"><i class="fa fa-comment"></i> <span class="d-none d-sm-none d-md-inline">Publice Comment</span></a>
                                                            <a class="btn btn-primary btn-sm" href="#"><i class="bi bi-chat-left-text-fill"></i> <span class="d-none d-sm-none d-md-inline">Direct Message</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> <!-- .Card End -->
                                            <li class="card mb-2">
                                                <div class="card-body p-lg-4 p-3">
                                                    <div class="d-flex mb-3 pb-3 border-bottom flex-wrap">
                                                        <img class="avatar rounded-circle" src="{{ URL('/').'/images/xs/avatar1.jpg' }}" alt="">
                                                        <div class="flex-fill ms-3 text-truncate">
                                                            <h6 class="mb-0"><span>Adrian Allan</span> <span class="text-muted small">650 Followers</span></h6>
                                                            <span class="text-muted">1 Day ago</span>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <span class="mb-2 me-3">
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-half text-warning"></i></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item-post">
                                                        <h6 class="">The standard Lorem Ipsum passage, used since the 1500s</h6>
                                                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                                        <div class="mb-2 mt-4 text-end">
                                                            <a class="me-lg-2 me-1 btn btn-primary btn-sm" href="#"><i class="fa fa-thumbs-up"></i> <span class="d-none d-sm-none d-md-inline">Like (105)</span></a>
                                                            <a class="me-lg-2 me-1 btn btn-primary btn-sm" href="#"><i class="fa fa-comment"></i> <span class="d-none d-sm-none d-md-inline">Publice Comment</span></a>
                                                            <a class="btn btn-primary btn-sm" href="#"><i class="bi bi-chat-left-text-fill"></i> <span class="d-none d-sm-none d-md-inline">Direct Message</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> <!-- .Card End -->
                                            <li class="card mb-2">
                                                <div class="card-body p-lg-4 p-3">
                                                    <div class="d-flex mb-3 pb-3 border-bottom flex-wrap">
                                                        <img class="avatar rounded-circle" src="{{ URL('/').'/images/xs/avatar2.jpg' }}" alt="">
                                                        <div class="flex-fill ms-3 text-truncate">
                                                            <h6 class="mb-0"><span>Benjamin Keith</span> <span class="text-muted small">458 Followers</span></h6>
                                                            <span class="text-muted">5 Day ago</span>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <span class="mb-2 me-3">
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                                <a href="#" class="rating-link active"><i class="bi bi-star-half text-warning"></i></a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="timeline-item-post">
                                                        <h6 class="">The standard Lorem Ipsum passage, used since the 1500s</h6>
                                                        <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                                        <div class="mb-2 mt-4 text-end">
                                                            <a class="me-lg-2 me-1 btn btn-primary btn-sm" href="#"><i class="fa fa-thumbs-up"></i> <span class="d-none d-sm-none d-md-inline">Like (105)</span></a>
                                                            <a class="me-lg-2 me-1 btn btn-primary btn-sm" href="#"><i class="fa fa-comment"></i> <span class="d-none d-sm-none d-md-inline">Publice Comment</span></a>
                                                            <a class="btn btn-primary btn-sm" href="#"><i class="bi bi-chat-left-text-fill"></i> <span class="d-none d-sm-none d-md-inline">Direct Message</span></a>
                                                        </div>
                                                        <div>
                                                            <div class="d-flex mt-3 pt-3 border-top">
                                                                <img class="avatar rounded-circle" src="{{ URL('/').'/images/xs/avatar3.jpg' }}" alt="">
                                                                <div class="flex-fill ms-3 text-truncate">
                                                                    <p class="mb-0"><span>Karen Clark</span> <small class="msg-time">5 Day ago</small></p>
                                                                    <span class="text-muted">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-4">
                                                            <textarea class="form-control" placeholder="Replay"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> <!-- .Card End -->
                                        </ul>
                                        <nav aria-label="...">
                                            <ul class="pagination justify-content-end">
                                              <li class="page-item disabled">
                                                <span class="page-link">Previous</span>
                                              </li>
                                              <li class="page-item"><a class="page-link" href="#">1</a></li>
                                              <li class="page-item active" aria-current="page">
                                                <span class="page-link">2</span>
                                              </li>
                                              <li class="page-item"><a class="page-link" href="#">3</a></li>
                                              <li class="page-item">
                                                <a class="page-link" href="#">Next</a>
                                              </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div><!-- Row End -->
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
