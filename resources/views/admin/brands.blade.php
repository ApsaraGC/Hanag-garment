<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands - Hanag's Garment</title>

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

/* Main Content Styles */
.main-content-inner {
    flex: 1;
    margin-left: 200px; /* Offset for the sidebar */
    padding: 20px;
    background-color: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    height: 100vh; /* To prevent long size issues */

}

/* Header */
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
}

.breadcrumbs a {
    text-decoration: none;
    color: #ff66b2;
}

.breadcrumbs a:hover {
    text-decoration: underline;
}

/* Search Box */
/* Search Box */
.search-container {
    position: relative;
    display: flex;
    align-items: center;
}

.search-input {
    width: 40%;
    padding: 10px 35px; /* Increased padding for better spacing around the text */
    border: 1px solid #ff66b2;
    border-radius: 5px; /* More rounded corners for a better look */
    outline: none;
    font-size: 14px;
}

.search-icon {
    position: absolute;
    right: 660px;
    font-size: 18px;
    color: #ff66b2;
    cursor: pointer;
    pointer-events: none; /* Prevent clicking the icon */
}

/* Focus Styles for Input */
.search-input:focus {
    border-color: #ff1493; /* Change border color when input is focused */
    box-shadow: 0 0 5px rgba(255, 20, 147, 0.5); /* Subtle glow effect */
}





/* Buttons */
.btn {
    padding: 10px 15px;
    background: #ff1493;
    color: white;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    transition: 0.3s;
    cursor: pointer;
    margin-left: 10px;
}

.btn:hover {
    background: #cc117a;
}

/* Table */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: white;
}

th, td {
    border: 1px solid #ffc0cb;
    padding: 12px;
    text-align: left;
}

th {
    background: #ffb6c1;
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

.action-icons a {
    color: #ff1493;
    text-decoration: none;
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
    padding: 8px 12px;
    margin: 5px;
    border: 1px solid #ff1493;
    color: #ff1493;
    text-decoration: none;
    border-radius: 5px;
    transition: 0.3s;
}

.pagination a:hover {
    background: #ff1493;
    color: white;
}

/* Flexbox Utility */
.flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

    </style>

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
    <div class="admin-panels">
        <!-- Sidebar -->
        @include('admin.navbar')
    </div>
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex">
                <h3>Brands</h3>
                <ul class="breadcrumbs">
                </ul>
            </div>

            <div>
                <div class="flex">
                    <!-- Search Bar -->
                    <form action="#" method="GET" class="search-container">
                        <input type="text" name="search" class="search-input" placeholder="Search brands...">
                        <i class="fas fa-search search-icon"></i>
                    </form>
                    <!-- Add New Brand -->
                    <a href="{{route('admin.add-brand')}}" class="btn">+ Add New</a>
                </div>

                @if (Session::has('status'))
                   <p class="alert alert-success">{{Session::get('status')}}</p>
                @endif

                <!-- Table -->
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
                        @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>
                                @if($brand->image)
                                    <img src="{{ asset('build/assets/images/brands/' . $brand->image) }}" width="100">
                                @else
                                    No Image
                                @endif
                            </td>


                            <td>
                                <div class="action-icons">
                                    <a href="{{ route('admin.editBrand', $brand->id) }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{route('admin.deleteBrand',$brand->id)}}" class="delete-button" data-id="{{ $brand->id }}" title="Delete">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    {{$brands->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>

    <script>
        // Delete confirmation popup
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const brandId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this brand?')) {
                    // Submit delete request
                    fetch(`/admin/delete-brand/${brandId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => response.json())
                      .then(data => {
                          if (data.success) {
                              alert('Brand deleted successfully.');
                              location.reload();
                          } else {
                              alert('Error deleting brand.');
                          }
                      });
                }
            });
        });
    </script>

</body>

</html>
