<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <!-- FontAwesome CDN for icons -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4; /* Soft background color */
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 50px;
            background-color: white; /* White background for the form */
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #5b5454;
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
            padding: 10px;
            padding-left: 20px; /* Adjust padding to make room for the icon on the left */
            padding-right: 40px; /* Make room for the icon */
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

            right: 10px;
            top: 65%;
            transform: translateY(-50%);
            color: #aaa; /* Gray color for icons */
            font-size: 20px;
        }

        .btn {
            background-color: #F070BB;
            color: white;
            border: none;
            padding: 12px 20px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #D5609B; /* Slightly darker pink on hover */
        }

        .btn:focus {
            outline: none;
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
        .form-group span {
    color: red;
    font-size: 12px;
    position: absolute;
    bottom: -18px; /* Position the error message below the input */
    left: 0;
    font-weight: normal;
}

    </style>
</head>
<body>

<!-- Include Navigation -->
@include('layouts.navigation')

<div class="container">
    <div class="form-container">
        <h2>Log Into Your Account</h2>

        <form action="{{route('login')}}" method="POST">
            @csrf
            <!-- CSRF Token -->

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}">
                <i class="fa fa-envelope" ></i> <!-- Email icon -->
                @error('email')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password">
                <i class="fa fa-eye" id="togglePassword"></i> <!-- Eye icon for toggling visibility -->
                @error('password')
                    <span>{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn">LOGIN</button>
        </form>
        <p>
            <a href="{{ route('password.request') }}">Forgot Password?</a>
        </p>

        <p>
            Don't have an account? <a href="{{route('register')}}">Create an account</a>
        </p>
    </div>
</div>

<!-- Include Footer -->
@include('layouts.Footer')
<!-- JavaScript for toggling password visibility -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
        // Toggle the type attribute of the password input
        const passwordField = document.getElementById('password');
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle the eye icon
        this.classList.toggle('fa-eye-slash');
    });
</script>
</body>
</html>
