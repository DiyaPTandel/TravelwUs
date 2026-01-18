<?php
session_start();
require_once('db-connect.php');

// Check if user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

// Fetch all packages
$stmt = $pdo->query("SELECT * FROM packages ORDER BY created_at DESC");
$packages = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .dashboard-container {
            display: flex;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
        }

        .package-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .package-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .package-card:hover {
            transform: translateY(-5px);
        }

        .package-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 15px;
        }

        .package-card h3 {
            color: #333;
            margin: 0 0 10px 0;
            font-size: 1.4em;
        }

        .price {
            color: #05adc8;
            font-size: 1.3em;
            font-weight: bold;
            margin: 10px 0;
        }

        .duration {
            color: #666;
            margin: 10px 0;
        }

        .description {
            color: #555;
            margin: 15px 0;
            line-height: 1.4;
        }

        .features {
            color: #666;
            margin: 15px 0;
            padding-left: 20px;
        }

        .package-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            font-weight: bold;
            transition: opacity 0.2s;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-edit {
            background: #05adc8;
        }

        .btn-delete {
            background: #dc3545;
        }

        .add-package {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #05adc8;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: transform 0.2s;
            text-decoration: none;
        }

        .add-package:hover {
            transform: scale(1.1);
        }

        .created-at {
            color: #999;
            font-size: 0.8em;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <main class="main-content">
            <h1>Manage Packages</h1>
            
            <div class="package-grid">
                <?php foreach ($packages as $package): ?>
                <div class="package-card">
                    <img src="<?= htmlspecialchars($package['image_url']) ?>" alt="<?= htmlspecialchars($package['name']) ?>">
                    <h3><?= htmlspecialchars($package['name']) ?></h3>
                    <p class="price">₹<?= number_format($package['price'], 2) ?></p>
                    <p class="duration"><?= htmlspecialchars($package['duration_days']) ?> Days, <?= htmlspecialchars($package['duration_nights']) ?> Nights</p>
                    <p class="description"><?= htmlspecialchars($package['description']) ?></p>
                    <p class="features"><?= htmlspecialchars($package['features']) ?></p>
                    <p class="created-at">Created: <?= date('F j, Y', strtotime($package['created_at'])) ?></p>
                    <div class="package-actions">
                        <button class="btn btn-edit" onclick="editPackage(<?= $package['package_id'] ?>)">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button class="btn btn-delete" onclick="deletePackage(<?= $package['package_id'] ?>)">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <a href="add_package.php" class="add-package" title="Add New Package">
                <i class="fas fa-plus"></i>
            </a>
        </main>
    </div>

    <script>
        function editPackage(id) {
            window.location.href = `edit_package.php?id=${id}`;
        }

        function deletePackage(id) {
            if (confirm('Are you sure you want to delete this package?')) {
                window.location.href = `delete_package.php?id=${id}`;
            }
        }
    </script>
</body>
</html>