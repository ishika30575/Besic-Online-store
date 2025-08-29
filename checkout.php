<?php
session_start();
include 'db.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = 1; // Hardcoded (later: login system)
    $cart = $_SESSION['cart'];
    $total = 0;

    foreach($cart as $id => $qty) {
        $result = $conn->query("SELECT * FROM products WHERE id=$id");
        $p = $result->fetch_assoc();
        $total += $p['price'] * $qty;
    }

    $conn->query("INSERT INTO orders (user_id, total) VALUES ($user_id, $total)");
    $order_id = $conn->insert_id;

    foreach($cart as $id => $qty) {
        $result = $conn->query("SELECT * FROM products WHERE id=$id");
        $p = $result->fetch_assoc();
        $price = $p['price'];
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price)
                      VALUES ($order_id, $id, $qty, $price)");
    }

    unset($_SESSION['cart']);
    echo "<h2>Order Placed Successfully!</h2>";
}
?>
<!DOCTYPE html>
<html>
<head><title>Checkout</title></head>
<body>
<h1>Checkout</h1>
<form method="post">
  <label>Name:</label><input type="text" name="name" required><br>
  <label>Address:</label><textarea name="address" required></textarea><br>
  <button type="submit">Place Order</button>
</form>
</body>
</html>
