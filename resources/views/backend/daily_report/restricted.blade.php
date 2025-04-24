@extends('backend.layouts.app')

@section('content')



<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg">
                <div class="card-header bg-light text-center">
                    <h3 class="mb-0">Access Restricted</h3>
                </div>
                <div class="card-body text-center">
                    <div class="mb-4">
                        {{-- <i class="fas fa-exclamation-triangle fa-5x text-warning"></i> --}}
                    </div>
                    <h4 class="mb-3">You have pending tickets that need attention!</h4>
                    <p class="text-muted mb-4">
                        Please resolve your assigned tickets before accessing the daily report.
                    </p>
                    
                    <div class="list-group mb-4">
                        @foreach($pendingTickets as $ticket)
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">#Tc-{{ $ticket->id }} - {{ $ticket->title }}</h5>
                                    <small class="text-muted">
                                        Status: 
                                        @if($ticket->status == 1)
                                            <span class="badge bg-warning">Open</span>
                                        {{-- @elseif($ticket->status == )
                                            <span class="badge bg-info">Progress</span> --}}
                                        @else
                                            <span class="badge bg-warning">On Hold</span>
                                        @endif
                                    </small>
                                </div>
                                <a href="{{ route('admin.ticket.ticket-detail', $ticket->id) }}" 
                                   class="btn btn-sm btn-primary">
                                    View Ticket
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <a href="{{ route('admin.ticket.ticket-view') }}" class="btn btn-primary">
                        <i class="fas fa-ticket-alt me-2"></i> Go to Tickets Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        opacity: 0.9;
        border: none;
        border-radius: 10px;
    }
    .card-header {
        border-bottom: 1px solid rgba(0,0,0,0.1);
    }
    .list-group-item {
        border-left: 3px solid var(--bs-warning);
    }

    /* Add this to your main CSS file */
    .restricted-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(248, 249, 250, 0.85);
        z-index: 1040;
        display: flex;
        justify-content: center;
        align-items: center;
    }

.restricted-content {
    background: white;
    padding: 2rem;
    border-radius: 0.5rem;
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    max-width: 600px;
    width: 100%;
}
.text-muted{
    display: block;
    text-align: justify;
}
</style>
@endsection