<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Assignment</title>
    <!-- Include your CSS stylesheets here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Create Assignment</h1>
        <?php
        include("CONN.php"); // Include your database connection file

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Get values from the form
            $courseId = $_POST["course_id"];
            $title = $_POST["title"];
            $description = $_POST["description"];
            $deadline = $_POST["deadline"];

            // Handle file upload
            $file_name = $_FILES["assignment_file"]["name"];
            $file_temp = $_FILES["assignment_file"]["tmp_name"];
            $file_destination = "uploads/" . $file_name; // Define the destination folder

            // Prepare the INSERT statement
            $insertQuery = "INSERT INTO assignment (course_id, title, description, deadline, file_path) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insertQuery);

            if ($stmt) {
                // Bind parameters and execute the statement
                $stmt->bind_param("issss", $courseId, $title, $description, $deadline, $file_destination);

                if (move_uploaded_file($file_temp, $file_destination) && $stmt->execute()) {
                    // Assignment created successfully and file uploaded, redirect to assignments.php
                    header("Location: assignments.php?course_id=" . $courseId);
                    exit();
                } else {
                    // Error creating assignment or uploading file, handle the error (e.g., display an error message)
                    echo "Error creating assignment or uploading file: " . $stmt->error;
                }

                // Close the prepared statement
                $stmt->close();
            } else {
                // Error in preparing the statement, handle the error
                echo "Error preparing statement: " . $conn->error;
            }
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

        <!-- Assignment creation form with file upload -->
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="course_id" value="<?php echo $_GET['course_id']; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Assignment Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="datetime-local" class="form-control" id="deadline" name="deadline" required>
            </div>
            <div class="mb-3">
                <label for="assignment_file" class="form-label">Upload File</label>
                <input type="file" class="form-control" id="assignment_file" name="assignment_file" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Assignment</button>
        </form>
    </div>
</body>
</html>
