if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}
$(function() {
    "use strict";
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    // Employees Data
    $(document).ready(function() {
        let chart = null;
        
        function fetchData(year, month) {
            $.ajax({
                url: `get-daily-stats/${year}/${month}`,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    if(chart) {
                        chart.destroy();
                    }
                    $('#apex-MainCategories').html('<div class="text-center">Loading...</div>');
                },
                success: function(chartData) {
                    initializeChart(chartData);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching chart data:', error);
                    initializeChart({ 
                        series: [0, 0, 0], 
                        labels: ['Billable', 'Non-Billable', 'Internal Billable'] 
                    });
                }
            });
        }
    
        function initializeChart(chartData) {
            const options = {
                chart: {
                    height: 400,
                    type: 'donut',
                    align: 'center'
                },
                plotOptions: {
                    pie: {
                        donut: {
                            size: '50%',  // Increase donut hole size
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total Hours',
                                    color: 'var(--text-color)',
                                    fontSize: '16px'
                                }
                            }
                        }
                    }
                },
                labels: chartData.labels,
                series: chartData.series,
                dataLabels: { enabled: false },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    show: true,
                },
                colors: [
                    '#198754',  // Green for Billable
                    '#F44336',  // Red for Non-Billable
                    '#1e79ea'   // Dark Blue for Internal Billable
                ],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: { 
                            width: 300,  // Increased from 200
                            height: 300 
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: '50%'
                                }
                            }
                        },
                        legend: {
                            fontSize: '12px'
                        }
                    }
                }]
            };
    
            $('#apex-MainCategories').empty(); // Clear loading message
            chart = new ApexCharts(document.querySelector("#apex-MainCategories"), options);
            chart.render();
        }
    
        // Initial load with current month/year
        const initialYear = $('#yearFilter').val();
        const initialMonth = $('#monthFilter').val();
        fetchData(initialYear, initialMonth);
    
        // Add change listeners
        $('#yearFilter, #monthFilter').on('change', function() {
            const year = $('#yearFilter').val();
            const month = $('#monthFilter').val();
            fetchData(year, month);
        });
    });

    // Employees Analytics
    // $(document).ready(function() { 
    //     var options = {
    //         series: [{
    //             name: 'Available',
    //             data: [4, 19, 7, 35, 14, 27, 9, 12],
    //         }],
    //             chart: {
    //             height: 140,
    //             type: 'line',
    //             toolbar: {
    //                 show: false,
    //             }
    //         },
    //         grid: {
    //             show: false,
    //             xaxis: {
    //                 lines: {
    //                     show: false
    //                 }
    //             },   
    //             yaxis: { 
    //                 lines: {
    //                     show: false
    //                 }
    //             }, 
    //         },
    //         stroke: {
    //             width: 4,
    //             curve: 'smooth',
    //             colors: ['var(--chart-color2)'],
    //         },
    //         xaxis: {
    //             type: 'datetime',
    //             categories: ['1/11/2021', '2/11/2021', '3/11/2021', '4/11/2021', '5/11/2021', '6/11/2021', '7/11/2021', '8/11/2021'],
    //             tickAmount: 10,
    //             labels: {
    //                 formatter: function(value, timestamp, opts) {
    //                     return opts.dateFormatter(new Date(timestamp), 'dd MMM')
    //                 }
    //             }
    //         },
    //         fill: {
    //             type: 'gradient',
    //             gradient: {
    //                 shade: 'dark',
    //                 gradientToColors: [ "var(--chart-color3)" ],
    //                 shadeIntensity: 1,
    //                 type: 'horizontal',
    //                 opacityFrom: 1,
    //                 opacityTo: 1,
    //                 stops: [0, 100, 100, 100],
    //             },
    //         },
    //         markers: {
    //             size: 3,
    //             colors: ["#FFA41B"],
    //             strokeColors: "#ffffff",
    //             strokeWidth: 2,
    //             hover: {
    //                 size: 7,
    //             }
    //         },
    //         yaxis: {
    //             show: false,
    //             min: -10,
    //             max: 50,
    //         }
    //     };

    //     var chart = new ApexCharts(document.querySelector("#apex-emplyoeeAnalytics"), options);
    //     chart.render();
    // });  


    // Initialize chart
    $(document).ready(function() {
        let lastYearChart = null;
        
        // Initialize chart container
        $('#lastYearChart').html('<div class="text-center">Loading chart...</div>');
    
        function initializeChart(data) {
            // Process data for conditional styling - now based on gradient logic
            // We'll use the same logic as the gradient - lower values are red, higher are blue
            const pointColors = data.series[0].map(value => {
                // Normalize value between 0 and 100 for comparison with gradient stops
                const maxValue = Math.max(...data.series[0]);
                const normalizedValue = maxValue > 0 ? (value / maxValue) * 100 : 0;
                
                // Use similar logic as gradient - values towards 0 are red, towards 100 are blue
                return normalizedValue < 50 ? '#FF4560' : '#36A2EB';
            });
        
            // Value-based gradient configuration
            const gradientFill = {
                type: 'gradient',
                gradient: {
                    type: 'vertical',
                    shadeIntensity: 1,
                    colorStops: [
                        {
                            offset: 0,
                            color: '#36A2EB', // Blue for high values
                            opacity: 0.6
                        },
                        {
                            offset: 100,
                            color: '#FF4560', // Red for low values
                            opacity: 0.6
                        }
                    ]
                }
            };
        
            const options = {
                chart: {
                    height: 400,
                    type: 'line',
                    toolbar: { show: false },
                    zoom: { enabled: false },
                    shadow: {
                        enabled: true,
                        color: '#36A2EB',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    }
                },
                series: [{
                    name: 'Billed Hours',
                    data: data.series[0]
                }],
                stroke: {
                    width: 4,
                    curve: 'smooth',
                    colors: ['#36A2EB'], // Base line color
                    shadow: {
                        enabled: true,
                        color: '#36A2EB',
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 0.2
                    }
                },
                fill: gradientFill,
                markers: {
                    size: 6,
                    colors: pointColors, // Now matches gradient logic
                    strokeColors: '#fff',
                    strokeWidth: 2,
                    hover: {
                        size: 8,
                        strokeWidth: 3
                    }
                },
                xaxis: {
                    categories: data.labels,
                    labels: {
                        style: {
                            colors: '#6b7280',
                            fontSize: '12px'
                        }
                    }
                },
                yaxis: {
                    min: 0,
                    labels: {
                        style: {
                            colors: '#6b7280',
                            fontSize: '12px'
                        },
                         // Add  formatter to show 2 decimal places
                        formatter: function(value) {
                            return value.toFixed(2) + ' hrs';
                        }
                    }
                },
                grid: {
                    borderColor: '#e5e7eb'
                },
                tooltip: {
                    theme: 'light',
                    y: {
                        // formatter: function(val) {
                        //     return val + ' hrs';
                          formatter: function(val) {
                          return val.toFixed(2) + ' hrs';
                        }
                    }
                },
                annotations: {
                    points: data.series[0].map((value, index) => {
                        const color = pointColors[index];
                        return {
                            x: data.labels[index],
                            y: value,
                            marker: {
                                size: 6,
                                fillColor: color,
                                strokeColor: '#fff',
                                strokeWidth: 2
                            }
                        };
                    })
                }
            };
        
            // Destroy existing chart
            if(lastYearChart) lastYearChart.destroy();
        
            // Create new chart
            lastYearChart = new ApexCharts(document.querySelector("#lastYearChart"), options);
            lastYearChart.render();
        }
    
        function fetchData(year, month) {
            $.ajax({
                url: `last-one-year/${year}/${month}`,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    $('#lastYearChart').html('<div class="text-center py-4">Loading data...</div>');
                },
                success: function(data) {
                    console.log('Chart Data:', data); // For debugging
                    initializeChart(data);
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    $('#lastYearChart').html('<div class="text-center py-4 text-danger">Error loading data</div>');
                }
            });
        }
    
        // Initial load
        const initialYear = $('#yearFilter').val();
        const initialMonth = $('#monthFilter').val();
        fetchData(initialYear, initialMonth);
    
    //     // Filter change handler
    //     $('#yearFilter, #monthFilter').on('change', function() {
    //         fetchData($('#yearFilter').val(), $('#monthFilter').val());
    //     });
    // });
    // Filter change handler

    $("#yearFilter, #monthFilter, #employeeFilter").on("change", function () {
      fetchData(
        $("#yearFilter").val(),
        $("#monthFilter").val(),
        $("#employeeFilter").val()
      );
    });
  });

  // 6 month report

  $(document).ready(function () {
    let lastYearChart = null;

    function initializeChart(data) {
      const colors = ["#198754", "#1e79ea", "#F44336"]; // Green, Red, Blue

      const options = {
        chart: {
          height: 400,
          type: "bar",
          toolbar: { show: false },
          stacked: true, // Changed to true for stacked bars
        },
        series: [
          { name: "Billable", data: data.series[0] },
          { name: "Internal Billable", data: data.series[1] },
          { name: "Non-Billable", data: data.series[2] },
        ],
        colors: colors,
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "70%",
            endingShape: "rounded",
            dataLabels: {
              total: {
                enabled: true,
                style: {
                  fontSize: "13px",
                  fontWeight: 900,
                },
              },
            },
          },
        },
        dataLabels: {
          enabled: false,
        },
        stroke: {
          show: true,
          width: 1,
          colors: ["transparent"],
        },
        xaxis: {
          categories: data.labels,
          labels: {
            style: {
              colors: "#6b7280",
              fontSize: "12px",
            },
          },
        },
        yaxis: {
          title: {
            text: "Hours",
            style: {
              color: "#6b7280",
              fontSize: "12px",
            },
            
          },
          labels: {
            style: {
              colors: "#6b7280",
              fontSize: "12px",
            },
              // Add this formatter to show 2 decimal places
            formatter: function(value) {
              return value.toFixed(2);
            }
          },
        },
        grid: {
          borderColor: "#e5e7eb",
        },
        tooltip: {
          y: {
            formatter: function (val) {
              // return val + " hrs";
              return val.toFixed(2) + " hrs";  // Changed to show 2 decimal places
            },
          },
        },
        legend: {
          position: "top",
          horizontalAlign: "right",
          markers: {
            radius: 12,
          },
          itemMargin: {
            horizontal: 10,
          },
        },
      };

      if (lastYearChart) lastYearChart.destroy();
      $("#chart-loader").hide();
      $("#six-month-cart").html("");

      lastYearChart = new ApexCharts(
        document.querySelector("#six-month-cart"),
        options
      );
      lastYearChart.render();
    }

    function fetchData(year, month, employee) {
      $("#chart-loader").show();
      $("#six-month-cart").html("");

      $.ajax({
        url: `last-six-month/${year}/${month}/${employee}`,
        type: "GET",
        dataType: "json",
        success: function (data) {
          initializeChart(data);
        },
        error: function (xhr) {
          console.error("Error:", xhr.responseText);
          $("#chart-loader").html(
            '<div class="text-danger">Error loading data</div>'
          );
        },
      });
    }

    // Initial load
    fetchData(null, null, null);

    // Initial load

    const initialYear = $("#yearFilter").val();

    const initialMonth = $("#monthFilter").val();

    const employeeFilter = $("#employeeFilter").val();

    fetchData(initialYear, initialMonth, employeeFilter);

    // On filter change

    $("#yearFilter, #monthFilter,#employeeFilter").on("change", function () {
      fetchData(
        $("#yearFilter").val(),
        $("#monthFilter").val(),
        $("#employeeFilter").val()
      );
    });
  });

     // Hr Resorce
    // $(document).ready(function() {
        
    //     var options = {
    //         series: [{
    //             name: 'Ui/Ux Designer',
    //             data: [45, 25, 44, 23, 25, 41, 32, 25, 22, 65, 22, 29]
    //         }, {
    //             name: 'App Development',
    //             data: [45, 12, 25, 22, 19, 22, 29, 23, 23, 25, 41, 32]
    //         }, {
    //             name: 'Quality Assurance',
    //             data: [45, 25, 32, 25, 22, 65, 44, 23, 25, 41, 22, 29]
    //         }, {
    //             name: 'Web Developer',
    //             data: [32, 25, 22, 11, 22, 29, 16, 25, 9, 23, 25, 13]
    //         }],
    //         chart: {
    //             type: 'bar',
    //             height: 300,
    //             stacked: true,
    //             toolbar: {
    //                 show: false
    //             },
    //             zoom: {
    //                 enabled: true
    //             }
    //         },
    //         colors: ['var(--chart-color1)','var(--chart-color2)','var(--chart-color3)','var(--chart-color4)'],
    //         responsive: [{
    //             breakpoint: 480,
    //             options: {
    //                 legend: {
    //                     position: 'bottom',
    //                     offsetX: -10,
    //                     offsetY: 0
    //                 }
    //             }
    //         }],
    //         xaxis: {
    //             categories: ['Jan','Feb','March','Apr','May','Jun','July','Aug','Sept','Oct','Nov','Dec'],
    //         },
    //         legend: {
    //             position: 'top', // top, bottom
    //             horizontalAlign: 'right', // left, right
    //         },
    //         dataLabels: {
    //             enabled: false,
    //         },
    //         fill: {
    //             opacity: 1
    //         }
    //     };

    //     var chart = new ApexCharts(document.querySelector("#hiringsources"), options);
    //     chart.render();
    // });
});

