@extends('backend.layouts.app')

@section('title', 'Manage Clients | Isarva Support')


@section('content')



<!-- Create Client POP UP FORM-->
@if (session()->has('flash_success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
        <i class="bi bi-check-circle-fill me-2 text-success"></i> 
        <span>{{ session('flash_success') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="modal fade" id="createclient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createclientform" action="{{ route('admin.our-client.store-client') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Client Name<span class="required">*</span></label>
                        <input type="text" class="form-control" name="client_name" placeholder="Enter the Client Name" >
                        <div class="text-danger" id="clientadd_error-client_name"></div> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Company Name<span class="required">*</span></label>
                        <input type="text" class="form-control" name="company_name" placeholder="Enter Client Company" >
                        <div class="text-danger" id="clientadd_error-company_name"></div> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Client Designation in Company</label>
                        <input type="text" class="form-control" name="client_pos_in_comp" placeholder="Enter the client's designation in the company (e.g., CEO, Manager)">
                        <div class="text-danger" id="clientadd_error-client_pos_in_comp"></div> 
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profile Image</label>
                        <input class="form-control" type="file" name="profile_image">
                        <div class="text-danger" id="clientadd_error-profile_image"></div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label">User Name</label>
                            <input type="text" class="form-control" name="username" placeholder="User Name" >
                            <div class="text-danger" id="clientadd_error-username"></div>
                        </div>
                        <div class="col">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password"   autocomplete="new-password">>
                            <div class="text-danger" id="clientadd_error-password"></div>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col">
                            <label class="form-label">Email ID<span class="required">*</span></label>
                            <input type="email" class="form-control" name="email" placeholder="Email ID" >
                            <div class="text-danger" id="clientadd_error-email"></div>
                        </div>
                        <div class="col">
                            <label class="form-label">Phone<span class="required">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone Number" >
                            <div class="text-danger" id="clientadd_error-phone"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description (optional)</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Add any extra details about the client"></textarea>
                        
                    </div> 
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Save Client</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Edit Client-->
@if (session()->has('flash_success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
        <i class="bi bi-check-circle-fill me-2 text-success"></i> 
        <span>{{ session('flash_success') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="modal fade" id="editclient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="createprojectlLabelone">Edit Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-client-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="client_name" class="form-label">Client Name</label>
                        <input type="text" class="form-control" id="client_name" name="client_name">
                        <div class="text-danger" id="client-edit-error-client_name"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Client Designation in Company</label>
                        <input type="text" class="form-control" id="client_pos_in_comp" name="client_pos_in_comp" placeholder="Enter the client's designation in the company (e.g., CEO, Manager)">
                        <div class="text-danger" id="client-edit-error-client_pos_in_comp"></div>
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name">
                        <div class="text-danger" id="client-edit-error-company_name"></div>
                    </div>
                    <div class="deadline-form">
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="username" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="username" name="username">
                                <div class="text-danger" id="client-edit-error-username"></div>
                            </div>
                            <div class="col">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank to keep current password"  autocomplete="off">
                            
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="email" class="form-label">Email ID <span class="required">*</span></label>
                                <input type="email" class="form-control" id="email" name="email">
                                <div class="text-danger" id="client-edit-error-email"></div>
                            </div>
                            <div class="col">
                                <label for="phone" class="form-label">Phone<span class="required">*</span></label>
                                <input type="text" class="form-control" id="phone" name="phone">
                                <div class="text-danger" id="client-edit-error-phone"></div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description (optional)</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="profile_image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="profile_image" name="profile_image">
                        <!-- Display existing profile image -->
                        <div id="current-profile-image" class="mt-2">
                            <img src="" alt="Profile Image" class="img-thumbnail" width="100" style="display: none;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Delete Confirmation -->
<div class="modal fade" id="deleteclient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="deleteprojectLabel">Delete Item Permanently?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body justify-content-center flex-column d-flex">
                <i class="icofont-ui-delete text-danger display-2 text-center mt-2"></i>
                <p class="mt-4 fs-5 text-center">You can only delete this item permanently.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- Add a form for the delete action -->
                <form id="delete-client-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger color-fff">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div> 

    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row clearfix">
                <div class="col-md-12">

                    <!-- Search Bar -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <form method="GET" action="{{ route('admin.our-client.search-client') }}">
                                <div class="input-group">
                                    <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control client_search" placeholder="Search  " aria-label="Search">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>  


                    <div class="card border-0 mb-4 no-bg">
                        <div class="card-header py-3 px-0 d-flex align-items-center justify-content-between border-bottom">
                            <h3 class="fw-bold flex-fill mb-0">Clients</h3>
                            <div class="col-auto d-flex">
                                {{-- <div class="dropdown">
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
                                </div> --}}
                                <button type="button" class="btn btn-dark ms-1" data-bs-toggle="modal" data-bs-target="#createclient">
                                    <i class="icofont-plus-circle me-2 fs-6"></i>Add Client
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Row End -->

            <div class="row g-3 row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2 row-cols-xxl-2 row-deck py-1 pb-4 gobackprj_btn">
                @if($clients->count() > 0)
                @foreach ($clients as $client)
                    <div class="col">
                        <div class="card teacher-card">
                            <div class="card-body d-flex">
                                <div class="profile-av pe-xl-4 pe-md-2 pe-sm-4 pe-4 text-center w220">
                                <img src="{{ asset($client->profile_image) }}" alt="" class="avatar xl rounded-circle img-thumbnail shadow-sm">
                                    <div class="about-info d-flex align-items-center mt-1 justify-content-center flex-column">
                                        <h6 class="mb-0 fw-bold d-block fs-6 mt-2">{{ $client->client_pos_in_comp}}</h6>
                                        <div class="btn-group mt-2" role="group" aria-label="Basic outlined example">
                                            <button type="button" class="btn btn-outline-secondary edit-client-btn" data-id="{{ $client->id }}" data-bs-toggle="modal" data-bs-target="#editclient">
                                                <i class="icofont-edit text-success"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary delete-client-btn" data-id="{{ $client->id }}" data-bs-toggle="modal" data-bs-target="#deleteclient">
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
                @else
                
                   <div class="col-12 text-center py-5 mx-auto">
                     <div class="no-info-card ">
                       <i class="fa fa-info-circle fa-3x text-info mb-3"></i>
                       <h4 class="mb-2">No information found</h4>
                       <p class="text-muted">Sorry, we couldn't find any Client data at this time.</p>
                       <a href="{{ route('admin.our-client.clients') }}" class="btn btn-primary mt-3">Go Back</a>
                    </div>
                 </div>
               @endif
            </div><!-- End row -->

        </div><!-- End container-xxl -->
    </div><!-- End body -->

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    {{-- <script src = " {{ asset('js/sweetalert2@11.js')}}"></script> --}}
    <script src ="{{ asset('sweetalaertcdn/sweetalert2@11.js')}}"></script>

    <script>
        var editClientRoute = "{{ route('admin.our-client.edit-client', ':id') }}";
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Edit values populating code
        $(document).ready(function () {
            
            // When the edit button is clicked
            $('.edit-client-btn').on('click', function () {
                
                var clientId = $(this).data('id'); // Get the client ID from the data attribute
              
                // Generate the URL using the route name and client ID
                var url = editClientRoute.replace(':id', clientId);


                // Fetch client data via AJAX
                $.ajax({
                    url: url, // Use the dynamically generated URL
                    method: 'GET',
                    success: function (response) {
                        console.log(response);
                        // Populate the modal form with the fetched data
                        $('#client_name').val(response.client_name);
                        $('#client_pos_in_comp').val(response.client_pos_in_comp);
                        $('#company_name').val(response.company_name);
                        $('#username').val(response.user_name);
                        $('#email').val(response.email_id);
                        $('#phone').val(response.phone);
                        $('#description').val(response.description);

                        // Set the form action URL for updating
                        $('#edit-client-form').attr('action', "{{ route('admin.our-client.update-client', ':id') }}".replace(':id', clientId));

                        // Display the existing profile image
                        if (response.profile_image) {
                            $('#current-profile-image img')
                                .attr('src', "{{ asset('') }}" + response.profile_image) // Set the image source
                                .show(); // Show the image
                        } else {
                            $('#current-profile-image img').hide(); // Hide the image if no profile image exists
                        }
                    },
                    error: function (xhr) {
                        console.error('Error fetching client data:', xhr.responseText);
                    }
                });
            });

        });


    // When the delete button is clicked
    $('.delete-client-btn').on('click', function () {
        var clientId = $(this).data('id'); // Get the client ID from the data attribute

        // Set the form action dynamically
        var deleteUrl = "{{ route('admin.our-client.destroy-client', ':id') }}"; // Route with placeholder
        deleteUrl = deleteUrl.replace(':id', clientId); // Replace placeholder with actual ID

        // Update the form action
        $('#delete-client-form').attr('action', deleteUrl);
    });

    // Handle form submission
    $('#delete-client-form').on('submit', function (e) {
        e.preventDefault(); // Prevent the default form submission

        var form = $(this);
        var url = form.attr('action');

        // Send the delete request via AJAX
        $.ajax({
                    url: url,
                    method: 'POST', // Use POST method (Laravel handles DELETE via method spoofing)
                    data: form.serialize(), // Serialize the form data
                    success: function (response) {
                        if (response.success) {
                            // Show a success message
                            alert(response.message);

                            // Optionally, reload the page or remove the deleted client from the list
                            location.reload(); // Reload the page to reflect the changes
                        }
                    },
                    error: function (xhr) {
                        console.error('Error deleting client:', xhr.responseText);
                        alert('An error occurred while deleting the client.');
                    }
                });
            });

            // Client ADD form validation code
            $(document).ready(function () {
                $('#createclientform').on('submit', function (e) {
                    e.preventDefault();

                    var form = $(this);
                    var url = form.attr('action');
                    var formData = new FormData(form[0]);

                    $('.text-danger').html(''); // Clear errors

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                
                        success: function (response) {
                            // Show loading spinner (optional)
                            $('#createclient').modal('hide');
                        
                            // Then show success message
                            Swal.fire({
                                title: 'Success!',
                                text: 'Client created successfully!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = "{{ route('admin.our-client.clients') }}";
                            });
                        },
                        error: function (xhr) {
                        // Reopen modal if error occurs
                            $('#createclient').modal('show');
                            var errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                            $('#clientadd_error-' + key).html(value[0]);
                            });
                        }
                    });
                });


                          
                   //----- AJAX for Client-edit form Modal validation -----

                    $('#edit-client-form').on('submit', function(e) {
                        e.preventDefault();
                        var form = $(this);
                        var formData = new FormData(form[0]);

                            // Clear previous errors
                            $('.text-danger').html('');

                                $.ajax({
                                    url: form.attr('action'),
                                    type: 'POST',
                                    data: formData,
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                            // Close modal immediately
                                            $('#editclient').modal('hide');
                                            
                                            // Remove modal backdrop (fixes black background issue)
                                            $('body').removeClass('modal-open');
                                            $('.modal-backdrop').remove();

                                            // Show properly oriented success alert
                                            Swal.fire({
                                                title: 'Success!',
                                                html: '<div style="transform: scaleX(1)">Client has been updated!</div>',
                                                icon: 'success',
                                                timer: 2000, // 2 seconds
                                                timerProgressBar: true,
                                                showConfirmButton: false,
                                                position: 'center',
                                                willClose: () => {
                                                    window.location.reload();
                                                }
                                            });
                                        },
                                        error: function(xhr) {
                                            var errors = xhr.responseJSON.errors;
                                            if (errors) {
                                                $.each(errors, function(key, value) {
                                                    $('#client-edit-error-' + key).html(value[0]);
                                                });
                                            }
                                        }
                                    });
                                });
                


            });



            




            
    </script>

@endsection
