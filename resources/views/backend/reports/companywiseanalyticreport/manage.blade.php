@extends('backend.layouts.app')

@section('title', 'Company wise Analytics Report | Isarva Support')

@section('content')


<style>


    /* Add spacing around the overall summary */
    .overall-summary {
        margin-top: 2rem;
        margin-bottom: 3rem;
        /* margin-left: 16%;
        margin-right:16%; */
        background: linear-gradient(to right, #fcf8e3 0%, #dff0d8 100%);
        /* background-color: #eef4de; */

    }

    /* Center the chart selector */
    .overall-summary .graph-type-selector {
        margin: 0 auto;
        width: 150px;
    }

    /* Add spacing between chart and stats */
    .overall-summary .chart-container {
        margin-bottom: 1.5rem;
    }

    .overallcopamywiseanalyticbody{

              background: aliceblue;

    }

</style>
<div class="container mt-4 maincompanyanayticclass">
      <h2 class="mb-4 p-3 text-center bg-light border rounded shadow-sm text-primary fw-bold" style="font-size: 1.75rem;">
        <i class="icofont-chart-bar-graph"></i></i>Company Analytics Report
    </h2>
    <!-- Search Form -->
    <div class="card shadow border-0 mb-4">
        <div class="card-body">
            <form action="{{ route('admin.companywise_analytic_report') }}" method="GET" class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label for="month" class="form-label fw-semibold text-dark">
                        <i class="icofont-calendar"></i> Select Month
                    </label>
                    <select name="month" id="month" class="form-select shadow-sm project_search">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}"
                                {{ $month == str_pad($i, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100 shadow-sm">
                        <i class="icofont-search-2"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

      <!-- Export PDF -->
    {{-- <div class="container mt-4 mb-2 m-0">
        
        <div class="card-body">
          
             <a href="{{ route('admin.company.report.pdf', ['month' => $month]) }}" class="btn btn-danger" target="_blank">
                Export PDF
            </a>

          
        </div>
        
    </div> --}}

<!-- Overall Summary Card -->
<div class="card mb-4 border-0 shadow overall-summary">
    <div class="card-header overall-summary-header">
        <h3 class="fw-bold mb-0 text-center">Overall Summary from {{ $prevMonthDate->format('F Y') }} to {{ $selectedDate->format('F Y') }}</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Previous Month Overall -->
            <div class="col-md-6 border-end premnthbody">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-primary">{{ $prevMonthDate->format('F Y') }}</h4>
                    <div class="graph-type-selector">
                        <select class="form-select form-select-sm overall-chart-type" 
                                data-month="{{ $prevMonthDate->format('m-Y') }}">
                            <option value="bar">Bar</option>
                            <option value="pie">Pie</option>
                            <option value="doughnut">Doughnut</option>
                        </select>
                    </div>
                </div>
                
                <div class="chart-container" style="height: 300px;">
                    <canvas id="overall-chart-{{ $prevMonthDate->format('m-Y') }}"></canvas>
                </div>
                
                @php $prevOverall = $overallData[$prevMonthDate->format('m-Y')]; @endphp
                <div class="mt-4 fs-5">
                    <p class="mb-1"><strong>Total hrs:</strong> {{ number_format($prevOverall['total_hrs'], 2) }} hrs</p>
                    <p class="mb-1 text-success"><strong>Billable:</strong> 
                        {{ number_format($prevOverall['billable'], 2) }} hrs
                        ({{ $prevOverall['total_hrs'] ? number_format($prevOverall['billable']/$prevOverall['total_hrs']*100, 2) : 0 }}%)
                    </p>
                    <p class="mb-1 text-danger"><strong>Non-Billable:</strong> 
                        {{ number_format($prevOverall['non_billable'], 2) }} hrs 
                        ({{ $prevOverall['total_hrs'] ? number_format($prevOverall['non_billable']/$prevOverall['total_hrs']*100, 2) : 0 }}%)
                    </p>
                    <p class="mb-0 text-primary"><strong>Internal Billable:</strong> 
                        {{ number_format($prevOverall['internal_billable'], 2) }} hrs
                        ({{ $prevOverall['total_hrs'] ? number_format($prevOverall['internal_billable']/$prevOverall['total_hrs']*100, 2) : 0 }}%)
                    </p>
                </div>
            </div>
            
            <!-- Current Month Overall -->
            <div class="col-md-6 curmonthbody">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-primary">{{ $selectedDate->format('F Y') }}</h4>
                    <div class="graph-type-selector">
                        <select class="form-select form-select-sm overall-chart-type" 
                                data-month="{{ $selectedDate->format('m-Y') }}">
                            <option value="bar">Bar</option>
                            <option value="pie">Pie</option>
                            <option value="doughnut">Doughnut</option>
                        </select>
                    </div>
                </div>
                
                <div class="chart-container" style="height: 300px;">
                    <canvas id="overall-chart-{{ $selectedDate->format('m-Y') }}"></canvas>
                </div>
                
                @php $currOverall = $overallData[$selectedDate->format('m-Y')]; @endphp
                <div class="mt-4 fs-5">
                    <p class="mb-1"><strong>Total hrs:</strong> {{ number_format($currOverall['total_hrs'], 2) }} hrs</p>
                    <p class="mb-1 text-success"><strong>Billable:</strong> 
                        {{ number_format($currOverall['billable'], 2) }} hrs 
                        ({{ $currOverall['total_hrs'] ? number_format($currOverall['billable']/$currOverall['total_hrs']*100, 2) : 0 }}%)
                    </p>
                    <p class="mb-1 text-danger"><strong>Non-Billable:</strong> 
                        {{ number_format($currOverall['non_billable'], 2) }} hrs 
                        ({{ $currOverall['total_hrs'] ? number_format($currOverall['non_billable']/$currOverall['total_hrs']*100, 2) : 0 }}%)
                    </p>
                    <p class="mb-0 text-primary"><strong>Internal Billable:</strong> 
                        {{ number_format($currOverall['internal_billable'], 2) }} hrs 
                        ({{ $currOverall['total_hrs'] ? number_format($currOverall['internal_billable']/$currOverall['total_hrs']*100, 2) : 0 }}%)
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Graphs Section -->
    @foreach($companyData as $companyId => $company)
    <div class="card mb-4 border-0 shadow overallcopamywiseanalyticbody">
        {{-- <div class="card-header bg-light"> --}}
         <div class="company-header-{{ Str::slug($company['name']) }}">
            <h3 class="fw-bold mb-0 text-center">{{ $company['name'] }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Previous Month -->
                <div class="col-md-6 border-end premnthbody">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary">{{ $prevMonthDate->format('F Y') }}</h4>
                        <div class="graph-type-selector">
                            <select class="form-select form-select-sm chart-type" 
                                    data-company="{{ $companyId }}"
                                    data-month="{{ $prevMonthDate->format('m-Y') }}">
                                <option value="bar">Bar</option>
                                <option value="pie">Pie</option>
                                <option value="doughnut">Doughnut</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="chart-{{ $companyId }}-{{ $prevMonthDate->format('m-Y') }}"></canvas>
                    </div>
                    
                    @php $prevData = $company['months'][$prevMonthDate->format('m-Y')]; @endphp
                    <div class="mt-4 fs-5">
                        <p class="mb-1"><strong>Total hrs:</strong><span class="usrhrs"> {{ number_format($prevData['total_hrs'], 2) }} hrs</span></p>
                        <p class="mb-1 text-success"><strong>Billable:</strong> 
                            {{ number_format($prevData['billable'], 2) }} hrs
                            ({{ $prevData['total_hrs'] ? number_format($prevData['billable']/$prevData['total_hrs']*100, 2) : 0 }}%)
                        </p>
                        <p class="mb-1 text-danger"><strong>Non-Billable:</strong> 
                            {{ number_format($prevData['non_billable'], 2) }} hrs 
                            ({{ $prevData['total_hrs'] ? number_format($prevData['non_billable']/$prevData['total_hrs']*100, 2) : 0 }}%)
                        </p>
                        <p class="mb-0 text-primary"><strong>Internal Billable:</strong> 
                            {{ number_format($prevData['internal_billable'], 2) }} hrs
                            ({{ $prevData['total_hrs'] ? number_format($prevData['internal_billable']/$prevData['total_hrs']*100, 2) : 0 }}%)
                        </p>
                    </div>
                </div>
                
                <!-- Current Month -->
                <div class="col-md-6 curmonthbody">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-primary">{{ $selectedDate->format('F Y') }}</h4>
                        <div class="graph-type-selector">
                            <select class="form-select form-select-sm chart-type" 
                                    data-company="{{ $companyId }}"
                                    data-month="{{ $selectedDate->format('m-Y') }}">
                                <option value="bar">Bar</option>
                                <option value="pie">Pie</option>
                                <option value="doughnut">Doughnut</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="chart-{{ $companyId }}-{{ $selectedDate->format('m-Y') }}"></canvas>
                    </div>
                    
                    @php $currData = $company['months'][$selectedDate->format('m-Y')]; @endphp
                    <div class="mt-4 fs-5">
                        <p class="mb-1"><strong>Total hrs:</strong><span class="usrhrs"> {{ number_format($currData['total_hrs'], 2) }} hrs</span></p>
                        <p class="mb-1 text-success"><strong>Billable:</strong> 
                            {{ number_format($currData['billable'], 2) }} hrs 
                            ({{ $currData['total_hrs'] ? number_format($currData['billable']/$currData['total_hrs']*100, 2) : 0 }}%)
                        </p>
                        <p class="mb-1 text-danger"><strong>Non-Billable:</strong> 
                            {{ number_format($currData['non_billable'], 2) }} hrs 
                            ({{ $currData['total_hrs'] ? number_format($currData['non_billable']/$currData['total_hrs']*100, 2) : 0 }}%)
                        </p>
                        <p class="mb-0 text-primary"><strong>Internal Billable:</strong> 
                            {{ number_format($currData['internal_billable'], 2) }} hrs 
                            ({{ $currData['total_hrs'] ? number_format($currData['internal_billable']/$currData['total_hrs']*100, 2) : 0 }}%)
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>


 <!-- Jquery Page Js -->
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
<!-- Include Charts -->
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script> --}}
<script src="{{ asset('js/chart.min.js')}}"></script>
<script src="{{ asset('js/chartjs-plugin-datalabels@2.js')}}"></script> 





<script>
    // Initialize all charts
    document.addEventListener('DOMContentLoaded', function() {
        // Register plugin
        Chart.register(ChartDataLabels);
        
        // Initialize charts
        const charts = {};
        const companyData = @json($companyData);
        
        // Create charts
        Object.keys(companyData).forEach(companyId => {
            ['{{ $prevMonthDate->format("m-Y") }}', '{{ $selectedDate->format("m-Y") }}'].forEach(monthYear => {
                const data = companyData[companyId].months[monthYear];
                const ctx = document.getElementById(`chart-${companyId}-${monthYear}`);
                const chartType = document.querySelector(`select[data-company="${companyId}"][data-month="${monthYear}"]`).value;
                
                // charts[`${companyId}-${monthYear}`] = new Chart(ctx, {
                //     type: chartType,
                //     data: {
                //         labels: ['Billable Hours', 'Non-Billable Hours', 'Internal Billable Hrs'],
                //         datasets: [{
                //             //   label: 'Hours',
                //             data: [
                //                 data.billable,
                //                 data.non_billable,
                //                 data.internal_billable
                //             ],
                //             backgroundColor: [
                //                 '#28a745', // Green
                //                 '#dc3545', // Red
                //                 '#007bff'  // Blue
                //             ]
                //         }]
                        
                //         // datasets: [
                //         //         {
                //         //             label: 'Billable',            //Prsent beside the select bar section
                //         //             data: [data.billable, 0, 0],
                //         //             backgroundColor: '#28a745'
                //         //         },
                //         //         {
                //         //             label: 'Non-Billable',
                //         //             data: [0, data.non_billable, 0],
                //         //             backgroundColor: '#dc3545'
                //         //         },
                //         //         {
                //         //             label: 'Internal',
                //         //             data: [0, 0, data.internal_billable],
                //         //             backgroundColor: '#007bff'
                //         //         }
                //         //     ],
                //         //     // labels: ['Billable', 'Non-Billable', 'Internal']

                //     },
                //     options: {
                //         responsive: true,
                //         maintainAspectRatio: false,
                //         plugins: {
                //             legend: { position: 'top' },
                //             title: {
                //                 display: true,
                //                 text: `Hours Distribution`
                //             },
                //             datalabels: {
                //                 formatter: (value) => value ? value + 'Hr' : '', // Values inside the graph
                //                 color: '#fff',
                //                 font: { weight: 'bold' }
                //             }
                //         }
                //     }
                // });

                let chartData;
                    if (chartType === 'bar') {
                        chartData = {
                            labels: ['Billable', 'Non-Billable', 'Internal'],
                            datasets: [
                                {
                                    label: 'Billable',
                                    data: [data.billable, 0, 0],
                                    backgroundColor: '#28a745',
                                      stack: 'stack1'   // Makes it wider 
                                
                                },
                                {
                                    label: 'Non-Billable',
                                    data: [0, data.non_billable, 0],
                                    backgroundColor: '#dc3545',
                                      stack: 'stack1'
                                
                                },
                                {
                                    label: 'Internal Billable',
                                    data: [0, 0, data.internal_billable],
                                    backgroundColor: '#007bff',
                                      stack: 'stack1'
                                
                                }
                            ]
                        };
                    } else {
                        chartData = {
                            labels: ['Billable', 'Non-Billable', 'Internal'],
                            datasets: [{
                                data: [
                                    data.billable,
                                    data.non_billable,
                                    data.internal_billable
                                ],
                                backgroundColor: [
                                    '#28a745',
                                    '#dc3545',
                                    '#007bff'
                                ]
                            }]
                        };
                    }

                    charts[`${companyId}-${monthYear}`] = new Chart(ctx, {
                        type: chartType,
                        data: chartData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'top' },
                                title: {
                                    display: true,
                                    text: `Hours Distribution`
                                },
                                datalabels: {
                                    formatter: (value) => value ? value + 'h' : '',
                                    color: '#fff',
                                    font: { weight: 'bold' }
                                }
                            }
                        }
                    });

            });
        });
        
        // Add chart type change listeners
        document.querySelectorAll('.chart-type').forEach(select => {
            select.addEventListener('change', function() {
                const companyId = this.dataset.company;
                const monthYear = this.dataset.month;
                const chartKey = `${companyId}-${monthYear}`;
                
                if (charts[chartKey]) {
                    charts[chartKey].destroy();
                    const ctx = document.getElementById(`chart-${companyId}-${monthYear}`);
                    
                    const data = companyData[companyId].months[monthYear];

                    // charts[chartKey] = new Chart(ctx, {
                    //     type: this.value,
                    //     data: {
                    //         labels: ['Billable', 'Non-Billable', 'Internal'],
                    //         datasets: [{
                    //             //    label: 'Billable',
                    //             data: [
                    //                 data.billable,
                    //                 data.non_billable,
                    //                 data.internal_billable
                    //             ],
                    //             backgroundColor: [
                    //                 '#28a745', // Green
                    //                 '#dc3545', // Red
                    //                 '#007bff'  // Blue
                    //             ]
                    //         }]
                    //     },
                    //     options: {
                    //         responsive: true,
                    //         maintainAspectRatio: false,
                    //         plugins: {
                    //             legend: { position: 'top' },
                    //             title: {
                    //                 display: true,
                    //                 text: `Hours Distribution`
                    //             },
                    //             datalabels: {
                    //                 formatter: (value) => value ? value + 'h' : '',
                    //                 color: '#fff',
                    //                 font: { weight: 'bold' }
                    //             }
                    //         }
                    //     }
                    // });

                    let chartData;
                    if (this.value === 'bar') {
                        chartData = {
                            labels: ['Billable', 'Non-Billable', 'Internal'],
                            datasets: [
                                {
                                    label: 'Billable',
                                    data: [data.billable, 0, 0],
                                    backgroundColor: '#28a745',
                                      stack: 'stack1'
                                
                                },
                                {
                                    label: 'Non-Billable',
                                    data: [0, data.non_billable, 0],
                                    backgroundColor: '#dc3545', 
                                      stack: 'stack1'
                                
                                },
                                {
                                    label: 'Internal Billable',
                                    data: [0, 0, data.internal_billable],
                                    backgroundColor: '#007bff',
                                      stack: 'stack1'
                                    
                                }
                            ]
                        };
                    } else {
                        chartData = {
                            labels: ['Billable', 'Non-Billable', 'Internal'],
                            datasets: [{
                                data: [
                                    data.billable,
                                    data.non_billable,
                                    data.internal_billable
                                ],
                                backgroundColor: [
                                    '#28a745', '#dc3545', '#007bff'
                                ]
                            }]
                        };
                    }

                    charts[chartKey] = new Chart(ctx, {
                        type: this.value,
                        data: chartData,
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'top' },
                                title: {
                                    display: true,
                                    text: `Hours Distribution`
                                },
                                datalabels: {
                                    formatter: (value) => value ? value + 'h' : '',
                                    color: '#fff',
                                    font: { weight: 'bold' }
                                }
                            }
                        }
                    });

                }
            });
        });


            
        // Initialize overall charts
        const overallCharts = {};

        function initOverallChart(monthYear, type) {
            const ctx = document.getElementById(`overall-chart-${monthYear}`).getContext('2d');
            const data = @json($overallData)[monthYear];
            
            if (overallCharts[monthYear]) {
                overallCharts[monthYear].destroy();
            }
            
            let chartData;
            if (type === 'bar') {
                chartData = {
                    labels: ['Billable', 'Non-Billable', 'Internal'],
                    datasets: [
                        {
                            label: 'Billable',
                            data: [data.billable, 0, 0],
                            backgroundColor: '#28a745',
                            stack: 'stack1'
                        },
                        {
                            label: 'Non-Billable',
                            data: [0, data.non_billable, 0],
                            backgroundColor: '#dc3545',
                            stack: 'stack1'
                        },
                        {
                            label: 'Internal Billable',
                            data: [0, 0, data.internal_billable],
                            backgroundColor: '#007bff',
                            stack: 'stack1'
                        }
                    ]
                };
            } else {
                chartData = {
                    labels: ['Billable', 'Non-Billable', 'Internal'],
                    datasets: [{
                        data: [
                            data.billable || 0,
                            data.non_billable || 0,
                            data.internal_billable || 0
                        ],
                        backgroundColor: [
                            '#28a745',
                            '#dc3545',
                            '#007bff'
                        ]
                    }]
                };
            }
            
            overallCharts[monthYear] = new Chart(ctx, {
                type: type,
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: {
                            display: true,
                            text: `Hours Distribution`
                        },
                        datalabels: {
                            formatter: (value) => value ? value + 'h' : '',
                            color: '#fff',
                            font: { weight: 'bold' }
                        }
                    }
                }
            });
        }

        // Initialize both overall charts
        initOverallChart('{{ $prevMonthDate->format("m-Y") }}', 'bar');
        initOverallChart('{{ $selectedDate->format("m-Y") }}', 'bar');

        // Change overall chart type
        document.querySelectorAll('.overall-chart-type').forEach(select => {
            select.addEventListener('change', function() {
                const monthYear = this.dataset.month;
                initOverallChart(monthYear, this.value);
            });
        });
    });



    
 

</script>




@endsection