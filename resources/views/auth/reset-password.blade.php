<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Reset Password</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; padding: 50px; }
        .container { max-width: 400px; margin: auto; background: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); }
        .btn { background-color: #007BFF; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer; width: 100%; }
        .btn:hover { background-color: #0056b3; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    @if(session('status'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('status') }}',
            timer: 3000,
            showConfirmButton: false,
            width: '350px',
            padding: '5px',
            customClass: {
                popup: 'swal-popup-small'
            }
        });
    </script>
    @endif
    <div class="container">
        <h2>Reset Password</h2>
        <form method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ old('email', request()->email) }}">
            <p class="error">@error('email') {{ $message }} @enderror</p>

            <label for="password">New Password</label>
            <input type="password" id="password" name="password" >
            <p class="error">@error('password') {{ $message }} @enderror</p>

            <label for="password_confirmation">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" >
            <p class="error">@error('password_confirmation') {{ $message }} @enderror</p>
            <button type="submit" class="btn">Reset Password</button>
        </form>
    </div>
</body>
</html>
