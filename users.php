<?php
include('db-connect.php');

// Fetch all regular users
$stmtUsers = $pdo->prepare("SELECT id, name, email FROM users");
$stmtUsers->execute();
$users = $stmtUsers->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
      body {
        background: linear-gradient(135deg, rgb(188, 195, 207), rgb(85, 144, 200));
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        color: #fff;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .bg-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.2);
        z-index: -1;
      }

      .container {
        max-width: 800px;
        width: 90%;
        padding: 40px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
      }

      h2 {
        color: #fff;
        text-align: center;
        margin-bottom: 20px;
      }

      table {
        width: 100%;
        border-collapse: collapse;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
      }

      th, td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      }

      th {
        background: linear-gradient(45deg,rgb(111, 130, 228),rgb(65, 76, 149));
        color: #fff;
      }

      tr:hover {
        background: rgba(255, 255, 255, 0.2);
      }

      tr:last-child td {
        border-bottom: none;
      }
    </style>
</head>
<body>
    <div class="bg-overlay"></div>
    <div class="container">
        <h2>Users List</h2>
        <?php if (empty($users)): ?>
            <p style="text-align: center; color: red;">No users found.</p>
        <?php else: ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['name']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>
