<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Hanag's Garment</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffe6f2;
            margin: 0;
            padding: 20px;
        }

        /* Container */
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            color: #ff1493;
            text-align: center;
        }

        /* Form Layout */
        .form-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        /* Labels */
        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: black;
        }

        /* Input Fields */
        input, textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ff66b2;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
            height: 80px;
        }

        /* Full Width Fields */
        .full-width {
            grid-column: span 2;
        }

        /* File Upload */
        .file-upload input[type="file"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ff66b2;
            background: white;
            cursor: pointer;
        }

        .file-upload input[type="file"]:hover {
            border-color: #ff1493;
        }

        /* Image Preview */
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
            justify-content: center;
        }

        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ff66b2;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }



        /* Submit Button */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background: #ff1493;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-submit:hover {
            background: #cc117a;
        }
       /* Custom Checkbox */
       .custom-checkbox label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.custom-checkbox input[type="checkbox"] {
    display: none;
}

.custom-checkbox .checkbox-box {
    width: 18px;
    height: 18px;
    border: 2px solid #ff1493;
    border-radius: 4px;
    display: inline-block;
    transition: 0.3s;
    position: relative;
}

.custom-checkbox input[type="checkbox"]:checked + .checkbox-box {
    background-color: #ff1493;
    border-color: #ff1493;
}

.custom-checkbox input[type="checkbox"]:checked + .checkbox-box::after {
    content: "✔";
    font-size: 14px;
    color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
        /* Image Preview */
        .image-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 10px;
            justify-content: center;
        }

        .image-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            border: 1px solid #ff66b2;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
        }





        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add New Product</h2>
        <form action="{{route('admin.storeProduct')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-container">
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" id="product_name" name="product_name" value="{{ old('product_name') }}">
                </div>
                @error('product_name')<span style="color:red;">{{$message}}</span>
         @enderror
                <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" id="color" name="color" value="{{ old('color') }}">
                </div>
                @error('color')<span style="color:red;">{{$message}}</span>
         @enderror
                <div class="form-group">
                    <label for="size">Size</label>
                    <input type="number" id="size" name="size" value="{{ old('size') }}">
                </div>
                @error('size')<span style="color:red;">{{$message}}</span>
         @enderror
                <div class="form-group">
                    <label for="short_description">Short Description</label>
                    <input type="text" id="short_description" name="short_description" value="{{ old('short_description') }}">
                </div>
                @error('short_description')<span style="color:red;">{{$message}}</span>
         @enderror
                <div class="form-group full-width">
                    <label for="description">Long Description</label>
                    <textarea id="description" name="description">{{ old('description') }}</textarea>
                </div>
                @error('description')<span style="color:red;">{{$message}}</span>
         @enderror

                <div class="form-group">
                    <label for="regular_price">Regular Price ($)</label>
                    <input type="number" id="regular_price" name="regular_price" value="{{ old('regular_price') }}" >
                </div>
                @error('regular_price')<span style="color:red;">{{$message}}</span>
         @enderror
                <div class="form-group">
                    <label for="sale_price">Sale Price ($)</label>
                    <input type="number" id="sale_price" name="sale_price" value="{{ old('sale_price') }}">
                </div>
                @error('sale_price')<span style="color:red;">{{$message}}</span>
         @enderror
                <div class="col-md-6 form-group">
                    <label>Stock Status</label>
                    <select name="stock_status" required>
                        <option value="instock" {{ old('stock_status') == 'instock' ? 'selected' : '' }}>In Stock</option>
                        <option value="outofstock" {{ old('stock_status') == 'outofstock' ? 'selected' : '' }}>Out of Stock</option>
                    </select>
                </div>
                @error('stock_status')<span style="color:red;">{{$message}}</span>
         @enderror

                <div class="col-md-6 form-group">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}" min="1">
                </div>
                @error('quantity')<span style="color:red;">{{$message}}</span>
         @enderror
                <div class="col-md-6 form-group">
                    <label>Category</label>
                    <select name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')<span style="color:red;">{{$message}}</span>
         @enderror
                <div class="col-md-6 form-group">
                    <label>Brand</label>
                    <select name="brand_id">
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('brand_id')<span style="color:red;">{{$message}}</span>
         @enderror

        @error('image')<span style="color:red;">{{$message}}</span>
        @enderror
        <div class="form-group full-width file-upload">
            <label for="image">Main Image</label>
            <input type="file" id="image" name="image" onchange="previewImage(event, 'mainPreview')">
            <div class="image-preview" id="mainPreview"></div>
        </div>

        <!-- Additional Images -->
        @error('images')
            <span style="color:red;">{{$message}}</span>
        @enderror

       
        <div class="form-group">
            <label for="images">Product Images</label>
            <input type="file" name="images[]" class="form-control" accept="image/*" multiple>
            {{-- <div class="image-preview" id="additionalImagePreview"></div> --}}
                </div>



                <div class="form-group custom-checkbox">
                    <label for="is_featured">
                        <input type="checkbox" id="is_featured" name="is_featured" {{ old('is_featured') ? 'checked' : '' }}>
                        <span class="checkbox-box"></span>
                        Is Featured
                    </label>
                </div>
                @error('is_featured')<span style="color:red;">{{$message}}</span>
                 @enderror

            </div>
            <button type="submit" class="btn-submit">Add Product</button>
        </form>
    </div>
    <script>
    // Preview the main image
    function previewImage(event, previewId) {
        const preview = document.getElementById(previewId);
        preview.innerHTML = ''; // Clear previous previews
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function() {
                const img = document.createElement('img');
                img.src = reader.result;
                img.style.maxWidth = '100px'; // Optional, to resize the preview
                img.style.maxHeight = '100px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        }
    }

    // Preview multiple additional images
    function previewImages(event) {
        const previewContainer = document.getElementById('additionalImagePreview');
        previewContainer.innerHTML = ''; // Clear previous previews
        const files = event.target.files;

        // Loop through the selected files and add them to the preview container
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function() {
                const img = document.createElement('img');
                img.src = reader.result;
                img.style.maxWidth = '100px'; // Optional, to resize the preview
                img.style.maxHeight = '100px';
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        }
    }
</script>

    </script>
</body>
</html>
