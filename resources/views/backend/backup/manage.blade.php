@extends('backend.layouts.app')

@section('title', 'Backup Manage  | Isarva Support')

@section('content')

<style>

    @media(max-width:758px){

           .managebcksrchaddbtn{

                display: grid !important;
                align-content: center !important;
                justify-content: center !important;
                justify-items: center !important;
        }

           .bckupsrch{
           
            margin: 20px;

           }

           .bckupsrchheader {

            flex-direction: column;
           }
             

    }

    @media(max-width:475px){

        .input-group{

            width: 248px !important;
        }
    }

</style>
{{-- 
        <div class="d-flex align-items-center justify-content-between  mb-4 ">
            <form action="{{ route('admin.backup_search')}}"  method="GET" class="col-md-4">
              
                    <div class="input-group">
                        <input type="text" class="form-control project_search" name="project_name" id="project_name" 
                            placeholder="Search by Domain / Ip" value="">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
             
            </form>

            <a href="{{ route('admin.backup_create') }}" class="addailytask"><i class="icofont-plus-circle me-2"></i>
                Add Backup
            </a>
        </div> --}}

      
        

       <!-- Success message for adding backup-->
        @if (session()->has('flash_success_addbackup'))
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
                <i class="bi bi-check-circle-fill me-2 text-success"></i> 
                <span>{{ session('flash_success_addbackup') }}</span>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Success message for updating backup-->
    @if (session()->has('flash_success_backup'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
            <i class="bi bi-check-circle-fill me-2 text-success"></i> 
            <span>{{ session('flash_success_backup') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
{{-- 
<div class="card">
    <div class="card-header">
        <h5 class="managebcktxt">Manage Backups</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Domain</th>
                    <th>Backup Type</th>
                    <th>Present IP</th>
                    <th>Last Backup File</th>
                    <th>Backup Location</th>
                    <th>PHP Version</th>
                    <th>Framework Version</th>
                    <th>WordPress Version</th>
                    <th>Created At</th>
                    <th>Latest Backup Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($backups as $backup)
                <tr>
                    <td>  
                        <a href="{{ route('admin.backup.log-history', ['domain' => urlencode($backup->domain)]) }}">
                              <p class="historylog"> <i class="icofont-history"></i></p>
                         </a>
                    </td>
                    <td>
                        <a href="{{ route('admin.backup.log-history', ['domain' => urlencode($backup->domain)]) }}">
                            {{ $backup->domain }}
                        </a>
                    </td>
                    <td>{{ $backup->backup_type_name }}</td>
                    <td>{{ $backup->present_ip ?? 'N/A' }}</td>
                    <td>{{ $backup->last_backup_file_name ?? 'N/A' }}</td>
                    <td>{{ $backup->last_backup_location ?? 'N/A' }}</td>
                    <td>{{ $backup->php_version ?? 'N/A' }}</td>
                    <td>{{ $backup->framework_version ?? 'N/A' }}</td>
                    <td>{{ $backup->wordpress_version ?? 'N/A' }}</td>
                    <td>{{ $backup->created_at ? $backup->created_at->format('d-m-Y') : 'N/A' }}</td>
                    <td>{{ $backup->updated_at ? $backup->updated_at->format('d-m-Y') : 'N/A' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}

      <!-- Pagination Links -->
      {{-- <div class="d-flex justify-content-center">
        {{ $backups->links() }}
    </div> --}}

{{-- </div> --}}


<div class="card bckupmanagetbl">
    <div class="card-header bckupsrchheader d-flex justify-content-between align-items-center">
        <h5 class="managebcktxt mb-0">Manage Backups</h5>
        <div class="d-flex managebcksrchaddbtn">
            <form action="{{ route('admin.backup_search') }}" method="GET" class="me-3">
                <div class="input-group bckupsrch" style="width: 300px;">
                    <input type="text" class="form-control  project_search" name="search" id="search" 
                        placeholder="Search domain or IP" value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="icofont-search"></i>
                    </button>
                    @if(request('search'))
                        <a href="{{ route('admin.backup_manage') }}" class="btn btn-outline-secondary">
                            <i class="icofont-close"></i>
                        </a>
                    @endif
                </div>
            </form>
            <a href="{{ route('admin.backup_create') }}" class="addailytask"><i class="icofont-plus-circle me-2"></i>
                Add Backup
            </a>
        </div>
    </div>
    
    <div class="card-body mt-3">
        @if(request('search') && $backups->isEmpty())
            <div class="alert alert-info">
                No backups found matching "{{ request('search') }}". 
                <a href="{{ route('admin.backup_manage') }}">Show all backups</a>
            </div>
        @elseif($backups->isEmpty())
            <div class="alert alert-info">
                No backup records found. 
                <a href="{{ route('admin.backup_create') }}">Create your first backup</a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
              
                            <th width="50">Action</th>
                            <th>Domain</th>
                            <th>Backup Type</th>
                            <th>IP Address</th>
                            <th>Last Backup File</th>
                            <th>Location</th>
                            @if($backups->contains('php_version'))
                                <th>PHP</th>
                            @endif
                            @if($backups->contains('framework_version'))
                                <th>Framework</th>
                            @endif
                            @if($backups->contains('wordpress_version'))
                                <th>WordPress</th>
                            @endif
                            <th>Last Backup Date</th>
                            {{-- <th>Last Updated</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($backups as $backup)
                        <tr>
       
                            {{-- <td class="text-center">  
                                <a href="{{ route('admin.backup.log-history', ['domain' => urlencode($backup->domain)]) }}" 
                                   class="text-primary" title="View history">
                                    <i class="icofont-history"></i>
                                </a>
                            </td> --}}
                            {{-- <td class="text-center">  
                                <a href="{{ route('admin.backup.log-history', $backup->group_id) }}" 
                                    class="text-primary" title="View history">
                                    <i class="icofont-history"></i>
                                </a>
                            </td> 
                            <td>
                                <a href="{{ route('admin.backup.log-history', ['domain' => urlencode($backup->domain)]) }}" 
                                   class="text-primary">
                                    {{ $backup->domain }}
                                </a>
                            </td> --}}
                            <td class="text-center">  
                                <a href="{{ route('admin.backup.log-history', $backup->group_id) }}" 
                                    class="logohistryicon" title="View history">
                                    <i class="icofont-history"></i>
                                </a>
                            </td> 
                            <td>
                                <a href="{{ route('admin.backup.log-history', $backup->group_id) }}" 
                                   class="text-primary fw-bold">
                                    {{ $backup->domain }}
                                </a>
                            </td>
                            <td>{{ $backup->backup_type_name }}</td>
                            <td>{{ $backup->present_ip ?? 'N/A' }}</td>
                            <td>{{ $backup->last_backup_file_name ?? 'N/A' }}</td>
                            <td>{{ $backup->last_backup_location ?? 'N/A' }}</td>
                            
                            @if($backups->contains('php_version'))
                                <td>{{ $backup->php_version ?? 'N/A' }}</td>
                            @endif
                            
                            @if($backups->contains('framework_version'))
                                <td>{{ $backup->framework_version ?? 'N/A' }}</td>
                            @endif
                            
                            @if($backups->contains('wordpress_version'))
                                <td>{{ $backup->wordpress_version ?? 'N/A' }}</td>
                            @endif
                            
                            {{-- <td>{{ $backup->created_at ? $backup->created_at->format('d M Y') : 'N/A' }}</td> --}}
                            <td>{{ $backup->last_backup_date ? $backup->last_backup_date->format('d M Y') : 'N/A' }}</td>
                            {{-- <td>{{ $backup->updated_at ? $backup->updated_at->format('d M Y') : 'N/A' }}</td> --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                   <!-- Pagination Links -->
            
                <div class="d-flex justify-content-center mt-3">
                    {{ $backups->appends(request()->query())->links() }}
                </div>
            </div>
        @endif
    </div>
</div>


   
<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>

@endsection