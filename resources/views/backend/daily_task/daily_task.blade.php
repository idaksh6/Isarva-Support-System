@extends('backend.layouts.app')

@section('title', 'Daily Tasks | Isarva Support')

@section('content')


<div class="d-flex align-items-center justify-content-end  mb-4">

    <a href="{{ route('admin.daily-task.create') }}"
       class="addailytask"><i class="icofont-plus-circle me-2"></i>Add Daily Task
    </a>
    
</div>

@if($tasks->count())
<div class="text-center my-4 p-3 rounded shadow-sm bg-light border">
    <h4 class="mb-0 text-primary fw-semibold">
        <i class="icofont-calendar"></i>
        Today's Daily Task - {{ \Carbon\Carbon::now()->format('d-m-Y') }}
    </h4>
</div>

<!-- Separate PDF Export Container -->
@if(auth()->user()->role == 1)
    <div class="mb-3">
        <a href="{{ route('admin.daily-task.export-pdf') }}" class="btn dailytskexprtbtn export-pdf-btn">
            <i class="icofont-file-pdf"></i> Export PDF
        </a>
    </div>
@endif



    <div class="table-responsive mt-4 dailytasktable">
        <table class="table table-bordered dailytasktablecontainer">
            <thead class="thead-dark">
                <tr>
                    <th>SI.NO</th>
                    <th>Action</th>
                    <th>Employee Name</th>
                    <th>Project (P) / Ticket (T)</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $index => $task)
                    <tr>
                        <td>{{ $index + 1 }}</td>

                        <td>
                            <a href="{{ route('admin.daily-task.edit', $task->id) }}" class="btn btn-outline-secondary">
                                <i class="icofont-edit"></i>
                            </a>
                        </td>
                        
                        <td>{{ $task->user->name ?? 'Unknown' }}</td>
                        <td>
                            @if($task->type == 1)
                                {{ $task->project_ticket_name }} (P)
                            @elseif($task->type == 2)
                                {{ $task->project_ticket_name }} (T)
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $task->description }}</td>
                        {{-- <td>{{ $task->status_text }}</td> --}}
                        <td>{!! $task->status_badge !!}</td>

                        
                        <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
   
        
    </div>
    @else
    <div class="alert alert-info text-center mt-4">
        No daily tasks submitted for today ({{ \Carbon\Carbon::now()->format('d-m-Y') }}).
    </div>
@endif





<div class="mt-3">
    {{ $tasks->links() }}
</div>


<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
@endsection