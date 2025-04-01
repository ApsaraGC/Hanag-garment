<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Ratings - Hanag's Garment</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        /* Custom styles for the table */
        /* Center the container */
        .container {
            padding: 20px;
            display: flex;
            margin-left:350px ;

            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
            flex-direction: column; /* Align content vertically */
            height: 100vh; /* Full viewport height */
        }

        /* Table */
        table {
            width: 80%; /* Adjust width of the table */
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add shadow for effect */
        }

        th,
        td {
            border: 1px solid #de7586;
            padding: 10px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #ff66b2;
            color: white;
        }

        tr:hover {
            background: #ffe6f2;
        }

        /* Style for the chart */
        #ratingsPieChart {
            width: 100%;
            height: 300px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="admin-panels">
        <!-- Sidebar -->
        @include('admin.navbar')
    </div>

    @if(session('popup_message'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('popup_message') }}',
                timer: 3000,
                showConfirmButton: false,
                width: '350px',
                padding: '5px',
                customClass: {
                    popup: 'swal-popup-small'
                }
            });
        </script>
    @endif

    <div class="main-content-inner">

        <div class="container">
            <h1>Product Ratings</h1>

            <!-- Table for Brand Ratings -->
            <h2>Brand Ratings</h2>


            <!-- Pie Chart for Brand Ratings -->
            <h2>Brand Ratings Distribution</h2>
            <canvas id="ratingsPieChart"></canvas>

            <script>
                // Data for Pie Chart
                const brandNames = @json($brandRatings->pluck('brand_name'));
                const averageRatings = @json($brandRatings->pluck('average_rating'));

                // Create Pie Chart
                const ctx = document.getElementById('ratingsPieChart').getContext('2d');
                const ratingsPieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: brandNames, // Labels will be brand names
                        datasets: [{
                            label: 'Average Rating',
                            data: averageRatings, // Data will be the average ratings
                            backgroundColor: [
                                '#FF6384', '#36A2EB', '#FFCE56', '#FF5733', '#9C27B0', '#4CAF50'
                            ], // Colors for each brand slice
                            borderColor: '#fff',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return tooltipItem.label + ': ' + tooltipItem.raw.toFixed(1) + ' / 5';
                                    }
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</body>
</html>
