<!-- materials.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materials</title>
    <!-- Include your CSS stylesheets here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Course Materials</h1>
        <?php
        include("CONN.php"); // Include your database connection file

        // Check if the course_id is provided in the URL
        if (isset($_GET['course_id'])) {
            $courseId = $_GET['course_id'];

            // Fetch materials for the specified course from the database
            $query = "SELECT * FROM materials WHERE course_id = ?";
            
            // Use a prepared statement to prevent SQL injection
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "i", $courseId);

            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                // Check if there are any materials
                if (mysqli_num_rows($result) > 0) {
                    echo '<table class="table">';
                    echo '<thead>';
                    echo '<tr>';
                    echo '<th>Title</th>';
                    echo '<th>File Path</th>';
                    echo '<th>Actions</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['title'] . '</td>';
                        echo '<td>' . $row['file_path'] . '</td>';
                        echo '<td>';
                        // Add links or actions to view, edit, or delete materials as needed
                      
                        echo '<td><a href="' . $row['file_path'] . '" target="_blank">View</a></td>';
                        echo '<td><a href="delete_material.php?material_id=' . $row['material_id'] . '&course_id=' . $courseId . '" class="btn btn-danger">Delete</a></td>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No materials found for this course.</p>';
                }
            } else {
                echo '<p>Error fetching materials: ' . mysqli_error($conn) . '</p>';
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo '<p>Course ID not provided in the URL.</p>';
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

        <!-- Add a button to create materials -->
        <a href="create_material.php?course_id=<?php echo $courseId; ?>" class="btn btn-primary">Create Materials</a>
    </div>
</body>
</html>
