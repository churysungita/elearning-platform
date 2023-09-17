<?php


session_start();
include("CONN.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Check if the user is an admin
    $admin_query = "SELECT * FROM admin WHERE BINARY username = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $admin_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $admin_result = mysqli_stmt_get_result($stmt);

    if ($admin_result && mysqli_num_rows($admin_result) == 1) {
        $admin_row = mysqli_fetch_assoc($admin_result);
        if (password_verify($password, $admin_row['password'])) {
            $_SESSION['admin_id'] = $admin_row['admin_id'];
            header("Location: HAD.php");
            exit();
        }
    }

    // Check if the user is an instructor
    $instructor_query = "SELECT * FROM instructor WHERE BINARY username = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $instructor_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $instructor_result = mysqli_stmt_get_result($stmt);

    if ($instructor_result && mysqli_num_rows($instructor_result) == 1) {
        $instructor_row = mysqli_fetch_assoc($instructor_result);
        if (password_verify($password, $instructor_row['password'])) {
            $_SESSION['instructor_id'] = $instructor_row['instructor_id'];
            header("Location: HID.php"); // Full path
            exit();
        }
    }

    // Check if the user is a student
    $student_query = "SELECT * FROM students WHERE BINARY username = ? LIMIT 1";
    $stmt = mysqli_prepare($conn, $student_query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $student_result = mysqli_stmt_get_result($stmt);

    if ($student_result && mysqli_num_rows($student_result) == 1) {
        $student_row = mysqli_fetch_assoc($student_result);
        if (password_verify($password, $student_row['password'])) {
            $_SESSION['student_id'] = $student_row['student_id'];
            header("Location: HSD.php"); // Full path
            exit();
        }
    }

    // If none of the above conditions matched, it's an invalid login
    $login_error = "Invalid login credentials.";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LOGIN PAGE</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>LOGIN</h1>
        <form class="login-container" action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" class="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" class="password" required><br>
            <button type="submit" name="login">Login</button>
            <!-- <a href="#">Forgot Password?</a> -->
        </form>
        <?php
        if (isset($login_error)) {
            echo '<p style="color: red;">' . $login_error . '</p>';
        }
        ?>
    </div>
</body>
</html>
