<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New category</title>

    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
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
            width: 100%;
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
            background: #888;
        }

        .btn-secondary:hover {
            background: #555;
        }
    </style>
</head>

<body>

    <div class="container">
        <h3>Add New Category</h3>

        <!-- Add category Form -->
        <form action="{{ route('admin.saveCategory') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- category Name -->
            <div class="form-group">
                <label for="category_name">Category Name:</label>
                <input type="text" id="category_name"value="{{old('category_name')}}" name="category_name" required placeholder="Enter category name">
            </div>
         @error('category_name')<span style="color:red;">{{$message}}</span>
         @enderror
         <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" id="description"value="{{old('description')}}" name="description" required placeholder="Enter category name">
        </div>
     @error('description')<span style="color:red;">{{$message}}</span>
     @enderror

            <!-- Buttons -->
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Save category</button>
                <a href="{{route('admin.categorys')}}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>



</body>

</html>
