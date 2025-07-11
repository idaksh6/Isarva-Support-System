<?php

namespace App\Traits;

trait ChartGenerator
{
    /**
     * Generate chart image using QuickChart API
     */
    public function generateChart($data, $type = 'doughnut')
    {
        $chartData = [
            'billable' => floatval($data['billable']),
            'non_billable' => floatval($data['non_billable']),
            'internal_billable' => floatval($data['internal_billable'])
        ];

        // Skip if no data
        if (array_sum($chartData) == 0) {
            return $this->generateNoDataChart();
        }

        $config = [
            'type' => $type,
            'data' => [
                'labels' => ['Billable', 'Non-Billable', 'Internal'],
                'datasets' => [[
                    'data' => array_values($chartData),
                    'backgroundColor' => [
                        '#28a745', // Green for billable
                        '#dc3545', // Red for non-billable  
                        '#007bff'  // Blue for internal
                    ],
                    'borderWidth' => 2,
                    'borderColor' => '#fff'
                ]]
            ],
            'options' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => [
                        'position' => 'bottom',
                        'labels' => [
                            'boxWidth' => 15,
                            'padding' => 15,
                            'font' => [
                                'size' => 12
                            ]
                        ]
                    ],
                    'datalabels' => [
                        'display' => true,
                        'color' => '#fff',
                        'font' => [
                            'weight' => 'bold',
                            'size' => 11
                        ],
                        'formatter' => [
                            'function' => '(value, context) => {
                                return value > 0 ? value + "h" : "";
                            }'
                        ]
                    ]
                ]
            ]
        ];

        // For bar charts, adjust the configuration
        if ($type === 'bar') {
            $config['data']['datasets'] = [
                [
                    'label' => 'Billable',
                    'data' => [$chartData['billable'], 0, 0],
                    'backgroundColor' => '#28a745'
                ],
                [
                    'label' => 'Non-Billable', 
                    'data' => [0, $chartData['non_billable'], 0],
                    'backgroundColor' => '#dc3545'
                ],
                [
                    'label' => 'Internal',
                    'data' => [0, 0, $chartData['internal_billable']],
                    'backgroundColor' => '#007bff'
                ]
            ];
            $config['data']['labels'] = ['Billable', 'Non-Billable', 'Internal'];
        }

        $chartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode($config)) . '&w=300&h=200&devicePixelRatio=2';
        
        return $chartUrl;
    }

    /**
     * Generate a "No Data" chart placeholder
     */
    private function generateNoDataChart()
    {
        $config = [
            'type' => 'doughnut',
            'data' => [
                'labels' => ['No Data'],
                'datasets' => [[
                    'data' => [1],
                    'backgroundColor' => ['#e9ecef'],
                    'borderWidth' => 1,
                    'borderColor' => '#dee2e6'
                ]]
            ],
            'options' => [
                'responsive' => true,
                'plugins' => [
                    'legend' => [
                        'display' => false
                    ],
                    'datalabels' => [
                        'display' => true,
                        'color' => '#6c757d',
                        'font' => [
                            'size' => 14,
                            'weight' => 'bold'
                        ],
                        'formatter' => [
                            'function' => '() => "No Data"'
                        ]
                    ]
                ]
            ]
        ];

        $chartUrl = 'https://quickchart.io/chart?c=' . urlencode(json_encode($config)) . '&w=300&h=200&devicePixelRatio=2';
        
        return $chartUrl;
    }
}