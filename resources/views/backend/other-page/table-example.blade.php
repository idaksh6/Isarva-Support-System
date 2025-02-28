@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Tables</h3>
                        </div>
                    </div>
                </div> <!-- Row end  -->

                <div class="row align-item-center">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Basic Table</h6> 
                            </div>
                            <div class="card-body basic-custome-color">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">3</th>
                                            <td>Larry the Bird</td>
                                            <td>Otto</td>
                                            <td>@twitter</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">4</th>
                                            <td>Wilson</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">5</th>
                                            <td>Alexander</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header py-3  bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Variants Table</h6> 
                                <p>Use contextual classes to color tables, table rows or individual cells.</p>
                            </div>
                            <div class="card-body  variants-custome-color">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                          <tr>
                                            <th scope="col">Class</th>
                                            <th scope="col">Heading</th>
                                            <th scope="col">Heading</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-primary">
                                              <th scope="row">Primary</th>
                                              <td>Cell</td>
                                              <td>Cell</td>
                                            </tr>
                                            <tr class="table-secondary">
                                              <th scope="row">Secondary</th>
                                              <td>Cell</td>
                                              <td>Cell</td>
                                            </tr>
                                            <tr class="table-success">
                                              <th scope="row">Success</th>
                                              <td>Cell</td>
                                              <td>Cell</td>
                                            </tr>
                                            <tr class="table-danger">
                                              <th scope="row">Danger</th>
                                              <td>Cell</td>
                                              <td>Cell</td>
                                            </tr>
                                            <tr class="table-warning">
                                              <th scope="row">Warning</th>
                                              <td>Cell</td>
                                              <td>Cell</td>
                                            </tr>
                                            <tr class="table-info">
                                              <th scope="row">Info</th>
                                              <td>Cell</td>
                                              <td>Cell</td>
                                            </tr>
                                            <tr class="table-light">
                                              <th scope="row">Light</th>
                                              <td>Cell</td>
                                              <td>Cell</td>
                                            </tr>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header py-3  bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Striped Table</h6> 
                                <p>Use <code>.table-striped</code> to add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>.</p>
                            </div>
                            <div class="card-body basic-custome-color">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">3</th>
                                            <td>Larry the Bird</td>
                                            <td>Otto</td>
                                            <td>@twitter</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">4</th>
                                            <td>Wilson</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">5</th>
                                            <td>Alexander</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header py-3  bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Hoverable Table</h6> 
                                <p>Add <code>.table-hover</code> to enable a hover state on table rows within a <code>&lt;tbody&gt;</code>.</p>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                          <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Last</th>
                                            <th scope="col">Handle</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <th scope="row">1</th>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">2</th>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">3</th>
                                            <td>Larry the Bird</td>
                                            <td>Otto</td>
                                            <td>@twitter</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">4</th>
                                            <td>Wilson</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                          </tr>
                                          <tr>
                                            <th scope="row">5</th>
                                            <td>Alexander</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-header py-3  bg-transparent border-bottom-0">
                                <h6 class="mb-0 fw-bold ">Datatable</h6> 
                            </div>
                            <div class="card-body">
                                <table id="patient-table" class="table table-hover align-middle mb-0" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Patients</th>
                                            <th>Age</th>
                                            <th>Adress</th>
                                            <th>Admited</th>
                                            <th>Discharge</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>PT-0001</td>
                                            <td><img src="{{ URL('/').'/images/xs/avatar3.jpg' }}" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Molly </span></td>
                                            <td>45</td>
                                            <td>70 Bowman St. South Windsor, CT 06074</td>
                                            <td>May 13, 2021</td>
                                            <td>May 16, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"> <span class="sr-only">40% Complete</span> </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-info">Admit</span></td>
                                        </tr>
                                        <tr>
                                            <td>PT-0011</td>
                                            <td><img src="{{ URL('/').'/images/xs/avatar1.jpg' }}" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Brian</span></td>
                                            <td>35</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>May 13, 2021</td>
                                            <td>May 22, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> <span class="sr-only">100% Complete</span> </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-success">Discharge</span></td>
                                        </tr>
                                        <tr>
                                            <td>PT-0045</td>
                                            <td><img src="{{ URL('/').'/images/xs/avatar2.jpg' }}" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Julia</span></td>
                                            <td>42</td>
                                            <td>4 Shirley Ave. West Chicago, IL 60185</td>
                                            <td>May 17, 2021</td>
                                            <td>May 16, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> <span class="sr-only">100% Complete</span> </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-success">Discharge</span></td>
                                        </tr>
                                        <tr>
                                            <td>PT-0030</td>
                                            <td><img src="{{ URL('/').'/images/xs/avatar4.jpg' }}" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Sonia</span></td>
                                            <td>25</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>May 13, 2021</td>
                                            <td>May 23, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-info" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%;"> <span class="sr-only">15% Complete</span> </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-info">Admit</span></td>
                                        </tr>
                                        <tr>
                                            <td>PT-0078</td>
                                            <td><img src="{{ URL('/').'/images/xs/avatar5.jpg' }}" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Adam H</span></td>
                                            <td>18</td>
                                            <td>4 Shirley Ave. West Chicago, IL 60185</td>
                                            <td>May 18, 2021</td>
                                            <td>May 18, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"> <span class="sr-only">85% Complete</span> </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-info">Admit</span></td>
                                        </tr>
                                        <tr>
                                            <td>PT-0098</td>
                                            <td><img src="{{ URL('/').'/images/xs/avatar9.jpg' }}" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Alexander</span></td>
                                            <td>38</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>May 13, 2021</td>
                                            <td>May 22, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> <span class="sr-only">100% Complete</span> </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-success">Discharge</span></td>
                                        </tr>
                                        <tr>
                                            <td>PT-0999</td>
                                            <td><img src="{{ URL('/').'/images/xs/avatar11.jpg' }}" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Gabrielle</span></td>
                                            <td>65</td>
                                            <td>4 Shirley Ave. West Chicago, IL 60185</td>
                                            <td>May 17, 2021</td>
                                            <td>May 16, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> <span class="sr-only">100% Complete</span> </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-success">Discharge</span></td>
                                        </tr>
                                        <tr>
                                            <td>PT-0101</td>
                                            <td><img src="{{ URL('/').'/images/xs/avatar12.jpg' }}" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Grace</span></td>
                                            <td>40</td>
                                            <td>4 Shirley Ave. West Chicago, IL 60185</td>
                                            <td>May 17, 2021</td>
                                            <td>May 16, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> <span class="sr-only">100% Complete</span> </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-success">Discharge</span></td>
                                        </tr>
                                        <tr>
                                            <td>PT-1001</td>
                                            <td><img src="{{ URL('/').'/images/xs/avatar8.jpg' }}" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Ryan </span></td>
                                            <td>34</td>
                                            <td>70 Bowman St. South Windsor, CT 06074</td>
                                            <td>May 13, 2021</td>
                                            <td>May 16, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"> <span class="sr-only">40% Complete</span> </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-info">Admit</span></td>
                                        </tr>
                                        <tr>
                                            <td>PT-1101</td>
                                            <td><img src="{{ URL('/').'/images/xs/avatar7.jpg' }}" class="avatar sm rounded-circle me-2" alt="profile-image"><span>Christian</span></td>
                                            <td>21</td>
                                            <td>123 6th St. Melbourne, FL 32904</td>
                                            <td>May 13, 2021</td>
                                            <td>May 22, 2021</td>
                                            <td>
                                                <div class="progress" style="height: 3px;">
                                                    <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> <span class="sr-only">100% Complete</span> </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-success">Discharge</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    </div>
                </div><!-- Row end  -->

            </div>
        </div>
    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script> 
    <script src="{{ asset('js/template.js') }}"></script>
    
@endsection
