@extends('backend.layouts.app')

@section('title', __('Metric Report | Isarva Support'))

@section('content')

<style>

.bodysection{

    font-size: 18px;
}

</style>

    <div class="search-container">
            <form method="GET" >
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="start_date" class="form-label">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="end_date" class="form-label">End Date:</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="form-control">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
    </div>
   @if(request()->has('start_date') && request()->has('end_date'))
    @if(!empty($dailyBreakdown))
        <div class="container mt-5">
            <h4 class="text-primary fw-bold mb-3 text-center">
                Per-Day Work Summary ({{ request('start_date') }} to {{ request('end_date') }})
            </h4>
            <div class="row">
                @foreach($dailyBreakdown as $date => $data)
                    @php
                        $totalHrs = $data['billable'] + $data['non_billable'] + $data['internal_billable'];
                    @endphp
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                                <strong>{{ \Carbon\Carbon::parse($date)->format('d-m-Y') }}</strong>
                                <span class="badge bg-light text-dark">Total: {{ number_format($totalHrs, 2) }} hrs</span>
                            </div>
                            <div class="card-body bodysection">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                        <strong class="text-success">Billable →</strong>
                                        {{ number_format($data['billable'], 2) }} hrs ({{ $data['billable_percent'] }}%)
                                    </li>
                                    <li>
                                        <strong class="text-danger">Non-Billable →</strong>
                                        {{ number_format($data['non_billable'], 2) }} hrs ({{ $data['non_billable_percent'] }}%)
                                    </li>
                                    <li>
                                        <strong class="text-primary">Internal Billable →</strong>
                                        {{ number_format($data['internal_billable'], 2) }} hrs ({{ $data['internal_billable_percent'] }}%)
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p class="text-center text-danger mt-4">No data found for the selected date range.</p>
    @endif
@endif



 <script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>

@endsection