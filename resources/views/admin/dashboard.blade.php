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
        /* Sidebar (Navbar) Styles */
.admin-panels {
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    position: fixed;
    height: 100%;
}

        .main-content {
            flex: 1;
    margin-left: 200px; /* Offset for the sidebar */
    padding: 20px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    height: 100vh; /* To prevent long size issues */
    overflow-x: hidden;

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
            text-decoration: none;
            color: #333;
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
        .chat-float-button {
    position: fixed;
    bottom: 30px;
    right: 30px;
    background-color: #ff69b4;
    color: white;
    font-size: 24px;
    padding: 15px;
    border-radius: 50%;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    text-decoration: none;
    z-index: 999;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.chat-float-button:hover {
    background-color: #e0569a;
    transform: scale(1.1);
}
  /* Table */
  table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: white;
        }

        th,
        td {
            border: 1px solid #ffc0cb;
            padding: 8px; /* Decrease the padding to reduce the space between columns */
            text-align: left;
            font-size: 16px;
        }
        th {
            background: #ff66b2;
            color: white;
        }
        tr {
    /* Removing any extra padding from the row itself */
    line-height: 1.4; /* Adjust the line height to make the rows tighter */
}
tbody tr:nth-child(odd) {
    background-color: #fff0f5; /* light pink */
}

tbody tr:nth-child(even) {
    background-color: #ffe4ec; /* slightly different pink */
}


        tr:hover {
            background: #ffe6f2;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
    <div class="admin-panels">
        @include('admin.navbar')
    </div>
     <div class="main-content">
        <header>
            <h2>Welcome Back, Admin!</h2>
            <p class="today-date">{{ \Carbon\Carbon::now()->format('l, d M Y') }}</p>
        </header>
        <div class="dashboard-container">
            <!-- Link wrapped around each card for redirection -->
            <a href="{{ route('admin.users') }}" class="card">
                Total Users: {{ $totalUsers }}</a>
            <a href="{{ route('admin.products') }}" class="card">
                Total Products: {{ $totalProducts }}
            </a>

            <a href="{{ route('admin.brands') }}" class="card">
                Total Brands: {{ $totalBrands }}
            </a>
            <a href="{{ route('admin.order') }}" class="card">
                Total Orders: {{ $totalOrders }}
            </a> <!-- Static value for total orders -->
        </div>
        <div class="revenue-cards">
            <div class="revenue-card">
                <h3>Total Revenue</h3>
                <p>Rs.{{ number_format($totalEarnings, 2,) }}</p>
            </div>
            <div class="revenue-card">
                <h3>Pending (COD)</h3>
                <p>Rs.{{ number_format($pendingRevenue, 2) }}</p>
            </div>
            <div class="revenue-card">
                <h3>Online Payment</h3>
                <p>Rs.{{ number_format($onlineRevenue, 2) }}</p>
            </div>
        </div>
        <div style="margin-top: 30px;">
            <h2 style="margin-bottom: 15px; text-align: center;">Recent Orders</h2>
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; background-color: white; border-radius: 0px; overflow: hidden; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <thead style="background-color: #ff69b4; color: white;">
                        <tr>
                            <th style="padding: 12px; text-align: center;">Order ID</th>
                            <th style="padding: 12px; text-align: center;">Customer</th>
                            <th style="padding: 12px; text-align: center;">Total (Rs)</th>
                            <th style="padding: 12px; text-align: center;">Status</th>
                            <th style="padding: 12px; text-align: center;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr style="text-align: center; border-bottom: 1px solid #eee; background-color: #fafafa; transition: background-color 0.3s ease;">
                                <td style="padding: 12px;">{{ $order->id }}</td>
                                <td style="padding: 12px;">{{ $order->user->full_name ?? 'Guest' }}</td>
                                <td style="padding: 12px;">{{ number_format($order->total_amount, 2) }}</td>
                                <td style="padding: 12px;">
                                    <span style="color: {{ $order->status == 'pending' ? '#e67e22' : ($order->status == 'completed' ? '#27ae60' : '#c0392b') }};">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td style="padding: 12px;">{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="padding: 15px; text-align: center; background-color: #fff;">No recent orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
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
        {{-- <a href="{{ route('admin.chat', ['userId' => Auth::id()]) }}" class="chat-float-button" title="Chat with Users">
            <i class="fas fa-comment-dots"></i>
        </a> --}}
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

                // Generate different colors for each category bar
                const barColors = [
                    '#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40',
                    '#c9cbcf', '#9ad0f5', '#f5b041', '#52be80'
                ];

                const backgroundColors = categoryLabels.map((_, i) => barColors[i % barColors.length]);
                const borderColors = categoryLabels.map((_, i) => barColors[i % barColors.length].replace('0.7', '1'));

                // Bar Chart for Categories
                new Chart(categoryCtx, {
                    type: 'bar',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            label: 'Products per Category',
                            data: categoryCounts,
                            backgroundColor: backgroundColors,
                            borderColor: borderColors,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: { beginAtZero: true }
                        }
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
