<?php
session_start();
if (!isset($_SESSION['instructor_id'])) {
    header("Location: ASSIGN-C.php"); // Redirect to login page if not logged in
    exit();
}

include("CONN.php");

// Fetch the list of courses with a Credit_number of 7.5 from the database
$query = "SELECT * FROM course WHERE Credit_number = 7.5";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>List of Courses</title>
</head>
<body>
<a href="SCL.php" style="text-decoration: center; color: blue;">SELECT</a>

<h2>List of Courses with Credit Number 7.5</h2>
<table>
    <tr>
        <th>Course Name</th>
        
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['C_name'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>

<!-- Add a logout link -->
<div style="position: absolute; top: 0; right: 0;">
    <a href="logout.php" style="text-decoration: none; color: red;">Logout</a>
</div>
</body>
</html>
