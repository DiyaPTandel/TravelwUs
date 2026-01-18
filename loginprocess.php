<?php
session_start();
require 'db-connect.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        
        // Redirect to intended page or default to index
        $redirect = $_SESSION['redirect_url'] ?? 'index.php';
        unset($_SESSION['redirect_url']);
        header("Location: $redirect");
        exit();
    } else {
        $_SESSION['login_error'] = "Incorrect email or password. Please try again.";
        header("Location: login.php");
        exit();
    }
} catch(PDOException $e) {
    $_SESSION['login_error'] = "An error occurred. Please try again later.";
    header("Location: login.php");
    exit();
}
?>