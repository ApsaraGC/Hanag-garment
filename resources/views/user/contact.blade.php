<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
      
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin:30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            position: relative;
            color: #444
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
            color: #444
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

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <!-- CSRF Token -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="full_name" name="name" placeholder="Your Name" >
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Email Address">
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number">
                    @error('phone')<span style="color:red;">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" placeholder="Your Message"></textarea>
                </div>
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
    </div>
 <!-- Include Footer -->
    @include('layouts.Footer')
</body>
</html>
