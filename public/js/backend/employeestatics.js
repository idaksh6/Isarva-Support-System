if (employeeData) {
    employeeData.forEach(user => {
        new Chart(document.getElementById(`chart-${user.user_id}`), {
            type: 'bar',
            data: {
                labels: [formattedRange],
                datasets: [
                    {
                        label: 'Billable',
                        data: [user.billable],
                        backgroundColor: '#4ade80',
                        stack: 'stack1'
                    },
                    {
                        label: 'Non-Billable',
                        data: [user.non_billable],
                        backgroundColor: '#e11212',
                        stack: 'stack1'
                    },
                    {
                        label: 'Internal',
                        data: [user.internal],
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
    });
}