<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: LOGIN.php");
    exit();
}

include("CONN.php");

// Check if the assignment_id is provided as a query parameter
if (isset($_GET['assignment_id'])) {
    $assignmentId = $_GET['assignment_id'];

    // Retrieve assignment details for the selected assignment
    $assignmentQuery = "SELECT assignment_id, course_id, title, description, deadline, file_path
                        FROM assignment
                        WHERE assignment_id = ?";
    $stmt = mysqli_prepare($conn, $assignmentQuery);
    mysqli_stmt_bind_param($stmt, "i", $assignmentId);
    mysqli_stmt_execute($stmt);
    $assignmentResult = mysqli_stmt_get_result($stmt);

    // Check if a valid assignment is found
    if ($row = mysqli_fetch_assoc($assignmentResult)) {
        $assignmentId = $row['assignment_id'];
        $courseId = $row['course_id'];
        $title = $row['title'];
        $description = $row['description'];
        $deadline = $row['deadline'];
        $file_path = $row['file_path'];
    } else {
        // Assignment not found, display a message
        $message = "Assignment not found or not yet uploaded.";
    }

    // Retrieve submitted assignments and scores for the selected assignment
    $submittedQuery = "SELECT sa.submission_id, sa.student_id, s.first_name, s.last_name, sa.submission_date, sa.comments
                       FROM submitted_assignments sa
                       INNER JOIN students s ON sa.student_id = s.student_id
                       WHERE sa.assignment_id = ?";
    $stmt = mysqli_prepare($conn, $submittedQuery);
    mysqli_stmt_bind_param($stmt, "i", $assignmentId);
    mysqli_stmt_execute($stmt);
    $submittedResult = mysqli_stmt_get_result($stmt);
} else {
    // Redirect back to the assignments page if assignment_id is not provided
    header("Location: assignments.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Details</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Assignment Details</h2>
    <hr>
    <?php if (isset($message)) { ?>
        <div class="alert alert-warning" role="alert">
            <?php echo $message; ?>
        </div>
    <?php } else { ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo $title; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">Assignment ID: <?php echo $assignmentId; ?></h6>
                <p class="card-text"><?php echo $description; ?></p>
                <p class="card-text">Course ID: <?php echo $courseId; ?></p>
                <p class="card-text">Deadline: <?php echo $deadline; ?></p>
                <p class="card-text">File Path: <a href="<?php echo $file_path; ?>" target="_blank"><?php echo $file_path; ?></a></p>
            </div>
        </div>

        <h3 class="mt-4">Submitted Assignments</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Submission ID</th>
                    <th>Student Name</th>
                    <th>Submission Date</th>
                    <th>Score</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($submittedRow = mysqli_fetch_assoc($submittedResult)) { ?>
                    <tr>
                        <td><?php echo $submittedRow['submission_id']; ?></td>
                        <td><?php echo $submittedRow['first_name'] . ' ' . $submittedRow['last_name']; ?></td>
                        <td><?php echo $submittedRow['submission_date']; ?></td>
              
                        <td><?php echo $submittedRow['comments']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <a href="student_assignments.php" class="btn btn-secondary mt-3">Back to Assignments</a>
</div>
</body>
</html>
