<?php
include("CONN.php");

if (isset($_GET['id'])) {
    $announcement_id = $_GET['id'];
    $delete_sql = "DELETE FROM Announcements WHERE AnnounceID = $announcement_id";
    
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: view_announcements.php"); // Redirect back to the instructor page
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
