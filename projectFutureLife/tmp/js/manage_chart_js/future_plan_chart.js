let myChart; // Chart cost

/**
 * Update chart
 * param year [int]
 */
function updateChart(year) {
    fetch(`roles/admin/API/manage_chart/manage_chart_future_plan.php?year=${year}`)
        .then(response => response.json())
        .then(data => {
            // Test error
            if (data.error) {
                console.error('Error:', data.error);
                return;
            }
            var ctx = document.getElementById('myChart').getContext('2d');
            // Delete chart if chart exist
            if (myChart) {
                myChart.destroy();
            }
            // Create chart
            myChart = new Chart(ctx, {
                type: 'bar', // chart bar
                data: {
                    labels: data.labels,
                    datasets: data.datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: `Tổng kế hoạch được thực hiện trong các tháng trong năm ${year}`
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Fetch error:', error));
}

// Action update chart
document.getElementById('updateChart').addEventListener('click', function() {
    // year chart
    let year = document.getElementById('year').value;
    updateChart(year);
});

// First show chart
document.addEventListener('DOMContentLoaded', function() {
    const currentYear = new Date().getFullYear();
    document.getElementById('year').value = currentYear; // Year now
    updateChart(currentYear);
});