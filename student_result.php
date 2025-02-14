<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Result Management System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 450px;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h2 {
            color: #1a1a1a;
            font-size: 28px;
            margin-bottom: 8px;
        }

        .header p {
            color: #666;
            font-size: 16px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
        }

        input, select {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M8 10.5l-4-4h8l-4 4z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            background-size: 16px;
        }

        button {
            width: 100%;
            padding: 14px;
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #4338ca;
            transform: translateY(-1px);
        }

        button:active {
            transform: translateY(0);
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: 4px;
            display: none;
        }

        input:invalid:not(:placeholder-shown) + .error,
        select:invalid:not(:placeholder-shown) + .error {
            display: block;
        }

        @media (max-width: 480px) {
            .container {
                padding: 20px;
            }

            .header h2 {
                font-size: 24px;
            }

            input, select, button {
                padding: 10px 14px;
            }
        }

        /* Animation for form submission */
        @keyframes submit-pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(0.95);
            }
            100% {
                transform: scale(1);
            }
        }

        button:active {
            animation: submit-pulse 0.2s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Student Result Portal</h2>
            <p>Enter your details to view semester results</p>
        </div>
        
        <form action="result.php" method="GET" id="resultForm">
            <div class="form-group">
                <label for="rollNumber">Roll Number</label>
                <input 
                    type="text" 
                    id="rollNumber" 
                    name="roll"
                    placeholder="Enter your roll number"
                    pattern="[0-9]+"
                    required
                >
                <div class="error">Please enter a valid roll number</div>
            </div>
            
            <div class="form-group">
                <label for="semester">Select Semester</label>
                <select id="semester" name="semester" required>
                    <option value="" disabled selected>Choose semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
                <div class="error">Please select a semester</div>
            </div>
            
            <button type="submit">View Result</button>
        </form>
    </div>

    <script>
        // Simple form validation
        document.getElementById('resultForm').addEventListener('submit', function(e) {
            const rollNumber = document.getElementById('rollNumber').value;
            const semester = document.getElementById('semester').value;

            if (!rollNumber || !semester) {
                e.preventDefault();
                alert('Please fill in all fields');
            }
        });
    </script>
</body>
</html>