<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "db_username", "db_password", "result_management");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, name, username, password FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        
        // Verify password (assuming password is hashed in database)
        if (password_verify($password, $admin['password'])) {
            // Set session variables
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_username'] = $admin['username'];
            
            // Redirect to dashboard
            header("Location: dashboard.php");
            exit();
        } else {
            // Invalid password
            $_SESSION['login_error'] = "Invalid username or password";
            header("Location: admin_login.php");
            exit();
        }
    } else {
        // Username not found
        $_SESSION['login_error'] = "Invalid username or password";
        header("Location: admin_login.php");
        exit();
    }
    
    $stmt->close();
    $conn->close();
}
?>