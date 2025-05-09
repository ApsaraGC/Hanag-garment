<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands - Hanag's Garment</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            background-color: #f8f9fa;
        }

        .admin-panels {
            position: fixed;
            height: 100%;
        }

        .main-content-inner {
            flex: 1;
            margin-left: 220px;
            padding: 30px;
            min-height: 100vh;
        }


        h3 {
            color: #ff1493;
            margin: 0;
            font-size: 28px;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

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

        .alert {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 8px;
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

        img {
            border-radius: 6px;
        }

        .action-icons {
            display: flex;
            gap: 15px;
        }

        .action-icons a {
            color: #ff1493;
            font-size: 18px;
            transition: 0.3s;
        }

        .action-icons a:hover {
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

        .no-results-message {
            text-align: center;
            color: #888;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
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
    <div class="admin-panels">
        @include('admin.navbar')
    </div>

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex">
                <h3>Brands</h3>
                <a href="{{ route('admin.add-brand') }}" class="btn">Add Brand</a>
            </div>

            @if (Session::has('status'))
                <div class="alert">
                    {{ Session::get('status') }}
                </div>
            @endif

            <table>
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>
                                @if ($brand->image)
                                    <img src="{{ asset('build/assets/images/brands/' . $brand->image) }}" width="50">
                                @else
                                    <span style="color: #ccc;">No Image</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-icons">
                                    <a href="{{ route('admin.editBrand', $brand->id) }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="#" style="background:none; border:none; color:red;" class="delete-button" data-id="{{ $brand->id }}" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="no-results-message">No brands found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination">
                {{ $brands->appends(request()->query())->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const brandId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ff1493',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/delete-brand/${brandId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        }).then(response => response.json())
                          .then(data => {
                              if (data.success) {
                                  Swal.fire('Deleted!', 'Brand has been deleted.', 'success')
                                      .then(() => location.reload());
                              } else {
                                  Swal.fire('Error!', 'Something went wrong.', 'error');
                              }
                          });
                    }
                });
            });
        });
    </script>
</body>
</html>
