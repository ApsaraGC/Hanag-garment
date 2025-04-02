<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            margin-bottom: 15px;
            font-size: 18px;
            color: #333;
        }

        .input-group {
            text-align: left;
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }

        .btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>This is a secure area of the application. Please confirm your password before continuing.</h2>

        <form action="/password-confirm" method="POST">
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div class="error-message"> <!-- Placeholder for error message --> </div>
            </div>

            <button type="submit" class="btn">Confirm</button>
        </form>
    </div>

</body>
</html>
