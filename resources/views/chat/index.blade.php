<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat with Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7f9;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px;
        }

        .chat-container {
            width: 80%;
            max-width: 300px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 20px;
        }


        #chat-box {
            border: 1px solid #ddd;
            height: 300px;
            width: 280px;
            overflow-y: auto;
            padding: 15px;
            margin-bottom: 15px;
            border-radius: 8px;
            background: #fafafa;
            display: flex;
            flex-direction: column;
        }

        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 10px;
            max-width: 70%;
            word-wrap: break-word;
            clear: both;
            display: inline-block;
        }
        .me {
            background: #d1ffd1;
            align-self: flex-end; /* Sent messages align to the right */
            text-align: right;
            margin-left: auto;   /* Push the message to the right */
        }
        .admin {
            background: #e1ecff;
            align-self: flex-start; /* Admin messages align to the left */
            text-align: left;
            margin-right: auto; /* Push the message to the left */
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
        <h3>Chat with Seller</h3>
        <div id="chat-box"></div>

        <form id="chat-form">
            <input type="hidden" id="receiver_id" value="{{ $adminId }}">
            <input type="text" id="message" placeholder="Type a message..." required>
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function fetchMessages() {
            const receiverId = $('#receiver_id').val();
            $.get(`/chat/fetch/${receiverId}`, function(data) { // Use a different route for user's fetch
                let chatBox = $('#chat-box');
                chatBox.html('');

                data.forEach(msg => {
                    let senderClass = msg.sender_id == {{ auth()->id() }} ? 'me' : 'admin';
                    let messageElement = `<div class="message ${senderClass}">${msg.message}</div>`;
                    chatBox.append(messageElement);
                });
                chatBox.scrollTop(chatBox[0].scrollHeight);
            });
        }

        $('#chat-form').on('submit', function(e) {
            e.preventDefault();
            $.post('{{ route("chat.send") }}', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                receiver_id: $('#receiver_id').val(),
                message: $('#message').val()
            }, function() {
                $('#message').val('');
                fetchMessages();
            });
        });

        setInterval(fetchMessages, 3000);
        fetchMessages();
    </script>
</body>
</html>
