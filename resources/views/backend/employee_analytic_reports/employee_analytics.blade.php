@extends('backend.layouts.app')

@section('title', 'Employee Analytics report | Isarva Support')

@section('content')

<style>

  .graphbox{
    
    border: 1px solid #d3d3d3
  }


  @media (min-width: 768px) {
    .col-md-5 {
        flex: 0 0 auto;
        width: 50%;
    }

    .empanalyticbilltype{

        color: green;
        font-weight: bold;
    }

    .empanalyticnonbilltype{

        color: red;
        font-weight: bold;
    }

    .emanalyticinttype{

        color: blue;
        font-weight: bold;
    }

    .crdtitle{

        border-bottom: 1px solid #d3d3d3;
        padding-bottom: 10px;
    }


        
    .card:hover {
        transform: scale(1.02);
        transition: all 0.3s ease;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

}
</style>
<div class="container py-4">
    <h2 class="mb-4 p-3 text-center bg-light border rounded shadow-sm text-primary fw-bold" style="font-size: 1.75rem;">
        <i class="icofont-chart-bar-graph"></i></i>Employee Analytics Report
    </h2>
    
    

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
    

    @if($employeeData)
        <!-- For date range under x axis -->
        @php
            $formattedRange = null;
            if ($start_date && $end_date) {
                $formattedStart = date('M-d', strtotime($start_date));
                $formattedEnd = date('M-d', strtotime($end_date));
                $formattedRange = $formattedStart . ' to ' . $formattedEnd;
            }
        @endphp

    <div class="row mainbody">
        @foreach($employeeData as $user)
            <div class="col-md-5 mb-4"> <!-- Grid(col-md) takes 5 column out of 12 -->
                <div class="card shadow-sm h-100">
                    <div class="card-body graphbox">
                        <h5 class="card-title crdtitle text-center">{{ $user->employee_name }}</h5>
                        <canvas id="chart-{{ $user->user_id }}" style="height: 200px;"></canvas>
                        <div class="mt-3 small">
                            <p><strong>Total Hours:</strong> {{ $user->total }} hrs</p>
                            <p class="empanalyticbilltype">Billable: {{ $user->billable }} hrs ({{ $user->billable_percent }}%)</p>
                            <p class="empanalyticnonbilltype">Non-Billable: {{ $user->non_billable }} hrs ({{ $user->non_billable_percent }}%)</p>
                            <p class="emanalyticinttype">Internal: {{ $user->internal }} hrs ({{ $user->internal_percent }}%)</p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endif
</div>

{{-- <!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<script src="{{ asset('js/chart.js')}}"></script>
<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
<script>
    @if($employeeData)
        @foreach($employeeData as $user)
            new Chart(document.getElementById('chart-{{ $user->user_id }}'), {
                type: 'bar',
                data: {
                    // labels: ['{{ $user->employee_name }}'],
                    labels: ['{{ $formattedRange }}'],

                    datasets: [
                        {
                            label: 'Billable',
                            data: [{{ $user->billable }}],
                            backgroundColor: '#4ade80',
                            stack: 'stack1'
                        },
                        {
                            label: 'Non-Billable',
                            data: [{{ $user->non_billable }}],
                            backgroundColor: '#e11212',
                            stack: 'stack1'
                        },
                        {
                            label: 'Internal',
                            data: [{{ $user->internal }}],
                            backgroundColor: '#60a5fa',
                            stack: 'stack1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': ' + context.raw + ' hrs';
                                }
                            }
                        }
                    },
                    scales: {
                        x: { stacked: true },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            title: { display: true, text: 'Hours' }
                        }
                    }
                }
            });
        @endforeach
    @endif
</script>
@endsection
