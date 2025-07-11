@extends('backend.layouts.mainclient')

@section('title', 'Client Tickets View | Isarva Support')


@section('content')

 <style>
        .client-ticket {
            background-color: #f8f9fa;
            border-left: 4px solid #0d6efd;
        }
        .table-responsive {
            overflow-x: auto;
        }

        .idcolor{

            color: #f19828;
        }
 </style>

    @if (session()->has('flash_success_cleintupdatedpaswrd'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
            <i class="bi bi-check-circle-fill me-2 text-success"></i> 
            <span>{{ session('flash_success_cleintupdatedpaswrd') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


 <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>My Tickets</h2>
        {{-- <a href="{{ route('client.project.dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a> --}}
    </div>

        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="clientTicketsTable" class="table table-hover align-middle mb-0" style="width:100%">
                        <thead>
                            <tr>
                                <th>Ticket ID</th>
                                <th>Title</th>
                                <th>Flagged  To</th>
                                <th>Created Date</th>
                                <th>Ticket Subject</th>
                                <th>Status</th>
                                {{-- <th>Priority</th>
                                <th>Department</th> --}}
                                <!-- Removed Actions column -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr class="client-ticket">
                                <td>
                                    <a href="{{ route('client.ticket_detail', ['id' => $ticket->id])}}" class="fw-bold idcolor">#Tc-{{ $ticket->id }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('client.ticket_detail', ['id' => $ticket->id])}}" class="fw-bold text-primary">
                                        {{ $ticket->title }}
                                     
                                    </a>
                                </td>
                                <td>
                                    {{-- @php
                                        $profileImg = \App\Helpers\ClientHelper::ProfileImg($ticket->flag_to);
                                    @endphp
                                    <img class="avatar rounded-circle" 
                                        src="{{ $profileImg ? url('/').'/'.$profileImg : url('/images/xs/avatar1.jpg') }}" 
                                        alt="Profile Image"> --}}
                                    @foreach ($employees as $id=>$name)
                                        {{ $id == $ticket->flag_to ? $name : '' }}
                                    @endforeach
                                </td>
                                <td>
                                       {{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y') }}
                                </td>

                                <td>
                                      {{ $ticket->title}}
                                </td>

                                <td>
                                    @if ($ticket->status==2)
                                        <span class="badge bg-info text-white rounded-pill">Progress</span>
                                    @elseif ($ticket->status==3)
                                        <span class="badge bg-warning text-white rounded-pill">On Hold</span>
                                    @elseif ($ticket->status==4)
                                        <span class="badge bg-success text-white rounded-pill">Monitor</span>
                                    @elseif ($ticket->status==5)
                                        <span class="assignbgcolor text-white rounded-pill">Assigned</span>
                                    @elseif ($ticket->status==6)
                                        <span class="badge bg-secondary text-white rounded-pill">Awaiting Response</span>
                                    @elseif ($ticket->status==7)
                                        <span class="badge bg-danger text-white rounded-pill">Closed</span>
                                    @else
                                        <span class="badge bg-warning text-white rounded-pill">Open</span>
                                    @endif
                                </td>
                                {{-- <td>
                                    @if ($ticket->priority==1)
                                        <span class="badge bg-warning">Low</span>  
                                    @elseif ($ticket->priority==2)
                                        <span class="badge bg-info">Medium</span> 
                                    @else
                                        <span class="badge bg-danger">High</span> 
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
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
@endsection

{{-- @push('scripts')
<script>
    $(document).ready(function() {
        $('#clientTicketsTable').DataTable({
            responsive: true
        });
    });
</script>
@endpush --}}