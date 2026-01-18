<?php 
include 'header.php';
require 'db-connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user details
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<div class="container">
    <div class="edit-profile-container">
        <h2>Edit Profile</h2>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php 
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <form id="editProfileForm" method="POST" action="update-profile.php" enctype="multipart/form-data">
            <div class="form-group">
                <label>Profile Picture</label>
                <input type="file" name="profile_image" accept="image/*">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly class="form-control-plaintext">
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" value="<?php echo htmlspecialchars($user['phone'] ?? ''); ?>">
            </div>
            <div class="button-group">
                <button type="submit" class="save-button">Save Changes</button>
                <a href="profile.php" class="cancel-button">Cancel</a>
            </div>
        </form>
    </div>
</div>
<style>
    .edit-profile-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 40px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }

    .edit-profile-container h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #333;
        font-size: 24px;
    }

    .form-group {
        margin-bottom: 20px;
        background: #f8f9fa;
        padding: 15px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .form-group input {
        width: 100%;
        padding: 10px 12px;
        border: 2px solid #e1e1e1;
        border-radius: 6px;
        font-size: 14px;
    }

    .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e1e1e1;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        outline: none;
    }

    .form-group input[type="file"] {
        padding: 10px;
        background: white;
    }

    .form-control-plaintext {
        background-color: #e9ecef !important;
        border: 1px solid #ced4da !important;
        cursor: not-allowed;
        color: #6c757d;
    }

    .button-group {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 25px;
    }
    .save-button, .cancel-button {
        padding: 10px 30px;
        font-size: 15px;
        font-weight: 500;
        border-radius: 6px;
        min-width: 140px;
        text-align: center;
    }

    .save-button {
        background: #007bff;
        color: white;
        border: none;
        cursor: pointer;
    }

    .save-button:hover {
        background: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,123,255,0.2);
    }

    .cancel-button {
        background: #6c757d;
        color: white;
        text-decoration: none;
    }

    .cancel-button:hover {
        background: #5a6268;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(108,117,125,0.2);
    }

    @media (max-width: 768px) {
        .edit-profile-container {
            margin: 20px;
            padding: 20px;
        }

        .button-group {
            flex-direction: column;
            gap: 15px;
        }

        .save-button, .cancel-button {
            width: 100%;
        }
    }
</style>

<?php include 'footer.php'; ?>