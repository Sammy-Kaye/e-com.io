<?php
// Start the session at the beginning
session_start();

include '../includes/header.php';
include_once '../database/db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: views/login.php");
    exit();
}

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle form actions: update, remove, clear, checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_cart'])) {
        foreach ($_POST['quantities'] as $product_id => $quantity) {
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['product_id'] == $product_id) {
                    $item['quantity'] = max(1, (int)$quantity); // Ensure quantity is at least 1
                }
            }
        }
    } elseif (isset($_POST['remove_item'])) {
        $product_id = $_POST['product_id'];
        $_SESSION['cart'] = array_filter($_SESSION['cart'], fn($item) => $item['product_id'] != $product_id);
    } elseif (isset($_POST['clear_cart'])) {
        $_SESSION['cart'] = [];
    } elseif (isset($_POST['checkout'])) {
        if (!empty($_SESSION['cart'])) {
            $user_id = $_SESSION['user_id'];
            $total_price = array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $_SESSION['cart']));

            // Insert into Orders table
            $stmt = $conn->prepare("INSERT INTO Orders (user_id, total_price) VALUES (?, ?)");
            $stmt->bind_param("id", $user_id, $total_price);

            if ($stmt->execute()) {
                $order_id = $stmt->insert_id;

                // Insert items into Order_Items table and update product stock
                foreach ($_SESSION['cart'] as $item) {
                    $stmt = $conn->prepare("INSERT INTO Order_Items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiid", $order_id, $item['product_id'], $item['quantity'], $item['price']);
                    $stmt->execute();

                    // Update product stock
                    $stmt = $conn->prepare("UPDATE products SET stock = stock - ? WHERE product_id = ?");
                    $stmt->bind_param("ii", $item['quantity'], $item['product_id']);
                    $stmt->execute();
                }

                // Clear the cart after successful purchase
                $_SESSION['cart'] = [];
                $success_message = "Items bought successfully!";
            } else {
                $error_message = "Error processing your order.";
            }

            $stmt->close();
        } else {
            $error_message = "Your cart is empty.";
        }
    }
}
?>

<div class="container">
    <h1>Your Cart</h1>

    <?php if (isset($success_message)) echo "<p class='success'>$success_message</p>"; ?>
    <?php if (isset($error_message)) echo "<p class='error'>$error_message</p>"; ?>

    <?php if (!empty($_SESSION['cart'])): ?>
        <form method="POST">
            <table>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td>R<?php echo number_format($item['price'], 2); ?></td> 
                        <td>
                            <input type="number" name="quantities[<?php echo $item['product_id']; ?>]" value="<?php echo $item['quantity']; ?>" min="1">
                        </td>
                        <td>R<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td> 
                        <td>
                            <button type="submit" name="remove_item" value="Remove">Remove</button>
                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <div class="cart-actions">
                <button type="submit" name="update_cart">Update Cart</button>
                <button type="submit" name="clear_cart">Clear Cart</button>
                <button type="submit" name="checkout">Checkout</button>
            </div>
        </form>
    <?php else: ?>
        <p>Your cart is empty.</p>
    <?php endif; ?>
</div>

<link rel="stylesheet" href="../assets/css/cart.css">

<?php include '../includes/footer.php'; ?>
