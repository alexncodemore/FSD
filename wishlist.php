<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
$wishlist = [];

$result = $conn->query("SELECT * FROM wishlist WHERE user_email='$email' ORDER BY added_on DESC");
if ($result) {
    $wishlist = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Wishlist - FreshCart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .wishlist-header {
            margin-bottom: 30px;
        }
        .wishlist-header h1 {
            font-size: 28px;
            color: #388E3C;
            position: relative;
        }
        .wishlist-header h1::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 4px;
            background-color: #4CAF50;
            border-radius: 2px;
        }
        .wishlist-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        .wishlist-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 15px;
            text-align: center;
        }
        .wishlist-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
        }
        .wishlist-card h3 {
            margin: 10px 0;
            font-size: 18px;
            color: #212121;
        }
        .wishlist-card p {
            color: #757575;
            font-size: 14px;
        }
        .wishlist-card .price {
            font-weight: 600;
            margin-top: 10px;
            color: #FF5722;
        }
        .wishlist-card .actions {
            margin-top: 15px;
        }
        .wishlist-card .btn {
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }
        .btn-cart {
            background-color: #4CAF50;
            color: white;
        }
        .btn-remove {
            background-color: #f44336;
            color: white;
            margin-left: 10px;
        }
        .no-wishlist {
            text-align: center;
            padding: 50px;
            color: #757575;
        }
        .no-wishlist i {
            font-size: 50px;
            margin-bottom: 20px;
            color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="wishlist-header">
        <h1>My Wishlist</h1>
        <p>Items you've saved for later</p>
    </div>

    <?php if (count($wishlist) > 0): ?>
        <div class="wishlist-container">
            <?php foreach ($wishlist as $item): ?>
                <div class="wishlist-card">
                    <img src="<?= htmlspecialchars($item['product_image']) ?>" alt="<?= htmlspecialchars($item['product_name']) ?>">
                    <h3><?= htmlspecialchars($item['product_name']) ?></h3>
                    <p class="price">₹<?= number_format($item['price'], 2) ?></p>
                    <div class="actions">
                        <form method="post" action="add_to_cart.php" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= $item['product_id'] ?>">
                            <button type="submit" class="btn btn-cart">Add to Cart</button>
                        </form>
                        <form method="post" action="remove_wishlist.php" style="display:inline;">
                            <input type="hidden" name="wishlist_id" value="<?= $item['id'] ?>">
                            <button type="submit" class="btn btn-remove">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="no-wishlist">
            <i class="fas fa-heart-broken"></i>
            <p>Your wishlist is empty</p>
            <a href="index2.php" class="btn btn-cart">Browse Products</a>
        </div>
    <?php endif; ?>
</body>
</html>