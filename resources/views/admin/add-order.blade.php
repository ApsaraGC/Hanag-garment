<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Hanag's Garment</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;

            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            /* Prevent whole page scrolling */
        }

        .admin-panels {
            height: 70px;
            /* Set your navbar height */
        }

        .content-scroll {
            width: 80%;
            display: flex;
            justify-content: center;
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            /* Enable vertical scrolling when content overflows */
            margin-bottom: 10px;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background-color: #ffffff;
            padding: 30px;
            height: 920px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            font-size: 24px;
            color: #ff66b2;
            margin-bottom: 20px;
        }

        .form-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
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
        input,
        textarea,
        select {
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
        .button-container {
            display: flex;
            justify-content: center;
            text-align: center;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-submit,
        .btn-cancel {
            padding: 10px 20px;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn-submit {
            background-color: #ff66b2;
        }

        .btn-submit:hover {
            background-color: #ff1493;
        }

        .btn-cancel {
            background-color: #dc3545;
        }

        .btn-cancel:hover {
            background-color: #c82333;
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

        .custom-checkbox input[type="checkbox"]:checked+.checkbox-box {
            background-color: #ff1493;
            border-color: #ff1493;
        }

        .custom-checkbox input[type="checkbox"]:checked+.checkbox-box::after {
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

        /* Hide number input arrows in WebKit browsers (Chrome, Safari, Edge) */
        input[type=number]#regular_price::-webkit-inner-spin-button,
        input[type=number]#regular_price::-webkit-outer-spin-button,
        input[type=number]#sale_price::-webkit-inner-spin-button,
        input[type=number]#sale_price::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Hide number input arrows in Firefox */
        input[type=number]#regular_price,
        input[type=number]#sale_price {
            -moz-appearance: textfield;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <!-- Include SweetAlert2 from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    {{-- <div class="admin-panels">
        @include('admin.navbar')
    </div> --}}
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
            <h2>Add New Product</h2>
</body>
</html>
