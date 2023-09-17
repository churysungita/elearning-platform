<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: LOGIN.php");
    exit();
}
include("CONN.php");

// Retrieve all courses from the courses table with program names
$sql = "SELECT c.course_id, c.title, c.description, c.course_weight, p.program_name
        FROM course c
        JOIN programs p ON c.program_id = p.program_id";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>All Courses</h2>
    <hr>
    <a href="HSD.php" class="btn btn-primary">Back to Dashboard</a>
    <div class="row">
        
        <?php
        // Loop through the result set and generate a card for each course
        while ($row = mysqli_fetch_assoc($result)) {
            $courseId = $row['course_id'];
            $title = $row['title'];
            $description = $row['description'];
            $courseWeight = $row['course_weight'];
            $programName = $row['program_name'];
        ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $title; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Course ID: <?php echo $courseId; ?></h6>
                        <p class="card-text"><?php echo $description; ?></p>
                        <p class="card-text">Course Weight: <?php echo $courseWeight; ?></p>
                        <p class="card-text">Program Name: <?php echo $programName; ?></p>
                        <a href="view_materials.php?course_id=<?php echo $courseId; ?>" class="btn btn-primary">View Materials</a>
                        <!-- You can customize the link URL and text as needed -->
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
