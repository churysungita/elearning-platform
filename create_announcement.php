<?php
session_start();
if (!isset($_SESSION['instructor_id'])) {
    header("Location: LOGIN.php");
    exit();
}

include("CONN.php");

// Check if the course_id is provided as a query parameter
if (isset($_GET['course_id'])) {
    $courseId = $_GET['course_id'];
} else {
    // Redirect back to the instructor's assigned courses if course_id is not provided
    header("Location: instructor_cards.php");
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $message = $_POST["message"];
    
    // Prepare the INSERT statement to create a new announcement
    $insertQuery = "INSERT INTO announcements (course_id, message, announcement_date) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $insertQuery);
    
    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "is", $courseId, $message);
    
    if (mysqli_stmt_execute($stmt)) {
        // Announcement created successfully, redirect back to announcements page
        header("Location: instructor_announcements.php?course_id=" . $courseId);
        exit();
    } else {
        // Error creating announcement, handle the error (e.g., display an error message)
        $error_message = "Error creating announcement: " . mysqli_error($conn);
    }
    
    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Announcement</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Create Announcement</h2>
    <hr>
    <?php if (isset($error_message)) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error_message; ?>
        </div>
    <?php } ?>
    <form method="POST">
        <div class="form-group">
            <label for="message">Announcement Message</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Announcement</button>
    </form>
    <a href="instructor_announcements.php?course_id=<?php echo $courseId; ?>" class="btn btn-secondary mt-3">Back to Announcements</a>
</div>
</body>
</html>
