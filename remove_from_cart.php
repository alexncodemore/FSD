<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cart_id = intval($_POST['cart_id']);
    $email = $_SESSION['email'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_email = ?");
    $stmt->bind_param("is", $cart_id, $email);
    $stmt->execute();
    $stmt->close();
}

header("Location: cart.php");
exit();
?>