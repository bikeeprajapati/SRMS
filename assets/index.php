<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
        }
        .hero h1 {
            font-size: 2.5rem;
        }
        .btn-custom {
            width: 200px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Result Management</a>
        </div>
    </nav>
    
    <section class="hero">
        <h1>Welcome to Student Result Management System</h1>
        <p class="lead">Easily access and manage student results.</p>
        <div>
            <a href="student_login.php" class="btn btn-primary btn-custom">Student Login</a>
            <a href="admin_login.php" class="btn btn-secondary btn-custom">Admin Login</a>
        </div>
    </section>
    
    <footer class="text-center py-3 bg-dark text-light">
        &copy; 2025 Student Result Management System | All Rights Reserved
    </footer>
</body>
</html>
