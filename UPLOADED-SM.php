<?php
session_start();
if (!isset($_SESSION['student_id'])) {
    header("Location: LOGIN.php"); // Redirect to login page if not logged in
    exit();
}

include('CONN.php'); // Include the database configuration

// Query to retrieve uploaded materials
$sql = "SELECT M_ID, course, name, Type, file_path FROM material";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>UPLOADED MATERIALS</title>
    <style>
        /* Reset some default styles for better consistency */
        body, h1 {
            margin: 0;
            padding: 0;
        }

        /* Center the container on the page */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 25vh; 
            margin top: 80px;

        }

        /* Style for the container */
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 50px;
            max-width: 2000px;
            margin top: 0px;
        }

        /* ... Your existing styles ... */

        /* Style the table */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* Style table header cells */
        th {
            background-color: #333;
            color: #fff;
            font-weight: bold;
            padding: 10px;
            text-align: center;
        }

        /* Style table data cells */
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }

        /* Style the buttons for Download, Update, and Delete */
        .download-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .update-button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }

        .delete-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><center>UPLOADED MATERIALS<center></h1>
        <table>
            <thead>
                <tr>
                    <th>M_ID</th>
                    <th>Course</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the database results and display each material
                while ($row = mysqli_fetch_assoc($result)) {
                    $M_ID = $row['M_ID'];
                    $course = $row['course'];
                    $name = $row['name'];
                    $Type = $row['Type'];
                    $file_path = $row['file_path'];

                    echo "<tr>";
                    echo "<td>$M_ID</td>";
                    echo "<td>$course</td>";
                    echo "<td>$name</td>";
                    echo "<td>$Type</td>";
                    echo "<td>";
                    echo "<a class='download-button' href='$file_path' download>Download</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="HSD.php">Back to Dashboard</a>
    </div>
</body>
</html>
