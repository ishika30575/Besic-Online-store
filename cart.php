<?php
session_start();
include 'db.php';
$cart = $_SESSION['cart'] ?? [];
?>
<!DOCTYPE html>
<html>
<head><title>Cart</title></head>
<body>
<h1>Your Cart</h1>
<table border="1" cellpadding="5">
<tr><th>Product</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr>
<?php
$total = 0;
foreach($cart as $id => $qty) {
    $result = $conn->query("SELECT * FROM products WHERE id=$id");
    $product = $result->fetch_assoc();
    $subtotal = $product['price'] * $qty;
    $total += $subtotal;
    echo "<tr>
            <td>{$product['name']}</td>
            <td>$qty</td>
            <td>₹{$product['price']}</td>
            <td>₹$subtotal</td>
          </tr>";
}
?>
<tr><td colspan="3">Total</td><td>₹<?php echo $total; ?></td></tr>
</table>
<a href="checkout.php">Proceed to Checkout</a>
</body>
</html>
