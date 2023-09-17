<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to E-Learning Platform</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        main {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
        }

        p {
            font-size: 18px;
            line-height: 1.5;
        }

        .login-button {
            display: block;
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .login-button:hover {
            background-color: #0056b3;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to E-Learning System</h1>
        <p>Your gateway to online learning</p>
        <a href="login.php" class="login-button">Login</a>
    </header>
    <main>
        <div class="row">
            <div class="col-md-6">
            <section>
    <h2>About Us</h2>
    <p>Welcome to the E-Learning System, your trusted online resource for quality education and professional development. We are dedicated to providing accessible and engaging learning experiences to students and professionals around the world.</p>
    
    <p>Our mission is to empower individuals with knowledge and skills that can transform their lives and careers. Whether you're a student looking to enhance your academic performance or a professional seeking to upgrade your skills, we have a wide range of courses and resources tailored to your needs.</p>

    
</section>

            </div>
            <div class="col-md-6">
                <!-- Right Column with Picture -->
                <img src="./images/picha.png" alt="E-Learning Image" class="img-fluid">
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; <?php echo date('Y'); ?> E-Learning System</p>
    </footer>
</body>
</html>
