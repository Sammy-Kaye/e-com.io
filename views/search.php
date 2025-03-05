<?php 
// Start the session at the beginning
session_start();

include '../includes/header.php'; // Include the header
include_once '../database/db_connect.php'; // Database connection
?>

<?php
// Get search query
$search_query = isset($_GET['query']) ? $_GET['query'] : '';

// Build SQL query for search
$sql = "SELECT p.product_id, p.name, p.description, p.price, p.stock, d.image_url 
        FROM products p 
        LEFT JOIN product_description d ON p.product_id = d.product_id";

if ($search_query) {
    $sql .= " WHERE p.name LIKE '%" . $conn->real_escape_string($search_query) . "%' 
              OR p.description LIKE '%" . $conn->real_escape_string($search_query) . "%'";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="../assets/css/products.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .search-header {
            background-color: #263238;
            color: white;
            padding: 2rem 1rem;
            text-align: center;
        }
        
        .search-form {
            max-width: 600px;
            margin: 2rem auto;
            display: flex;
            position: relative;
        }
        
        .search-form input {
            flex: 1;
            padding: 1rem;
            padding-left: 3rem;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
            font-size: 1rem;
        }
        
        .search-form i.fa-search {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }
        
        .search-form button {
            background-color: #ff8f00;
            color: white;
            border: none;
            padding: 1rem 1.5rem;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .search-form button:hover {
            background-color: #e68200;
        }
        
        .search-results-count {
            text-align: center;
            margin-bottom: 2rem;
            font-size: 1.2rem;
            color: #666;
        }
    </style>
</head>
<body>
    <main>
        <section class="search-header">
            <h1>Search Results</h1>
            <p>Find the perfect items for your gardening needs 🌿</p>
        </section>

        <!-- Search Form -->
        <div class="container">
            <form method="GET" action="search.php" class="search-form">
                <i class="fas fa-search"></i>
                <input type="text" name="query" placeholder="Search products..." value="<?php echo htmlspecialchars($search_query); ?>">
                <button type="submit">Search</button>
            </form>
            
            <div class="search-results-count">
                <?php if ($search_query): ?>
                    <p>Found <?php echo $result->num_rows; ?> results for "<?php echo htmlspecialchars($search_query); ?>"</p>
                <?php else: ?>
                    <p>Enter a search term to find products</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Products Container -->
        <div class="products-container container">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="product-card">
                        <div class="product-info">
                            <h2><?php echo $row['name']; ?></h2>
                            <p class="description"><?php echo substr($row['description'], 0, 100) . '...'; ?></p>
                            <p class="price">R<?php echo number_format($row['price'], 2); ?></p>
                            <p class="stock"><?php echo $row['stock'] > 0 ? "In Stock" : "Out of Stock"; ?></p>
                        </div>
                        <a href="product_details.php?product_id=<?php echo $row['product_id']; ?>" class="btn view-details">View Details</a>
                    </div>
                <?php endwhile; ?>
            <?php elseif ($search_query): ?>
                <p>No products match your search query.</p>
            <?php endif; ?>

            <?php $conn->close(); ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; // Include the footer ?>
</body>
</html>
