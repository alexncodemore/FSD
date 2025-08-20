<?php 
include 'db_connect.php'; 
session_start(); 

if (isset($_POST['signup'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql)) {
    
        $user_id = $conn->insert_id;
        $_SESSION['user'] = $name;
        $_SESSION['user_id'] = $user_id;
        
        
        $_SESSION['just_signed_up'] = true;
        echo "<script>
                alert('Signup successful!');
                window.location.href = 'index2.php';
              </script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #ffecd2, #fcb69f);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .signup-container {
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

        input[type="text"],
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
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #218838;
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
    <div class="signup-container">
        <form method="POST">
            <h3>Create Your FreshCart Account</h3>

            <label for="name">Full Name</label>
            <input type="text" name="name" placeholder="Enter your name" required>

            <label for="email">Email Address</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Create a password" required>

            <button type="submit" name="signup">Sign Up</button>

            <p>Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</body>
</html>
