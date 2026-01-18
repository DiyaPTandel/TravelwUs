<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('login-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        /* Blur Effect on Background */
        .bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px); /* Increased blur */
            z-index: -1;
        }

        .container {
            max-width: 400px;
            background: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(15px);
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: scale(1.02);
        }

        h2 {
            color: #fff;
            margin-bottom: 15px;
        }

        input {
            width: 90%;
            padding: 12px;
            margin: 12px auto;
            display: block;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease-in-out;
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        input:focus {
            border: 2px solid #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            background: rgba(255, 255, 255, 0.4);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease-in-out, transform 0.2s ease;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        #message {
            margin-top: 10px;
            color: red;
            font-size: 14px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="bg-overlay"></div> <!-- Background Blur Layer -->

    <div class="container">
        <h2>Forgot Password</h2>
        <input type="email" id="email" placeholder="Enter your email" required>
        <button id="reset-btn">Send Reset Link</button>
        <p id="message"></p>
    </div>

    <script>
        $(document).ready(function(){
            $('#reset-btn').click(function(){
                var email = $('#email').val().trim();
                if (email === '') {
                    $('#message').text('Please enter a valid email.');
                    return;
                }
                $.post('forgot_password.php', { email: email }, function(response){
                    $('#message').text(response);
                });
            });
        });
    </script>
</body>
</html>