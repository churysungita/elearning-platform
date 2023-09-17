<?php

include("CONN.php");

// Retrieve assignments from the database
$sql = "SELECT AS_ID, AssignmentName, Description, DueDate, MaxPoints, FileAttachment FROM Assignments";
$result = $conn->query($sql);

// Handle assignment deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM Assignments WHERE AS_ID = $delete_id";
    
    if ($conn->query($delete_sql) === TRUE) {
       
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>assignment page</title>
    <style>
        /* Reset some default styles */
body, h1, table {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

h1 {
    text-align: center;
    margin: 20px 0;
}

/* Table styling */
table {
    width: 90%;
    margin: 20px auto;
    border-collapse: collapse;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
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

/* Actions column styling */
.actions {
    text-align: center;
}

.actions a {
    text-decoration: none;
    padding: 5px 10px;
    background-color: #007bff;
    color: #fff;
    border-radius: 5px;
}

.actions a:hover {
    background-color: #0056b3;
}

/* Responsive layout for smaller screens */
@media (max-width: 768px) {
    table {
        width: 100%;
    }

    table th, table td {
        padding: 8px;
    }
}

    </style>
</head>
<body>
    <h1>assignment page</h1>
    <table border="1">
        <tr>
            <th>Assignment ID</th>
            <th>Assignment Name</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Max Points</th>
            <th>File Attachment</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['AS_ID'] . "</td>";
            echo "<td>" . $row['AssignmentName'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";
            echo "<td>" . $row['DueDate'] . "</td>";
            echo "<td>" . $row['MaxPoints'] . "</td>";
            echo "<td><a href='" . $row['FileAttachment'] . "'>Download</a></td>";
            echo "<td><a href='edit_assignment.php?id=" . $row['AS_ID'] . "'>Edit</a> | <a href='delete_assignment.php?delete_id=" . $row['AS_ID'] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
