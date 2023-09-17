<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: LOGIN.php"); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }

        .dashboard {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            border-radius: 5px;
        }

        .dashboard h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .nav-list {
            list-style-type: none;
            padding: 0;
        }

        .nav-list li {
            margin-bottom: 10px;
        }

        .nav-link {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            font-size: 18px;
            display: inline-block;
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .nav-link:hover {
            background-color: #0056b3;
        }

        #changePassword, #logout {
            background-color: #dc3545;
        }

        #changePassword:hover, #logout:hover {
            background-color: #bb2d3b;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <h1>Student Dashboard</h1>
        <ul class="nav-list">
            <li><a class="nav-link" href="student_materials.php">MATERIALS</a></li>
            <li><a class="nav-link" href="student_view_announcements.php">ANNOUNCEMENTS</a></li>
            <li><a class="nav-link" href="student_assignments.php">ASSIGNMENTS</a></li>
        </ul>
    </div>
    <!-- Add a logout link -->
    <div style="position: absolute; top: 0; right: 0;">
        <a href="logout.php" style="text-decoration: none; color: red;">Logout</a>
    </div>

    <script>
        // JavaScript functionality can be added here, such as handling logout or changing passwords.
        document.getElementById('logout').addEventListener('click', function() {
            // Implement logout functionality here
            alert('Logout clicked. You can handle the logout process here.');
        });

        document.getElementById('changePassword').addEventListener('click', function() {
            // Implement change password functionality here
            alert('Change Password clicked. You can handle the password change process here.');
        });
    </script>
</body>
</html>
