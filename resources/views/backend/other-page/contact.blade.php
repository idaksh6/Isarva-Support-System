@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold py-3 mb-0">Contact</h3>
                            <div class="d-flex py-2 project-tab flex-wrap w-sm-100">
                                <ul class="nav nav-tabs tab-body-header rounded ms-3 prtab-set w-sm-100" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#list-view" role="tab">List View</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#grid-view" role="tab">Grid View</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> <!-- Row end  -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="list-view">
                        <div class="row clearfix g-3">
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h6 class="mb-0 fw-bold ">Contact Add</h6>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row g-3 mb-3">
                                              <div class="col-sm-12">
                                                <label for="fileimg" class="form-label">Contact Image</label>
                                                <input type="File" class="form-control" id="fileimg">
                                              </div>
                                              <div class="col-sm-12">
                                                <label for="depone" class="form-label">Person Name</label>
                                                <input type="text" class="form-control" id="depone">
                                              </div>
                                              <div class="col-sm-12">
                                                <label for="abc" class="form-label">Birthdate</label>
                                                <input type="date" class="form-control" id="abc">
                                              </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-sm-12">
                                                    <label for="deptwo" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="deptwo">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="deptwophone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="deptwophone">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Add Contact</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Person Name</th> 
                                                    <th>Birthdate</th>
                                                    <th>Email</th> 
                                                    <th>Phone</th>   
                                                    <th>Actions</th>  
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <td>
                                                    <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar1.jpg' }}" alt="">
                                                    <span class="fw-bold ms-1">Joan Dyer</span>
                                                </td>
                                                <td>
                                                        12/03/2021
                                                </td>
                                                <td>JoanDyer@gmail.com</td>
                                                <td>518-555-0145</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar2.jpg' }}" alt="">
                                                        <span class="fw-bold ms-1">Ryan	Randall</span>
                                                    </td>
                                                    <td>
                                                        12/03/2021
                                                </td>
                                                <td>RyanRandall@gmail.com</td>
                                                <td>617-555-0164</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td>
                                                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar3.jpg' }}" alt="">
                                                        <span class="fw-bold ms-1">Phil	Glover</span>
                                                    </td>
                                                    <td>
                                                        16/03/2021
                                                </td>
                                                <td>PhilGlover@gmail.com</td>
                                                <td>775-555-0117</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                   
                                                    <td>
                                                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar4.jpg' }}" alt="">
                                                        <span class="fw-bold ms-1">Victor Rampling</span>
                                                    </td>
                                                    <td>
                                                        25/02/2021
                                                    </td>
                                                    <td>VictorRampling@gmail.com</td>
                                                    <td>512-555-0189</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td>
                                                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar5.jpg' }}" alt="">
                                                        <span class="fw-bold ms-1">Sally Graham</span>
                                                    </td>
                                                    <td>
                                                        16/02/2021
                                                    </td>
                                                    <td>SallyGraham@gmail.com</td>
                                                    <td>303-555-0133</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    
                                                    <td>
                                                        <img class="avatar rounded-circle" src="{{ url('/').'/images/xs/avatar6.jpg' }}" alt="">
                                                        <span class="fw-bold ms-1">Robert Anderson</span>
                                                    </td>
                                                    <td>
                                                    18/01/2021
                                                    </td>
                                                    <td>RobertAnderson@gmail.com</td>
                                                    <td>402-555-0177</td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                            <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row End -->
                    </div>
                    <div class="tab-pane fade" id="grid-view">
                        <div class="row clearfix g-3">
                            <div class="col-lg-4">
                                <div class="card sticky-lg-top">
                                    <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                        <h6 class="mb-0 fw-bold ">Contact Add</h6>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row g-3 mb-3">
                                            <div class="col-sm-12">
                                                <label for="fileimg" class="form-label">Contact Image</label>
                                                <input type="File" class="form-control" id="fileimg">
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="depone" class="form-label">Person Name</label>
                                                <input type="text" class="form-control" id="depone">
                                            </div>
                                            <div class="col-sm-12">
                                                <label for="abc" class="form-label">Birthdate</label>
                                                <input type="date" class="form-control" id="abc">
                                            </div>
                                            </div>
                                            <div class="row g-3 mb-3">
                                                <div class="col-sm-12">
                                                    <label for="deptwo" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="deptwo">
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="deptwophone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="deptwophone">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Add Contact</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="row row-cols-sm-1 row-cols-md-2 row-col-lg-3 row-cols-xl-2 row-cols-xxl-3">
                                    <div class="col">
                                        <div class="card teacher-card mb-3 flex-column">
                                            <div class="card-body d-flex teacher-fulldeatil flex-column">
                                                <div class="profile-teacher text-center w220 mx-auto">
                                                    <a href="#">
                                                        <img src="{{ url('/').'/images/lg/avatar4.jpg' }}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                                    </a>
                                                    <button class="btn btn-primary" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit"></i></button>
                                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                                        <span class="text-muted small">Contact ID : Con-0001</span>
                                                    </div>
                                                </div>
                                                <div class="teacher-info   w-100">
                                                    <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">Adrian	Allan</h6>
                                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span>
                                                    <div class="row g-2 pt-2">
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-ui-touch-phone"></i>
                                                                <span class="ms-2">202-555-0174 </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-email"></i>
                                                                <span class="ms-2">adrianallan@gmail.com</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-birthday-cake"></i>
                                                                <span class="ms-2">19/03/1980</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-address-book"></i>
                                                                <span class="ms-2">775-555-0117</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card teacher-card mb-3 flex-column">
                                            <div class="card-body d-flex teacher-fulldeatil flex-column">
                                                <div class="profile-teacher text-center w220 mx-auto">
                                                    <a href="#">
                                                        <img src="{{ url('/').'/images/lg/avatar2.jpg' }}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                                    </a>
                                                    <button class="btn btn-primary" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#editprofile"><i class="icofont-edit"></i></button>
                                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                                        <span class="text-muted small">Contact ID : Con-0001</span>
                                                    </div>
                                                </div>
                                                <div class="teacher-info   w-100">
                                                    <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">Adrian	Allan</h6>
                                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span>
                                                    <div class="row g-2 pt-2">
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-ui-touch-phone"></i>
                                                                <span class="ms-2">202-555-0174 </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-email"></i>
                                                                <span class="ms-2">adrianallan@gmail.com</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-birthday-cake"></i>
                                                                <span class="ms-2">19/03/1980</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-address-book"></i>
                                                                <span class="ms-2">775-555-0117</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card teacher-card mb-3 flex-column">
                                            <div class="card-body d-flex teacher-fulldeatil flex-column">
                                                <div class="profile-teacher text-center w220 mx-auto">
                                                    <a href="#">
                                                        <img src="{{ url('/').'/images/lg/avatar1.jpg' }}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                                    </a>
                                                    <button class="btn btn-primary" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#editprofile"><i class="icofont-edit"></i></button>
                                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                                        <span class="text-muted small">Contact ID : Con-0001</span>
                                                    </div>
                                                </div>
                                                <div class="teacher-info   w-100">
                                                    <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">Adrian	Allan</h6>
                                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span>
                                                    <div class="row g-2 pt-2">
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-ui-touch-phone"></i>
                                                                <span class="ms-2">202-555-0174 </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-email"></i>
                                                                <span class="ms-2">adrianallan@gmail.com</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-birthday-cake"></i>
                                                                <span class="ms-2">19/03/1980</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-address-book"></i>
                                                                <span class="ms-2">775-555-0117</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card teacher-card mb-3 flex-column">
                                            <div class="card-body d-flex teacher-fulldeatil flex-column">
                                                <div class="profile-teacher text-center w220 mx-auto">
                                                    <a href="#">
                                                        <img src="{{ url('/').'/images/lg/avatar5.jpg' }}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                                    </a>
                                                    <button class="btn btn-primary" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#editprofile"><i class="icofont-edit"></i></button>
                                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                                        <span class="text-muted small">Contact ID : Con-0001</span>
                                                    </div>
                                                </div>
                                                <div class="teacher-info   w-100">
                                                    <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">Adrian	Allan</h6>
                                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span>
                                                    <div class="row g-2 pt-2">
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-ui-touch-phone"></i>
                                                                <span class="ms-2">202-555-0174 </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-email"></i>
                                                                <span class="ms-2">adrianallan@gmail.com</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-birthday-cake"></i>
                                                                <span class="ms-2">19/03/1980</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-address-book"></i>
                                                                <span class="ms-2">775-555-0117</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card teacher-card mb-3 flex-column">
                                            <div class="card-body d-flex teacher-fulldeatil flex-column">
                                                <div class="profile-teacher text-center w220 mx-auto">
                                                    <a href="#">
                                                        <img src="{{ url('/').'/images/lg/avatar6.jpg' }}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                                    </a>
                                                    <button class="btn btn-primary" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#editprofile"><i class="icofont-edit"></i></button>
                                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                                        <span class="text-muted small">Contact ID : Con-0001</span>
                                                    </div>
                                                </div>
                                                <div class="teacher-info   w-100">
                                                    <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">Adrian	Allan</h6>
                                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span>
                                                    <div class="row g-2 pt-2">
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-ui-touch-phone"></i>
                                                                <span class="ms-2">202-555-0174 </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-email"></i>
                                                                <span class="ms-2">adrianallan@gmail.com</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-birthday-cake"></i>
                                                                <span class="ms-2">19/03/1980</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-address-book"></i>
                                                                <span class="ms-2">775-555-0117</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card teacher-card mb-3 flex-column">
                                            <div class="card-body d-flex teacher-fulldeatil flex-column">
                                                <div class="profile-teacher text-center w220 mx-auto">
                                                    <a href="#">
                                                        <img src="{{ url('/').'/images/lg/avatar7.jpg' }}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                                    </a>
                                                    <button class="btn btn-primary" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#editprofile"><i class="icofont-edit"></i></button>
                                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                                        <span class="text-muted small">Contact ID : Con-0001</span>
                                                    </div>
                                                </div>
                                                <div class="teacher-info   w-100">
                                                    <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">Adrian	Allan</h6>
                                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span>
                                                    <div class="row g-2 pt-2">
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-ui-touch-phone"></i>
                                                                <span class="ms-2">202-555-0174 </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-email"></i>
                                                                <span class="ms-2">adrianallan@gmail.com</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-birthday-cake"></i>
                                                                <span class="ms-2">19/03/1980</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-address-book"></i>
                                                                <span class="ms-2">775-555-0117</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card teacher-card mb-3 flex-column">
                                            <div class="card-body d-flex teacher-fulldeatil flex-column">
                                                <div class="profile-teacher text-center w220 mx-auto">
                                                    <a href="#">
                                                        <img src="{{ url('/').'/images/lg/avatar8.jpg' }}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                                    </a>
                                                    <button class="btn btn-primary" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#editprofile"><i class="icofont-edit"></i></button>
                                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                                        <span class="text-muted small">Contact ID : Con-0001</span>
                                                    </div>
                                                </div>
                                                <div class="teacher-info   w-100">
                                                    <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">Adrian	Allan</h6>
                                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span>
                                                    <div class="row g-2 pt-2">
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-ui-touch-phone"></i>
                                                                <span class="ms-2">202-555-0174 </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-email"></i>
                                                                <span class="ms-2">adrianallan@gmail.com</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-birthday-cake"></i>
                                                                <span class="ms-2">19/03/1980</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-address-book"></i>
                                                                <span class="ms-2">775-555-0117</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card teacher-card mb-3 flex-column">
                                            <div class="card-body d-flex teacher-fulldeatil flex-column">
                                                <div class="profile-teacher text-center w220 mx-auto">
                                                    <a href="#">
                                                        <img src="{{ url('/').'/images/lg/avatar9.jpg' }}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                                    </a>
                                                    <button class="btn btn-primary" style="position: absolute;top:15px;right: 15px;" data-bs-toggle="modal" data-bs-target="#editprofile"><i class="icofont-edit"></i></button>
                                                    <div class="about-info d-flex align-items-center mt-3 justify-content-center flex-column">
                                                        <span class="text-muted small">Contact ID : Con-0001</span>
                                                    </div>
                                                </div>
                                                <div class="teacher-info   w-100">
                                                    <h6 class="mb-0 mt-2  fw-bold d-block fs-6 text-center">Adrian	Allan</h6>
                                                    <span class="py-1 fw-bold small-11 mb-0 mt-1 text-muted text-center mx-auto d-block">24 years, California</span>
                                                    <div class="row g-2 pt-2">
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-ui-touch-phone"></i>
                                                                <span class="ms-2">202-555-0174 </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-email"></i>
                                                                <span class="ms-2">adrianallan@gmail.com</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-birthday-cake"></i>
                                                                <span class="ms-2">19/03/1980</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center">
                                                                <i class="icofont-address-book"></i>
                                                                <span class="ms-2">775-555-0117</span>
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
                    </div>
                </div>
            </div>
        </div>

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script> 
    <script src="{{ asset('js/template.js') }}"></script>
    
@endsection
