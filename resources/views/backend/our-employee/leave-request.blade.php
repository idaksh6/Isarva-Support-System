@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Leave Request</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#leaveadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Leave</button>
                            </div>
                        </div>
                    </div>
                </div> <!-- Row end  -->
                <div class="row clearfix g-3">
                  <div class="col-sm-12">
                        <div class="card mb-3">
                            <div class="card-body">
                                <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Employee Id</th>
                                            <th>Employee Name</th>
                                            <th>Leave Type</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Reason</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.our-employee.members-profile') }}" class="fw-bold text-secondary">#EMP : 00001</a>
                                            </td>
                                           <td>
                                               <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar1.jpg'}}" alt="">
                                               <span class="fw-bold ms-1">Joan Dyer</span>
                                           </td>
                                           <td>
                                               Casual Leave
                                           </td>
                                           <td>
                                                12/03/2021
                                           </td>
                                           <td>
                                                14/03/2021
                                           </td>
                                           <td>
                                                Going to Holiday
                                           </td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#leaveapprove"><i class="icofont-check-circled text-success"></i></button>
                                                    <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#leavereject"><i class="icofont-close-circled text-danger"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.our-employee.members-profile') }}" class="fw-bold text-secondary">#EMP : 00038</a>
                                            </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar2.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Ryan	Randall</span>
                                            </td>
                                            <td>
                                                Casual Leave
                                            </td>
                                            <td>
                                                 11/04/2021
                                            </td>
                                            <td>
                                                 12/04/2021
                                            </td>
                                            <td>
                                                 Going to Holiday
                                            </td>
                                             <td>
                                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                     <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#leaveapprove"><i class="icofont-check-circled text-success"></i></button>
                                                     <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#leavereject"><i class="icofont-close-circled text-danger"></i></button>
                                                 </div>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td>
                                                <a href="{{ route('admin.our-employee.members-profile') }}" class="fw-bold text-secondary">#EMP : 00007</a>
                                            </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar3.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Phil	Glover</span>
                                            </td>
                                            <td>
                                                Medical Leave
                                            </td>
                                            <td>
                                                 11/04/2021
                                            </td>
                                            <td>
                                                 12/04/2021
                                            </td>
                                            <td>
                                                Going to Hospital
                                            </td>
                                             <td>
                                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                     <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#leaveapprove"><i class="icofont-check-circled text-success"></i></button>
                                                     <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#leavereject"><i class="icofont-close-circled text-danger"></i></button>
                                                 </div>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td>
                                                <a href="{{ route('admin.our-employee.members-profile') }}" class="fw-bold text-secondary">#EMP : 00010</a>
                                            </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar4.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Victor Rampling</span>
                                            </td>
                                            <td>
                                                Medical Leave
                                            </td>
                                            <td>
                                                 28/04/2021
                                            </td>
                                            <td>
                                                 30/04/2021
                                            </td>
                                            <td>
                                                Going to Hospital
                                            </td>
                                             <td>
                                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                     <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#leaveapprove"><i class="icofont-check-circled text-success"></i></button>
                                                     <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#leavereject"><i class="icofont-close-circled text-danger"></i></button>
                                                 </div>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td>
                                                <a href="{{ route('admin.our-employee.members-profile') }}" class="fw-bold text-secondary">#EMP : 00002</a>
                                            </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar5.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Sally Graham</span>
                                            </td>
                                            <td>
                                                Medical Leave
                                            </td>
                                            <td>
                                                 01/05/2021
                                            </td>
                                            <td>
                                                 06/05/2021
                                            </td>
                                            <td>
                                                Hospital Admit
                                            </td>
                                             <td>
                                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                     <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#leaveapprove"><i class="icofont-check-circled text-success"></i></button>
                                                     <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#leavereject"><i class="icofont-close-circled text-danger"></i></button>
                                                 </div>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td>
                                                <a href="{{ route('admin.our-employee.members-profile') }}" class="fw-bold text-secondary">#EMP : 00005</a>
                                            </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar6.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Robert Anderson</span>
                                            </td>
                                            <td>
                                                Medical Leave
                                            </td>
                                            <td>
                                                 03/05/2021
                                            </td>
                                            <td>
                                                 06/05/2021
                                            </td>
                                            <td>
                                                Hospital Admit
                                            </td>
                                             <td>
                                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                     <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#leaveapprove"><i class="icofont-check-circled text-success"></i></button>
                                                     <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#leavereject"><i class="icofont-close-circled text-danger"></i></button>
                                                 </div>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td>
                                                <a href="{{ route('admin.our-employee.members-profile') }}" class="fw-bold text-secondary">#EMP : 00014</a>
                                            </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar7.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Ryan	Stewart</span>
                                            </td>
                                            <td>
                                                Casual Leave
                                            </td>
                                            <td>
                                                 10/07/2021
                                            </td>
                                            <td>
                                                 18/08/2021
                                            </td>
                                            <td>
                                               Famaily Holiday
                                            </td>
                                             <td>
                                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                     <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#leaveapprove"><i class="icofont-check-circled text-success"></i></button>
                                                     <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#leavereject"><i class="icofont-close-circled text-danger"></i></button>
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
        </div>
    
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script> 
    <script src="{{ asset('js/template.js') }}"></script>

    <script>
    // project data table
    $(document).ready(function() {
        $('#myProjectTable')
        .addClass( 'nowrap' )
        .dataTable( {
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });
    });
    </script>
    
@endsection
