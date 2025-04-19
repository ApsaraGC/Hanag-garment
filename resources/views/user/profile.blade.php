<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Hanag Garments</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Reset & General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0px;
            padding: 0;
            background-color: #f9f9f9;
        }

        .account-info {
            display: flex;
            align-items: center;
            gap: 40px;
            justify-content: center;
            padding: 40px;
            max-width: 600px;
            margin: 40px auto;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .right-section {
            width: 65%;
        }

        .right-section img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
            margin: 10px auto;
        }

        .right-section h2 {
            margin-bottom: 20px;
            color: #ff69b4;
        }

        .profile-form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .profile-form input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ff69b4;
            border-radius: 5px;
        }

        /* Save Button Styles */
        button {
            background-color: #ff69b4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ff85c1;
        }

        /* Cancel Button Styles */
        .btn-cancel {
            background: #dc3545;
            color: #fff;
            text-decoration: none;
            display: inline-block;
            padding: 10px 20px;
            margin-top: 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-cancel:hover {
            background: #a71d2a;
        }

        /* Layout & Spacing */
        .left-section h2 {
            color: #ff69b4;
        }

        .actions {
            display: flex;
            gap: 20px;
            justify-content: center;
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .account-info {
                padding: 20px;
                margin: 20px;
            }

            .right-section {
                width: 100%;
            }
            .btn-cancel, button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Include Navigation -->
    @include('layouts.navigation')
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

    <div class="account-info">
        <div class="right-section">
            <h2>Edit Your Information</h2>

            <!-- Profile Image -->
            {{-- <img id="profile-image" src="{{ asset(Auth::user()->image) }}" alt="Profile Image"> --}}

            <!-- Image Upload Form -->
            <form  class="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- <label for="profile-picture">Upload New Image</label>
                <input type="file" id="profile-picture" name="profile_picture" accept="image/*" onchange="previewImage(event)"> --}}

                <label for="full-name">Full Name</label>
                <input type="text" id="full-name" name="full_name" value="{{ old('full_name', Auth::user()->full_name ) }}" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', Auth::user()->email ) }}" required>

                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone_number" value="{{ old('phone_number', Auth::user()->phone_number) }}">

                <div class="actions">
                    <button class="upload-btn" type="submit">Save Changes</button>
                    <a href="{{ route('dashboard') }}" class="btn-cancel">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const image = document.getElementById('profile-image');
            image.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>

    <!-- Include Footer -->
    @include('layouts.footer')
</body>
</html>
