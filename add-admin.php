<?php
session_start();
include('db-connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['error'] = "All fields are required!";
    } elseif (strlen($password) < 6) {
        $_SESSION['error'] = "Password must be at least 6 characters!";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM admin_users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = "Email already exists!";
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO admin_users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
            if ($stmt->execute([$name, $email, $hashed_password])) {
                $_SESSION['success'] = "Admin added successfully!";
            } else {
                $_SESSION['error'] = "Failed to add admin.";
            }
        }
    }

    header("Location: add_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; text-align: center; }
        form { display: block; width: 300px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background: white; }
        input, button { display: block; width: 100%; margin-bottom: 10px; padding: 10px; }
        button { background: #007BFF; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .error-message { color: red; }
        .success-message { color: green; }
    </style>
</head>
<body>
    <h2>Add New Admin</h2>

    <?php
    if (isset($_SESSION['success'])) {
        echo "<p class='success-message'>" . $_SESSION['success'] . "</p>";
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo "<p class='error-message'>" . $_SESSION['error'] . "</p>";
        unset($_SESSION['error']);
    }
    ?>

    <form id="adminForm" method="POST">
        <input type="text" id="name" name="name" placeholder="Admin Name" required>
        <input type="email" id="email" name="email" placeholder="Admin Email" required>
        <input type="password" id="password" name="password" placeholder="Password" required>
        <button type="submit">Add Admin</button>
    </form>
</body>
</html>
