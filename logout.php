<?php
// Start the session
session_start();

// Include database connection
require_once 'config/database.php';

// Log the logout activity if admin is logged in
if (isset($_SESSION['admin_id'])) {
    $admin_id = $_SESSION['admin_id'];
    logActivity($admin_id, 'Logout', 'Admin logged out', $conn);
}

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page
header("Location: admin_login.php");
exit();
?>