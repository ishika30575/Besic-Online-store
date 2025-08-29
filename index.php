<?php
session_start();
include 'db.php';
$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Online Store</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Product Listing</h1>
    <div class="products">
        <?php while($row = $result->fetch_assoc()): ?>
            <div class="product">
                <!-- Product Image -->
                <?php if (!empty($row['image'])): ?>
                    <img src="images/<?php echo $row['image']; ?>" width="150" alt="<?php echo $row['name']; ?>">
                <?php endif; ?>

                <!-- Product Details -->
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p><strong>₹<?php echo $row['price']; ?></strong></p>

                <!-- Add to Cart Form -->
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="number" name="qty" value="1" min="1">
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

    <br>
    <a href="cart.php">🛒 View Cart</a>
</body>
</html>
