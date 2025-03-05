<?php
// Start the session at the beginning
session_start(); // Start session to store cart data

include '../includes/header.php';
include_once '../database/db_connect.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page
    header("Location: ../views/login.php");
    exit();
}

// Get product_id from the query string
$product_id = isset($_GET['product_id']) ? (int)$_GET['product_id'] : 0;

// Fetch product details
$sql = "SELECT p.product_id, p.name, p.description, p.price, p.stock, d.detailed_description, d.image_url, d.additional_info 
        FROM products p 
        LEFT JOIN product_description d ON p.product_id = d.product_id 
        WHERE p.product_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error preparing SELECT statement: " . $conn->error;
    exit;
}

$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0):
    $product = $result->fetch_assoc();

    // Add to Cart logic
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
        $quantity = (int)$_POST['quantity'];

        if ($quantity > 0 && $quantity <= $product['stock']) {
            // Create a cart item array
            $cart_item = [
                'product_id' => $product['product_id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
            ];

            // Check if the cart already exists in the session
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            // Add item to cart or update quantity
            $cart_found = false;
            foreach ($_SESSION['cart'] as $index => $item) {
                if ($item['product_id'] === $cart_item['product_id']) {
                    $_SESSION['cart'][$index]['quantity'] += $quantity;
                    $cart_found = true;
                    break;
                }
            }

            if (!$cart_found) {
                $_SESSION['cart'][] = $cart_item;
            }

            echo "<p class='success-message'>Added to cart successfully!</p>";
        } else {
            echo "<p class='error-message'>Invalid quantity or insufficient stock.</p>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Details</title>
    <link rel="stylesheet" href="../assets/css/product_details.css">
</head>
<body>
    <main class="product-details-page">
        <section class="product-details">
            <h1><?php echo htmlspecialchars($product['name']); ?></h1>
            <div class="product-info">
                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                <div class="product-description">
                    <p><strong>Price:</strong> R<?php echo number_format($product['price'], 2); ?></p>
                    <p><strong>Stock:</strong> <?php echo $product['stock'] > 0 ? "In Stock" : "Out of Stock"; ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($product['detailed_description']); ?></p>
                    <?php if ($product['stock'] > 0): ?>
                        <form method="POST" action="" class="add-to-cart-form">
                            <label for="quantity">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" min="1" max="<?php echo $product['stock']; ?>" value="1">
                            <button type="submit" name="add_to_cart" class="btn">Add to Cart</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
<?php
else:
    echo "<p class='error-message'>Product not found.</p>";
endif;

$stmt->close();
$conn->close();
include '../includes/footer.php';
?>
