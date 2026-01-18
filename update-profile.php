<?php
session_start();
require 'db-connect.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    
    try {
        // Handle image upload
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['profile_image']['name'];
            $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            if (!in_array($file_ext, $allowed)) {
                throw new Exception('Invalid file type. Only JPG, JPEG, PNG & GIF files are allowed.');
            }
            
            // Create unique filename
            $new_filename = 'profile_' . $user_id . '_' . time() . '.' . $file_ext;
            $upload_path = 'uploads/' . $new_filename;
            
            // Check if uploads directory exists, if not create it
            if (!file_exists('uploads')) {
                mkdir('uploads', 0777, true);
            }
            
            // Move uploaded file
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $upload_path)) {
                // Update database with new image filename
                $stmt = $pdo->prepare("UPDATE users SET name = ?, phone = ?, profile_image = ? WHERE id = ?");
                $stmt->execute([$name, $phone, $new_filename, $user_id]);
            } else {
                throw new Exception('Failed to upload image.');
            }
        } else {
            // Update without changing image
            $stmt = $pdo->prepare("UPDATE users SET name = ?, phone = ? WHERE id = ?");
            $stmt->execute([$name, $phone, $user_id]);
        }
        
        $_SESSION['success'] = "Profile updated successfully!";
        
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
    }
    
    header('Location: profile.php');
    exit();
}
?>