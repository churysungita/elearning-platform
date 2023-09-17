<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: LOGIN.php");
    exit();
}

include("CONN.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user input
    $department_name = mysqli_real_escape_string($conn, $_POST['department_name']);

    // Use prepared statement to insert data
    $department_sql = "INSERT INTO departments (department_name) VALUES (?)";
    $stmt = mysqli_prepare($conn, $department_sql);
    mysqli_stmt_bind_param($stmt, "s", $department_name);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Department created successfully!";
    } else {
        $_SESSION['error_message'] = "Error creating department: " . mysqli_error($conn);
    }

    // Redirect to the admin dashboard after creating the department
    header("Location: HAD.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Include Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Create Course Assignment Form -->
    <h2 class="text-center mb-4">CREATE DEPARTMENTS</h2>
    <form id="assign-Courses-form" action="" method="post">
        <div class="form-group">
            <label for="title">Department Name:</label>
            <input type="text" class="form-control" id="title" name="department_name" placeholder="Enter Department name" required>
        </div>

       


        <button type="submit" class="btn btn-primary">CREATE DEPARTMENT</button>
    </form>

    <!-- Add a logout link -->
    <div class="mt-3 text-right">
        <a href="HAD.php" class="btn btn-danger">Back to Dashboard</a>
    </div>
</div>
</body>
</html>


