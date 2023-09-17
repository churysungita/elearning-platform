<?php
include 'CONN.php'; // Include your database connection script

if (isset($_GET['id'])) {
    $announcement_id = $_GET['id'];
    $sql = "SELECT * FROM Announcements WHERE AnnounceID = $announcement_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Announcement not found.";
        exit; // Exit the script if the announcement is not found
    }
} else {
    echo "Invalid request.";
    exit; // Exit the script if no announcement ID is provided
}

// Handle the form submission for updating the announcement
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $content = $_POST["content"];
    $posted_by = $_POST["posted_by"];
    $visibility = $_POST["visibility"];
    
    $update_sql = "UPDATE Announcements 
                   SET Title = '$title', 
                       Content = '$content', 
                       PostedBy = '$posted_by', 
                       Visibility = '$visibility' 
                   WHERE AnnounceID = $announcement_id";

    if ($conn->query($update_sql) === TRUE) {
        header("Location: view_announcements.php"); // Redirect back to the announcements page after update
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Announcement</title>
</head>
<body>
    <h1>Edit Announcement</h1>
    <form action="edit_announcement.php?id=<?php echo $announcement_id; ?>" method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $row['Title']; ?>" required><br><br>

        <label for="content">Content:</label>
        <textarea name="content" rows="4" required><?php echo $row['Content']; ?></textarea><br><br>

        <label for="posted_by">Posted By:</label>
        <input type="text" name="posted_by" value="<?php echo $row['PostedBy']; ?>" required><br><br>

        <label for="visibility">Visibility:</label>
        <select name="visibility" required>
            <option value="All" <?php if ($row['Visibility'] == 'All') echo 'selected'; ?>>All</option>
            <option value="Students" <?php if ($row['Visibility'] == 'Students') echo 'selected'; ?>>Students</option>
            <option value="Instructors" <?php if ($row['Visibility'] == 'Instructors') echo 'selected'; ?>>Instructors</option>
            <option value="Admins" <?php if ($row['Visibility'] == 'Admins') echo 'selected'; ?>>Admins</option>
        </select><br><br>

        <input type="submit" value="Update Announcement">
    </form>
</body>
</html>
