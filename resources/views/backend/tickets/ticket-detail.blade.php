@extends('backend.layouts.app')

@section('title', __('Ticket Detail'))

@section('content')

<style>
    .page-item.active span.page-link {
    color: blue !important;
}
</style>

<div class="container-fluid">
    <div class="row g-4">
        @if (session('flash_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('flash_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Main Content -->
        <div>
            <a href="{{ route('admin.ticket.ticket-view') }}" class="btn btn-danger text-white float-end">Back</a>
        </div>
        <div class="col-lg-8 ticketdicusioncontainer ">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between bg-white p-4 rounded-3 shadow-sm mb-4">
                <div>
                    <h1 class="h4 mb-2 text-dark fw-semibold">#{{ $ticket->id }} - {{ $ticket->title }}</h1>
                    <div class="d-flex align-items-center gap-2">
                        @if ($ticket->priority==1)
                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill">High</span>  
                        @elseif ($ticket->priority==2)
                            <span class="badge bg-info  text-white px-3 py-2 rounded-pill">Medium</span> 
                        @else
                            <span class="badge bg-warning  text-white px-3 py-2 rounded-pill">Low</span> 
                        @endif
                        {{-- <span class="badge bg-danger text-white px-3 py-2 rounded-pill">
                            Priority: {{ $ticket->priority }}
                        </span> --}}


                                @if ($ticket->status==2)
                                    <span class="badge bg-info text-white px-3 py-2 rounded-pill">
                                        Status: Progress
                                    </span>
                                @elseif ($ticket->status==3)
                                    <span class="badge bg-warning text-white px-3 py-2 rounded-pill">
                                        Status: On Hold
                                    </span>
                                @elseif ($ticket->status==4)
                                    <span class="badge bg-success text-white px-3 py-2 rounded-pill">
                                        Status: Monitor
                                    </span>
                                @elseif ($ticket->status==5)
                                    <span class="assignbgcolor text-white px-3 py-2 rounded-pill">
                                        Status: Assigned
                                    </span>
                                @elseif ($ticket->status==6)
                                    <span class="badge bg-secondary text-white px-3 py-2 rounded-pill">
                                        Status: Awaiting for Client Response
                                    </span>
                                @elseif ($ticket->status==7)
                                    <span class="badge bg-danger text-white px-3 py-2 rounded-pill">
                                        Status: Closed
                                    </span>
                                @else
                                    <span class="badge bg-warning text-white px-3 py-2 rounded-pill">
                                        Status: Open
                                    </span>
                                @endif
                               
                            
                        
                    </div>
                </div>
                <div class="text-end">
                    <p class="text-muted mb-1 small">Created: {{ date('M d, h:i A', strtotime($ticket->created_on)) }}</p>
                    <p class="text-muted mb-0 small">Last Updated: {{ date('M d, h:i A', strtotime($ticket->last_modified_on)) }}</p>
                </div>
            </div>

            <!-- Comments Section -->
            @foreach($comments as $comment)
            <div class="d-flex gap-3 mb-4 pb-3 border-bottom">
                <div class="flex-shrink-0">
                    <div class="avatar bg-primary text-white rounded-2 p-2">
                        <i class="icofont-user-male fs-5"></i>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <h6 class="mb-0 fw-semibold">
                                @if(isset($comment->user_name))
                                    {{ $comment->user_name }}
                                @else
                                    User #{{ $comment->user_id }}
                                @endif
                            </h6>
                        </div>
                        <small class="text-muted">
                            {{ date('M d, h:i A', strtotime($comment->created_on)) }}
                        </small>
                    </div>
                    <p class="mb-2 text-dark">{{ $comment->comments }}</p>
                    @if($comment->attahcement)
                    <div class="d-flex align-items-center gap-2">
                        <i class="icofont-paperclip text-muted"></i>
                        <a href="{{ asset('images/ticket_attachments/'.$comment->attahcement) }}" 
                        class="text-decoration-none small"
                        target="_blank">
                            Download Attachment
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
         
            <!-- Pagination Links -->
            <div class="d-flex justify-content-end mt-3 text-white">
                {{ $comments->links() }}
            </div>

            <!-- Reply Section -->
            <div class="bg-light rounded-3 p-4  shadow-sm" id="reply-section">
                <form action="{{ route('admin.ticket.comment-store') }}" method="POST" id="ticket-comment-form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $id }}">
                    
                    <div class="mb-3">
                        <textarea class="form-control border-0 bg-white mb-3 p-3" 
                            name="comments"
                            rows="4" 
                            placeholder="Type your reply..."
                            style="border-radius: 12px !important;"></textarea>
                    </div>

                    

                    <div class="row mb-3">
                        <label for="assignedTo" class="col-sm-2 col-form-label">Flagged To</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="assignedTo" id="assignedTo">
                                <option value="">Select Employee</option>
                                @foreach($employees as $id => $name)
                                    <option value="{{ $id }}" {{ (isset($ticket) && $ticket->flag_to == $id) ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
{{--                     
                    <div class="row mb-3">
                        <label for="teamMembers" class="col-sm-2 col-form-label">Assigned To </label>
                        <div class="col-sm-10">
                            <select class="form-select select2" name="teamMembers[]" id="teamMembers" multiple="multiple">
                                <option value="">Select Team Members</option>
                                @foreach($employees as $id => $name)
                                    <option value="{{ $id }}"
                                        @if(isset($ticket) && in_array($id, explode(',', $ticket->team_members ?? '')))
                                            selected
                                        @endif
                                    >{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                     {{-- <div class="row mb-3 ">
                        <label for="teamMembers" class="col-sm-2 col-form-label">Assigned To</label>
                        <div class="col-sm-10 assignselectclass">
                            <select class="form-select select2" name="teamMembers[]" id="assignedtoticketdetail" multiple="multiple">
                                <option value="">Select Team Members</option>
                                @foreach($employees as $id => $name)
                                    <option value="{{ $id }}"
                                       @if(isset($ticketComment) && in_array($id, explode(',', $ticketComment->assigned_to ?? '')))
                                            selected
                                        @endif
                                    >{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="row mb-3">
                        <label for="teamMembers" class="col-sm-2 col-form-label">Assigned To</label>
                        <div class="col-sm-10">
                            <select class="form-select select2" name="teamMembers[]" id="assignedtoticketdetail" multiple="multiple">
                                @foreach($employees as $id => $name)
                                    <option value="{{ $id }}"
                                    @if(isset($ticket) && in_array($id, explode(',', $ticket->team_members ?? '')))
                                            selected
                                        @endif
                                    >{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div> 

                





                     {{-- <div class="row mb-3">
                        <label for="assignedTo" class="col-sm-2 col-form-label">Assigned To</label>
                        <div class="col-sm-10">
                            <select class="form-select" name="assignedTo[]" id="assignedTo" multiple>
                                @foreach($employees as $id => $name)
                                    <option value="{{ $id }}" 
                                        @if(isset($ticket) && in_array($id, (array) $ticket->flag_to)) selected @endif>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}
                    
                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select class="form-select " name="status" id="status">
                                <option value="">Select Status</option>
                                @foreach($status as $id => $name)
                                    <option value="{{ $id }}" {{ $ticket->status == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <input type="file" name="attachment" id="attachment" hidden>
                            <button type="button" onclick="document.getElementById('attachment').click()" 
                                class="btn btn-sm btn-dark rounded-pill px-3 d-flex align-items-center">
                                <i class="icofont-paperclip me-2"></i>Attach
                            </button>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 d-flex align-items-center">
                            <i class="icofont-paper-plane me-2"></i>Send
                        </button>
                    </div>
                    
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 @if($ticket->is_client == 1) client-ticket-card @endif">
                <div class="card-body p-4 ticketdetailscontainer ">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-semibold mb-0 text-dark">Ticket Details</h5>
                        @if($ticket->is_client == 1)
                            <span class="badge bg-primary rounded-pill px-2 py-1">
                                <i class="icofont-star me-1"></i> Client
                            </span>
                        @endif
                    </div>
                    
                    <div class="d-flex flex-column gap-3">
                        <!-- Detail Items -->

                        <div class="d-flex align-items-center gap-3">
                                <div class="icon-box bg-success">
                                    <i class="icofont-users-social text-white"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Assigned To</small>
                                    <div class="d-flex flex-wrap gap-2">
                                        @php
                                            $assignedIds = explode(',', $ticket->team_members);
                                        @endphp

                                    @foreach ($ticket->assigned_to_names as $name)
                                        <span class="badge bg-dark text-white rounded-pill">{{ $name }}</span>
                                    @endforeach

                                    </div>
                                </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-primary">
                                <i class="icofont-building text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Department</small>
                                @if ($ticket->department==1)
                                    <span class="fw-semibold">Development</span>     
                                @elseif ($ticket->department==2)
                                    <span class="fw-semibold">Billing</span>   
                                @elseif ($ticket->department==3)
                                    <span class="fw-semibold">Graphics</span>   
                                @else
                                    <span class="fw-semibold">Other Support</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-success">
                                <i class="icofont-users-social text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Assigned To</small>
                                <div class="d-flex gap-2">
                                    @foreach ($employees as $id=>$name)
                                        <span class="badge bg-dark text-white rounded-pill">{{ $id == $ticket->flag_to ? $name : '' }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-danger">
                                <i class="icofont-lock text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Privacy</small>
                                @if ($ticket->privacy==1)
                                    <span class="fw-semibold text-success">Private</span>
                                @else
                                    <span class="fw-semibold text-success">Public</span>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-warning">
                                <i class="icofont-wall-clock text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Domain</small>
                                <span class="fw-semibold">{{$ticket->domain}}</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-success">
                                <i class="icofont-user text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Created By</small>
                                <div class="d-flex gap-2">
                                    {{-- @if($ticket->is_client != 1)
                                        <span class="badge bg-danger text-white rounded-pill">{{ $ticket->name }}</span>
                                    @endif --}}
                                    @if($ticket->is_client != 1)
                                            <span class="badge bg-danger text-white rounded-pill">{{ $ticket->created_by_name ?? 'N/A' }}</span>
                                    @endif
                                    @if($ticket->is_client == 1)
                                        <span class="badge bg-primary text-white rounded-pill">Client</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                            {{-- @if($ticket->is_client == 1)
                                <div class="d-flex align-items-center gap-3">
                                    <div class="icon-box bg-success">
                                    <i class="icofont-phone text-white"></i>
                                </div>
                               <div>
                                    <small class="text-muted d-block">Phone Number</small>
                                    <span class="fw-semibold">{{$ticket->phone_number ?? 'N/A'}}</span>
                                </div> 
                            @endif
                        </div> --}}

                        

                        @if($ticket->is_client == 1)
                        <div class="client-details-divider">
                            <!-- Divider -->
                            <div class="my-4 border-start border-2 ps-3">
                                <h5 class="fw-semibold mb-3 text-primary">Client Details</h5>

                                <!-- Client Name -->
                                <div class="mb-3">
                                    <small class="text-muted d-block">Name</small>
                                    <span class="fw-semibold">{{ $ticket->client_name ?? 'N/A' }}</span>
                                </div>

                                <div>
                                    <small class="text-muted d-block">Phone Number</small>
                                    <span class="fw-semibold">{{$ticket->phone_number ?? 'N/A'}}</span>
                                </div>

                                <!-- Email ID -->
                                <div class="mb-3">
                                    <small class="text-muted d-block">Email</small>
                                    <span class="fw-semibold">{{ $ticket->email_id ?? 'N/A' }}</span>
                                </div>

                            <!-- Type -->
                                <div class="mb-3">
                                    <small class="text-muted d-block">Type</small>
                                    <span class="fw-semibold">{{ $ticket->type_name ?? 'N/A' }}</span>
                                </div>



                                <!-- Comment -->
                                <div class="mb-3">
                                    <small class="text-muted d-block">Comment</small>
                                    <div class="fw-semibold">{!! nl2br(e($ticket->comments ?? 'N/A')) !!}</div>
                                </div>

                                <!-- Attachment -->
                                <div class="mb-3">
                                    <small class="text-muted d-block">Attachment</small>
                                    @if($ticket->attachment)
                                        <a href="{{ asset('images/ticket_attachments/' . $ticket->attachment) }}" 
                                        class="fw-semibold text-decoration-underline text-info" 
                                        target="_blank">
                                        View Attachment
                                        </a>
                                    @else
                                        <span class="fw-semibold">N/A</span>
                                    @endif
                                </div>
                            </div>
                        @endif

                        </div>
                    </div>

                     <hr>
                    <div class="d-flex flex-column gap-3 mt-4">
                        <h6 class="text-dark fw-semibold">Billable Analysis</h6>

                        {{-- Total Hrs --}}
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-dark">
                                <i class="icofont-clock-time text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Total Hrs</small>
                                <span class="fw-semibold text-dark">
                                    {{ number_format($billableStats['total_hrs'], 2) }}
                                </span>
                            </div>
                        </div>
                    
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-success">
                                <i class="icofont-check text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Billable Hrs</small>
                                <span class="fw-semibold text-success">
                                    {{ number_format($billableStats['totals']['billable'], 2) }} ({{ $billableStats['percentages']['billable'] }}%)
                                </span>
                            </div>
                        </div>
                    
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-danger">
                                <i class="icofont-close-line text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Non-Billable Hrs</small>
                                <span class="fw-semibold text-danger">
                                    {{ number_format($billableStats['totals']['non_billable'], 2) }} ({{ $billableStats['percentages']['non_billable'] }}%)
                                </span>
                            </div>
                        </div>
                    
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-primary">
                                <i class="icofont-ui-settings text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Internal Billable Hrs</small>
                                <span class="fw-semibold text-primary">
                                    {{ number_format($billableStats['totals']['internal_billable'], 2) }} ({{ $billableStats['percentages']['internal_billable'] }}%)
                                </span>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>    
<script src="{{ asset('js/template.js') }}"></script>


<!-- Jquery Page Js -->
<script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script>
    
    $(document).ready(function () {
        $("#ticket-comment-form").validate({
            rules: {
                comments: {
                    required: true,
                },
            },
            messages: {
                comments: {
                    required: "Please enter a comment.",
                },
            },
            errorElement: "div",
            errorClass: "text-danger mt-1",
            highlight: function (element) {
                $(element).addClass("is-invalid");
            },
            unhighlight: function (element) {
                $(element).removeClass("is-invalid");
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        // Trigger file input on button click
        $("#attachment").on("change", function () {
            let fileName = $(this).val().split("\\").pop();
            if (fileName) {
                alert("Selected file: " + fileName);
            }
        });

        $('#assignedtoticketdetail').select2({
        placeholder: "Select Members",
            allowClear: true,
            width: '100%' // Ensures it takes full width of the container
        });
    });

  
    

 
</script>
{{-- 
<script>
 $(document).ready(function() {
    $('#assignedtoticketdetail').select2({
        placeholder: "Select Team Members",
        width: '100%',
        dropdownAutoWidth: true,
        closeOnSelect: false,
        minimumResultsForSearch: 5,
        templateSelection: function(data) {
            // Return just the text without extra spans
            return data.text;
        },
        escapeMarkup: function(m) {
            return m;
        }
    });
});


</script> --}}

{{-- <script>
    $(document).ready(function() {
        $('#assignedTo').select2({
            placeholder: "Select Employee",
            allowClear: true,
            dropdownParent: $('#reply-section') // 👈 this avoids the dropdown being appended to <body>
        });
    });
</script> --}}


@endsection

@push('styles')
<style>
    .avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .icon-box {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .badge {
        font-weight: 500;
        letter-spacing: 0.05em;
    }

    .rounded-3 {
        border-radius: 16px !important;
    }

    .btn-dark {
        background: #2d2d2d;
        border-color: #2d2d2d;
    }

    .btn-primary {
        background: #4a90e2;
        border-color: #4a90e2;
    }

    .card {
        border: 1px solid #eceff1;
        background: #ffffff;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #4a90e2;
    }



   
</style>
@endpush