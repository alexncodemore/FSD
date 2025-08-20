<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$cart_items = [];

$result = $conn->query("SELECT * FROM cart WHERE user_email='$email'");
if ($result) {
    $cart_items = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - FreshCart</title>
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

        .cart-header {
            margin-bottom: 30px;
        }

        .cart-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-dark);
            margin-bottom: 10px;
            position: relative;
            display: inline-block;
        }

        .cart-header h1::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: var(--primary);
            border-radius: 2px;
        }

        .cart-header p {
            color: var(--gray);
        }

        .cart-container {
            background-color: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 30px;
            transition: var(--transition);
        }

        .cart-container:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .cart-items {
            margin-bottom: 30px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .cart-item:hover {
            background-color: rgba(76, 175, 80, 0.03);
        }

        .item-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .item-details {
            flex-grow: 1;
        }

        .item-name {
            font-weight: 500;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .item-price {
            font-weight: 600;
            color: var(--secondary);
        }

        .item-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 30px;
            overflow: hidden;
        }

        .quantity-btn {
            width: 30px;
            height: 30px;
            background-color: var(--light);
            border: none;
            cursor: pointer;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .quantity-btn:hover {
            background-color: #e0e0e0;
        }

        .quantity-input {
            width: 40px;
            height: 30px;
            border: none;
            text-align: center;
            font-weight: 500;
            -moz-appearance: textfield;
        }

        .quantity-input::-webkit-outer-spin-button,
        .quantity-input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .update-btn {
            background-color: var(--primary);
            color: var(--white);
            border: none;
            border-radius: 4px;
            padding: 8px 15px;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
        }

        .update-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .remove-btn {
            background-color: transparent;
            color: var(--secondary);
            border: none;
            font-size: 20px;
            cursor: pointer;
            transition: var(--transition);
        }

        .remove-btn:hover {
            color: #d32f2f;
            transform: scale(1.1);
        }

        .cart-summary {
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            padding-top: 20px;
            margin-top: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .total-label {
            font-weight: 500;
            color: var(--gray);
        }

        .total-value {
            font-weight: 600;
            color: var(--dark);
        }

        .grand-total {
            font-size: 20px;
            color: var(--primary-dark);
        }

        .checkout-btn {
            display: block;
            width: 100%;
            max-width: 300px;
            margin: 30px auto 0;
            padding: 15px;
            background-color: var(--secondary);
            color: var(--white);
            border: none;
            border-radius: 30px;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
        }

        .checkout-btn:hover {
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 87, 34, 0.3);
        }

        .empty-cart {
            text-align: center;
            padding: 40px 0;
        }

        .empty-cart i {
            font-size: 60px;
            color: #e0e0e0;
            margin-bottom: 20px;
        }

        .empty-cart p {
            font-size: 18px;
            color: var(--gray);
            margin-bottom: 20px;
        }

        .shop-btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: var(--primary);
            color: var(--white);
            border-radius: 30px;
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
        }

        .shop-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .cart-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .item-img {
                margin-right: 0;
                margin-bottom: 15px;
            }
            
            .item-actions {
                width: 100%;
                justify-content: space-between;
            }
            
            .checkout-btn {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="cart-header">
            <h1>My Cart</h1>
            <p>Review your items before checkout</p>
        </div>

        <div class="cart-container">
            <?php if (count($cart_items) > 0): ?>
                <div class="cart-items">
                    <?php $total = 0; ?>
                    <?php foreach ($cart_items as $item): ?>
                        <?php $subtotal = $item['price'] * $item['quantity']; ?>
                        <?php $total += $subtotal; ?>
                        <div class="cart-item">
                            <img src="<?= htmlspecialchars($item['product_image']) ?>" class="item-img" alt="<?= htmlspecialchars($item['product_name']) ?>">
                            <div class="item-details">
                                <div class="item-name"><?= htmlspecialchars($item['product_name']) ?></div>
                                <div class="item-price">₹<?= number_format($item['price'], 2) ?></div>
                            </div>
                            <div class="item-actions">
                                <form method="post" action="update_cart.php" class="quantity-form">
                                    <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                                    <div class="quantity-control">
                                        <button type="button" class="quantity-btn minus">-</button>
                                        <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1" class="quantity-input">
                                        <button type="button" class="quantity-btn plus">+</button>
                                    </div>
                                    <button type="submit" class="update-btn">Update</button>
                                </form>
                                <form method="post" action="remove_cart.php">
                                    <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                                    <button type="submit" class="remove-btn" title="Remove item">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="cart-summary">
                    <div class="total-row">
                        <span class="total-label">Subtotal:</span>
                        <span class="total-value">₹<?= number_format($total, 2) ?></span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Shipping:</span>
                        <span class="total-value">Free</span>
                    </div>
                    <div class="total-row grand-total">
                        <span>Total:</span>
                        <span>₹<?= number_format($total, 2) ?></span>
                    </div>
                </div>

                <a href="checkout.php" class="checkout-btn">
                    <i class="fas fa-lock"></i> Proceed to Checkout
                </a>
            <?php else: ?>
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <p>Your cart is empty</p>
                    <a href="index2.php" class="shop-btn">
                        <i class="fas fa-arrow-left"></i> Start Shopping
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.parentElement.querySelector('.quantity-input');
                let value = parseInt(input.value);
                
                if (this.classList.contains('minus') && value > 1) {
                    input.value = value - 1;
                } else if (this.classList.contains('plus')) {
                    input.value = value + 1;
                }
            });
        });
    </script>
</body>
</html>