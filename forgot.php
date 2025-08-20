<?php
include 'db_connect.php';
session_start();

if (isset($_POST['reset'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
    } else {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $result = $conn->query("SELECT * FROM users WHERE email='$email'");
        if ($result->num_rows === 1) {
            $update = $conn->query("UPDATE users SET password='$hashed_password' WHERE email='$email'");
            if ($update) {
                echo "<script>
                        alert('Password updated successfully!');
                        window.location.href = 'login.php';
                      </script>";
            } else {
                echo "<script>alert('Error updating password: " . $conn->error . "');</script>";
            }
        } else {
            echo "<script>alert('Email not found in our records.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link rel="stylesheet" href="styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #c2e9fb, #a1c4fd);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .reset-container {
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

        button {
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

        button:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            font-size: 14px;
            margin-top: 10px;
        }

        a {
            color: #28a745;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="reset-container">
        <form method="POST">
            <h3>Reset Your FreshCart Account Password</h3>

            <label for="email">Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label for="new_password">New Password</label>
            <input type="password" name="new_password" placeholder="Enter new password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Confirm new password" required>

            <button type="submit" name="reset">Reset Password</button>

            <p>Back to <a href="signin.php">Sign Up</a> or <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>