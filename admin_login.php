<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Student Result Management System</title>
   <link rel="stylesheet" href="assets/css/login/styles.css">
   <script src="assets/js/login/script.js" defer></script>
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
            <button class="mobile-menu-btn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M3 12h18M3 6h18M3 18h18"/>
                </svg>
            </button>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="student_result.php">Results</a>
                <a href="admin_login.php">Admin</a>
                <a href="index.php#about">About</a>
                <a href="index.php#contact">Contact</a>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="login-container">
            <div class="login-header">
                <div class="avatar">
                    <svg viewBox="0 0 24 24">
                        <path d="M12 4C14.21 4 16 5.79 16 8S14.21 12 12 12 8 10.21 8 8 9.79 4 12 4M12 14C16.42 14 20 15.79 20 18V20H4V18C4 15.79 7.58 14 12 14Z"/>
                    </svg>
                </div>
                <h2>Admin Login</h2>
                <p>Enter your credentials to access the admin panel</p>
            </div>

            <form id="loginForm" onsubmit="handleSubmit(event)">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username"
                        placeholder="Enter your username"
                        required
                    >
                    <div class="error-message" id="usernameError">Please enter a valid username</div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password"
                        placeholder="Enter your password"
                        required
                    >
                    <div class="error-message" id="passwordError">Please enter your password</div>
                </div>

                <button type="submit" class="login-btn" id="loginBtn">Login</button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Student Result Management System. All rights reserved.</p>
        </div>
    </footer>

    
</body>
</html>