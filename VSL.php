<?php
session_start();
if (!isset($_SESSION['instructor_id'])) {
    header("Location: REGISTER-S.php"); // Redirect to login page if not logged in
    exit();
}

include("CONN.php");

// Fetch the list of student from the database
$query = "SELECT * FROM student";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> </title>
</head>
<body>
    <h2>List of Students</h2>
    <table>
        <tr>
            <th>Student ID</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Last Name</th>
            <th>Year of Study</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Program</th>
            <th>Username</th>
            <th>Password</th>
            <th>Email</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['S_ID'] . "</td>";
            echo "<td>" . $row['F_name'] . "</td>";
            echo "<td>" . $row['M_name'] . "</td>";
            echo "<td>" . $row['L_name'] . "</td>";
            echo "<td>" . $row['Study'] . "</td>";
            echo "<td>" . $row['gender'] . "</td>";
            echo "<td>" . $row['AGE'] . "</td>";
            echo "<td>" . $row['Program'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
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
