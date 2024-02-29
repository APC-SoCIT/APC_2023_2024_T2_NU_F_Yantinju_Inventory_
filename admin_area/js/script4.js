Chart.defaults.global.defaultFontFamily = "Poppins";
let ctx = document.querySelector("#revenueChart");
ctx.height = 53;

let revChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [], // Empty labels array to be populated later
        datasets: [{
            label: "Sales", // Change label to "Sales"
            borderColor: "blue",
            backgroundColor: "rgba(235, 247, 245, 0.5)",
            data: [] // Empty data array to be populated later
        
        }, {
            label: "Previous Month Sales", // Label for previous month sales
            borderColor: "green",
            backgroundColor: "rgba(211, 235, 221, 0.5)",
            data: [] // Empty data array to be populated later
        
        }]
    },
    options: {
        responsive: true,
        tooltips: {
            intersect: false,
            mode: 'index'
        }
    }
});

// Add event listener to monthSelect dropdown
let monthSelect = document.getElementById("monthSelect");
monthSelect.addEventListener("change", function () {
    let selectedMonth = this.value;
    fetchDataForMonth(selectedMonth);
});

// Function to fetch data for selected month
function fetchDataForMonth(month) {
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_data.php?month=" + month, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            
            let previousMonth = parseInt(month) - 1;
            let data = JSON.parse(xhr.responseText);

            // Extracting labels and sales data from fetched data for current month
            let labels = data.current_month.map(entry => entry.day);
            let salesData = data.current_month.map(entry => entry.sales);
            let labels2 = data.previous_month.map(entry => entry.day);
            let salesData2 = data.previous_month.map(entry => entry.sales);

            // Update chart data with fetched data for current month
            revChart.data.labels = labels;
            revChart.data.datasets[0].data = salesData;

            // Update chart data with fetched data for previous month
            revChart.data.datasets[1].data = salesData2;

            // Update the chart
            revChart.update();
        }
    };
    xhr.send();
}

// Initial data fetch for the default selected month
let initialMonth = monthSelect.value;
fetchDataForMonth(initialMonth);
