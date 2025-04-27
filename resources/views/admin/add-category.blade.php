<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New category</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;

            margin: 0;
            padding: 0;
            overflow: hidden;
            /* Prevent whole page scrolling */
        }

        .admin-panels {
            height: 70px;
            /* Set your navbar height */
        }

        .content-scroll {
            display: flex;
            justify-content: center;
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            /* Enable vertical scrolling when content overflows */
            margin-bottom: 10px;
        }
        .container {
            width: 60%;
            max-width: 900px;
            background-color: #ffffff;
            padding: 30px;
            height: 370px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            text-align: center;
            color: #ff1493;
        }
        /* Form Styling */
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="file"] {
            width: 96%;
            padding: 10px;
            border: 1px solid #ff66b2;
            border-radius: 5px;
            outline: none;
        }
        /* Image Preview */
        .image-preview {
            width: 100px;
            height: 100px;
            border: 1px solid #ff66b2;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
            overflow: hidden;
            border-radius: 5px;
        }
        .image-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        /* Buttons */
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 15px;
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            transition: 0.3s;
        }
        .btn-primary {
            background: #ff1493;
        }
       .btn-primary:hover {
            background: #cc117a;
        }

        .btn-secondary {
            background-color: #dc3545;
        }

        .btn-secondary:hover {
            background: #555;
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
                width: '350px',  // Adjust width as needed
                padding: '5px', // Optional: Adjust padding
                customClass: {
                    popup: 'swal-popup-small'
                }
            });
        </script>
    @endif
    <div class="content-scroll">

        <div class="container">
            <h3>Add New Category</h3>

            <!-- Add category Form -->
            <form action="{{ route('admin.saveCategory') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- category Name -->
                <div class="form-group">
                    <label for="category_name">Category Name:</label>
                    <input type="text" id="category_name" value="{{old('category_name')}}" name="category_name">
                    @error('category_name')<span style="color:red;">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <input type="text" id="description" value="{{old('description')}}" name="description">
                    @error('description')<span style="color:red;">{{$message}}</span>
                    @enderror
                </div>

                <!-- Category Image -->
                <div class="form-group">
                    <label for="image">Category Image:</label>
                    <input type="file" id="image" name="image">
                    @error('image')<span style="color:red;">{{ $message }}</span>@enderror
                </div>

                <!-- Buttons -->
                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">Save category</button>
                    <a href="{{route('admin.categorys')}}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
</body>

</html>
