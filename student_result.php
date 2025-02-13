<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/student_result.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">Result Management</a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <h2 class="text-center">Check Your Result</h2>
        <div class="card shadow">
            <div class="card-body">
                <form action="" method="post" class="form-container">
                    <div class="mb-3">
                        <label class="form-label">Roll Number</label>
                        <input type="text" class="form-control" name="roll_number" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <select class="form-control" name="semester" required>
                            <option value="">Select Semester</option>
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
                    <button type="submit" class="btn btn-primary">View Result</button>
                </form>
            </div>
        </div>

        <!-- Display Student Result -->
        <?php if (isset($result) && $result->num_rows > 0): ?>
        <div class="mt-4">
            <h3 class="text-center">Result for Roll No: <?php echo htmlspecialchars($roll_number); ?></h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Marks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['subject']); ?></td>
                            <td><?php echo htmlspecialchars($row['marks']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php elseif (isset($result)): ?>
        <p class="text-danger text-center mt-3">No results found. Please check your Roll Number and Semester.</p>
        <?php endif; ?>

    </div>

    <!-- Footer -->
    <footer class="text-center py-3 bg-dark text-light">
        &copy; 2025 Student Result Management System | All Rights Reserved
    </footer>

</body>
</html>