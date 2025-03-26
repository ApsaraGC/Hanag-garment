<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands - Hanag's Garment</title>

    <style>
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #ffe6f2;
    margin: 0;
    padding: 0;
    display: flex;
    height: 100vh;
}

/* Sidebar Styles */


/* Content Wrapper */
.main-content-inner {
    flex: 1;
    padding: 10px;
    background-color: white;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow-y: auto;
}

/* Flex Layout for Navbar and Category Page Content */
.flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
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
}

.search-input {
    width: 40%;
    padding: 10px 35px 10px 15px;
    border: 1px solid #ff66b2;
    border-radius: 5px;
    outline: none;
}

.search-icon {
    position: absolute;
    right: 640px;
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
    background: white;
}

th,
td {
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
                <h3>Category</h3>

            </div>

            <div>
                <div class="flex">
                    <!-- Search Bar -->
                    <form action="#" method="GET" class="search-container">
                        <!-- Search Bar -->

                <input type="text" id="search" class="search-input" placeholder="Search products...">
                <i class="fas fa-search search-icon"></i>

                    </form>
                    <!-- Add New Brand -->
                    <a href="{{route('admin.add-category')}}" class="btn">+ Add New</a>
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
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>{{$category->description ?? 'N/A'}}
                            </td>
                            <td>
                                <div class="action-icons">
                                    <a href="{{ route('admin.edit-category', $category->id) }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.deleteCategory', $category->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none; background: none; cursor: pointer;">
                                            <i class="fas fa-trash-alt" style="color: red;"></i>
                                        </button>
                                    </form>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    {{$categories->links('pagination::bootstrap-4')}}
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        // Delete confirmation popup
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const categoryId = this.getAttribute('data-id');
                if (confirm('Are you sure you want to delete this category?')) {
                    // Submit delete request
                    fetch(`/admin/delete-category/${categoryId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    }).then(response => response.json())
                      .then(data => {
                          if (data.success) {
                              alert('Category deleted successfully.');
                              location.reload();
                          } else {
                              alert('Error deleting category.');
                          }
                      });
                }
            });
        });
    </script> --}}

</body>

</html>
