<?php
session_start();

// Admin credentials
$admin_username = "admin";
$admin_password = "Admin@123"; // In a real application, this should be hashed

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate credentials
    if ($username === $admin_username && $password === $admin_password) {
        // Set session variables
        $_SESSION['admin_id'] = 1;
        $_SESSION['admin_name'] = "Administrator";
        $_SESSION['admin_username'] = $username;
        
        // Redirect to dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Invalid credentials
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: admin_login.php");
        exit();
    }
}
?>