<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with {{ $userName }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f9;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
            min-height: 100vh;
        }

        .chat-container {
            display: flex;
            width: 100%;
            max-width: 1000px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 20px;
            height: 80vh;
        }

        .chat-links-container {
            flex-basis: 250px;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            margin-right: 20px;
            overflow-y: auto;
        }

        .chat-links h4 {
            margin: 0;
            color: #333;
            font-size: 18px;
            margin-bottom: 15px;
        }

        .chat-links {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .chat-links a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            padding: 10px 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
            transition: background 0.3s, transform 0.3s;
        }

        .chat-links a:hover {
            background: #f1f1f1;
            transform: translateY(-2px);
        }

        .chat-links i {
            margin-right: 8px;
            font-size: 18px;
        }

        .chat-box-container {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #chat-box {
            border: 1px solid #ddd;
            height: 100%;
            overflow-y: auto;
            padding: 15px;
            border-radius: 8px;
            background: #fafafa;
            flex-grow: 1;
            margin-bottom: 20px;
        }

        .message {
            padding: 10px 15px;
            margin: 5px 0;
            border-radius: 10px;
            max-width: 50%;
            word-wrap: break-word;
            clear: both;
            position: relative;
        }

        .me {
            background: #d1ffd1;
            align-self: flex-end;
            margin-left: auto;
            text-align: right;
        }

        .user {
            background: #e1ecff;
            align-self: flex-start;
            margin-right: auto;
            text-align: left;
        }

        .delete-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            color: red;
            cursor: pointer;
            font-size: 14px;
        }

        #chat-form {
            display: flex;
            gap: 10px;
        }

        #message {
            flex: 1;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="chat-container">
        <!-- Left Side (User List) -->
        <div class="chat-links-container">
            <h4>Start a New Chat</h4>
            <div class="chat-links">
                @foreach(\App\Models\User::whereNotIn('id', [auth()->id(), 2])->get() as $user)
                    <a href="{{ route('admin.chat', $user->id) }}">
                        <i class="fas fa-user"></i> {{ $user->full_name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Right Side (Chat Box and Form) -->
        <div class="chat-box-container">
            <h3>Chat with {{ $userName }}</h3>
            <div id="chat-box"></div>

            <form id="chat-form">
                <input type="hidden" id="receiver_id" value="{{ $userId }}">
                <input type="text" id="message" placeholder="Type a message..." required>
                <button type="submit"><i class="fas fa-paper-plane"></i></button>
            </form>
        </div>
    </div>

    <!-- JS Section -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchMessages() {
            $.get('{{ route("chat.fetch") }}', function(data) {
                let chatBox = $('#chat-box');
                chatBox.html('');  // Clear chat box before re-rendering

                data.forEach(msg => {
                    // Determine whether the message is from the user (me) or the admin
                    let senderClass = msg.sender_id == {{ auth()->id() }} ? 'me' : 'admin';

                    // Dynamically set the styles for left or right alignment
                    let messageElement = `<div class="message ${senderClass}" style="background-color: ${senderClass == 'me' ? '#d1ffd1' : '#e1ecff'};
                                          text-align: ${senderClass == 'me' ? 'right' : 'left'};
                                          align-self: ${senderClass == 'me' ? 'flex-end' : 'flex-start'};
                                          margin-${senderClass == 'me' ? 'left' : 'right'}: auto;">${msg.message}</div>`;

                    // Add message to the chat box
                    chatBox.append(messageElement);

                    // Scroll to the bottom of the chat box to show the latest messages
                    chatBox.scrollTop(chatBox[0].scrollHeight);
                });
            });
        }

        $('#chat-form').on('submit', function(e) {
            e.preventDefault();

            // Send the message via AJAX
            $.post('{{ route("chat.send") }}', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                receiver_id: $('#receiver_id').val(),
                message: $('#message').val()
            }, function() {
                $('#message').val('');  // Clear message input
                fetchMessages();  // Fetch the latest messages
            });
        });

        // Fetch messages every 3 seconds
        setInterval(fetchMessages, 3000);
        fetchMessages();  // Initial fetch of messages
    </script>

</body>
</html>
