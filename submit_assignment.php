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
    $sql = "SELECT assignment_id, course_id, title, description, deadline, file_path
            FROM assignment
            WHERE assignment_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $assignmentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if a valid assignment is found
    if ($row = mysqli_fetch_assoc($result)) {
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
} else {
    // Redirect back to the assignments page if assignment_id is not provided
    header("Location: assignments.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Handle file upload here
    // You can use $_FILES to access the uploaded file
    // Move the uploaded file to a destination directory, and store the path in the database

    // Example code to move the uploaded file (change the destination directory as needed)
    $uploadDirectory = "uploads/";
    $uploadedFilePath = $uploadDirectory . $_FILES["uploaded_file"]["name"];
    
    if (move_uploaded_file($_FILES["uploaded_file"]["tmp_name"], $uploadedFilePath)) {
        // File uploaded successfully, now you can store $uploadedFilePath in the database

        // Insert the submission into the submitted_assignments table
        $insertQuery = "INSERT INTO submitted_assignments (assignment_id, student_id, submission_date, file_path)
                        VALUES (?, ?, NOW(), ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);
        mysqli_stmt_bind_param($stmt, "iis", $assignmentId, $_SESSION['student_id'], $uploadedFilePath);

        if (mysqli_stmt_execute($stmt)) {
            // Submission created successfully, redirect back to assignment details page
            header("Location: student_assignments?assignment_id=" . $assignmentId);
            exit();
        } else {
            // Error creating submission, handle the error (e.g., display an error message)
            $error_message = "Error creating submission: " . mysqli_error($conn);
        }
        
        // Close the prepared statement for submission
        mysqli_stmt_close($stmt);
    } else {
        // Error uploading the file, handle the error (e.g., display an error message)
        $error_message = "Error uploading the file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Assignment</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Submit Assignment</h2>
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
                <!-- Display the file upload form -->
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="uploaded_file">Upload File</label>
                        <input type="file" class="form-control-file" id="uploaded_file" name="uploaded_file" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Assignment</button>
                </form>
                <!-- End of file upload form -->
                <a href="student_assignments.php" class="btn btn-secondary mt-3">Back to Assignments</a>
            </div>
        </div>
    <?php } ?>
</div>
</body>
</html>
