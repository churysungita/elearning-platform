<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Materials</title>
    <!-- Include your CSS stylesheets here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Create Materials</h1>
        <?php
        include("CONN.php"); // Include your database connection file

        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["title"]) && isset($_POST["course_id"])) {
            $courseId = $_POST["course_id"];
            $materialTitle = $_POST["title"];

            // Handle file upload
            $fileUploadDirectory = "uploads/"; // Directory where uploaded files will be stored
            $uploadedFileName = $_FILES["file"]["name"];
            $targetFilePath = $fileUploadDirectory . $uploadedFileName;

            // Check if the file was uploaded successfully
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                // Insert the material into the database
                $insertQuery = "INSERT INTO materials (course_id, title, file_path) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($insertQuery);
                $stmt->bind_param("iss", $courseId, $materialTitle, $targetFilePath);

                if ($stmt->execute()) {
                    echo "Material created successfully.";
                } else {
                    echo "Error creating material: " . $stmt->error;
                }

                // Close the prepared statement
                $stmt->close();
            } else {
                echo "Error uploading file.";
            }
        } else {
            // Check if course_id is provided in the URL
            if (isset($_GET['course_id'])) {
                $courseId = $_GET['course_id'];
            } else {
                echo "Invalid request. Please select a course to create materials for.";
            }
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="course_id" value="<?php echo $courseId; ?>">
            <div class="form-group">
                <label for="title">Material Title:</label>
                <input type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" name="file" id="file" required>
            </div>
            <button type="submit" class="btn btn-primary">Create Material</button>
        </form>
    </div>
</body>
</html>
