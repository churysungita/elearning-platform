<?php
session_start();
if (!isset($_SESSION['instructor_id'])) {
    header("Location: LOGIN.php"); // Redirect to login page if not logged in
    exit();
}

include('CONN.php'); // Include the database configuration

// Check if M_ID is provided in the URL
if (isset($_GET['M_ID'])) {
    $M_ID = $_GET['M_ID'];

    // Delete the material from the database
    $sql = "DELETE FROM material WHERE M_ID = '$M_ID'";
    mysqli_query($conn, $sql);

    // Redirect back to the uploaded materials page
    header("Location: UPLOADED-M.php");
    exit();
}
?>
