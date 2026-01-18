<?php
session_start();
require_once('db-connect.php');

// Check if user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - TravelwUs</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #05adc8;
            --secondary-color: #84d2f7;
            --dark-color: #333;
            --light-color: #fff;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .dashboard-container {
            display: flex;
        }

        .sidebar {
            width: 250px;
            background: var(--dark-color);
            min-height: 100vh;
            padding: 20px 0;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .sidebar-header {
            padding: 0 20px;
            margin-bottom: 30px;
        }

        .sidebar-header h2 {
            color: var(--light-color);
            margin: 0;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin-bottom: 5px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #fff;
            text-decoration: none;
            transition: background 0.3s;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
        }

        .nav-link i {
            margin-right: 10px;
            width: 20px;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .card h3 {
            margin: 0 0 10px 0;
            color: var(--dark-color);
        }

        .card p {
            margin: 0;
            font-size: 24px;
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>TravelwUs</h2>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="admin_dashboard.php" class="nav-link">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="admin_packages.php" class="nav-link">
                        <i class="fas fa-box"></i>  Add Packages
                    </a>
                </li>
                <li class="nav-item">
                    <a href="feedback.php" class="nav-link">
                        <i class="fas fa-comments"></i> Feedback
                    </a>
                </li>
                <li class="nav-item">
                    <a href="posts.php" class="nav-link">
                        <i class="fas fa-newspaper"></i> Posts
                    </a>
                </li>
                <li class="nav-item">
                    <a href="users.php" class="nav-link">
                        <i class="fas fa-users"></i> Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="customize.php" class="nav-link">
                        <i class="fas fa-paint-brush"></i> Customize
                    </a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            <h1>Dashboard</h1>
            <div class="dashboard-cards">
                <div class="card">
                    <h3>Total Packages</h3>
                    <p>12</p>
                </div>
                <div class="card">
                    <h3>Total Users</h3>
                    <p>150</p>
                </div>
                <div class="card">
                    <h3>New Feedback</h3>
                    <p>5</p>
                </div>
                <div class="card">
                    <h3>Total Posts</h3>
                    <p>25</p>
                </div>
            </div>
        </main>
    </div>
</body>
</html>