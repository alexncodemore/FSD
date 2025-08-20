<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$orders = [];

// Fetch orders from database
$result = $conn->query("SELECT * FROM orders WHERE user_email='$email' ORDER BY order_date DESC");
if ($result) {
    $orders = $result->fetch_all(MYSQLI_ASSOC);
}
echo $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders - FreshCart</title>
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
            <div style="margin-bottom: 20px;">
                <a href="index2.php" class="shop-btn" style="background-color: var(--secondary);">
                    <i class="fas fa-arrow-left"></i> Back to Home
                </a>
            </div>
        }

        .orders-header {
            margin-bottom: 30px;
        }

        .orders-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .orders-header h1::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        .orders-header p {
            color: var(--gray);
        }

        .orders-container {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .order-card {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            padding: 20px;
            transition: var(--transition);
        }

        .order-card:hover {
            background-color: rgba(76, 175, 80, 0.03);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .order-id {
            font-weight: 600;
            color: var(--primary-dark);
        }

        .order-date {
            color: var(--gray);
            font-size: 14px;
        }

        .order-status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }

        .status-delivered {
            background-color: #e8f5e9;
            color: var(--primary-dark);
        }

        .status-pending {
            background-color: #fff8e1;
            color: #ff8f00;
        }

        .status-cancelled {
            background-color: #ffebee;
            color: #d32f2f;
        }

        .order-details {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 15px;
        }

        .detail-item {
            display: flex;
            flex-direction: column;
        }

        .detail-label {
            font-size: 14px;
            color: var(--gray);
            margin-bottom: 5px;
        }

        .detail-value {
            font-weight: 500;
        }

        .order-items {
            margin-top: 20px;
        }

        .items-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--dark);
        }

        .item-list {
            list-style: none;
        }

        .item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed rgba(0, 0, 0, 0.1);
        }

        .item:last-child {
            border-bottom: none;
        }

        .item-name {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .item-img {
            width: 40px;
            height: 40px;
            border-radius: 4px;
            object-fit: cover;
        }

        .item-price {
            font-weight: 500;
        }

        .no-orders {
            text-align: center;
            padding: 50px;
            color: var(--gray);
        }

        .no-orders i {
            font-size: 50px;
            margin-bottom: 20px;
            color: #e0e0e0;
        }

        .no-orders p {
            margin-bottom: 20px;
        }

        .shop-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: var(--primary);
            color: var(--white);
            border-radius: 4px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .shop-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .order-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .order-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="orders-header">
            <h1>My Orders</h1>
            <p>View your order history and track current orders</p>
        </div>
        <div style="margin-bottom: 20px;">
            <a href="index2.php" class="shop-btn" style="background-color: var(--secondary);">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>


        <div class="orders-container">
            <?php if (count($orders) > 0): ?>
                <?php foreach ($orders as $order): ?>
                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <span class="order-id">Order #<?= htmlspecialchars($order['order_id']) ?></span>
                                <span class="order-date">• <?= date('M d, Y', strtotime($order['order_date'])) ?></span>
                            </div>
                            <span class="order-status status-<?= strtolower($order['status']) ?>">
                                <?= htmlspecialchars($order['status']) ?>
                            </span>
                        </div>

                        <div class="order-details">
                            <div class="detail-item">
                                <span class="detail-label">Total Amount</span>
                                <span class="detail-value">₹<?= number_format($order['total_amount'], 2) ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Payment Method</span>
                                <span class="detail-value"><?= htmlspecialchars($order['payment_method']) ?></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Delivery Address</span>
                                <span class="detail-value"><?= htmlspecialchars($order['delivery_address']) ?></span>
                            </div>
                        </div>

                        <div class="order-items">
                            <h3 class="items-title">Items Ordered</h3>
                            <ul class="item-list">
                                <?php 
                                
                                $order_id = $order['order_id'];
                                $items_result = $conn->query("SELECT * FROM order_items WHERE order_id='$order_id'");
                                if ($items_result && $items_result->num_rows > 0):
                                    while ($item = $items_result->fetch_assoc()):
                                ?>
                                    <li class="item">
                                        <div class="item-name">
                                            <img src="<?= htmlspecialchars($item['product_image']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>" class="item-img">
                                            <span><?= htmlspecialchars($item['product_name']) ?></span>
                                        </div>
                                        <div class="item-price">
                                            ₹<?= number_format($item['price'], 2) ?> × <?= $item['quantity'] ?>
                                        </div>
                                    </li>
                                <?php 
                                    endwhile;
                                endif;
                                ?>
                            </ul>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-orders">
                    <i class="fas fa-box-open"></i>
                    <p>You haven't placed any orders yet</p>
                    <a href="index.php" class="shop-btn">Start Shopping</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>