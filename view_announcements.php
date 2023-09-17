<?php
 include("CONN.php");

// Retrieve announcements from the database
$sql = "SELECT * FROM Announcements ORDER BY DatePosted DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Announcements</title>
    <style>
        /* Add CSS styling for the table */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        h1{
            text-align:center;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        table th {
            background-color: #007bff;
            color: #fff;
        }

        .actions {
            text-align: center;
        }

        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            background-color: red;
            color: #fff;
            border-radius: 5px;
        }

        .actions a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Announcements</h1>
    <table>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Posted By</th>
            <th>Date Posted</th>
            <th>Visibility</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['Content'] . "</td>";
            echo "<td>" . $row['PostedBy'] . "</td>";
            echo "<td>" . $row['DatePosted'] . "</td>";
            echo "<td>" . $row['Visibility'] . "</td>";
            echo "<td class='actions'>";
            echo "<a href='edit_announcement.php?id=" . $row['AnnounceID'] . "'>Edit</a>";
            echo " | ";
            echo "<a href='delete_announcement.php?id=" . $row['AnnounceID'] . "'>Delete</a>";
            echo "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
