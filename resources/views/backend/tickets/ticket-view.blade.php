@extends('backend.layouts.app')
{{-- @include('backend.layouts.common-oppup') --}}

@section('title', __('Dashboard'))

@section('content')

<style>
    /* Css for select2 */
    .select2-container .select2-selection--single {
        height: 38px;
        padding: 5px 10px;
        border-radius: 4px;
      
    }
    .select2-selection__clear{
    
        border: 0px; 
        padding-right: 20px; 
        /* background: none; */
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 4px !important;
        right: 1px;
        width: 20px;
    }
</style>

    @if (session('flash_success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('flash_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Tickets</h3>
                        <div class="col-auto d-flex w-sm-100">
                            <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#tickadd"><i class="icofont-plus-circle me-2 fs-6"></i>Add Tickets</button>
                        </div>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row clearfix g-3">
                
                <div class="col-sm-12">
                    {{-- Search filter --}}
                    <div class="card mb-2">
                        <div class="card-header">
                            <h5 class="fw-bold py-2"><i class="fa fa-search"></i> Search Tickets</h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ route('admin.ticket.ticket-view') }}">
                                <div class="row g-3">
                                    <!-- Search Input -->
                                    <div class="col-md-4 ">
                                        <label for="q" class="form-label ">Search</label>
                                        <div class="input-group">
                                            <input type="text" name="q" value="{{ $q ?? '' }}" class="form-control ticket_search " placeholder="Search by Ticket Title, Ticket No, Domain" aria-label="Search">
                                            <button class="btn btn-primary my-1" type="submit">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </div>
                                    </div>
                            
                                    <!-- Month and Year Selection -->
                                    <div class="col-md-4">
                                        <label for="month_year" class="form-label">Month & Year</label>
                                        <input type="month" class="form-control" name="month_year" id="month-year" value="{{ request('month_year') }}">
                                    </div>
                            
                            
                                    <!-- Assigned To -->
                                    <div class="col-md-4">
                                        <label for="assignedTo" class="form-label">Assigned To</label>
                                        <select class="form-select" name="assignedTo" id="assignedTo">
                                            <option value="">Select Assigned To</option>
                                            @foreach($employees as $id => $name)
                                                <option value="{{ $id }}" {{ request('assignedTo') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            
                                    <!-- Department -->
                                    <div class="col-md-4">
                                        <label for="department" class="form-label">Department</label>
                                        <select class="form-select" id="department" name="department">
                                            <option value="">Select Department</option>
                                            <@foreach($department as $id => $name)
                                                <option value="{{ $id }}" {{ request('department') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Priority -->
                                    <div class="col-md-4">
                                        <label for="priority" class="form-label">Priority</label>
                                        <select class="form-select" id="priority" name="priority">
                                            <option value="">Select Priority</option>
                                            <@foreach($priority as $id => $name)
                                                <option value="{{ $id }}" {{ request('priority') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- status -->
                                    <div class="col-md-4">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" name="status" id="status">
                                            <option value="">Select Status</option>
                                            @foreach($status as $id => $name)
                                                <option value="{{ $id }}" {{ request('status') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Search Button -->
                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary float-start">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                        <a href="{{ route('admin.ticket.ticket-view') }}" class="btn btn-secondary float-start mx-2">
                                            <i class="fa fa-times"></i> Clear
                                        </a>
                                    </div>
                                    
                                </div> 
                            </form>
                            
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Ticket Id</th>
                                        <th>Subject</th>
                                        <th>Assigned</th> 
                                        <th>Created Date</th> 
                                        <th>Status</th>   
                                        <th>Priority</th>
                                        <th>Department</th>
                                        <th>Actions</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($tickets))
                                        
                                    
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td>
                                                <a href="{{ route('admin.ticket.ticket-detail', $ticket->id) }}" class="fw-bold text-secondary">#Tc-{{ $ticket->id }}</a>
                                            </td>
                                            <td>
                                                {{ $ticket->title }}
                                            </td>
                                            <td>
                                                @php
                                                    $profileImg=\App\Helpers\ClientHelper::ProfileImg($ticket->flag_to);

                                                @endphp
                                                <img class="avatar rounded-circle" 
                                                src="{{ $profileImg ? url('/').'/'.$profileImg : url('/images/xs/avatar1.jpg') }}" 
                                                alt="Profile Image">
                                                @foreach ($employees as $id=>$name)
                                                    {{-- <span class="fw-bold ms-1">{{ $id == $ticket->flag_to ? $name : '' }}</span> --}}
                                                    {{ $id == $ticket->flag_to ? $name : '' }}
                                                @endforeach
                                                
                                            </td>
                                            <td>
                                                {{ $ticket->created_at->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                @if ($ticket->status==2)
                                                    <span class="badge bg-info text-white  rounded-pill">
                                                         Progress
                                                    </span>
                                                @elseif ($ticket->status==3)
                                                    <span class="badge bg-warning text-white  rounded-pill">
                                                         On Hold
                                                    </span>
                                                @elseif ($ticket->status==4)
                                                    <span class="badge bg-success text-white  rounded-pill">
                                                         Monitor
                                                    </span>
                                                @elseif ($ticket->status==5)
                                                    <span class="badge bg-success text-white  rounded-pill">
                                                         Assigned
                                                    </span>
                                                @elseif ($ticket->status==6)
                                                    <span class="badge bg-danger text-white  rounded-pill">
                                                         Awaiting for Client Response
                                                    </span>
                                                @elseif ($ticket->status==7)
                                                    <span class="badge bg-danger text-white  rounded-pill">
                                                         Closed
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning text-white  rounded-pill">
                                                         Open
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($ticket->priority==1)
                                                    <span class="badge bg-danger">High</span>  
                                                @elseif ($ticket->priority==2)
                                                    <span class="badge bg-info">Medium</span> 
                                                @else
                                                    <span class="badge bg-warning">Low</span> 
                                                @endif
                                            </td>
                                            <td>
                                                @if ($ticket->department==1)
                                                    <span class="badge bg-warning">Development</span>  
                                                @elseif ($ticket->department==2)
                                                    <span class="badge bg-info">Billing</span> 
                                                @elseif ($ticket->department==3)
                                                    <span class="badge bg-success">Graphics</span> 
                                                @else
                                                    <span class="badge bg-primary">Other Support</span> 
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                    <button type="button" class="btn btn-outline-secondary edit-ticket-btn" data-id="{{ $ticket->id }}" data-bs-toggle="modal" data-bs-target="#editticket">
                                                        <i class="icofont-edit text-success"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary delete-ticket-btn" data-id="{{ $ticket->id }}" data-bs-toggle="modal" data-bs-target="#deleteticket">
                                                        <i class="icofont-ui-delete text-danger"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- Row End -->
        </div>
    </div>

    <!-- Add Ticket updated to View by - AK -->
    <div class="modal fade" id="tickadd" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="leaveaddLabel">Ticket Add</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.ticket.ticket-store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="client" class="form-label">Client<span class="required">*</span></label>
                            <select class="form-select select2" name="client" id="client" required>
                                <option value="">Select Client</option>
                                @foreach($clients as $id => $client_name)
                                    <option value="{{ $id }}" {{ request('client') == $id ? 'selected' : '' }}>{{ $client_name }}</option>
                                @endforeach
                            </select>
                            {{-- <input type="text" class="form-control" id="client" name="client" required> --}}
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title<span class="required">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="domain" class="form-label">Domain</label>
                            <input type="text" class="form-control" id="domain" name="domain">
                        </div>
                        <div class="mb-3">
                            <label for="tag" class="form-label">Tag</label>
                            <select class="form-select " id="tag" name="tag">
                                <option value="1">Bug Report</option>
                                <option value="2">Question</option>
                                <option value="3">Reminder</option>
                                <option value="4">Incident</option>
                                <option value="5">Problem</option>
                                <option value="6">Feature Request</option>
                                <option value="7">Request</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="source" class="form-label">Source</label>
                            <select class="form-select" id="source" name="source">
                                <option value="1">Email</option>
                                <option value="2">Call</option>
                                <option value="3">Meeting</option>
                                <option value="4">Chat</option>
                                <option value="5">WhatsApp</option>
                                <option value="6">Direct</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority<span class="required">*</span></label>
                            <select class="form-select" id="priority" name="priority" required>
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="project" class="form-label">Project</label>
                            <select class="form-select select2" name="project" id="project">
                                <option value="">Select Project</option>
                                @foreach($projects as $id => $project_name)
                                    <option value="{{ $id }}" {{ request('project') == $id ? 'selected' : '' }}>{{ $project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description<span class="required">*</span></label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="privacy" class="form-label">Privacy<span class="required">*</span></label>
                            <select class="form-select" id="privacy" name="privacy" required>
                                <option value="1">Private</option>
                                <option value="2">Public</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="assignedTo" class="form-label">Assigned To<span class="required">*</span></label>
                            <select class="form-select select2" name="assignedTo" id="assignedTo" required>
                                <option value="">Select Employee</option>
                                @foreach($employees as $id => $name)
                                    <option value="{{ $id }}" {{ request('assignedTo') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="dueDate" class="form-label">Due Date<span class="required">*</span></label>
                            <input type="date" class="form-control" id="dueDate" name="dueDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="department" class="form-label">Department<span class="required">*</span></label>
                            <select class="form-select" id="department" name="department" required>
                                <option value="1">Development</option>
                                <option value="2">Billing</option>
                                <option value="3">Graphics</option>
                                <option value="4">Other Support</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="attachment" class="form-label">Attachment</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Ticket-->
    <div class="modal fade" id="editticket" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="edittickitLabel">Ticket Edit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-ticket-form" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="t_id" id="t_id">
                        
                        <div class="mb-3">
                            <label for="t_client" class="form-label">Client<span class="required">*</span></label>
                            <select class="form-select select2" name="t_client" id="t_client" required>
                                <option value="">Select Client</option>
                                @foreach($clients as $id => $client_name)
                                    <option value="{{ $id }}" {{ request('t_client') == $id ? 'selected' : '' }}>{{ $client_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="t_title" class="form-label">Title<span class="required">*</span></label>
                            <input type="text" class="form-control" id="t_title" name="t_title" required>
                        </div>
                        <div class="mb-3">
                            <label for="t_domain" class="form-label">Domain</label>
                            <input type="text" class="form-control" id="t_domain" name="t_domain">
                        </div>
                        <div class="mb-3">
                            <label for="t_tag" class="form-label">Tag</label>
                            <select class="form-select" id="t_tag" name="t_tag">
                                <option value="1">Bug Report</option>
                                <option value="2">Question</option>
                                <option value="3">Reminder</option>
                                <option value="4">Incident</option>
                                <option value="5">Problem</option>
                                <option value="6">Feature Request</option>
                                <option value="7">Request</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="t_source" class="form-label">Source</label>
                            <select class="form-select" id="t_source" name="t_source">
                                <option value="1">Email</option>
                                <option value="2">Call</option>
                                <option value="3">Meeting</option>
                                <option value="4">Chat</option>
                                <option value="5">WhatsApp</option>
                                <option value="6">Direct</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="t_priority" class="form-label">Priority<span class="required">*</span></label>
                            <select class="form-select" id="t_priority" name="t_priority" required>
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="t_project" class="form-label">Project</label>
                            <select class="form-select select2" name="t_project" id="t_project">
                                <option value="">Select Project</option>
                                @foreach($projects as $id => $project_name)
                                    <option value="{{ $id }}" {{ request('t_project') == $id ? 'selected' : '' }}>{{ $project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="t_description" class="form-label">Description<span class="required">*</span></label>
                            <textarea class="form-control" id="t_description" name="t_description" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="t_privacy" class="form-label">Privacy<span class="required">*</span></label>
                            <select class="form-select" id="t_privacy" name="t_privacy" required>
                                <option value="1">Private</option>
                                <option value="2">Public</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="t_assignedTo" class="form-label">Assigned To<span class="required">*</span></label>
                            <select class="form-select select2" name="t_assignedTo" id="t_assignedTo" required>
                                <option value="">Select Assigned To</option>
                                @foreach($employees as $id => $name)
                                
                                    <option value="{{ $id }}" {{ request('t_assignedTo') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="t_dueDate" class="form-label">Due Date<span class="required">*</span></label>
                            <input type="date" class="form-control" id="t_dueDate" name="t_dueDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="t_department" class="form-label">Department<span class="required">*</span></label>
                            <select class="form-select" id="t_department" name="t_department" required>
                                <option value="1">Development</option>
                                <option value="2">Billing</option>
                                <option value="3">Graphics</option>
                                <option value="4">Other Support</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="t_attachment" class="form-label">Attachment</label>
                            <input type="file" class="form-control" id="t_attachment" name="t_attachment">
                        </div>
                        <div class="d-flex align-items-center gap-2 attachment-div">
                            <i class="icofont-paperclip text-muted"></i>
                            <a id="attachment-link" href="#" class="text-decoration-none small" target="_blank" style="display: none;">
                                View Attachment
                            </a>
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


    <div class="modal fade" id="deleteticket" tabindex="-1" aria-hidden="true">
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
                    <form id="delete-ticket-form" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger color-fff">Delete</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>    
    <script src="{{ asset('js/template.js') }}"></script>
   
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script> 
 
    <script src="{{ asset('assets/plugins/bootstrap/bootstrap.bundle.min.js')}}"></script>
    


      




    <script>
        var editTicketRoute = "{{ route('admin.ticket.edit-ticket', ':id') }}";
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

   

    <script>

            $(document).ready(function () {
                    $('#tickadd').on('shown.bs.modal', function () {
                        $(this).find('.select2').select2({
                            dropdownParent: $('#tickadd')
                        });
                    });
                });

                $('#editticket').on('shown.bs.modal', function () {
                        $(this).find('.select2').select2({
                            dropdownParent: $('#editticket')
                        });
                    });



        $(document).ready(function () {
            
            // When the edit button is clicked
            $('.edit-ticket-btn').on('click', function () {
                
                
                var ticketId = $(this).data('id'); // Get the client ID from the data attribute
                
                // Generate the URL using the route name and client ID
                var url = editTicketRoute.replace(':id', ticketId);


                // Fetch client data via AJAX
                $.ajax({
                    url: url, // Use the dynamically generated URL
                    method: 'GET',
                    success: function (response) {
                        console.log(response.end_date);

                        // Populate form fields
                        $('#t_client').val(response.client);
                        $('#t_title').val(response.title);
                        $('#t_domain').val(response.domain);
                        $('#t_tag').val(response.type); // Assuming 'type' corresponds to 'tag'
                        $('#t_source').val(response.source);
                        $('#t_priority').val(response.priority);
                        $('#t_project').val(response.project);
                        $('#t_description').val(response.comments); // Assuming 'comments' corresponds to 'description'
                        $('#t_privacy').val(response.privacy);
                        $('#t_assignedTo').val(response.flag_to); // Assuming 'flag_to' corresponds to 'Assigned To'
                        //$('#t_dueDate').val(response.end_date);
                        $('#t_department').val(response.department);
                        if (response.end_date) {
                            let dateObj = new Date(response.end_date);
                            let formattedDate = dateObj.getFullYear() + "-" + 
                                                ("0" + (dateObj.getMonth() + 1)).slice(-2) + "-" + 
                                                ("0" + dateObj.getDate()).slice(-2);
                            $('#t_dueDate').val(formattedDate);
                        }

                        if (response.attachment) {
                            let attachmentUrl = "{{ asset('images/ticket_attachments/') }}" + "/" + response.attachment;
                            $('#attachment-link').attr('href', attachmentUrl).text('View Attachment').show();
                            $(".attachment-div").removeClass("d-none");
                        } else {
                            $('#attachment-link').hide();
                            $(".attachment-div").addClass("d-none");
                        }

                        // Set the form action URL for updating
                        $('#edit-ticket-form').attr('action', "{{ route('admin.ticket.update-ticket', ':id') }}".replace(':id', response.id));

                        // Display the existing profile image if available
                        if (response.profile_image) {
                            $('#current-profile-image img')
                                .attr('src', "{{ asset('') }}" + response.profile_image)
                                .show();
                        } else {
                            $('#current-profile-image img').hide();
                        }
                    },
                    error: function (xhr) {
                        console.error('Error fetching ticket data:', xhr.responseText);
                    }
                });

            });

        });


         // When the delete button is clicked
         $('.delete-ticket-btn').on('click', function () {
           
            
            var ticketId = $(this).data('id'); // Get the client ID from the data attribute

           
            // Set the form action dynamically
            var deleteUrl = "{{ route('admin.ticket.destroy-ticket', ':id') }}"; // Route with placeholder
            deleteUrl = deleteUrl.replace(':id', ticketId); // Replace placeholder with actual ID

            // Update the form action
            $('#delete-ticket-form').attr('action', deleteUrl);
        });

        // Handle form submission
        $('#delete-ticket-form').on('submit', function (e) {
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
                    console.error('Error deleting ticket:', xhr.responseText);
                    alert('An error occurred while deleting the ticket.');
                }
            });
        });
        </script>

@endsection