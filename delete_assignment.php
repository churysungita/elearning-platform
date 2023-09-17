<?php
include("CONN.php");

if (isset($_GET['AS_ID'])) {
    $AS_ID = $_GET['AS_ID'];
    $delete_sql = "DELETE FROM assignments WHERE AS_ID = $AS_ID";
    
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: viewassignment.php"); // Redirect back to the instructor page
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
