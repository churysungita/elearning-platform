<?php
include("CONN.php"); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["material_id"]) && isset($_GET["course_id"])) {
    $materialId = $_GET["material_id"];
    $courseId = $_GET["course_id"];

    // Perform the material deletion using a prepared statement
    $deleteQuery = "DELETE FROM materials WHERE material_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $materialId);

    if ($stmt->execute()) {
        // Material deleted successfully, you can redirect back to the materials page
        header("Location: materials.php?course_id=$courseId");
        exit();
    } else {
        // Error deleting material, handle the error (e.g., display an error message)
        echo "Error deleting material: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
} else {
    // Invalid request, handle the error (e.g., display an error message)
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>
