<?php 
session_start();

if(isset($_SESSION['signup_success']) && !empty($_SESSION['signup_success'])) {
    unset($_SESSION['signup_success']);
    header("Location: login.php");
    exit();
}

include 'header.php'; 
?>

<?php include 'header.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<style>
    /* Background Image */
    body {
        background: url('login-bg.jpg') no-repeat center center fixed;
        background-size: cover;
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

    /* Centered Form */
    .register-box {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        margin: 10vh auto;
        animation: fadeIn 1s ease-in-out;
    }
    .form-control {
        background: rgba(255, 255, 255, 0.2);
        border: none;
        padding: 10px;
        border-radius: 8px;
        color: #fff;
        width: 100%;
        transition: 0.3s;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.4);
        outline: none;
    }
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
    }

    /* Button Styles */
    .btn-primary {
        background: linear-gradient(45deg, #007bff, #0056b3);
        border: none;
        padding: 12px;
        border-radius: 8px;
        color: white;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #0056b3, #004494);
        transform: scale(1.05);
    }


    /* Error Message Styling */
    .text-danger {
        font-size: 14px;
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

<script>
function togglePasswordVisibility() {
    let passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    } 
}
    $(document).ready(function(){
        $("#RegisterForm").validate({
            rules: {
                name: { required: true, minlength: 3 },
                email: { required: true, email: true },
                phone: { required: true, minlength: 10, maxlength: 10 },
                password: { required: true, minlength: 6 },
                confirm_password: { required: true, minlength: 6, equalTo: "#password" }
            },
            messages:{
                name: { required: "Please enter your name", minlength: "Name must be at least 4 characters long" },
                email: { required: "Please enter your email", email: "Enter a valid email" },
                phone: { required: "Please enter your phone number", email: "Enter an valid number" },
                password: { required: "Please enter a password", minlength: "At least 6 characters" },
                confirm_password: { required: "Confirm password", minlength: "At least 6 characters", equalTo:"Passwords do not match" }
            },
            errorClass: "text-danger",
            submitHandler:function(form){
                form.submit();
            }
        });
    });
</script>

<div class="bg-overlay"></div>

<div class="container">
    <div class="register-box">
        <h2 class="text-center">Register</h2>

        <?php
        if(isset($_SESSION['signup_error']) && !empty($_SESSION['signup_error'])) {
            echo '<p style="color:red;">'.$_SESSION['signup_error'].'</p>';
            unset($_SESSION['signup_error']);
        }
        if(isset($_SESSION['signup_success']) && !empty($_SESSION['signup_success'])) {
            unset($_SESSION['signup_success']);
            exit();
        }
        ?>

        <form action="registerprocess.php" method="post" id="RegisterForm">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Phone No.</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
</div>

<?php include 'footer.php'; ?>
