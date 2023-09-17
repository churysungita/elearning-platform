<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: LOGIN.php");
    exit();
}

include("CONN.php");

// Fetch announcements for all courses from the database
$query = "SELECT a.announcement_id, a.message, a.announcement_date, c.title AS course_title
          FROM announcements a
          LEFT JOIN course c ON a.course_id = c.course_id";
$stmt = mysqli_prepare($conn, $query);

if (mysqli_stmt_execute($stmt)) {
    $result = mysqli_stmt_get_result($stmt);
} else {
    // Handle the error as needed
    echo "Error fetching announcements: " . mysqli_error($conn);
}

// Close the prepared statement
mysqli_stmt_close($stmt);

// Close the database connection
mysqli_close($conn);
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
    <h2>All Announcements</h2>
    <hr>
    <div class="row">
        <?php
        // Loop through the announcements and display them
        while ($row = mysqli_fetch_assoc($result)) {
            $announcementId = $row['announcement_id'];
            $message = $row['message'];
            $announcementDate = $row['announcement_date'];
            $courseTitle = $row['course_title'];
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Announcement</h5>
                        <p class="card-text"><?php echo $message; ?></p>
                        <p class="card-text">Announcement ID: <?php echo $announcementId; ?></p>
                        <p class="card-text">Date: <?php echo $announcementDate; ?></p>
                        <p class="card-text">Course: <?php echo $courseTitle; ?></p>
                        <!-- You can customize the card as needed -->
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <a href="HSD.php" class="btn btn-primary">Back to Dashboard</a>
</div>
</body>
</html>
