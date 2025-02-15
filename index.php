<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management System</title>
    <link rel="stylesheet" href="assets/css/index.css">
    <script src="assets/js/index.js" defer></script>
    
</head>
<body>
    <!-- Sticky Header -->
    <header class="sticky-header">
        <nav class="nav-container">
            <a href="index.php" class="logo">
                <svg viewBox="0 0 24 24">
                    <path d="M12 3L1 9L12 15L21 10.09V17H23V9M5 13.18V17.18L12 21L19 17.18V13.18L12 17L5 13.18Z"/>
                </svg>
                <span>SDC-BIM-SRMS</span>
            </a>
            <button class="mobile-menu-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12h18M3 6h18M3 18h18"/>
                </svg>
            </button>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="student_result.php">Results</a>
                <a href="admin_login.php">Admin</a>
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </div>
        </nav>
    </header>

    <div class="container">
        <!-- Header Section -->
        <header class="header">
            <h1>SDC BIM Result Management System</h1>
            <p>Access your academic results and administrative controls in one place</p>
        </header>

        <!-- Cards Section -->
        <div class="cards-container">
            <!-- Student Result Card -->
            <div class="card" onclick="window.location.href='student_result.php'">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 3L1 9L12 15L21 10.09V17H23V9M5 13.18V17.18L12 21L19 17.18V13.18L12 17L5 13.18Z"/>
                    </svg>
                </div>
                <h2>Student Results</h2>
                <p>View your semester results by entering your roll number and selecting the semester.</p>
                <a href="student_result.php" class="card-button">View Results</a>
            </div>

            <!-- Admin Login Card -->
            <div class="card" onclick="window.location.href='admin_login.php'">
                <div class="card-icon">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 4C14.21 4 16 5.79 16 8S14.21 12 12 12 8 10.21 8 8 9.79 4 12 4M12 14C16.42 14 20 15.79 20 18V20H4V18C4 15.79 7.58 14 12 14Z"/>
                    </svg>
                </div>
                <h2>Admin Portal</h2>
                <p>Secure access for administrators to manage student results and system settings.</p>
                <a href="admin_login.php" class="card-button">Admin Login</a>
            </div>
        </div>
    </div>

    <!-- Enhanced Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About SDC-BIM-RMS</h3>
                <p>Shanker Dev BIM Student Result Management System is a comprehensive platform designed to manage and track academic performance efficiently.</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="student_result.php">Check Results</a></li>
                    <li><a href="admin_login.php">Admin Login</a></li>
                    <li><a href="#about">About Us</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p>Email: info@srms.edu</p>
                <p>Phone: (123) 456-7890</p>
                <p>Address: 123 Education Street, Learning City</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2024 Student Result Management System. All rights reserved.</p>
        </div>
    </footer>

   
</body>
</html>