<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: LOGIN.php");
    exit();
}

include("CONN.php");

// Check if the course_id is provided as a query parameter
if (isset($_GET['course_id'])) {
    $courseId = $_GET['course_id'];

    // Retrieve materials for the selected course
    $sql = "SELECT material_id, title, file_path FROM materials WHERE course_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $courseId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if there are materials for this course
    if (mysqli_num_rows($result) > 0) {
        $materialsExist = true;
    } else {
        $materialsExist = false;
    }
} else {
    // Redirect back to the courses page if course_id is not provided
    header("Location: courses.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Materials</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" />
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Materials for Course ID: <?php echo $courseId; ?></h2>
    <hr>
    <?php if ($materialsExist) { ?>
        <div class="row">
            <?php
            // Loop through the materials and display them
            while ($row = mysqli_fetch_assoc($result)) {
                $materialId = $row['material_id'];
                $title = $row['title'];
                $filePath = $row['file_path'];
            ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $title; ?></h5>
                            <p class="card-text">Material ID: <?php echo $materialId; ?></p>
                            <a href="<?php echo $filePath; ?>" class="btn btn-primary" download>Download Material</a>
                            <!-- You can customize the link URL and text as needed -->
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    <?php } else { ?>
        <p>No materials are uploaded for this course.</p>
    <?php } ?>
</div>
</body>
</html>
