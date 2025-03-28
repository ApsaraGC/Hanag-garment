<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- FontAwesome for icons -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;

            padding: 12px 30px 12px 12px; /* Adjusting for icon space on the right */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        .form-group input:focus {
            border-color: #F070BB;
            outline: none;
            background-color: #fff;
        }

        .form-group i {
            position: absolute;
            right: 10px; /* Position the icon on the right */
            top: 65%;
            transform: translateY(-50%); /* Center the icon vertically */
            color: #aaa;
            font-size: 20px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-column {
            flex: 1 1 calc(50% - 20px); /* 2 columns */
        }

        .form-column input {
            width: 100%;
        }

        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn {
            background-color: #F070BB;
            color: white;
            border: none;
            margin-left: 250px;
            text-align: center;
            padding: 12px 20px;
            width: 30%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #D5609B;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        p a {
            color: #F070BB;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<!-- Include Navigation -->
@include('layouts.navigation')

<div class="container">
    <div class="form-container">
        <h2>Register Your Account</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf

            <!-- First Row of Fields -->
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="full_name">Name</label>
                        <input type="text" id="full_name" name="full_name" placeholder="Full Name" value="{{ old('full_name') }}">
                        <i class="fa fa-user"></i> <!-- Name icon -->
                        @error('full_name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                        <i class="fa fa-envelope"></i> <!-- Email icon -->
                        @error('email')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Second Row of Fields -->
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" >
                        <i class="fa fa-phone"></i> <!-- Phone icon -->
                        @error('phone_number')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Address" value="{{ old('address') }}">
                        <i class="fa fa-home"></i> <!-- Address icon -->
                        @error('address')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Third Row of Fields -->
            <div class="form-row">
                <div class="form-column">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Password">
                        <i class="fa fa-lock"></i> <!-- Password icon -->
                        @error('password')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="password_confirmation" placeholder="Confirm Password">
                        <i class="fa fa-lock"></i> <!-- Password icon -->
                    </div>
                </div>
            </div>

            <button type="submit" class="btn">SIGN UP</button>
        </form>

        <p>
            Have an account? <a href="{{ route('login') }}">Login to your account</a>
        </p>
    </div>
</div>

<!-- Include Footer -->
@include('layouts.Footer')

</body>
</html>
