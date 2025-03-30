<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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
            font-size: 28px;
            position: relative;
        }

        /* Underline for heading */
        .form-container h2::after {
            content: '';
            display: block;
            width: 90px;
            height: 3px;
            background-color: #F070BB;
            margin: 10px auto 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #F070BB;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Adjusting the size of the textarea */
        .form-group textarea {
            height: 100px;
            resize: vertical; /* Allows the user to resize the textarea vertically */
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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



    <div class="container">
        <div class="form-container">
            <h2>Contact</h2>

            <form action="{{ route('messages.store') }}" method="POST">
                @csrf
                <!-- CSRF Token -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="full_name" name="name" placeholder="Your Name" >
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Your Message" required></textarea>
                </div>

                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </div>

    <!-- Include Footer -->
    @include('layouts.Footer')
</body>
</html>
