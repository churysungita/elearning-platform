<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: LOGIN.php");
    exit();
}

include("CONN.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user input
    $program_name = mysqli_real_escape_string($conn, $_POST['program_name']);
    $department_id = intval($_POST['department_id']);

    // Use prepared statement to insert data
    $program_sql = "INSERT INTO programs (program_name, department_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $program_sql);
    mysqli_stmt_bind_param($stmt, "si", $program_name, $department_id);

    // Execute the query
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Program created successfully!";
    } else {
        $_SESSION['error_message'] = "Error creating program: " . mysqli_error($conn);
    }

    // Redirect to the admin dashboard after creating the program
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
    <!-- Create Program Form -->
    <h2 class="text-center mb-4">CREATE PROGRAM</h2>
    <form id="create-program-form" action="" method="post">
        <div class="form-group">
            <label for="program_name">Program Name:</label>
            <input type="text" class="form-control" id="program_name" name="program_name" placeholder="Enter Program Name" required>
        </div>

        <div class="form-group">
            <label for="department_id">Department:</label>
            <select class="form-control" id="department_id" name="department_id" required>
                <option value=""></option>
                <!-- Options here (e.g., fetched from the departments table) -->
                <?php
                // Fetch department options from the database
                $department_options = "SELECT department_id, department_name FROM departments";
                $result = mysqli_query($conn, $department_options);

                // Loop through the results and generate option elements
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['department_id'] . "'>" . $row['department_name'] . "</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">CREATE PROGRAM</button>
    </form>

    <!-- Add a logout link -->
    <div class="mt-3 text-right">
        <a href="HAD.php" class="btn btn-danger">Back to Dashboard</a>
    </div>
</div>

</body>
</html>
