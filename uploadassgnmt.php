<?php
include("CONN.php");

$upload_directory = "uploads/";

if (!file_exists($upload_directory)) {
    mkdir($upload_directory, 0755, true); // Create the directory with appropriate permissions
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assignment_name = $_POST["assignmentName"];
    $description = $_POST["description"];
    $due_date = $_POST["dueDate"];
    $max_points = intval($_POST["maxPoints"]); // Convert to integer

    // Validate max points range (between 1 and 100)
    if ($max_points < 1 || $max_points > 100) {
        echo "Invalid maximum points value. Please enter a value between 1 and 100.";
    } else {
        // File upload handling (same as before)
        $target_directory = "uploads/";
        $target_file = $target_directory . basename($_FILES["fileAttachment"]["name"]);

        if (move_uploaded_file($_FILES["fileAttachment"]["tmp_name"], $target_file)) {
            // Insert assignment data into the database (same as before)
            $sql = "INSERT INTO Assignments (AS_ID, AssignmentName, Description, DueDate, MaxPoints, FileAttachment) 
                    VALUES (NULL, '$assignment_name', '$description', '$due_date', $max_points, '$target_file')";

            if ($conn->query($sql) === TRUE) {
               header('location:viewassignment.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "File upload failed.";
        }
    }
}

// Close the database connection
$conn->close();
?>
