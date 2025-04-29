<?php
// Start the session to access session variables
session_start();
require_once 'config/database.php';

// Check if user is logged in as admin, if not redirect to login page
if (!isset($_SESSION['admin_id']) || empty($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Get admin information
$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'] ?? 'Administrator';

// Get current semester
$current_semester = fetchRow("SELECT * FROM semesters WHERE is_current = 1", $conn);
$current_semester_name = $current_semester ? $current_semester['name'] : 'No Active Semester';
$current_semester_id = $current_semester ? $current_semester['id'] : 0;

// Get statistics
$total_students = countRows("SELECT id FROM students", $conn);
$active_students = countRows("SELECT id FROM students WHERE status = 'Active'", $conn);
$total_subjects = countRows("SELECT id FROM subjects", $conn);
$total_results = countRows("SELECT id FROM results", $conn);
$pending_results = countRows("SELECT id FROM results WHERE status = 'Pending'", $conn);
$total_notices = countRows("SELECT id FROM notices WHERE status = 'Active' AND (expiry_date IS NULL OR expiry_date >= CURDATE())", $conn);

// Get recent results
$sql = "SELECT r.id, s.name as student_name, sub.name as subject_name, r.marks, r.grade, r.created_at 
        FROM results r 
        JOIN students s ON r.student_id = s.id 
        JOIN subjects sub ON r.subject_id = sub.id 
        ORDER BY r.created_at DESC 
        LIMIT 5";
$recent_results = fetchRows($sql, $conn);

// Get important notices
$sql = "SELECT * FROM notices 
        WHERE status = 'Active' 
        AND (expiry_date IS NULL OR expiry_date >= CURDATE()) 
        ORDER BY is_important DESC, notice_date DESC 
        LIMIT 5";
$notices = fetchRows($sql, $conn);

// Log this activity
logActivity($admin_id, 'Login', 'Admin accessed dashboard', $conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Student Result Management System</title>
    <style>
        :root {
            --primary-color: #4a6cf7;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #17a2b8;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --body-bg: #f5f8fb;
            --card-bg: #ffffff;
            --header-bg: #ffffff;
            --sidebar-bg: #ffffff;
            --text-color: #333333;
            --border-color: #e9ecef;
            --shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--body-bg);
            color: var(--text-color);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Sticky Header */
        .sticky-header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background-color: var(--header-bg);
            box-shadow: var(--shadow);
        }

        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            max-width: 1400px;
            margin: 0 auto;
        }

        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: var(--primary-color);
            font-weight: bold;
            font-size: 1.2rem;
        }

        .logo svg {
            width: 24px;
            height: 24px;
            margin-right: 0.5rem;
            fill: currentColor;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: var(--transition);
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .nav-links a.active {
            color: var(--primary-color);
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-color);
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            flex: 1;
            max-width: 1400px;
            margin: 0 auto;
            width: 100%;
            padding: 1rem;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--sidebar-bg);
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            padding: 1.5rem;
            margin-right: 1.5rem;
        }

        .admin-profile {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-bottom: 1.5rem;
            margin-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .admin-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background-color: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            margin-bottom: 1rem;
        }

        .admin-avatar svg {
            width: 40px;
            height: 40px;
            fill: currentColor;
        }

        .admin-name {
            font-weight: bold;
            margin-bottom: 0.25rem;
        }

        .admin-role {
            color: var(--secondary-color);
            font-size: 0.875rem;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            text-decoration: none;
            color: var(--text-color);
            border-radius: 0.375rem;
            transition: var(--transition);
        }

        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: rgba(74, 108, 247, 0.1);
            color: var(--primary-color);
        }

        .sidebar-menu a svg {
            width: 20px;
            height: 20px;
            margin-right: 0.75rem;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--dark-color);
        }

        .semester-badge {
            background-color: var(--primary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1rem;
        }

        .stat-card {
            background-color: var(--card-bg);
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            padding: 1.5rem;
            display: flex;
            align-items: center;
            transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }

        .stat-icon svg {
            width: 24px;
            height: 24px;
            fill: white;
        }

        .stat-icon.students {
            background-color: var(--primary-color);
        }

        .stat-icon.subjects {
            background-color: var(--warning-color);
        }

        .stat-icon.results {
            background-color: var(--success-color);
        }

        .stat-icon.notices {
            background-color: var(--info-color);
        }

        .stat-details {
            flex: 1;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.25rem;
        }

        .stat-label {
            color: var(--secondary-color);
            font-size: 0.875rem;
        }

        /* Quick Actions */
        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .action-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 1rem;
            text-decoration: none;
            color: var(--text-color);
            font-weight: 500;
            transition: var(--transition);
        }

        .action-btn:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .action-btn svg {
            width: 20px;
            height: 20px;
            margin-right: 0.5rem;
        }

        /* Content Cards */
        .content-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .content-card {
            background-color: var(--card-bg);
            border-radius: 0.5rem;
            box-shadow: var(--shadow);
            padding: 1.5rem;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid var(--border-color);
        }

        .card-title {
            font-size: 1.125rem;
            font-weight: bold;
            color: var(--dark-color);
        }

        .view-all {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
        }

        /* Results Table */
        .results-table {
            width: 100%;
            border-collapse: collapse;
        }

        .results-table th, .results-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid var(--border-color);
        }

        .results-table th {
            font-weight: 600;
            color: var(--secondary-color);
        }

        .results-table tr:last-child td {
            border-bottom: none;
        }

        .grade-badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 0.25rem;
            font-weight: 500;
            font-size: 0.75rem;
            text-align: center;
            min-width: 2rem;
        }

        .grade-a {
            background-color: rgba(40, 167, 69, 0.1);
            color: var(--success-color);
        }

        .grade-b {
            background-color: rgba(0, 123, 255, 0.1);
            color: var(--primary-color);
        }

        .grade-c {
            background-color: rgba(255, 193, 7, 0.1);
            color: var(--warning-color);
        }

        .grade-f {
            background-color: rgba(220, 53, 69, 0.1);
            color: var(--danger-color);
        }

        /* Notices List */
        .notices-list {
            list-style: none;
        }

        .notice-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-color);
        }

        .notice-item:last-child {
            border-bottom: none;
        }

        .notice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .notice-title {
            font-weight: 600;
            color: var(--dark-color);
        }

        .notice-date {
            font-size: 0.75rem;
            color: var(--secondary-color);
        }

        .notice-content {
            font-size: 0.875rem;
            color: var(--secondary-color);
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .notice-important {
            background-color: rgba(220, 53, 69, 0.05);
            border-left: 3px solid var(--danger-color);
            padding-left: 0.75rem;
        }

        /* Footer */
        .footer {
            background-color: var(--header-bg);
            padding: 1rem;
            text-align: center;
            margin-top: auto;
            box-shadow: 0 -1px 3px rgba(0, 0, 0, 0.05);
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            color: var(--secondary-color);
            font-size: 0.875rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                margin-right: 0;
                margin-bottom: 1.5rem;
            }

            .admin-profile {
                flex-direction: row;
                justify-content: flex-start;
                padding-bottom: 1rem;
            }

            .admin-avatar {
                margin-bottom: 0;
                margin-right: 1rem;
                width: 60px;
                height: 60px;
            }

            .admin-avatar svg {
                width: 30px;
                height: 30px;
            }

            .sidebar-menu {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .sidebar-menu li {
                margin-bottom: 0;
            }
        }

        @media (max-width: 768px) {
            .nav-container {
                padding: 1rem;
            }

            .nav-links {
                display: none;
            }

            .mobile-menu-btn {
                display: block;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .quick-actions {
                grid-template-columns: 1fr 1fr;
            }

            .content-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .quick-actions {
                grid-template-columns: 1fr;
            }
        }

        /* Mobile Menu */
        .mobile-menu {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1001;
        }

        .mobile-menu-content {
            position: absolute;
            top: 0;
            right: 0;
            width: 250px;
            height: 100%;
            background-color: var(--card-bg);
            padding: 1rem;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .mobile-menu.active {
            display: block;
        }

        .mobile-menu.active .mobile-menu-content {
            transform: translateX(0);
        }

        .mobile-menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }

        .close-menu {
            background: none;
            border: none;
            cursor: pointer;
            color: var(--text-color);
        }

        .mobile-nav-links {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .mobile-nav-links a {
            display: block;
            padding: 0.75rem;
            text-decoration: none;
            color: var(--text-color);
            border-radius: 0.375rem;
            transition: var(--transition);
        }

        .mobile-nav-links a:hover {
            background-color: rgba(74, 108, 247, 0.1);
            color: var(--primary-color);
        }
    </style>
</head>
<body>
    <!-- Sticky Header -->
    <header class="sticky-header">
        <nav class="nav-container">
            <a href="index.php" class="logo">
                <svg viewBox="0 0 24 24">
                    <path d="M12 3L1 9L12 15L21 10.09V17H23V9M5 13.18V17.18L12 21L19 17.18V13.18L12 17L5 13.18Z"/>
                </svg>
                <span>SDC-BIM-RMS</span>
            </a>
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12h18M3 6h18M3 18h18"/>
                </svg>
            </button>
            <div class="nav-links">
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="students.php">Students</a>
                <a href="subjects.php">Subjects</a>
                <a href="results.php">Results</a>
                <a href="notices.php">Notices</a>
                <a href="logout.php">Logout</a>
            </div>
        </nav>
    </header>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-content">
            <div class="mobile-menu-header">
                <h3>Menu</h3>
                <button class="close-menu" id="closeMenu">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 6L6 18M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="mobile-nav-links">
                <a href="dashboard.php" class="active">Dashboard</a>
                <a href="students.php">Students</a>
                <a href="subjects.php">Subjects</a>
                <a href="results.php">Results</a>
                <a href="notices.php">Notices</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <!-- Dashboard Container -->
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="admin-profile">
                <div class="admin-avatar">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 4C14.21 4 16 5.79 16 8S14.21 12 12 12 8 10.21 8 8 9.79 4 12 4M12 14C16.42 14 20 15.79 20 18V20H4V18C4 15.79 7.58 14 12 14Z"/>
                    </svg>
                </div>
                <div class="admin-info">
                    <div class="admin-name"><?php echo htmlspecialchars($admin_name); ?></div>
                    <div class="admin-role">Administrator</div>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li>
                    <a href="dashboard.php" class="active">
                        <svg viewBox="0 0 24 24">
                            <path d="M13,3V9H21V3M13,21H21V11H13M3,21H11V15H3M3,13H11V3H3V13Z"/>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="semesters.php">
                        <svg viewBox="0 0 24 24">
                            <path d="M19,4H18V2H16V4H8V2H6V4H5C3.89,4 3,4.9 3,6V20A2,2 0 0,0 5,22H19A2,2 0 0,0 21,20V6A2,2 0 0,0 19,4M19,20H5V10H19V20M19,8H5V6H19V8Z"/>
                        </svg>
                        Semesters
                    </a>
                </li>
                <li>
                    <a href="students.php">
                        <svg viewBox="0 0 24 24">
                            <path d="M12,5.5A3.5,3.5 0 0,1 15.5,9A3.5,3.5 0 0,1 12,12.5A3.5,3.5 0 0,1 8.5,9A3.5,3.5 0 0,1 12,5.5M5,8C5.56,8 6.08,8.15 6.53,8.42C6.38,9.85 6.8,11.27 7.66,12.38C7.16,13.34 6.16,14 5,14A3,3 0 0,1 2,11A3,3 0 0,1 5,8M19,8A3,3 0 0,1 22,11A3,3 0 0,1 19,14C17.84,14 16.84,13.34 16.34,12.38C17.2,11.27 17.62,9.85 17.47,8.42C17.92,8.15 18.44,8 19,8M5.5,18.25C5.5,16.18 8.41,14.5 12,14.5C15.59,14.5 18.5,16.18 18.5,18.25V20H5.5V18.25M0,20V18.5C0,17.11 1.89,15.94 4.45,15.6C3.86,16.28 3.5,17.22 3.5,18.25V20H0M24,20H20.5V18.25C20.5,17.22 20.14,16.28 19.55,15.6C22.11,15.94 24,17.11 24,18.5V20Z"/>
                        </svg>
                        Students
                    </a>
                </li>
                <li>
                    <a href="subjects.php">
                        <svg viewBox="0 0 24 24">
                            <path d="M6,2A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2H6M6,4H13V9H18V20H6V4M8,12V14H16V12H8M8,16V18H13V16H8Z"/>
                        </svg>
                        Subjects
                    </a>
                </li>
                <li>
                    <a href="results.php">
                        <svg viewBox="0 0 24 24">
                            <path d="M19,3H14.82C14.25,1.44 12.53,0.64 11,1.2C10.14,1.5 9.5,2.16 9.18,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M12,3A1,1 0 0,1 13,4A1,1 0 0,1 12,5A1,1 0 0,1 11,4A1,1 0 0,1 12,3M7,7H17V5H19V19H5V5H7V7M7.5,13.5L9,12L11,14L15.5,9.5L17,11L11,17L7.5,13.5Z"/>
                        </svg>
                        Results
                    </a>
                </li>
                <li>
                    <a href="notices.php">
                        <svg viewBox="0 0 24 24">
                            <path d="M10,21H14A2,2 0 0,1 12,23A2,2 0 0,1 10,21M21,19V20H3V19L5,17V11C5,7.9 7.03,5.17 10,4.29C10,4.19 10,4.1 10,4A2,2 0 0,1 12,2A2,2 0 0,1 14,4C14,4.1 14,4.19 14,4.29C16.97,5.17 19,7.9 19,11V17L21,19M17,11A5,5 0 0,0 12,6A5,5 0 0,0 7,11V18H17V11M19.75,3.19L18.33,4.61C20.04,6.3 21,8.6 21,11H23C23,8.07 21.84,5.25 19.75,3.19M1,11H3C3,8.6 3.96,6.3 5.67,4.61L4.25,3.19C2.16,5.25 1,8.07 1,11Z"/>
                        </svg>
                        Notices
                    </a>
                </li>
                <li>
                    <a href="settings.php">
                        <svg viewBox="0 0 24 24">
                            <path d="M12,15.5A3.5,3.5 0 0,1 8.5,12A3.5,3.5 0 0,1 12,8.5A3.5,3.5 0 0,1 15.5,12A3.5,3.5 0 0,1 12,15.5M19.43,12.97C19.47,12.65 19.5,12.33 19.5,12C19.5,11.67 19.47,11.34 19.43,11L21.54,9.37C21.73,9.22 21.78,8.95 21.66,8.73L19.66,5.27C19.54,5.05 19.27,4.96 19.05,5.05L16.56,6.05C16.04,5.66 15.5,5.32 14.87,5.07L14.5,2.42C14.46,2.18 14.25,2 14,2H10C9.75,2 9.54,2.18 9.5,2.42L9.13,5.07C8.5,5.32 7.96,5.66 7.44,6.05L4.95,5.05C4.73,4.96 4.46,5.05 4.34,5.27L2.34,8.73C2.21,8.95 2.27,9.22 2.46,9.37L4.57,11C4.53,11.34 4.5,