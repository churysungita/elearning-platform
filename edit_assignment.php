<?php
include("CONN.php"); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get values from the form
    $assignmentId = $_POST["assignment_id"];
    $title = $_POST["title"];
    $description = $_POST["description"];
    $deadline = $_POST["deadline"];

    // Prepare the UPDATE statement
    $updateQuery = "UPDATE assignment SET title = ?, description = ?, deadline = ? WHERE assignment_id = ?";
    $stmt = $conn->prepare($updateQuery);

    // Bind parameters and execute the statement
    $stmt->bind_param("sssi", $title, $description, $deadline, $assignmentId);

    if ($stmt->execute()) {
        // Assignment updated successfully, redirect to assignments.php
        header("Location: assignments.php");
        exit();
    } else {
        // Error updating assignment, handle the error (e.g., display an error message)
        echo "Error updating assignment: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}

// Check if assignment_id is provided in the URL
if (isset($_GET["assignment_id"])) {
    $assignmentId = $_GET["assignment_id"];

    // Fetch assignment data from the database
    $query = "SELECT * FROM assignment WHERE assignment_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $assignmentId);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Assign fetched values to variables for pre-filling the form
            $title = $row["title"];
            $description = $row["description"];
            $deadline = $row["deadline"];
        } else {
            // Assignment not found, handle the error (e.g., display an error message)
            echo "Assignment not found.";
        }
    } else {
        // Error fetching assignment data, handle the error (e.g., display an error message)
        echo "Error fetching assignment data: " . $stmt->error;
    }
} else {
    // Missing assignment_id, handle the error (e.g., display an error message)
    echo "Missing assignment ID.";
}

// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Assignment</title>
    <!-- Include your CSS stylesheets here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Edit Assignment</h1>
        <!-- Assignment edit form -->
        <form method="POST">
            <input type="hidden" name="assignment_id" value="<?php echo $assignmentId; ?>">
            <div class="mb-3">
                <label for="title" class="form-label">Assignment Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $title; ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo $description; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="datetime-local" class="form-control" id="deadline" name="deadline" value="<?php echo date("Y-m-d\TH:i", strtotime($deadline)); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Assignment</button>
        </form>
    </div>
</body>
</html>
