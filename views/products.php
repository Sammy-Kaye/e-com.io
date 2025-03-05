<?php 
// Start the session at the beginning
session_start();

include '../includes/header.php'; // Include the header
include_once '../database/db_connect.php'; // Database connection
?>

<?php
// Fetch categories from the database
$category_query = "SELECT category_id, name FROM categories";
$category_result = $conn->query($category_query);

// Initialize category and price filters
$category_filter = isset($_GET['category']) ? $_GET['category'] : '';
$price_filter = isset($_GET['price']) ? $_GET['price'] : '';
$search_query = isset($_GET['search']) ? $_GET['search'] : '';

// Build SQL query dynamically based on filters
$sql = "SELECT p.product_id, p.name, p.description, p.price, p.stock, d.image_url 
        FROM products p 
        LEFT JOIN product_description d ON p.product_id = d.product_id";

$filters = [];

if ($category_filter) {
    $filters[] = "p.category_id = '" . $conn->real_escape_string($category_filter) . "'";
}

if ($price_filter) {
    if ($price_filter == 'low') {
        $filters[] = "p.price < 500";
    } elseif ($price_filter == 'medium') {
        $filters[] = "p.price BETWEEN 500 AND 1000";
    } elseif ($price_filter == 'high') {
        $filters[] = "p.price > 1000";
    }
}

if ($search_query) {
    $filters[] = "(p.name LIKE '%" . $conn->real_escape_string($search_query) . "%' OR p.description LIKE '%" . $conn->real_escape_string($search_query) . "%')";
}

if (count($filters) > 0) {
    $sql .= " WHERE " . implode(' AND ', $filters);
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Products</title>
    <link rel="stylesheet" href="../assets/css/products.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .filter-box {
            background-color: #f9f9f9;
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        
        .filter-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }
        
        .search-section {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .search-section label {
            font-weight: 600;
            font-size: 1rem;
            color: #333;
        }
        
        .search-input-group {
            display: flex;
            width: 100%;
        }
        
        .search-input-group input {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
            font-size: 1rem;
        }
        
        .search-input-group button {
            background-color: #ff8f00;
            color: white;
            border: none;
            padding: 0 1.25rem;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .search-input-group button:hover {
            background-color: #e68200;
        }
        
        .filter-section {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .filter-section label {
            font-weight: 600;
            font-size: 1rem;
            color: #333;
        }
        
        .filter-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            align-items: center;
        }
        
        .filter-group {
            flex: 1;
            min-width: 200px;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .filter-group select {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            background-color: white;
        }
        
        .filter-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 1rem;
        }
        
        .btn {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        
        .btn:hover {
            background-color: #276829;
        }
        
        @media (max-width: 768px) {
            .filter-row {
                flex-direction: column;
                align-items: stretch;
            }
            
            .filter-group {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <main>
        <section class="page-header">
            <h1>Browse Our Products</h1>
            <p>Find the perfect items for your gardening needs 🌿</p>
        </section>

        <!-- Filter Box -->
        <div class="filter-box container">
            <form method="GET" action="products.php" class="filter-container">
                <!-- Search Section -->
                <div class="search-section">
                    <label for="search">Search:</label>
                    <div class="search-input-group">
                        <input type="text" id="search" name="search" placeholder="Search products..." value="<?php echo htmlspecialchars($search_query); ?>">
                        <button type="submit" aria-label="Search"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                
                <!-- Filter Section -->
                <div class="filter-section">
                    <div class="filter-row">
                        <div class="filter-group">
                            <label for="category">Category:</label>
                            <select name="category" id="category">
                                <option value="">All</option>
                                <?php if ($category_result->num_rows > 0): ?>
                                    <?php while ($row = $category_result->fetch_assoc()): ?>
                                        <option value="<?php echo $row['category_id']; ?>" <?php echo $category_filter == $row['category_id'] ? 'selected' : ''; ?>>
                                            <?php echo $row['name']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="filter-group">
                            <label for="price">Price:</label>
                            <select name="price" id="price">
                                <option value="">All</option>
                                <option value="low" <?php echo $price_filter === 'low' ? 'selected' : ''; ?>>Low (Under R500)</option>
                                <option value="medium" <?php echo $price_filter === 'medium' ? 'selected' : ''; ?>>Medium (R500-R1000)</option>
                                <option value="high" <?php echo $price_filter === 'high' ? 'selected' : ''; ?>>High (Over R1000)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="filter-actions">
                        <button type="submit" class="btn">Apply Filters</button>
                    </div>
                </div>
            </form>
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
                        <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="product_details.php?product_id=<?php echo $row['product_id']; ?>" class="btn view-details">View Details</a>
                        <?php else: ?>
                        <a href="login.php" class="btn view-details">Login to View Details</a>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No products match your filters.</p>
            <?php endif; ?>

            <?php $conn->close(); ?>
        </div>
    </main>

    <?php include '../includes/footer.php'; // Include the footer ?>
</body>
</html>
