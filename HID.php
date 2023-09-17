<!-- instructor_cards.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Details</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include your CSS stylesheets here -->
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Instructor Details</h1>
        <div class="row mt-4">
            <div class="col-md-6">
                
                <!-- Instructor Card -->
                <div class="card mb-3">
                    <div class="card-body">
                        <?php
                        include("CONN.php"); // Include your database connection file

                        // Assuming you have a session variable that contains the logged-in user's ID
                        session_start();
                        $loggedInUserId = $_SESSION['instructor_id'];

                        // Fetch instructor data for the logged-in user from the database
                        $query = "SELECT * FROM instructor WHERE instructor_id = ?";

                        // Use a prepared statement to prevent SQL injection
                        $stmt = mysqli_prepare($conn, $query);
                        mysqli_stmt_bind_param($stmt, "i", $loggedInUserId);

                        if (mysqli_stmt_execute($stmt)) {
                            $result = mysqli_stmt_get_result($stmt);

                            // Check if there are any records
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Display instructor details
                                    echo '<h5 class="card-title">' . $row['first_name'] . ' ' . $row['last_name'] . '</h5>';
                                    echo '<p class="card-text"><strong>Username:</strong> ' . $row['username'] . '</p>';
                                    echo '<p class="card-text"><strong>Email:</strong> ' . $row['email'] . '</p>';
                                    // You can add more details as needed
                                }
                            } else {
                                echo '<p class="mt-3">No instructor found for the logged-in user.</p>';
                            }
                        } else {
                            echo '<p class="mt-3">Error fetching instructor data: ' . mysqli_error($conn) . '</p>';
                        }

                        // Close the prepared statement and the database connection
                        mysqli_stmt_close($stmt);
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Courses Card -->
                
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Assigned Courses</h5>
                        <ul class="list-group">
                            <?php
                            include("CONN.php"); // Include your database connection file

                            // Fetch assigned courses and their program names for the logged-in instructor from the database
                            $query = "SELECT ci.course_id, c.title AS course_title, c.description, c.course_weight, p.program_name
                                      FROM course_instructor ci
                                      INNER JOIN course c ON ci.course_id = c.course_id
                                      INNER JOIN programs p ON c.program_id = p.program_id
                                      WHERE ci.instructor_id = ?";

                            // Use a prepared statement to prevent SQL injection
                            $stmt = mysqli_prepare($conn, $query);
                            mysqli_stmt_bind_param($stmt, "i", $loggedInUserId);

                            if (mysqli_stmt_execute($stmt)) {
                                $result = mysqli_stmt_get_result($stmt);

                                // Check if there are any records
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        // Display assigned course details along with the program name
                    echo '<div class="mb-4">';
                    echo '<h6 class="mb-2"><strong>Course Title:</strong> ' . $row['course_title'] . '</h6>';
                    echo '<p><strong>Course Description:</strong> ' . $row['description'] . '</p>';
                    echo '<p><strong>Course Weight:</strong> ' . $row['course_weight'] . '</p>';
                    echo '<p><strong>Program Name:</strong> ' . $row['program_name'] . '</p>';

                    // Create links for materials, assignments, and announcements
                    echo '<p><a href="materials.php?course_id=' . $row['course_id'] . '">Materials</a></p>';
                    echo '<p><a href="assignments.php?course_id=' . $row['course_id'] . '">Assignments</a></p>';
                  
                    echo '<p><a href="instructor_announcemennts.php?course_id=' . $row['course_id'] . '">Announcements</a></p>';
                    echo '<p><a href="assignment_submitted_to_instructor.php?course_id=' . $row['course_id'] . '">Submitted Assignments</a></p>';
                    echo '</div>';
                                    }
                                } else {
                                    echo '<li class="list-group-item">No courses assigned to this instructor.</li>';
                                }
                            } else {
                                echo '<li class="list-group-item">Error fetching assigned courses: ' . mysqli_error($conn) . '</li>';
                            }

                            // Close the prepared statement and the database connection
                            mysqli_stmt_close($stmt);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>    <div style="position: absolute; top: 0; right: 0;">
        <a href="logout.php" style="text-decoration: none; color: red;">Logout</a>
    </div>

    <!-- Include Bootstrap JS and jQuery (if needed) -->

</body>
</html>
