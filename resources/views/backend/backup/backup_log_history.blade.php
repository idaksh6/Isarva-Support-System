@extends('backend.layouts.app')

@section('title', 'Backup Log History | Isarva Support')

@section('content')

<style>

.table tr th {
    color: var(--text-color);
    text-transform: uppercase;
    font-size: 12px;
    text-align: center;
}

.table tr td {
    border-color: var(--border-color);
    color: var(--text-color);
    text-align: center;
}

.bckupmanagebtn:hover {
    color: green !important;
    background: white !important;
}

</style>



<div class="d-flex justify-content-end mb-2">
    <a href="{{ route('admin.backup_manage') }}" class="btn  btn-success bckupmanagebtn btn-sm d-flex align-items-center gap-2 shadow-sm fw-bold">
        Manage
    </a>
</div>

<div class="card">
    <div class="card-header">
        {{-- <h5 class="managebcktxt">Backup History for: {{ $domain }}</h5> --}}
        <h5 class="managebcktxt">
            @if($groupType == 'P')
                Project Backup History: 
            @elseif($groupType == 'T')
                Ticket Backup History: 
            @else
                Domain Backup History: 
            @endif
            {{ $displayName }}
        </h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="bckupsino">SI.No</th>
                    <th class="bckupsino">Action</th>
                    <th>Last Backup Date</th>
                    <th>Backup File</th>
                    <th> PHP Version</th>
                    <th> Wordpress Version</th>
                    <th>Drive Link</th>
                    <th> Created On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($logs as $index => $log)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td> 
                        <a href="{{ route('admin.backup.edit', $log->id) }}"  class="btn btn-outline-secondary">
                            <i class="icofont-edit"></i>
                        </a>
                    </td>
                    
                    <td>{{ \Carbon\Carbon::parse($log->last_backup_date)->format('d-m-Y') }}</td>
                    <td>{{ $log->last_backup_file_name ?? 'N/A' }}</td>
              
                    <td>{{ $log->php_version ?? 'N/A'}}</td>
                    <td>{{ $log->wordpress_version ?? 'N/A'}}</td>
                  
                    {{-- <td>
                        @if($log->drive_link)
                            <a href="{{ $log->drive_link }}" target="_blank">View Link</a>
                        @else
                            N/A
                        @endif
                    </td> --}}
                    <td>
                        @if($log->drive_link)
                            <a href="{{ $log->drive_link }}" target="_blank" class="btn btn-outline-primary btn-sm drive-link">
                                <i class="icofont-cloud-upload"></i> View  Link
                            </a>
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </td>

                    <td>{{ $log->created_at ? $log->created_at->format('d M Y') : 'N/A' }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>


@endsection
