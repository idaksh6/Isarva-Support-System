@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Expenses</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Expenses</button>
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
                                            <th>Exp Id</th>
                                            <th>Item</th>
                                            <th>Order By</th> 
                                            <th>Date</th>
                                            <th>From</th> 
                                            <th>Status</th>   
                                            <th>Actions</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                #EX-00002
                                            </td>
                                            <td>
                                               Internet Payment
                                           </td>
                                           <td>
                                               <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar1.jpg'}}" alt="">
                                               <span class="fw-bold ms-1">Joan Dyer</span>
                                           </td>
                                           <td>
                                                12/03/2021
                                           </td>
                                           <td>Airtel Portal</td>
                                           <td><span class="badge bg-warning">In Progress</span></td>
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <button type="button" class="btn btn-outline-secondary"  data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                    <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                #EX-00006
                                            </td>
                                            <td>
                                                Keybord Order
                                            </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar2.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Ryan	Randall</span>
                                            </td>
                                            <td>
                                                12/03/2021
                                           </td>
                                           <td>Flipkart</td>
                                           <td><span class="badge bg-warning">In Progress</span></td>
                                             <td>
                                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                     <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                     <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                 </div>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td>
                                                #EX-00004
                                            </td>
                                            <td>
                                                Printer Repairing
                                            </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar3.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Phil	Glover</span>
                                            </td>
                                            <td>
                                                16/03/2021
                                           </td>
                                           <td>JustDial</td>
                                           <td><span class="badge bg-warning">In Progress</span></td>
                                             <td>
                                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                     <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                     <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                 </div>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td>
                                                #EX-00011
                                            </td>
                                            <td>
                                               Pen/book Order
                                             </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar4.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Victor Rampling</span>
                                            </td>
                                            <td>
                                                25/02/2021
                                            </td>
                                            <td>Flipkart</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                             <td>
                                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                     <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                     <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                 </div>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td>
                                                #EX-00018
                                            </td>
                                            <td>
                                                Food Order
                                              </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar5.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Sally Graham</span>
                                            </td>
                                            <td>
                                                16/02/2021
                                              </td>
                                            <td>Swiggy</td>
                                            <td><span class="badge bg-success">Completed</span></td>
                                             <td>
                                                 <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                     <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expedit"><i class="icofont-edit text-success"></i></button>
                                                     <button type="button" class="btn btn-outline-secondary deleterow"><i class="icofont-ui-delete text-danger"></i></button>
                                                 </div>
                                             </td>
                                         </tr>
                                         <tr>
                                            <td>
                                                #EX-00014
                                            </td>
                                            <td>
                                               Decoration Order
                                            </td>
                                            <td>
                                                <img class="avatar rounded-circle" src="{{url('/').'/images/xs/avatar6.jpg'}}" alt="">
                                                <span class="fw-bold ms-1">Robert Anderson</span>
                                            </td>
                                            <td>
                                              18/01/2021
                                            </td>
                                            <td>Flipkart</td>
                                            <td><span class="badge bg-success">Completed</span></td>
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
        $('.deleterow').on('click',function(){
        var tablename = $(this).closest('table').DataTable();  
        tablename
                .row( $(this)
                .parents('tr') )
                .remove()
                .draw();

        } );
    });
</script>

@endsection
