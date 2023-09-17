<?php
session_start();
if (!isset($_SESSION['instructor_id'])) {
    header("Location: LOGIN.php"); // Redirect to login page if not logged in
    exit();
}

include('CONN.php'); // Include the database configuration

if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true); // Create the "uploads" directory with full permissions (0777)
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $M_ID = $_POST['M_ID'];
    $course = $_POST['course'];
    $name = $_POST['name'];
    $Type = $_POST['Type'];
    

    $fileType = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
    $allowedTypes = array("pdf", "doc", "ppt", "mp4");

    if (in_array($fileType, $allowedTypes)) {
        $filename = $_FILES["file"]["name"];
        $file_path = "uploads/" . $filename; // Define the file path

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $file_path)) {
            // Insert file information into the database
            $sql = "INSERT INTO material (M_ID, course, name, Type, file_path) VALUES ('$M_ID', '$course', '$name', '$Type', '$file_path')";

           
            mysqli_query($conn, $sql);

        } else {
            echo "Error moving the uploaded file.";
        }
    } else {
        echo "Invalid file type. Allowed types: PDF, DOC, PPT, MP4.";
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload Material</title>
<style>
/* Reset some default styles for better consistency */
body, h1, form {
    margin: 0;
    padding: 0;
}

/* Style the body */
body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    text-align: center;
}

/* Style the header */
h1 {
    background-color: #333;
    color: #fff;
    padding: 20px;
}

/* Style the form container */
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    max-width: 400px;
    margin: 20px auto;
}

/* Style the file input label and input */
label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Style the submit button */
input[type="submit"] {
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

/* Style the Back to Dashboard link */
a {
    display: inline-block;
    margin-top: 10px;
    color: #333;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

</style>
</head>
<body>
    <h1>Upload Material</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="M_ID">M_ID:</label>
        <input type="text" name="M_ID" required><br>

        <label for="course">Course:</label>
        <input type="text" name="course" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <label for="Type">Type (doc, pdf, ppt, mp4):</label>
        <input type="text" name="Type" required><br>

        <input type="file" name="file" accept=".pdf,.doc,.ppt,.mp4" required><br>
        
        <input type="submit" name="submit" value="Upload"><br><br>
        <a href="UPLOADED-M.php" style="text-decoration: none; color: BLUE;">VIEW</a>
    </form>
    <a href="HID.php">Back to Dashboard</a>
   
</body>
</html>
