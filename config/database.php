<?php
// Database configuration
$db_host = "localhost";
$db_user = "root";         // Change to your MySQL username
$db_pass = "";             // Change to your MySQL password
$db_name = "student_result_management";

// Create database connection
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Function to execute query and return result
function executeQuery($sql, $conn) {
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    return $result;
}

// Function to get a single row
function fetchRow($sql, $conn) {
    $result = executeQuery($sql, $conn);
    return mysqli_fetch_assoc($result);
}

// Function to get multiple rows
function fetchRows($sql, $conn) {
    $result = executeQuery($sql, $conn);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// Function to escape string for SQL
function escapeString($string, $conn) {
    return mysqli_real_escape_string($conn, $string);
}

// Function to count rows
function countRows($sql, $conn) {
    $result = executeQuery($sql, $conn);
    return mysqli_num_rows($result);
}

// Function to get last inserted ID
function getLastId($conn) {
    return mysqli_insert_id($conn);
}

// Function to log activity
function logActivity($admin_id, $activity_type, $description, $conn) {
    $admin_id = (int)$admin_id;
    $activity_type = escapeString($activity_type, $conn);
    $description = escapeString($description, $conn);
    $ip_address = $_SERVER['REMOTE_ADDR'];
    
    $sql = "INSERT INTO activity_logs (admin_id, activity_type, description, ip_address) 
            VALUES ($admin_id, '$activity_type', '$description', '$ip_address')";
    
    return executeQuery($sql, $conn);
}
?>