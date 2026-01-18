<?php
session_start();
include('db.php'); // Ensure this file contains a valid $conn connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];  // ✅ Added phone number
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if (empty($name) || empty($email) || empty($phone) || empty($password) || empty($confirm_password)) {
        $_SESSION['signup_error'] = "All fields are required!";
        header("Location: register.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['signup_error'] = "Passwords do not match!";
        header("Location: register.php");
        exit();
    }

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists
    $sql_check_email = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql_check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $_SESSION['signup_error'] = "Email already exists!";
        header("Location: register.php");
        exit();
    }

    // ✅ Insert user data into the database (including phone)
    $sql = "INSERT INTO users (name, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $phone, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['signup_success'] = "Registration successful! You can now log in.";
        header("Location: register.php");
        exit();
    } else {
        $_SESSION['signup_error'] = "Error: " . $conn->error;
        header("Location: register.php");
        exit();
    }
}

$conn->close();
?>
