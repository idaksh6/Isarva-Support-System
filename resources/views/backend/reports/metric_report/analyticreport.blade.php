@extends('backend.layouts.app')

@section('title', __('Metric Report | Isarva Support'))

@section('content')


<style>

  .mainconatiner {

    max-width: 100% !important;
  }

  .perdaysmrymaincontainer{

     max-width: 100% !important;
  }


  .totlhrs{

    font-size: 16px;
    color: purple;
  }

  .totloverallhrs{

    font-size: 22px;
    color: purple;
  }

  .billhrsection{

    font-size: 15px;
  }

  .mainchildbody{

    border: 1px solid #d3d3d3;
  }

</style>

    <!-- search container -->
    <div class="search-container">
        <form method="GET">
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

    {{-- @if(!empty($totals))
        <div class="container mainconatiner mt-4">
            <h5 class="text-center fw-bold">Overall Summary</h5>
            <canvas id="trendChart" height="120"></canvas>

            @php
                $grandTotal = $totals['billable'] + $totals['non_billable'] + $totals['internal_billable'];
            @endphp

            <div class="mt-3 text-center">
                <strong>Total Hrs: {{ number_format($grandTotal, 2) }}</strong>
                <div class="text-muted mt-1">
                    <span class="fw-bold text-success">Billable</span>: <span class="text-success">{{ number_format($totals['billable'], 2) }}</span> hrs |
                    <span class="fw-bold text-danger">Non-Billable</span>: <span class="text-danger">{{ number_format($totals['non_billable'], 2) }}</span> hrs |
                    <span class="fw-bold text-primary">Internal</span>: <span class="text-primary">{{ number_format($totals['internal_billable'], 2) }}</span> hrs
                </div>
            </div>
        </div>
    @endif --}}
    @if(!empty($totals))
        <div class="container mainconatiner mt-4">
            <h5 class="text-center fw-bold mb-3">Overall Summary</h5>
            <canvas id="trendChart" height="120"></canvas>

            @php
                $grandTotal = $totals['billable'] + $totals['non_billable'] + $totals['internal_billable'];
                $billablePercent = $grandTotal > 0 ? round(($totals['billable'] / $grandTotal) * 100, 2) : 0;
                $nonBillablePercent = $grandTotal > 0 ? round(($totals['non_billable'] / $grandTotal) * 100, 2) : 0;
                $internalPercent = $grandTotal > 0 ? round(($totals['internal_billable'] / $grandTotal) * 100, 2) : 0;
            @endphp

            <div class="mt-3 text-center">
                <strong class="totloverallhrs">Total Hrs: {{ number_format($grandTotal, 2) }}</strong>
                <div class="text-muted mt-2 d-flex justify-content-center gap-4 flex-wrap" style="font-size: 1rem;">
                    <div>
                        <span class="fw-bold text-success">Billable:</span>
                        <span class="text-success">{{ number_format($totals['billable'], 2) }} hrs ({{ $billablePercent }}%)</span>
                    </div>
                    <div>
                        <span class="fw-bold text-danger">Non-Billable:</span>
                        <span class="text-danger">{{ number_format($totals['non_billable'], 2) }} hrs ({{ $nonBillablePercent }}%)</span>
                    </div>
                    <div>
                        <span class="fw-bold text-primary">Internal:</span>
                        <span class="text-primary">{{ number_format($totals['internal_billable'], 2) }} hrs ({{ $internalPercent }}%)</span>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if(!empty($dailyBreakdown))
        <div class="container perdaysmrymaincontainer mt-4">
            <h5 class="fw-bold text-primary text-center mb-3">Per-Day Breakdown</h5>
            <div class="row">
                @php $i = 0; @endphp
                @foreach($dailyBreakdown as $date => $data)
                    {{-- <div class="col-md-4 mb-4"> --}}
                    <div class="col-sm-12 col-md-6 col-lg-4 mb-4">

                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <span>{{ \Carbon\Carbon::parse($date)->format('d M Y') }}</span>
                                <select class="chart-type-select form-select form-select-sm w-auto" data-chart-id="chart_{{ $loop->index }}">
                                    <option value="bar">Bar</option>
                                    <option value="pie">Pie</option>
                                </select>
                            </div>
                            <div class="card-body mainchildbody">
                                <canvas id="chart_{{ $loop->index }}" height="180"></canvas>

                                @php
                                    $total = $data['billable'] + $data['non_billable'] + $data['internal_billable'];
                                @endphp

                                <div class="mt-3">
                                    <strong class="totlhrs">
                                        Total Hrs: {{ number_format($data['billable'] + $data['non_billable'] + $data['internal_billable'], 2) }}
                                    </strong>

                                    <div class="text-muted mt-2 billhrsection">
                                        <p class="mb-2">
                                            <span class="fw-bold text-success">Billable</span>:
                                            <span class="text-success">{{ number_format($data['billable'], 2) }} hrs ({{ $data['billable_percent'] }}%)</span>
                                        </p>
                                        <p class="mb-2">
                                            <span class="fw-bold text-danger">Non-Billable</span>:
                                            <span class="text-danger" style="font-weight: 600;">{{ number_format($data['non_billable'], 2) }} hrs ({{ $data['non_billable_percent'] }}%)</span>
                                        </p>
                                        <p class="mb-2">
                                            <span class="fw-bold text-primary">Internal</span>:
                                            <span class="text-primary">{{ number_format($data['internal_billable'], 2) }} hrs ({{ $data['internal_billable_percent'] }}%)</span>
                                        </p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    @php $i++; @endphp
                    @if($i % 3 == 0)</div><div class="row">@endif
                @endforeach
            </div>
        </div>
    @endif

