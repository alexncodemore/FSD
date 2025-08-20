<?php include 'db_connect.php'; session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #74ebd5, #9face6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }

        h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        .btn input {
            width: 100%;
            padding: 12px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn input:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        a {
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form method="POST">
            <h3>Login to Your FreshCart Account</h3>

            <label for="email">Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <div class="btn">
                <input type="submit" name="login" value="Login">
            </div>

            <p>Don't have an account? <a href="signin.php">Sign Up</a></p>
            <p><a href="forgot.php">Forgot Password?</a></p>
        </form>
    </div>
</body>
</html>

<?php
if (isset($_POST['login'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['name'];          
            $_SESSION['email'] = $user['email'];        
            $_SESSION['phone'] = $user['phone'] ?? ''; 
            $_SESSION['address'] = $user['address'] ?? '';
            $_SESSION['just_signed_in'] = true;

            echo "<script>
                    alert('You are now logged in!');
                    window.location.href = 'index2.php';
                </script>";
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('User not found.');</script>";
    }
}
?>