document.addEventListener('DOMContentLoaded', function () {
    const data = {
        labels: ['Red', 'Blue', 'Yellow'],
        datasets: [{
            label: 'My First Dataset',
            data: [300, 50, 100],
            backgroundColor: ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
            hoverOffset: 4
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
    };

    // Get the canvas element
    const ctx = document.getElementById('userchart').getContext('2d');

    // Create the doughnut chart
    new Chart(ctx, config);
});