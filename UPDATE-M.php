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

    // Query to retrieve material information by M_ID
    $sql = "SELECT M_ID, course, name, Type FROM material WHERE M_ID = '$M_ID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
} else {
    // Redirect to the uploaded materials page if M_ID is not provided
    header("Location: UPLOADED-M.php");
    exit();
}

// Function to update material information
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course = $_POST['course'];
    $name = $_POST['name'];
    $Type = $_POST['Type'];

    // Update material information in the database
    $sql = "UPDATE material SET course = '$course', name = '$name', Type = '$Type' WHERE M_ID = '$M_ID'";
    mysqli_query($conn, $sql);

    // Redirect back to the uploaded materials page
    header("Location: UPLOAD-M.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Material</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <h1>Update Material</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="M_ID" value="<?php echo $M_ID; ?>">
        <label for="course">Course:</label>
        <input type="text" name="course" value="<?php echo $row['course']; ?>" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br>

        <label for="Type">Type (doc, pdf, ppt, mp4):</label>
        <input type="text" name="Type" value="<?php echo $row['Type']; ?>" required><br>

        <input type="submit" name="submit" value="Update"><br><br>
        <a href="UPLOAD-M.php">Back to Upload Materials</a>
    </form>
</body>
</html>
