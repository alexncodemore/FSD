<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$message = "";

if (isset($_POST['change'])) {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    $result = $conn->query("SELECT password FROM users WHERE email='$email'");
    $user = $result->fetch_assoc();

    if (!password_verify($current, $user['password'])) {
        $message = "❌ Current password is incorrect.";
    } elseif ($new !== $confirm) {
        $message = "❌ New passwords do not match.";
    } elseif (strlen($new) < 6) {
        $message = "❌ New password must be at least 6 characters.";
    } else {
        $hashed = password_hash($new, PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET password='$hashed' WHERE email='$email'");
        $message = "✅ Password changed successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password - FreshCart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4CAF50;
            --primary-dark: #388E3C;
            --secondary: #FF5722;
            --accent: #FFC107;
            --dark: #212121;
            --light: #f5f5f5;
            --gray: #757575;
            --white: #ffffff;
            --shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .password-container {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            transition: var(--transition);
        }

        .password-container:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .password-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .password-header h2 {
            color: var(--primary-dark);
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .password-header p {
            color: var(--gray);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        .form-group .input-field {
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: var(--transition);
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
        }

        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray);
            font-size: 16px;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .message {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
        }

        .error {
            color: #d32f2f;
            background-color: #fde8e8;
        }

        .success {
            color: var(--primary-dark);
            background-color: #e8f5e9;
        }

        @media (max-width: 480px) {
            .password-container {
                padding: 30px 20px;
            }
            
            .password-header h2 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="password-container">
        <div class="password-header">
            <h2>Change Password</h2>
            <p>Secure your account with a new password</p>
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <div class="input-field">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="current_password" id="current_password" required>
                </div>
            </div>

            <div class="form-group">
                <label for="new_password">New Password</label>
                <div class="input-field">
                    <i class="fas fa-key"></i>
                    <input type="password" name="new_password" id="new_password" required>
                </div>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm New Password</label>
                <div class="input-field">
                    <i class="fas fa-check-circle"></i>
                    <input type="password" name="confirm_password" id="confirm_password" required>
                </div>
            </div>

            <button type="submit" name="change" class="submit-btn">Update Password</button>

            <?php if ($message): ?>
                <div class="message <?= strpos($message, '✅') !== false ? 'success' : 'error' ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>