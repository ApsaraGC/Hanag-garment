<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Brand</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
            background: red;
        }

        .btn-secondary:hover {
            background: #555;
        }
    </style>
</head>

<body>

    <div class="container">
        <h3>Add New Brand</h3>

        <!-- Add Brand Form -->
        <form action="{{ route('admin.saveBrand') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Brand Name -->
            <div class="form-group">
                <label for="brand_name">Brand Name:</label>
                <input type="text" id="brand_name"value="{{old('brand_name')}}" name="brand_name" required placeholder="Enter brand name">
            </div>
         @error('brand_name')<span style="color:red;">{{$message}}</span>
         @enderror
            <!-- Brand Image Upload -->
            <div class="form-group">
                <label for="brand_image">Upload Brand Image:</label>
                <input type="file" id="image" name="image" accept="image/*" required onchange="previewImage(event)">
                <div class="image-preview" id="imagePreview">
                    <p>No image selected</p>
                </div>
            </div>
            @error('image')<span style="color:red;">{{$message}}</span>
            @enderror
            <!-- Buttons -->
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">Save Brand</button>
                <a href="{{route('admin.brands')}}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        // Function to Preview Image Before Uploading
        function previewImage(event) {
            var preview = document.getElementById("imagePreview");
            var file = event.target.files[0];
            var reader = new FileReader();

            reader.onload = function() {
                preview.innerHTML = '<img src="' + reader.result + '">';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

</body>

</html>
