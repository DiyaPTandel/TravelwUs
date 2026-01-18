<?php include 'header.php'; 

if (isset($_SESSION['login_error'])) {
    $error_message = $_SESSION['login_error'];
    unset($_SESSION['login_error']);
}
?>

<style>
    /* Background Image */
    body {
        background: url('login-bg.jpg') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
        font-family: 'Arial', sans-serif;
    }

    /* Blur Effect */
    .bg-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: -1;
    }

    /* Centered Form */
    .login-box {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        margin: 100px auto;
        animation: fadeIn 1s ease-in-out;
    }

    .login-box h2 {
        text-align: center;
        color: #fff;
        margin-bottom: 20px;
    }

    .form-group {
        position: relative;
        margin-bottom: 20px;
    }

    .form-label {
        margin-bottom: 10px;
        display: block;
        color: #fff;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        padding-left: 15px;
        border: none;
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.2);
        color: #fff;
        font-size: 16px;
        outline: none;
        transition: background 0.3s ease;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.3);
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #007bff;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    .text-center {
        text-align: center;
    }

    .text-danger {
        font-size: 14px;
        color: #f8d7da;
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .mt-2 {
        margin-top: 10px;
    }

    a {
        color: #fff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    a:hover {
        color: #007bff;
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
</style>

<div class="bg-overlay"></div>

<div class="container">
    <div class="login-box">
        <h2>Login</h2>

        <?php if (isset($error_message)): ?>
            <div class="alert">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <form action="loginprocess.php" method="post" id="LoginForm">
            <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <div class="text-center mt-2">
                <a href="forgot_password.php">Forgot Password?</a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
$(document).ready(function(){
    $("#LoginForm").validate({
        rules: {
            email: { 
                required: true, 
                email: true 
            },
            password: { 
                required: true, 
                minlength: 6 
            }
        },
        messages: {
            email: { 
                required: "Please enter your email",
                email: "Please enter a valid email" 
            },
            password: { 
                required: "Please enter a password",
                minlength: "Password must be at least 6 characters" 
            }
        },
        errorClass: "text-danger",
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.insertAfter(element);
        },
        highlight: function(element) {
            $(element).css('background', 'rgba(255, 0, 0, 0.1)');
        },
        unhighlight: function(element) {
            $(element).css('background', 'rgba(255, 255, 255, 0.2)');
        }
    });
});
</script>

<?php include 'footer.php'; ?>
