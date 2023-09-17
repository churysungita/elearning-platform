<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: LOGIN.php");
    exit();
}

include("CONN.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate user input
    $course_id = intval($_POST['course_id']);
    $instructor_id = intval($_POST['instructor_id']);

    // Use prepared statement to insert data into course_instructor table
    $assignment_sql = "INSERT INTO course_instructor (instructor_id, course_id) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $assignment_sql);
    mysqli_stmt_bind_param($stmt, "ii", $instructor_id, $course_id);

    // Execute the query for instructor assignment
    mysqli_stmt_execute($stmt);

    // Redirect to the admin dashboard after assigning the course
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
    <!-- Assign Courses Form -->
    <h2 class="text-center mb-4">ASSIGN COURSES</h2>
    <form id="assign-Courses-form" action="" method="post">
        <!-- Assuming you have a select field to choose the course -->
        <div class="form-group">
            <label for="course_id">Course:</label>
            <select class="form-control" id="course_id" name="course_id" required>
                <option value=""></option>
                <!-- Options here (e.g., fetched from the course table) -->
                <?php
                // Fetch course options from the database
                $course_options = "SELECT course_id, title FROM course";
                $result = mysqli_query($conn, $course_options);

                // Loop through the results and generate option elements
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['course_id'] . "'>" . $row['title'] . "</option>";
                }
                ?>
            </select>
        </div>

        <!-- Assuming you have a select field to choose the instructor -->
        <div class="form-group">
            <label for="instructor_id">Instructor:</label>
            <select class="form-control" id="instructor_id" name="instructor_id" required>
                <option value=""></option>
                <!-- Options here (e.g., fetched from the instructor table) -->
                <?php
                // Fetch instructor options from the database
                $instructor_options = "SELECT instructor_id, first_name, last_name FROM instructor";
                $result = mysqli_query($conn, $instructor_options);

                // Loop through the results and generate option elements
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['instructor_id'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">ASSIGN</button>
    </form>

    <!-- Add a logout link -->
    <div class="mt-3 text-right">
        <a href="HAD.php" class="btn btn-danger">Back to Dashboard</a>
    </div>
</div>
</body>
</html>
