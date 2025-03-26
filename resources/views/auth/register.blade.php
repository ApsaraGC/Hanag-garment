<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 900px;
            margin: -130px auto;
            padding: 150px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #F070BB;
            border-radius: 5px;
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
            padding: 10px 20px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #F070BB;
        }

        p {
            text-align: center;
            margin-top: 10px;
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
                <div class="form-group">
                    <label for="full_name">Name</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Name" value="{{ old('full_name') }}" required>
                    @error('full_name')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                    @error('email')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone_number">Phone Number</label>
                    <input type="text" id="phone_number" name="phone_number" placeholder="Phone Number" value="{{ old('phone_number') }}" required>
                    @error('phone_number')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" placeholder="Address" value="{{ old('address') }}" required>
                    @error('address')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    @error('password')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="password_confirmation" placeholder="Confirm Password" required>
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
