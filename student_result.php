<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Result - Student Result Management System</title>
    <link rel="stylesheet" href="assets/css/student_result.css">
    <script src="assets/js/student_result.js" defer></script>
   
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
                <a href="#about">About</a>
                <a href="#contact">Contact</a>
            </div>
        </nav>
    </header>

    <div class="container">
        <!-- Result Form Section -->
        <div class="result-form-container">
            <div class="form-header">
                <h2>Student Result Portal</h2>
                <p>Enter your details to view your results</p>
            </div>
            <form id="resultForm" onsubmit="handleSubmit(event)">
                <div class="form-group">
                    <label for="rollNumber">Roll Number</label>
                    <input 
                        type="text" 
                        id="rollNumber" 
                        name="rollNumber"
                        placeholder="Enter your roll number"
                        required
                        pattern="[0-9]+"
                    >
                </div>
                <div class="form-group">
                    <label for="semester">Select Semester</label>
                    <select id="semester" name="semester" required>
                        <option value="">Choose semester</option>
                        <option value="1">Semester 1</option>
                        <option value="2">Semester 2</option>
                        <option value="3">Semester 3</option>
                        <option value="4">Semester 4</option>
                        <option value="5">Semester 5</option>
                        <option value="6">Semester 6</option>
                        <option value="7">Semester 7</option>
                        <option value="8">Semester 8</option>
                    </select>
                </div>
                <button type="submit" class="submit-btn">View Result</button>
            </form>
        </div>

        <!-- Loading Animation -->
        <div class="loading" id="loading">
            <div class="spinner"></div>
            <p>Loading your results...</p>
        </div>

        <!-- Result Display Section -->
        <div class="result-container" id="resultContainer">
            <div class="student-info">
                <h3>Student Information</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span>Name</span>
                        <strong id="studentName">John Doe</strong>
                    </div>
                    <div class="info-item">
                        <span>Roll Number</span>
                        <strong id="studentRoll">12345</strong>
                    </div>
                    <div class="info-item">
                        <span>Semester</span>
                        <strong id="studentSemester">Semester 1</strong>
                    </div>
                    <div class="info-item">
                        <span>Branch</span>
                        <strong id="studentBranch">Computer Science</strong>
                    </div>
                </div>
            </div>

            <table class="result-table">
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Credits</th>
                        <th>Marks</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody id="resultTableBody">
                    <!-- Sample Row (will be populated by JavaScript) -->
                    <tr>
                        <td>CS101</td>
                        <td>Introduction to Programming</td>
                        <td>4</td>
                        <td>85</td>
                        <td><span class="grade excellent">A</span></td>
                    </tr>
                </tbody>
            </table>

            <div class="result-summary">
                <div class="summary-item">
                    <span>Total Credits</span>
                    <strong id="totalCredits">20</strong>
                </div>
                <div class="summary-item">
                    <span>SGPA</span>
                    <strong id="sgpa">8.5</strong>
                </div>
                <div class="summary-item">
                    <span>Result</span>
                    <strong id="result">PASS</strong>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About SRMS</h3>
                <p> SDC-BIM Student Result Management System is a comprehensive platform designed to manage and track academic performance efficiently.</p>
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
                <p>Email: shankerdevcampusbim@gmail.com</p>
                <p>Phone: 015318016</p>
                <p>Address: Ram Shah Path, Putalisadak, Kathmandu</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 SDC-BIM Student Result Management System. All rights reserved.</p>
        </div>
    </footer>

   
</body>
</html>