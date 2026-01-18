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

<div class="profile-container">
    <div class="profile-sidebar">
        <div class="profile-header">
            <?php
            $profile_image = !empty($user['profile_image']) 
                ? 'uploads/' . htmlspecialchars($user['profile_image']) 
                : 'images/default-profile.jpg';
            ?>
            <img src="<?php echo $profile_image; ?>" alt="Profile Picture" class="profile-img-small">
            <h2><?php echo htmlspecialchars($user['name']); ?></h2>
        </div>
        
        <div class="profile-menu">
            <a href="profile.php" class="menu-item active">My Profile</a>
            <a href="my_bookings.php" class="menu-item">My Bookings</a>
            <a href="#" class="menu-item" id="change-password-btn">Change Password</a>
            <a href="logout.php" class="menu-item logout">Logout</a>
        </div>
    </div>

    <div class="profile-content">
        <div class="section" id="profile-section">
            <h3>Personal Information</h3>
            
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

            <div class="user-info-container">
                <div class="profile-image-section">
                    <img src="<?php echo $profile_image; ?>" alt="Profile Picture" class="profile-img">
                </div>
                <div class="user-info">
                    <p><strong>Name:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($user['phone'] ?? 'Not set'); ?></p>
                    <a href="edit_profile.php" class="edit-button">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Change Password Modal -->
<div id="change-password-modal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Change Password</h2>
        <form id="change-password-form" method="POST" action="change_password.php">
            <label for="old-password">Current Password:</label>
            <input type="password" id="old-password" name="old_password" required>
            
            <label for="new-password">New Password:</label>
            <input type="password" id="new-password" name="new_password" required>
            
            <label for="confirm-password">Confirm New Password:</label>
            <input type="password" id="confirm-password" name="confirm_password" required>
            
            <button type="submit">Update Password</button>
        </form>
    </div>
</div>

<!-- jQuery for Modal Functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $('#change-password-btn').click(function(){
        $('#change-password-modal').fadeIn();
    });
    $('.close').click(function(){
        $('#change-password-modal').fadeOut();
    });
});
</script>

<!-- CSS -->
<style>
.modal { display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
.modal-content { position: relative; padding: 20px; }
.close { position: absolute; top: 10px; right: 15px; cursor: pointer; font-size: 20px; }
input { width: 100%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 5px; }
button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; }
button:hover { background: #0056b3; }
</style>

<style>
    .profile-container {
        display: flex;
        max-width: 1200px;
        margin: 40px auto;
        gap: 30px;
        padding: 0 20px;
        min-height: calc(100vh - 200px);
    }

    .profile-sidebar {
        width: 280px;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 20px;
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .profile-header {
        text-align: center;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }

    .profile-img-small {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 15px;
        border: 3px solid #f0f0f0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .profile-header h2 {
        margin: 10px 0 5px;
        font-size: 1.2rem;
    }

    .profile-header p {
        color: #666;
        font-size: 0.9rem;
        margin: 0;
    }

    .profile-menu {
        margin-top: 20px;
    }

    .menu-item {
        display: block;
        padding: 12px 15px;
        color: #333;
        text-decoration: none;
        border-radius: 5px;
        margin-bottom: 5px;
        transition: all 0.3s ease;
    }

    .menu-item:hover, .menu-item.active {
        background: #f5f5f5;
        transform: translateX(5px);
    }

    .menu-item.active {
        background: #007bff;
        color: white;
    }

    .menu-item.logout {
        color: #dc3545;
        margin-top: 20px;
        border-top: 1px solid #eee;
        padding-top: 20px;
    }

    .menu-item.logout:hover {
        background: #dc3545;
        color: white;
    }

    .profile-content {
        flex: 1;
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        padding: 30px;
    }

    .user-info-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 30px;
        background: #f8f9fa;
        padding: 20px;
        border-radius: 10px;
        margin-top: 20px;
        text-align: center;
    }

    .profile-image-section {
        margin-bottom: 20px;
    }

    .profile-img {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .user-info {
        width: 100%;
        max-width: 500px;
    }

    .user-info p {
        margin-bottom: 15px;
        font-size: 16px;
        color: #333;
        padding: 15px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        text-align: left;
    }

    .edit-button {
        display: inline-block;
        padding: 10px 20px;
        background: #007bff;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 20px;
        transition: all 0.3s ease;
    }

    .edit-button:hover {
        background: #0056b3;
        transform: translateY(-2px);
    }

    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    .alert-success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @media (max-width: 768px) {
        .profile-container {
            flex-direction: column;
            padding: 10px;
        }

        .profile-sidebar {
            width: 100%;
            position: static;
        }

        .profile-content {
            padding: 20px;
        }

        .user-info-container {
            padding: 15px;
        }

        .profile-img {
            width: 150px;
            height: 150px;
        }
    }
</style>

<?php include 'footer.php'; ?>