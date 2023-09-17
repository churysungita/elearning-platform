<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: LOGIN.php");
    exit();
}

include("CONN.php");

// Retrieve all assignments for each course
$sql = "SELECT assignment_id, course_id, title, description, deadline
        FROM assignment";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>All Assignments</h2>
        <hr>
        <a href="HSD.php" class="btn btn-primary">Back to Dashboard</a>
        <div class="row">
            <?php
        // Loop through the result set and generate a card for each assignment
        while ($row = mysqli_fetch_assoc($result)) {
            $assignmentId = $row['assignment_id'];
            $courseId = $row['course_id'];
            $title = $row['title'];
            $description = $row['description'];
            $deadline = $row['deadline'];
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $title; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Assignment ID: <?php echo $assignmentId; ?></h6>
                        <p class="card-text"><?php echo $description; ?></p>
                        <p class="card-text">Course ID: <?php echo $courseId; ?></p>
                        <p class="card-text">Deadline: <?php echo $deadline; ?></p>
                        <a href="student_view_submitted_assignment_details.php?assignment_id=<?php echo $assignmentId; ?>"
                            class="btn btn-primary">View Assignment Details</a>
                        <a href="submit_assignment.php?assignment_id=<?php echo $assignmentId; ?>"
                            class="btn btn-success">Submit Assignment</a>
                        <!-- You can customize the link URLs and text as needed -->
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
    </div>
</body>

</html>