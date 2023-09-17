<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .dashboard {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px;
        }

        .course-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        .course-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .course-code {
            font-size: 16px;
            color: #666;
        }

        .course-elements {
            margin-top: 20px;
        }

        .element {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="course-box">
            <div class="course-title">CP 121</div>
            <div class="course-code">Computer Programming</div>
            <div class="course-elements">
                <div class="element">
                    <a href="#">Materials</a>
                </div>
                <div class="element">
                    <a href="#">Students</a>
                </div>
                <div class="element">
                    <a href="#">Assignments</a>
                </div>
                <div class="element">
                    <a href="#">Announcements</a>
                </div>
            </div>
        </div>
        <!-- Repeat the course-box structure for other courses -->
    </div>
    <?php
// Database connection parameters
$host = 'your_database_host';
$username = 'your_database_username';
$password = 'your_database_password';
$database = 'your_database_name';

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch course data from the database
$sql = "SELECT id, course_title, course_code FROM courses";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $courseId = $row['id'];
        $courseTitle = $row['course_title'];
        $courseCode = $row['course_code'];
        
        // Output course box with dynamic data
        echo '<div class="course-box">';
        echo '<div class="course-title">' . $courseCode . '</div>';
        echo '<div class="course-code">' . $courseTitle . '</div>';
        echo '<div class="course-elements">';
        echo '<div class="element"><a href="materials.php?course_id=' . $courseId . '">Materials</a></div>';
        echo '<div class="element"><a href="students.php?course_id=' . $courseId . '">Students</a></div>';
        echo '<div class="element"><a href="assignments.php?course_id=' . $courseId . '">Assignments</a></div>';
        echo '<div class="element"><a href="announcements.php?course_id=' . $courseId . '">Announcements</a></div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo "No courses found in the database.";
}

// Close the database connection
$conn->close();
?>

</body>
</html>
