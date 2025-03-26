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

    </style>
</head>
<body>
 <!-- Include Navigation -->
 @include('layouts.navigation')

<div class="container">
    <div class="form-container">
        <h2>Log in Your Account</h2>

        <form action="{{route('login')}}" method="POST">
            @csrf
            <!-- CSRF Token -->

            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                @error('email')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                @error('password')
                    <span style="color: red; font-size: 14px;">{{ $message }}</span>
                @enderror
            </div>


            <button type="submit" class="btn">LOGIN</button>
        </form>
        <p style="text-align: center; margin-top: 10px;">
            Not Account Yet? <a href="{{route('register')}}">Create an account</a>
        </p>
    </div>
</div>

</li>

<!-- Include Footer -->
@include('layouts.Footer')
</body>
</html>
