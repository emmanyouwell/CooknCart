@extends('layouts.app')

@section('content')
    <div style="display: flex; flex-direction: row;">
        <!-- Pie Chart for Ratings -->
        <div style="width: 500px; height: 500px;">
            <canvas id="ratingsPieChart" width="300" height="300"></canvas>
        </div>
        
        <!-- Bar Chart for Sales -->
        <div style="width: 500px; height: 500px;">
            <h1>Total Sales: ₱{{ number_format(array_sum(array_column($salesChartData, 'total_price')), 2) }}</h1>
            <canvas id="salesBarChart" width="300" height="300"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Pie Chart for Ratings data and setup
        var ratingsData = @json($chartData);

        var ratingsLabels = [];
        var ratingsValues = [];

        ratingsData.forEach(item => {
            ratingsLabels.push(item.recipe_name);
            ratingsValues.push(item.average_rating);
        });

        var ratingsPieCtx = document.getElementById('ratingsPieChart').getContext('2d');
        var ratingsPieChart = new Chart(ratingsPieCtx, {
            type: 'pie',
            data: {
                labels: ratingsLabels,
                datasets: [{
                    data: ratingsValues,
                    backgroundColor: getRandomColors(ratingsData.length),
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {}
        });

        // Bar Chart for Sales data and setup
        var salesChartData = @json($salesChartData);

        var salesLabels = [];
        var salesData = [];

        salesChartData.forEach(item => {
            salesLabels.push('Order ' + item.order_id);
            salesData.push(item.total_price);
        });

        var salesBarCtx = document.getElementById('salesBarChart').getContext('2d');
        var salesBarChart = new Chart(salesBarCtx, {
            type: 'bar',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Total Sales',
                    data: salesData,
                    backgroundColor: getRandomColor(),
                    borderColor: getRandomColor(),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        // You can adjust the step size and other options as needed
                    }
                }
            }
        });

        // Utility function to generate random colors
        function getRandomColors(count) {
            var colors = [];
            for (var i = 0; i < count; i++) {
                colors.push(getRandomColor());
            }
            return colors;
        }

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>
@endsection
