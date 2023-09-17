<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignments</title>
    <!-- Include your CSS stylesheets here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Assignments</h1>
        <?php
        include("CONN.php"); // Include your database connection file

        // Check if course_id is provided in the URL
        if (isset($_GET['course_id'])) {
            $courseId = $_GET['course_id'];

            // Fetch assignments for the specified course
            $query = "SELECT * FROM assignment WHERE course_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $courseId);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if there are any assignments
            if ($result->num_rows > 0) {
                echo '<table class="table">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Title</th>';
                echo '<th>Description</th>';
                echo '<th>Deadline</th>';
                echo '<th>Actions</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['title'] . '</td>';
                    echo '<td>' . $row['description'] . '</td>';
                    echo '<td>' . $row['deadline'] . '</td>';
                    echo '<td>';
                    echo '<a href="edit_assignment.php?assignment_id=' . $row['assignment_id'] . '" class="btn btn-primary">Edit</a>';
                    echo '<a href="delete_assignment.php?assignment_id=' . $row['assignment_id'] . '" class="btn btn-danger">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
                }

                echo '</tbody>';
                echo '</table>';
            } else {
                echo 'No assignments found for this course.';
            }

            // Close the prepared statement
            $stmt->close();
        } else {
            echo 'Invalid request. Please select a course to view assignments for.';
        }
        ?>

        <!-- Add a button to create assignments -->
        <?php
        if (isset($_GET['course_id'])) {
            $courseId = $_GET['course_id'];
            echo '<a href="create_assignments.php?course_id=' . $courseId . '" class="btn btn-primary">Create Assignment</a>';
        } else {
            echo '<a href="create_assignments.php" class="btn btn-primary">Create Assignment</a>';
        }
        ?>
    </div>
</body>
</html>
