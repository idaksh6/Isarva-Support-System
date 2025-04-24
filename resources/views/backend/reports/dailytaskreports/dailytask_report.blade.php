@extends('backend.layouts.app')

@section('title', 'Daily_Task Report | Isarva Support')

@section('content')

<div class="search-container">
    <form method="GET" action="{{ route('admin.dailytask_reports') }}" id="searchForm">
        <div class="row">
            <div class="col-md-6">
                <div class="date-field">
                    <label for="start-date">Start Date:</label>
                    <input type="date" id="start-date" name="start_date" 
                        value="{{ request('start_date', now()->subDay()->toDateString()) }}"
                        class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="date-field">
                    <label for="end-date">End Date:</label>
                    <input type="date" id="end-date" name="end_date" 
                        value="{{ request('end_date', now()->toDateString()) }}"
                        class="form-control">
                </div>
            </div>
        </div>
        <button type="submit" class="search-button">Search</button>
    </form>
</div>

@if(request()->has('start_date') && request()->has('end_date'))

    @if($tasks->count())
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Si.No</th>
                        <th>Employee Name</th>
                        <th>Project / Ticket</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $index => $task)
                        <tr>
                            <td>{{ ($tasks->currentPage() - 1) * $tasks->perPage() + $index + 1 }}</td>
                            <td>{{ $task->user->name ?? 'N/A' }}</td>
                            <td>
                                {{ $task->project_ticket_name ?: 'N/A' }}
                                @if($task->type == 1)
                                    <span class="text-muted">(P)</span>
                                @elseif($task->type == 2)
                                    <span class="text-muted">(T)</span>
                                @endif
                            </td>
                            <td>{!! $task->status_badge !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $tasks->links() }}
        </div>
    @else
        <p class="mt-4 text-danger font-weight-bold">No info found.</p>
    @endif

@endif

<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>

@endsection
