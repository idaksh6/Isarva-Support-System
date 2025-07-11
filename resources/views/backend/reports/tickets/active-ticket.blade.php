@extends('backend.layouts.app')


@section('title', 'Active Tickets Report | Isarva Support')


@section('content')

<style>
    .select2-container .select2-selection--single {
        height: calc(2.3rem + 2px) !important; /* Match Bootstrap form height */
        padding: 0.375rem 0.75rem; /* Match input padding */
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow
    {
        height: 35px;
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Search Filters</h5>
        </div>
        <div class="card-body">
            <form action="{{route('admin.reports.active-tickets')}}" method="GET">
                <div class="row">
                    <div class="col-md-4 pb-2">
                        <label for="status" class="form-label">Status</label>
                        <div class="input-group">
                            <select class="form-select select2" name="status" id="status">
                                <option value="0">Active</option>
                                @foreach($status as $id => $name)
                                    <option value="{{ $id }}" {{ request('status') == $id ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>  
                    
                    <div class="col-sm-8 text-end d-flex align-items-end pb-2">
                        <button type="submit" class="btn btn-primary float-start">
                            <i class="fa fa-search"></i> Search
                        </button>
                        <a href="{{ route('admin.reports.active-tickets') }}" class="btn btn-secondary float-start mx-2">
                            <i class="fa fa-times"></i> Clear
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div class="card my-4">
        <div class="card-body">
            <div class="">
                <h6 class="fw-bold">{{$ticketStatus}} Tickets: {{$ticketCount}}</h6>
            </div>
            <button id="exportPdf" class="btn btn-success text-white my-2">
                <i class="fas fa-file-pdf"></i> Export to PDF
            </button>
            <div class="table-responsive" >
                <table class="table table-bordered fixed-header-table">
                    <thead>
                        <th>Sl.No</th>
                        <th>TicketId</th>
                        <th>Ticket Name</th>
                        <th>Total Worked Hours</th>
                        <th>Status</th>
                        <th>Priority</th>
                        <th>Created By</th>
                        <th>Assigned To</th>
                        <th>End Date</th>
                        <th>Comments</th>
                    </thead>
                    <tbody>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($tickets as $t)
                        <tr>
                            <td>
                                {{$i}}
                            </td>
                            {{-- <td>
                                {{'#'.$t->ticketId.''.$t->title}}
                            </td> --}}
                            <td>
                                {{'#'.$t->ticketId}}
                            </td>
                            <td>
                                {{$t->title}}
                            </td>
                            <td>
                                {{$t->hrs}}
                            </td>
                            <td>
                                {{ $status[$t->status] ?? 'Unknown' }}
                            </td>
                            <td>
                                {{$Priority[$t->priority] ?? 'Unknown'}}
                            </td>
                            <td>
                                {{$employees[$t->created_by] ?? 'Unknown'}}
                            </td>
                            <td>
                                {{$employees[$t->flag_to] ?? $employees[$t->created_by] }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($t->end_date)->format('d-m-Y') }}
                            </td>
                            <td>
                                {{$t->discussion_comments}}
                            </td>
                        </tr> 
                        @php
                            $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center">
                    {{ $tickets->links() }}
                </div>

            </div>
        </div>
    </div>


</div>

<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>


<script>
    $(document).ready(function() {
    $('#status').select2({
        placeholder: "Select Status",
        allowClear: true,
        width: '100%' // Ensures it takes full width of the container
    });

    $('#exportPdf').on('click', function() {
        // Get all current filter values
        const status = $('#status').val();
        
        // Build the URL with all current filters
        let url = '{{ route("admin.reports.ExportPdf-ticket") }}' + 
            '?status=' + encodeURIComponent(status);
        
        // Open the URL to trigger the download
        window.location.href = url;
    });
});

</script>
@endsection