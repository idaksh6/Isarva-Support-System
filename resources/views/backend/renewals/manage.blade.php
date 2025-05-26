@extends('backend.layouts.app')

@section('title', __('Manage Renewal'))


@section('content')
    <h1>Renewal Management</h1>


      <!-- Success message for adding backup-->
    @if (session()->has('flash_success_addrenewal'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
            <i class="bi bi-check-circle-fill me-2 text-success"></i> 
            <span>{{ session('flash_success_addrenewal') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <!-- Success message for updating backup-->
        @if (session()->has('flash_success_updaterenewal'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
                <i class="bi bi-check-circle-fill me-2 text-success"></i> 
                <span>{{ session('flash_success_updaterenewal') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    {{-- <div class="renewalsrchaddcontainer d-flex justify-content-between align-items-center">

        <a href="{{ route('admin.renewals.create') }}" class="btn btn-success mb-3">Add New Renewal</a>

        <div class="col-md-4">
            <div class="input-group">
                <input type="text" class="form-control project_search" name="project_name" id="project_name" 
                    placeholder="Search by project name" value="{{ request('project_name') }}">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </div>
        </div>
    </div> --}}

    <!-- Search and add conatiner -->
    <div class="renewalsrchaddcontainer d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.renewals.create') }}" class="btn btn-success mb-3">Add New Renewal</a>
        
        <div class="col-md-4">
            <form action="{{ route('admin.renewals.search') }}" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control project_search" name="q" 
                        placeholder="Search domain/hosting/application" value="{{ request('q') }}">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
  

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Actions</th>
                <th>Client</th>
                <th>Our Services</th>
                <th>IP / Domain / App Name</th>
                <th>Expiry Date</th>
                <th>Priority</th>
            </tr>
        </thead>
      
        <tbody>
            @forelse($services as $service)
                @php
                    $clientName = $service->client->client_name ?? 'N/A';
            
                    $servicesData = [];
            
                    if ($service->d_service) {
                        $servicesData[] = [
                            'type' => 'Domain',
                            'value' => $service->d_name,
                            'expiry' => $service->d_exp,
                        ];
                    }
                    if ($service->h_service) {
                        $servicesData[] = [
                            'type' => 'Hosting',
                            'value' => $service->h_ip,
                            'expiry' => $service->h_exp,
                        ];
                    }
                    if ($service->a_service) {
                        $servicesData[] = [
                            'type' => 'Application',
                            'value' => $service->a_name,
                            'expiry' => $service->a_exp,
                        ];
                    }
                    $rowspan = count($servicesData);
                @endphp
            
                @foreach($servicesData as $index => $data)
                    <tr>
                        @if($index === 0)
                            <td rowspan="{{ $rowspan }}">
                                <a href="{{ route('admin.renewals.edit', $service->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                {{-- <form action="#" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this renewal?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form> --}}
                                <a href="#" class="btn btn-sm btn-outline-danger" onclick="confirmDelete({{ $service->id }})">Delete</a>

                                    <form id="delete-form-{{ $service->id }}" action="{{ route('admin.renewals.delete', $service->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                               
                            </td>
                            <td rowspan="{{ $rowspan }}">{{ $clientName }}</td>
                        @endif
            
                        <td>
                            @switch($data['type'])
                                @case('Domain')
                                    <p class="domainservice">Domain</p>
                                    @break
                                @case('Hosting')
                                    <p class="hostingservice">Hosting</p>
                                    @break
                                @case('Application')
                                    <p class="applicationservice">Application</p>
                                    @break
                            @endswitch
                        </td>
                        <td>
                            <p class="ip-or-domain-name">{{ $data['value'] }}</p>
                        </td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($data['expiry'])->format('d-F-Y') }}
                        </td>
                        {{-- <td>
                            <span class="badge 
                                @if($service->priority == 'urgent') bg-danger
                                @elseif($service->priority == 'upcoming') bg-warning text-dark
                                @else bg-success
                                @endif">
                                {{ ucfirst($service->priority) }}
                            </span>
                        </td> --}}
                         
                        @if($index === 0)
                            <td rowspan="{{ $rowspan }}" class="priority-cell">
                                @if($service->d_service)
                                    <p class="badge priority-badge priorityclass mb-4
                                            @if($service->domainPriority() == 'urgent') bg-danger
                                            @elseif($service->domainPriority() == 'upcoming') bg-warning text-dark
                                            @else bg-success @endif">
                                            Domain: {{ ucfirst($service->domainPriority() ?? 'N/A') }}
                                    </p><br>
                                @endif
                                    
                                @if($service->h_service)
                                    <p class="badge priority-badge  priorityclass mb-4
                                            @if($service->hostingPriority() == 'urgent') bg-danger
                                            @elseif($service->hostingPriority() == 'upcoming') bg-warning text-dark
                                            @else bg-success @endif">
                                            Hosting: {{ ucfirst($service->hostingPriority() ?? 'N/A') }}
                                    </p><br>
                                @endif
                                    
                                @if($service->a_service)
                                    <p class="badge priority-badge priorityclass 
                                            @if($service->applicationPriority() == 'urgent') bg-danger
                                            @elseif($service->applicationPriority() == 'upcoming') bg-warning text-dark
                                            @else bg-success @endif">
                                            App: {{ ucfirst($service->applicationPriority() ?? 'N/A') }}
                                    </p>
                                @endif
                            </td>
                        @endif
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        @if(request()->has('q'))
                            <div class="no-results">
                                <i class="icofont-search-1 mb-3 text-muted"></i>
                                <h5 class="text-muted">No matching renewals found</h5>
                                <p class="text-muted">Your search for "{{ request('q') }}" did not match any records</p>
                                <a href="{{ route('admin.renewals.manage') }}" class="btn btn-primary mt-2">
                                    Clear Search
                                </a>
                            </div>
                        @else
                            <div class="no-results">
                                {{-- <i class="fas fa-database fa-2x mb-3 text-muted"></i> --}}
                                <i class="icofont-database  mb-3 text-muted"></i>
                                <h5 class="text-muted">No renewal information available</h5>
                                <p class="text-muted">Click "Add New Renewal" to create your first record</p>
                            </div>
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-3">
        {{ $services->links() }}
    </div>
    


    <script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>

    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
    


@endsection

