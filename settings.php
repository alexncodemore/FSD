<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$user = [];

// Fetch user details
$result = $conn->query("SELECT * FROM users WHERE email='$email'");
if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - FreshCart</title>
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
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }

        .settings-container {
            display: flex;
            gap: 30px;
            margin-top: 30px;
        }

        .settings-sidebar {
            width: 250px;
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 20px;
        }

        .settings-content {
            flex: 1;
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 30px;
        }

        .settings-header {
            margin-bottom: 30px;
        }

        .settings-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 10px;
            position: relative;
        }

        .settings-header h1::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        .settings-header p {
            color: var(--gray);
        }

        .settings-menu {
            list-style: none;
        }

        .settings-menu li {
            margin-bottom: 10px;
        }

        .settings-menu a {
            display: block;
            padding: 12px 15px;
            color: var(--dark);
            text-decoration: none;
            border-radius: 6px;
            transition: var(--transition);
            font-weight: 500;
        }

        .settings-menu a:hover, .settings-menu a.active {
            background-color: rgba(76, 175, 80, 0.1);
            color: var(--primary-dark);
        }

        .settings-menu a i {
            width: 25px;
            text-align: center;
            margin-right: 10px;
        }

        .settings-panel {
            display: none;
        }

        .settings-panel.active {
            display: block;
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

        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: var(--transition);
        }

        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(76, 175, 80, 0.2);
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

        .profile-pic-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .profile-pic {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary);
        }

        .profile-pic-upload {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .notification-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .notification-label {
            font-weight: 500;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 24px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: var(--transition);
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: var(--transition);
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--primary);
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        @media (max-width: 768px) {
            .settings-container {
                flex-direction: column;
            }
            
            .settings-sidebar {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="settings-header">
            <h1>Account Settings</h1>
            <p>Manage your account preferences and security settings</p>
        </div>

        <div class="settings-container">
            <div class="settings-sidebar">
                <ul class="settings-menu">
                    <li><a href="#" class="active" data-panel="profile"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a href="#" data-panel="security"><i class="fas fa-lock"></i> Security</a></li>
                    <li><a href="#" data-panel="notifications"><i class="fas fa-bell"></i> Notifications</a></li>
                    <li><a href="#" data-panel="privacy"><i class="fas fa-shield-alt"></i> Privacy</a></li>
                    <li><a href="#" data-panel="payment"><i class="fas fa-credit-card"></i> Payment Methods</a></li>
                </ul>
            </div>

            <div class="settings-content">
                <!-- Profile Settings Panel -->
                <div class="settings-panel active" id="profile-panel">
                    <h2>Profile Information</h2>
                    <p class="section-description">Update your personal information and profile picture</p>
                    
                    <form action="update_profile.php" method="POST" enctype="multipart/form-data">
                        <div class="profile-pic-container">
                            <img src="<?= htmlspecialchars($user['profile_pic'] ?? 'https://via.placeholder.com/80') ?>" alt="Profile" class="profile-pic" id="profile-preview">
                            <div class="profile-pic-upload">
                                <input type="file" name="profile_pic" id="profile-pic-upload" accept="image/*" style="display: none;">
                                <button type="button" class="btn btn-outline" onclick="document.getElementById('profile-pic-upload').click()">
                                    <i class="fas fa-camera"></i> Change Photo
                                </button>
                                <small>JPG, PNG up to 2MB</small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($user['name'] ?? '') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email'] ?? '') ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                        </div>

                        <div class="form-group">
                            <label for="address">Delivery Address</label>
                            <textarea id="address" name="address" rows="3"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </form>
                </div>

                <!-- Security Settings Panel -->
                <div class="settings-panel" id="security-panel">
                    <h2>Security Settings</h2>
                    <p class="section-description">Manage your password and account security</p>
                    
                    <form action="change_password.php" method="POST">
                        <div class="form-group">
                            <label for="current-password">Current Password</label>
                            <input type="password" id="current-password" name="current_password" required>
                        </div>

                        <div class="form-group">
                            <label for="new-password">New Password</label>
                            <input type="password" id="new-password" name="new_password" required>
                        </div>

                        <div class="form-group">
                            <label for="confirm-password">Confirm New Password</label>
                            <input type="password" id="confirm-password" name="confirm_password" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-key"></i> Update Password
                        </button>
                    </form>
                </div>

                <!-- Notification Settings Panel -->
                <div class="settings-panel" id="notifications-panel">
                    <h2>Notification Preferences</h2>
                    <p class="section-description">Choose how you receive notifications</p>
                    
                    <form action="update_notifications.php" method="POST">
                        <div class="notification-item">
                            <div class="notification-label">Email Notifications</div>
                            <label class="switch">
                                <input type="checkbox" name="email_notifications" <?= ($user['email_notifications'] ?? 1) ? 'checked' : '' ?>>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="notification-item">
                            <div class="notification-label">SMS Notifications</div>
                            <label class="switch">
                                <input type="checkbox" name="sms_notifications" <?= ($user['sms_notifications'] ?? 0) ? 'checked' : '' ?>>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="notification-item">
                            <div class="notification-label">Promotional Offers</div>
                            <label class="switch">
                                <input type="checkbox" name="promo_notifications" <?= ($user['promo_notifications'] ?? 1) ? 'checked' : '' ?>>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="notification-item">
                            <div class="notification-label">Order Updates</div>
                            <label class="switch">
                                <input type="checkbox" name="order_notifications" <?= ($user['order_notifications'] ?? 1) ? 'checked' : '' ?>>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-bell"></i> Save Preferences
                        </button>
                    </form>
                </div>

                <!-- Privacy Settings Panel -->
                <div class="settings-panel" id="privacy-panel">
                    <h2>Privacy Settings</h2>
                    <p class="section-description">Control your privacy and data sharing preferences</p>
                    
                    <form action="update_privacy.php" method="POST">
                        <div class="notification-item">
                            <div class="notification-label">Show my profile to other users</div>
                            <label class="switch">
                                <input type="checkbox" name="profile_visibility" <?= ($user['profile_visibility'] ?? 0) ? 'checked' : '' ?>>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="notification-item">
                            <div class="notification-label">Allow personalized recommendations</div>
                            <label class="switch">
                                <input type="checkbox" name="personalized_ads" <?= ($user['personalized_ads'] ?? 1) ? 'checked' : '' ?>>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="notification-item">
                            <div class="notification-label">Share data with third-party partners</div>
                            <label class="switch">
                                <input type="checkbox" name="data_sharing" <?= ($user['data_sharing'] ?? 0) ? 'checked' : '' ?>>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-shield-alt"></i> Update Privacy Settings
                        </button>
                    </form>
                </div>

                <!-- Payment Methods Panel -->
                <div class="settings-panel" id="payment-panel">
                    <h2>Payment Methods</h2>
                    <p class="section-description">Manage your saved payment options</p>
                    
                    <div class="payment-methods">
                        <!-- This would be dynamically populated from database -->
                        <div class="payment-card">
                            <i class="fab fa-cc-visa"></i>
                            <span>Visa ending in 4242</span>
                            <button class="btn btn-outline">Remove</button>
                        </div>
                        
                        <button class="btn btn-primary" style="margin-top: 20px;">
                            <i class="fas fa-plus"></i> Add New Payment Method
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Switch between settings panels
        document.querySelectorAll('.settings-menu a').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all links and panels
                document.querySelectorAll('.settings-menu a').forEach(el => el.classList.remove('active'));
                document.querySelectorAll('.settings-panel').forEach(el => el.classList.remove('active'));
                
                // Add active class to clicked link
                this.classList.add('active');
                
                // Show corresponding panel
                const panelId = this.getAttribute('data-panel') + '-panel';
                document.getElementById(panelId).classList.add('active');
            });
        });

        // Profile picture preview
        document.getElementById('profile-pic-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('profile-preview').src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>