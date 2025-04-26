<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Ratings - Hanag's Garment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
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

        .container {
            padding: 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .main-content-inner {
            flex: 1;
            padding: 10px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow-y: auto;
        }

        h1, h2 {
            color:#ff66b2;
            margin-bottom: 20px;
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


        /* Chart Styles */
        #ratingsPieChart {
            width: 100%;
            max-width: 500px;
            height: 300px;
            margin-top: 30px;
        }

        .alert {
            padding: 10px;
            background-color: #ff66b2;
            color: white;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="admin-panels">
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

            <!-- Table for User Ratings -->
            <h2>User Ratings for Products</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>User Name</th>
                        <th>Rating</th>
                        <th>Message</th>
                        {{-- <th>Actions</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($productReviews as $review)
                        <tr>
                            <td>{{ $review['product_name'] }}</td>
                            <td>{{ $review['full_name'] }}</td>
                            <td>{{ $review['rating'] }} / 5</td>
                            <td>{{ $review['message'] }}</td>
                            {{-- <td>
                                <a href="#" class="delete-review-button" data-id="{{ $review->id }}" title="Delete">
                                    <i class="fas fa-trash-alt" style="color: #e74c3c;"></i>
                                </a>
                            </td> --}}


                                                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.delete-review-button');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const reviewId = this.dataset.id;  // Get the ID from the data attribute

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This review will be permanently deleted!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74c3c',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/reviews/${reviewId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => {
                            if (response.ok) {
                                Swal.fire('Deleted!', 'The review has been removed.', 'success').then(() => {
                                    location.reload();  // Reload the page to remove the deleted review
                                });
                            } else {
                                Swal.fire('Error!', 'Something went wrong.', 'error');
                            }
                        });
                    }
                });
            });
        });
    });
</script>


</html>
