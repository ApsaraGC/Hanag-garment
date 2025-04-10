<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Hanag's Garment</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* General Styles */
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
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

        .main-content-inner {
            flex: 1;
            margin-left: 200px;
            /* Offset for the sidebar */
            padding: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            height: 100vh;
            /* To prevent long size issues */

        }

        h3 {
            color: #ff1493;
            margin: 0;
        }

        /* Breadcrumbs */
        .breadcrumbs {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 10px;
            font-size: 14px;
        }

        .breadcrumbs a {
            text-decoration: none;
            color: #ff66b2;
        }

        .breadcrumbs a:hover {
            text-decoration: underline;
        }

        /* Search Box */
        .search-container {
            position: relative;
            display: flex;
            align-items: center;
            max-width: 300px;
            width: 100%;
        }

        .search-input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ff66b2;
            border-radius: 5px;
            outline: none;
            font-size: 14px;
        }

        .search-icon {
            position: absolute;
            right: 10px;
            font-size: 18px;
            color: #ff66b2;
            cursor: pointer;
        }

        /* Buttons */
        .btn {
            padding: 10px 15px;
            background: #ff1493;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.3s;
            cursor: pointer;
        }

        .btn:hover {
            background: #cc117a;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
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

        /* Action Icons */
        .action-icons {
            display: flex;
            gap: 10px;
        }

        .action-icons a,
        .action-icons {
            color: #ff1493;
            text-decoration: none;
            font-size: 18px;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .action-icons a:hover,
        .action-icons button:hover {
            color: #cc117a;
        }

        /* Pagination */
        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 15px;
            margin: 5px;
            border: 1px solid #ff1493;
            color: #ff1493;
            text-decoration: none;
            border-radius: 50px;
            font-size: 14px;
            transition: 0.3s;
        }

        .pagination a:hover {
            background: #ff1493;
            color: white;
        }

        /* Active Page */
        .pagination .active a {
            background: #ff1493;
            color: white;
            font-weight: bold;
        }

        .pagination .disabled a,
        .pagination .disabled .page-link {
            color: #ccc;
            cursor: not-allowed;
        }

        .pagination .prev:disabled,
        .pagination .next:disabled {
            background: #e0e0e0;
            color: #ccc;
            cursor: not-allowed;
        }

        /* Adjust the pagination numbers */
        .pagination .page-item {
            display: inline-block;
        }

        /* Center pagination numbers properly */
        .pagination .page-item .page-link {
            display: inline-block;
            padding: 8px 16px;
        }



        /* Flexbox Utility */
        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .admin-panels {
                width: 100%;
                box-shadow: none;
            }

            .main-content-inner {
                margin: 10px;
            }

            .flex {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .search-container {
                display: flex;
                align-items: center;
                gap: 5px;
            }

            .search-input {
                width: 250px;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            .btn-search {
                background: #3498db;
                color: white;
                border: none;
                padding: 8px 12px;
                border-radius: 5px;
                cursor: pointer;
            }

            .btn {
                width: 100%;
                text-align: center;
            }
        }

        /* custom styles for success alert */
        .alert-success {
            background-color: #28a745;
            /* Green background */
            color: white;
            /* White text */
            padding: 15px;
            border-radius: 5px;
            font-size: 16px;
            margin: 10px 0;
            border: 1px solid #218838;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
                width: '350px',  // Adjust width as needed
                padding: '5px', // Optional: Adjust padding
                customClass: {
                    popup: 'swal-popup-small'
                }
            });
        </script>
    @endif

    <div class="main-content-inner">
        <h3>Products - Hanag's Garment</h3>

        <!-- Breadcrumbs -->
        <ul class="breadcrumbs">

        </ul>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}


            </div>
        @endif
        <div class="flex">
            <form action="{{ route('admin.products') }}" method="GET">
                <div class="search-container">
                    <input type="text" id="search" class="search-input" name="search" placeholder="Search products...">
                    <i class="fas fa-search search-icon"></i>
                </div>
                <input type="hidden" name="page" value="1">
            </form>

            <a href="{{ route('admin.add-product') }}" class="btn">Add Product</a>
        </div>
        <!-- Product Table -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Brand</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($products->count() > 0)
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" width="50" alt="{{ $product->product_name }}">
                                @else
                                    No Image
                                @endif
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category->category_name }}</td>
                            <td>{{ $product->brand->brand_name ?? 'N/A' }}</td>
                            <td>${{ $product->regular_price }}</td>
                            <td>{{ $product->stock_status }}</td>
                            <td>{{ $product->quantity }}</td>
                            <td>
                           <a href="{{ route('admin.editProducts', $product->id) }}" title="Edit"><i class="fas fa-edit" style="color:rgb(255, 0, 200);"></i></a>
                                <form action="{{ route('admin.deleteProducts', $product->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="background:none; border:none; color:red;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="9" style="text-align: center; font-size: 18px; font-weight: bold; color: red;">
                            No products found!
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        <!-- Pagination -->
        <div class="pagination">
            {{ $products->appends(request()->query())->links('pagination::bootstrap-5') }}
        </div>

    </div>
</body>

</html>
