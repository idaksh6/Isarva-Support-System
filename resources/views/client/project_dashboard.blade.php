{{-- @extends('backend.layouts.app')

@section('content') --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Client Project Dashboard</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<style>
    .dropdown-header {
        padding: 0.5rem 1rem;
    }
    .dropdown-item {
        padding: 0.5rem 1.5rem;
    }
    .dropdown-item i {
        width: 20px;
        text-align: center;
    }
    #profileDropdown {
        transition: all 0.3s;
    }
    #profileDropdown:hover {
        background-color: #0d6efd;
        color: white;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ route('client.ticket_view')}}" class="btn btn-secondary">
                <i class="fas fa-ticket-alt"></i> Goto Tickets
            </a>

            <!-- Profile Dropdown -->
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="profileDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-1"></i> {{ $clientEmail }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li>
                        <div class="dropdown-header px-3 py-2">
                            <div class="fw-bold">{{ $clientName }}</div>
                            <small class="text-muted">Client Account</small>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                            <i class="fas fa-user me-2"></i> View Profile
                        </a>
                    </li>
                   <li>
                        <a class="dropdown-item text-danger" href="{{ route('client.logout') }}">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <h2 class="mb-4 text-center">Client Project Dashboard</h2>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-primary shadow">
                    <div class="card-body text-center">
                        <h4>{{ $activeProjects }}</h4>
                        <p>Active Projects</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-warning shadow">
                    <div class="card-body text-center">
                        <h4>{{ $onHoldProjects }}</h4>
                        <p>On Hold Projects</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-info shadow">
                    <div class="card-body text-center">
                        <h4>{{ $activeTickets }}</h4>
                        <p>Active Tickets</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card text-white bg-success shadow">
                    <div class="card-body text-center">
                        <h4>{{ $closedTickets }}</h4>
                        <p>Closed Tickets</p>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <!-- Profile Modal (optional) -->
    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Client Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-user-circle fa-5x text-primary"></i>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Client Name</label>
                        <input type="text" class="form-control" value="{{ $clientName }}" readonly>
                    </div>
                    <!-- Add more client details here if needed -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
{{-- @endsection --}}