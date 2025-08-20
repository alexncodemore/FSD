<?php session_start(); ?>
<h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2> <br>
<!-- <a href="logout.php">Logout</a><br> -->

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .btn {
            margin-top: 20px;
        }
        .btn input {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn input:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Welcome to your Dashboard!</h2>
    <p>You are logged in as <?php echo $_SESSION['user']; ?>.</p>
    <div class="btn">
        <input type="button" value="Logout" onclick="window.location.href='logout.php'">
    </div>
</body>
</html>

