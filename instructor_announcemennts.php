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

    // Retrieve announcements for the selected course
    $sql = "SELECT announcement_id, message, announcement_date
            FROM announcements
            WHERE course_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $courseId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    // Redirect back to the instructor's assigned courses if course_id is not provided
    header("Location: instructor_cards.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Announcements for Course ID: <?php echo $courseId; ?></h2>
    <hr>
    <div class="mb-3">
        <!-- Add a button to create new announcements -->
        <a href="create_announcement.php?course_id=<?php echo $courseId; ?>" class="btn btn-success">Create Announcement</a>
    </div>
    <div class="row">
        <?php
        // Loop through the announcements and display them
        while ($row = mysqli_fetch_assoc($result)) {
            $announcementId = $row['announcement_id'];
            $message = $row['message'];
            $announcementDate = $row['announcement_date'];
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Announcement</h5>
                        <p class="card-text"><?php echo $message; ?></p>
                        <p class="card-text">Announcement ID: <?php echo $announcementId; ?></p>
                        <p class="card-text">Date: <?php echo $announcementDate; ?></p>
                        <!-- You can customize the card as needed -->
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <a href="HID.php" class="btn btn-primary">Back to Assigned Courses</a>
</div>
</body>
</html>