<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
<script src={{ asset('js/chart.js')}}></script>

<script>
    // Overall Trend Chart
    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [
                {
                    label: 'Billable',
                    data: {!! json_encode(array_values(array_column($dailyBreakdown, 'billable'))) !!},
                    borderColor: '#28a745',
                    fill: false
                },
                {
                    label: 'Non-Billable',
                    data: {!! json_encode(array_values(array_column($dailyBreakdown, 'non_billable'))) !!},
                    borderColor: '#dc3545',
                    fill: false
                },
                {
                    label: 'Internal Billable',
                    data: {!! json_encode(array_values(array_column($dailyBreakdown, 'internal_billable'))) !!},
                    borderColor: '#007bff',
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Per-Day Card Charts
    @foreach($dailyBreakdown as $date => $data)
        const chart_{{ $loop->index }} = new Chart(document.getElementById('chart_{{ $loop->index }}'), {
            type: 'bar',
            data: {
                labels: ['Billable', 'Non-Billable', 'Internal'],
                datasets: [{
                    label: 'Hours',
                    data: [
                        {{ $data['billable'] }},
                        {{ $data['non_billable'] }},
                        {{ $data['internal_billable'] }}
                    ],
                    backgroundColor: ['#28a745', '#dc3545', '#007bff'],
                    borderColor: ['#28a745', '#dc3545', '#007bff'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { 
                        position: 'top',
                        display: true,
                        labels: {
                            generateLabels: (chart) => {
                                const data = chart.data;
                                return data.labels.map((label, i) => ({
                                    text: label,
                                    fillStyle: data.datasets[0].backgroundColor[i],
                                    hidden: chart.getDatasetMeta(0).data[i].hidden,
                                    index: i
                                }));
                            }
                        },
                        onClick: (e, legendItem, legend) => {
                            const index = legendItem.index;
                            const ci = legend.chart;
                            const meta = ci.getDatasetMeta(0);
                            meta.data[index].hidden = !meta.data[index].hidden;
                            ci.update();
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        display: true // Ensure y-axis is shown for bar charts
                    }
                }
            }
        });

        // Chart type switcher
        document.querySelector(`[data-chart-id="chart_{{ $loop->index }}"]`).addEventListener('change', (e) => {
            chart_{{ $loop->index }}.config.type = e.target.value;
            chart_{{ $loop->index }}.options = {
                responsive: true,
                plugins: {
                    legend: { 
                        position: 'top',
                        display: true,
                        labels: {
                            generateLabels: (chart) => {
                                const data = chart.data;
                                return data.labels.map((label, i) => ({
                                    text: label,
                                    fillStyle: data.datasets[0].backgroundColor[i],
                                    hidden: chart.getDatasetMeta(0).data[i].hidden,
                                    index: i
                                }));
                            }
                        },
                        onClick: (e, legendItem, legend) => {
                            const index = legendItem.index;
                            const ci = legend.chart;
                            const meta = ci.getDatasetMeta(0);
                            meta.data[index].hidden = !meta.data[index].hidden;
                            ci.update();
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        display: e.target.value === 'bar' // Show y-axis only for bar charts
                    }
                }
            };
            chart_{{ $loop->index }}.update();
        });
    @endforeach
</script>


@endsection