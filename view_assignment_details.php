<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: LOGIN.php");
    exit();
}

include("CONN.php");

// Check if the assignment_id is provided as a query parameter
if (isset($_GET['assignment_id'])) {
    $assignmentId = $_GET['assignment_id'];

    // Retrieve assignment details for the selected assignment
    $sql = "SELECT assignment_id, course_id, title, description, deadline, file_path
            FROM assignment
            WHERE assignment_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $assignmentId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if a valid assignment is found
    if ($row = mysqli_fetch_assoc($result)) {
        $assignmentId = $row['assignment_id'];
        $courseId = $row['course_id'];
        $title = $row['title'];
        $description = $row['description'];
        $deadline = $row['deadline'];
        $file_path = $row['file_path'];

        // Check if a file is associated with the assignment
        if ($file_path !== null) {
            // File exists, provide download link with a notification icon
            echo "<a href=\"$file_path\" class=\"btn btn-primary\" download>";
            echo "<i class=\"fa fa-download\"></i> Download Assignment</a>";
        } else {
            // File does not exist, display a message and use JavaScript to redirect to home
            echo "<p>No file associated with this assignment.</p>";
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "student_assignments.php";
                    }, 3000); // Redirect to home after 3 seconds
                  </script>';
        }
    } else {
        // Assignment not found, display a message and use JavaScript to redirect to home
        $message = "Assignment not found.";
        echo "<p>$message</p>";
        echo '<script>
                setTimeout(function() {
                    window.location.href = "student_assignments.php";
                }, 3000); // Redirect to home after 3 seconds
              </script>';
    }
} else {
    // Redirect back to the assignments page if assignment_id is not provided
    header("Location: assignments.php");
    exit();
}
?>
