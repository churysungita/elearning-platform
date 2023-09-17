<?php
session_start();
if (!isset($_SESSION['instructor_id'])) {
    header("Location: ASSIGN-C.php"); // Redirect to login page if not logged in
    exit();
}

include("CONN.php");

// Fetch the list of courses from the database
$query = "SELECT * FROM course";
$result = mysqli_query($conn, $query);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['select_course'])) {
    // Get the selected course's ID
    $selected_course_id = $_POST['selected_course_id'];
    
    // Update the instructor's course selection in the database (replace 'your_instructor_id' with the actual instructor ID)
    $instructor_id = $_SESSION['instructor_id'];
    $update_query = "UPDATE instructor SET I_course = '$selected_course_id' WHERE I_ID = '$instructor_id'";
    mysqli_query($conn, $update_query);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>List of Courses</title>
    <script>
        function displayCourseId(courseId) {
            alert("Selected Course ID: " + courseId);
        }
    </script>
</head>
<body>
    <h2>List of Courses</h2>
    <table>
        <tr>
            <th>Course ID</th>
            <th>Action</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['C_ID'] . "</td>";
            echo "<td>";
            echo '<form method="post">';
            echo '<input type="hidden" name="selected_course_id" value="' . $row['C_ID'] . '">';
            echo '<button type="button" onclick="displayCourseId(\'' . $row['C_ID'] . '\')">Select</button>';
            echo '</form>';
            echo "</td>";
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
