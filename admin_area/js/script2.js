 document.addEventListener('DOMContentLoaded', function () {
            const data = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'View',
                    borderColor: "blue",
                    data: [500, 700, 600, 800, 900, 750],
                    backgroundColor: "rgb(235, 247, 245, 0.7)",
                    borderWidth: 2
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            // Get the canvas element
            const ctx = document.getElementById('accessChart').getContext('2d');

            // Create the bar chart
            new Chart(ctx, config);
        });