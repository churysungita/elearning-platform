<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment Upload</title>
   <style>
    /* Reset some default styles */
body, h1, form {
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

/* Form container */
form {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
}

/* Form input fields */
label, input, textarea {
    display: block;
    margin-bottom: 15px;
    width: 100%;
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="datetime-local"],
input[type="number"],
textarea {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* File input styling */
input[type="file"] {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #f9f9f9;
    cursor: pointer;
}

/* Submit button */
input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

/* Error message styling */
.error {
    color: #ff0000;
    font-weight: bold;
    margin-top: 10px;
}

/* Responsive layout for smaller screens */
@media (max-width: 768px) {
    form {
        width: 90%;
    }
}

   </style>
</head>
<body>
    <h1>Upload Assignment</h1>
<form action="uploadassgnmt.php" method="post" enctype="multipart/form-data">
    <label for="assignmentName">Assignment Name:</label>
    <input type="text" name="assignmentName" required><br><br>

    <label for="description">Description:</label>
    <textarea name="description" rows="4" required></textarea><br><br>

    <label for="dueDate">Due Date:</label>
    <input type="datetime-local" name="dueDate" required><br><br>

    <label for="maxPoints">Max Points:</label>
    <input type="number" name="maxPoints" min="1" max="100" required><br><br>

    <label for="fileAttachment">Upload Assignment File:</label>
    <input type="file" name="fileAttachment" required><br><br>

    <input type="submit" value="Upload Assignment">
</form>

</body>
</html>
