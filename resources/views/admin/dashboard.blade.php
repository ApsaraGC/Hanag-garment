<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .main-content {
            flex: 1;
            padding: 20px;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #ff69b4;
            color: white;
            border-radius: 8px;
        }
        .dashboard-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin: 20px 0px 20px 100px;
        }
        .card {
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 200px;
            font-size: 18px;
            font-weight: bold;
            transition: transform 0.3s ease-in-out;
        }
        .card:hover {
            transform: translateY(-5px);
            background-color: #fce4ec;
        }
        .revenue-cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin: 20px 0;
        }
        .revenue-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }
        .revenue-card h3 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .chart-container {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }
        .chart-box {
            flex: 1;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            height: 400px;
        }
        canvas {
            height: 320px !important;
        }
    </style>
</head>
<body>
    <div class="admin-panels">
        @include('admin.navbar')
    </div>
    <div class="main-content">
        <header>
            <div class="search-bar">
                <input type="text" placeholder="Search here">
            </div>
            <div class="admin-info">
                <p>Admin</p>
                <span>Hanag GC</span>
            </div>
        </header>

        <div class="dashboard-container">
            <div class="card">Total Users: {{ $totalUsers }}</div>
            <div class="card">Total Products: {{ $totalProducts }}</div>
            <div class="card">Total Brands: {{ $totalBrands }}</div>
            <div class="card">Total Orders: 500</div> <!-- Static value for total orders -->
        </div>

        <div class="revenue-cards">
            <div class="revenue-card">
                <h3>Total Revenue</h3>
                <p>${{ number_format($totalEarnings, 2,) }}</p>
            </div>
            <div class="revenue-card">
                <h3>Pending (COD)</h3>
                <p>${{ number_format($pendingRevenue, 2) }}</p>
            </div>
            <div class="revenue-card">
                <h3>Online Payment</h3>
                <p>${{ number_format($onlineRevenue, 2) }}</p>
            </div>
        </div>

        <div class="chart-container">
            <div class="chart-box">
                <h3>Products per Category</h3>
                <canvas id="categoryChart"></canvas>
            </div>
            <div class="chart-box">
                <h3>Products per Brand</h3>
                <canvas id="brandChart"></canvas>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var categoryCtx = document.getElementById('categoryChart').getContext('2d');
                var brandCtx = document.getElementById('brandChart').getContext('2d');

                var categoryData = @json($categories);
                var brandData = @json($brands);

                var categoryLabels = categoryData.map(cat => cat.category_name);
                var categoryCounts = categoryData.map(cat => cat.products_count);

                var brandLabels = brandData.map(brand => brand.brand_name);
                var brandCounts = brandData.map(brand => brand.products_count);

                // Bar Chart for Categories
                new Chart(categoryCtx, {
                    type: 'bar',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            label: 'Products per Category',
                            data: categoryCounts,
                            backgroundColor: 'rgba(75, 192, 192, 0.7)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: { y: { beginAtZero: true } }
                    }
                });

                // Pie Chart for Brands
                new Chart(brandCtx, {
                    type: 'pie',
                    data: {
                        labels: brandLabels,
                        datasets: [{
                            data: brandCounts,
                            backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40']
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            });
        </script>
</body>
</html>
