<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'] ?? null;

if ($email) {
    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $result->fetch_assoc();
} else {
    $user = ['name' => $_SESSION['user'], 'email' => 'Not Provided', 'phone' => 'Not Provided', 'address' => 'Not Provided'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - FreshCart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
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
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Profile Container */
        .profile-container {
            max-width: 800px;
            margin: 50px auto;
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            overflow: hidden;
            position: relative;
            transition: var(--transition);
        }

        .profile-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .profile-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            padding: 30px;
            color: var(--white);
            display: flex;
            align-items: center;
            gap: 20px;
            position: relative;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/food.png');
            opacity: 0.1;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
            z-index: 1;
        }

        .profile-info {
            z-index: 1;
        }

        .profile-info h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-info p {
            font-size: 16px;
            opacity: 0.9;
        }

        .profile-content {
            padding: 30px;
        }

        .profile-section {
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background-color: var(--accent);
            border-radius: 3px;
        }

        .detail-item {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(76, 175, 80, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary);
            font-size: 18px;
        }

        .detail-content h4 {
            font-size: 16px;
            font-weight: 500;
            color: var(--gray);
            margin-bottom: 5px;
        }

        .detail-content p {
            font-size: 18px;
            font-weight: 500;
            color: var(--dark);
        }

        .action-buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 30px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 16px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .btn-outline {
            background-color: transparent;
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: rgba(76, 175, 80, 0.1);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade {
            animation: fadeIn 0.8s ease forwards;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                text-align: center;
            }
            
            .profile-info {
                text-align: center;
            }
            
            .detail-item {
                flex-direction: column;
            }
            
            .detail-icon {
                margin-bottom: 10px;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="profile-container animate-fade">
            <div class="profile-header">
                <img src="https://as2.ftcdn.net/jpg/03/49/49/79/1000_F_349497933_Ly4im8BDmHLaLzgyKg2f2yZOvJjBtlw5.jpg" alt="User" class="profile-pic">
                <div class="profile-info">
                    <h2><?= htmlspecialchars($user['name'] ?? $_SESSION['user']) ?></h2>
                    <p>Member since <?= date('F Y', strtotime($user['created_at'] ?? 'now')) ?></p>
                </div>
            </div>
            
            <div class="profile-content">
                <div class="profile-section">
                    <h3 class="section-title">Personal Information</h3>
                    
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="detail-content">
                            <h4>Email Address</h4>
                            <p><?= htmlspecialchars($user['email'] ?? 'Not Provided') ?></p>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="detail-content">
                            <h4>Phone Number</h4>
                            <p><?= htmlspecialchars($user['phone'] ?? 'Not Provided') ?></p>
                        </div>
                    </div>
                    
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="detail-content">
                            <h4>Delivery Address</h4>
                            <p><?= htmlspecialchars($user['address'] ?? 'Not Provided') ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <a href="settings.php">
                        <button class="btn btn-primary">
                            <i class="fas fa-edit"></i> Edit Profile
                        </button>
                    </a>
                    <button class="btn btn-outline">
                        <a href="change_password.php">
                            <button class="btn btn-outline">
                                <i class="fas fa-key"></i> Change Password
                            </button>
                        </a>

                        <!-- <i class="fas fa-key"></i> Change Password -->
                    </button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>