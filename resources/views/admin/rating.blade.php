<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Ratings - Hanag's Garment</title>
  <!-- FontAwesome CDN for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
       /* Base Reset */
       * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }

        /* Container for the content */
        .container {
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
        }


        /* Responsive table */
        @media (max-width: 768px) {
            table {
                width: 100%;
                font-size: 12px;
            }
        }

        /* Chart Styles */
        #ratingsPieChart {
            width: 100%;
            max-width: 500px;
            height: 300px;
            margin-top: 30px;
        }

        /* Popup message customization */
        .swal-popup-small {
            padding: 20px;
        }

        /* Styling for alert messages */
        .alert {
            padding: 10px;
            background-color: #ff66b2;
            color: white;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
        .main-content-inner{
            flex: 1;
    padding: 10px;
    background-color: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow-y: auto;
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
