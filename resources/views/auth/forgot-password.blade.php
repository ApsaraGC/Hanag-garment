<!-- resources/views/auth/forget-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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

    </style>
</head>
<body>

    <div class="container">
        <div class="form-container">
        <h2>Reset your password</h2>

        <!-- Display success message after password reset -->
        @if(session('status'))
            <div class="success-message">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.reset.submit') }}">
            @csrf
            <div class="form-group">
            <label for="username">Username (Email or Full Name)</label>
            <input type="text" id="username" name="username" required>
            <i class="fa fa-envelope"></i> <!-- Email icon -->

        </div>
        <div class="form-group">            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required>
            <i class="fa fa-lock"></i>
            <br>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            <i class="fa fa-eye" id="togglePassword"></i> <!-- Eye icon for toggling visibility -->

            <br>
        </div>
            <button type="submit" class="btn">Reset Password</button>
        </form>

        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
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

