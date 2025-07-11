@extends('backend.layouts.mainclient')

@section('title', 'Client Ticket Details View | Isarva Support')


@section('content')

<div class="container-fluid">
    <div class="row g-4">
        <!-- Success message -->
        @if (session('flash_success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('flash_success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Back Button -->
        <div>
            <a href="{{ route('client.ticket_view') }}" class="btn btn-secondary text-white">Back to Tickets</a>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8 ticketdicusioncontainer mb-4">
            <!-- Header Section -->
            <div class="d-flex align-items-center justify-content-between bg-white p-4 rounded-3 shadow-sm mb-4">
                <div>
                    <h1 class="h4 mb-2 text-dark fw-semibold">#{{ $ticket->id }} - {{ $ticket->title }}</h1>
                    <div class="d-flex align-items-center gap-2">
                        <!-- Priority Badge -->
                        @if ($ticket->priority==1)
                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill">High</span>  
                        @elseif ($ticket->priority==2)
                            <span class="badge bg-info text-white px-3 py-2 rounded-pill">Medium</span> 
                        @else
                            <span class="badge bg-warning text-white px-3 py-2 rounded-pill">Low</span> 
                        @endif
                        
                        <!-- Status Badge -->
                        @if ($ticket->status==2)
                            <span class="badge bg-info text-white px-3 py-2 rounded-pill">Status: Progress</span>
                        @elseif ($ticket->status==3)
                            <span class="badge bg-warning text-white px-3 py-2 rounded-pill">Status: On Hold</span>
                        @elseif ($ticket->status==4)
                            <span class="badge bg-success text-white px-3 py-2 rounded-pill">Status: Monitor</span>
                        @elseif ($ticket->status==6)
                            <span class="badge bg-secondary text-white px-3 py-2 rounded-pill">Status: Awaiting Response</span>
                        @elseif ($ticket->status==7)
                            <span class="badge bg-danger text-white px-3 py-2 rounded-pill">Status: Closed</span>
                        @else
                            <span class="badge bg-warning text-white px-3 py-2 rounded-pill">Status: Open</span>
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
                    {{-- <div class="avatar bg-primary text-white rounded-2 p-2">
                        <i class="icofont-user-male fs-5"></i>
                    </div> --}}
                      <div class="avatar {{ isset($comment->user_name) ? 'bg-primary' : 'bg-warning' }} text-white rounded-2 p-2" 
                        title="{{ isset($comment->user_name) ? 'User' : 'Client' }}">
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
                                   <div class="clientaccess">
                                        <h6 class="mb-0 fw-semibold">
                                                    Client <i class="icofont-star me-1 text-warning"></i>
                                            </h6>
                                    </div>    
                                    {{-- Client #{{ $comment->user_id }} --}}
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
            <div class="d-flex justify-content-end mt-3">
                {{ $comments->links() }}
            </div>

            <!-- Reply Section (Client can only add comments) -->
            <div class="bg-light rounded-3 p-4 shadow-sm" id="reply-section">
                <form action="{{ route('client.ticket.comment-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ticket_id" value="{{ $id }}">
                    
                    <div class="mb-3">
                        <textarea class="form-control border-0 bg-white mb-3 p-3" 
                            name="comments"
                            rows="4" 
                            placeholder="Type your reply..."
                            style="border-radius: 12px !important;"
                            required></textarea>
                    </div>

                    {{-- <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <input type="file" name="attachment" id="clientview_attachment" hidden>
                            <button type="button" onclick="document.getElementById('clientview_attachment').click()" 
                                class="btn btn-sm btn-dark rounded-pill px-3 d-flex align-items-center">
                                <i class="icofont-paperclip me-2"></i>Attach
                            </button>
                        </div>
                        <button type="submit" class="btn btn-primary rounded-pill px-4 d-flex align-items-center">
                            <i class="icofont-paper-plane me-2"></i>Send
                        </button>
                    </div> --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2 align-items-center">
                            <!-- Hidden file input -->
                            <input type="file" name="attachment" id="clientview_attachment" hidden onchange="showSelectedFileName(this)">

                            <!-- Attach Button -->
                            <button type="button" onclick="document.getElementById('clientview_attachment').click()" 
                                class="btn btn-sm btn-dark rounded-pill px-3 d-flex align-items-center">
                                <i class="icofont-paperclip me-2"></i>Attach
                            </button>

                            <!-- Selected file name and cancel -->
                            <div id="selected-file-wrapper" class="d-none align-items-center bg-light px-3 py-1 rounded-pill border small">
                                <span id="selected-file-name" class="me-2 text-truncate" style="max-width: 200px;"></span>
                                <button type="button" class="btn btn-sm btn-close p-0 m-0" aria-label="Remove" onclick="clearSelectedFile()" style="font-size: 0.75rem;"></button>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary rounded-pill px-4 d-flex align-items-center">
                            <i class="icofont-paper-plane me-2"></i>Send
                        </button>
                    </div>


                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-3 client-ticket-card">
                <div class="card-body p-4 ticketdetailscontainer">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-semibold mb-0 text-dark">Ticket Details</h5>
                        <span class="badge bg-primary rounded-pill px-2 py-1">
                            <i class="icofont-star me-1"></i> Client
                        </span>
                    </div>
                    
                    <div class="d-flex flex-column gap-3">
                        <!-- Client Details -->
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-success">
                                <i class="icofont-user text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Your Name</small>
                                <span class="fw-semibold">{{ $ticket->client_name }}</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-primary">
                                <i class="icofont-envelope text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Your Email</small>
                                <span class="fw-semibold">{{ $ticket->email_id }}</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-warning">
                                <i class="icofont-phone text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Your Phone</small>
                                <span class="fw-semibold">{{ $ticket->phone_number }}</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-info">
                                <i class="icofont-globe text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Domain</small>
                                <span class="fw-semibold">{{ $ticket->domain }}</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-secondary">
                                <i class="icofont-tag text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Type</small>
                                <span class="fw-semibold">{{ $ticket->type_name ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-box bg-dark">
                                <i class="icofont-users-social text-white"></i>
                            </div>
                            <div>
                                <small class="text-muted d-block">Assigned To</small>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach ($ticket->assigned_to_names as $name)
                                        <span class="badge bg-dark text-white rounded-pill">{{ $name }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Original Message -->
                        <div class="mt-4">
                            <small class="text-muted d-block">Your Description</small>
                            <div class="fw-semibold p-3 bg-light rounded">
                                {!! nl2br(e($ticket->comments)) !!}
                            </div>
                        </div>

                        <!-- Attachment -->
                        @if($ticket->attachment)
                        <div class="mt-3">
                            <small class="text-muted d-block">Your Attachment</small>
                            <a href="{{ asset('images/ticket_attachments/' . $ticket->attachment) }}" 
                                class="fw-semibold text-decoration-underline text-info d-block mt-1" 
                                target="_blank">
                                <i class="icofont-paperclip me-1"></i> Download Attachment
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
@endsection

<script>
   // Trigger file input on button click
     function showSelectedFileName(input) {
        const wrapper = document.getElementById('selected-file-wrapper');
        const nameSpan = document.getElementById('selected-file-name');

        if (input.files.length > 0) {
            nameSpan.textContent = input.files[0].name;
            wrapper.classList.remove('d-none');
        } else {
            clearSelectedFile();
        }
    }

    function clearSelectedFile() {
        const fileInput = document.getElementById('clientview_attachment');
        const wrapper = document.getElementById('selected-file-wrapper');
        const nameSpan = document.getElementById('selected-file-name');

        fileInput.value = ''; // Reset file input
        nameSpan.textContent = '';
        wrapper.classList.add('d-none');
    }

</script>


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
    }
    
    .client-ticket-card {
        border-left: 4px solid #4a90e2;
    }
    
    .ticketdetailscontainer {
        background-color: #f8f9fa;
    }
    
    .ticketdicusioncontainer {
        background-color: #fff;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }

        #selected-file {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
        vertical-align: middle;
    }

    
   .page-item.active .page-link {
    background-color: blue !important;
    border-color: var(--primary-color);
}
    
    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            gap: 1rem;
        }
        
        .d-flex.flex-column {
            width: 100%;
        }
    }
</style>
@endpush
