    <style>
        body {
            background: url('login-bg.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
        }
        /* Blur Effect */
        .bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5); /* Dark Overlay */
            backdrop-filter: blur(4px); /* Blur Effect */
            z-index: -1;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 90vh;
            padding: 20px;
        }
        .contact-container {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 20px;
            box-shadow: 0px 0px 10px gray;
            border-radius: 8px;
            max-width: 600px;
            width: 100%;
            animation: fadeIn 1s ease-in-out;
        }
        .contact-form {
            width: 100%;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 15px;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 4px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            color: #fff;
        }
        textarea {
            height: 100px;
            resize: none;
        }
        button {
            background: linear-gradient(45deg, #05adc8, #84d2f7);
            color: black;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.3s ease;
            width: 100%;
        }
        button:hover {
            background: linear-gradient(45deg, #84d2f7, #05adc8);
            transform: scale(1.05);
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        #responseMessage {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="bg-overlay"></div>

    <div class="container">
        <div class="contact-container">
            <div class="contact-form">
                <h2 style="text-align: center;">Contact Us</h2>
                <form id="contactForm" method="post" action="">
                    <div class="form-group">
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">E-mail Address:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    
                    <button type="submit">Send Message</button>
                </form>
                <p id="responseMessage"></p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#contactForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#responseMessage').text(response);
                        $('#contactForm')[0].reset();
                    }
                });
            });
        });
    </script>

    <?php include 'footer.php'; ?> 

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $message = htmlspecialchars($_POST['message']);
        
        $to = "hirebalajitravels@gmail.com";
        $subject = "New Contact Form Submission";
        $headers = "From: $email\r\n";
        $body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage:\n$message";
        
        if (mail($to, $subject, $body, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Message sending failed.";
        }
    }
    ?>
