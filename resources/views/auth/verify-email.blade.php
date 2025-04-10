<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 60px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .message {
            font-size: 14px;
            color: #4b5563;
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            padding: 10px;
            border-radius: 5px;
            font-weight: 500;
            margin-bottom: 20px;
        }
        .button-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .btn {
            background-color: #4f46e5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background-color: #4338ca;
        }
        .logout-btn {
            background: none;
            border: none;
            color: #4b5563;
            font-size: 14px;
            text-decoration: underline;
            cursor: pointer;
            padding: 0;
        }
        .logout-btn:hover {
            color: #1f2937;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message-box">
            <p class="message">
                Thanks for signing up! Please verify your email address by clicking the link in the email we just sent you.
                If you didn’t receive it, we’ll gladly send you another.
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="alert alert-success">
                    A new verification link has been sent to your email address.
                </div>
            @endif

            <div class="actions">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-primary">Resend Verification Email</button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Log Out</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
