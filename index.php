<?php
// Start the session at the very beginning
session_start();

// Include the header file
include 'includes/indexheader.php';
?>
<?php
if (isset($_SESSION['welcome_message'])) {
    echo "<script>alert('" . $_SESSION['welcome_message'] . "');</script>";
    unset($_SESSION['welcome_message']); // Clear the message after showing it
}
?>

<?php
include 'database/db_connect.php';

// Fetch the first 4 products from the database
$sql = "SELECT p.product_id, p.name, p.description, p.price, d.image_url 
        FROM products p
        LEFT JOIN product_description d ON p.product_id = d.product_id
        LIMIT 4";  // Limit to the first 4 products
$result = $conn->query($sql);
?>

<main>
    <link rel="stylesheet" href="../assets/css/index.css">
    
    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Welcome to Heckers Garden Centre 🌱</h1>
            <p>Your one-stop shop for all your gardening needs! Discover our premium plants, tools, and expert advice.</p>
            <div class="hero-buttons">
                <a href="views/products.php" class="btn hero-btn">Shop Now</a>
                <a href="views/events.php" class="btn hero-btn">Upcoming Events</a>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="featured-products">
        <div class="container">
            <div class="section-header">
                <h2>Featured Products</h2>
                <p class="section-description">Explore our handpicked selection of premium garden products that will transform your outdoor space.</p>
            </div>
            <div class="product-grid">
                <?php while ($product = $result->fetch_assoc()) : ?>
                    <div class="product-card">
                        <div class="product-image-container">
                            <?php if (!empty($product['image_url'])) : ?>
                                <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                            <?php else : ?>
                                <img src="assets/images/product-placeholder.jpg" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-image">
                            <?php endif; ?>
                        </div>
                        <div class="product-content">
                            <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                            <p><?php echo htmlspecialchars($product['description']); ?></p>
                            <div class="product-price">R<?php echo number_format($product['price'], 2); ?></div>
                            <a href="views/product_details.php?product_id=<?php echo $product['product_id']; ?>" class="btn hero-btn">View Details</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Transform Your Garden Today</h2>
                <p>Join our community of garden enthusiasts and get expert advice, special offers, and exclusive access to our events.</p>
                <div class="cta-buttons">
                    <a href="views/signup.php" class="btn hero-btn">Sign Up Now</a>
                    <a href="views/contact.php" class="btn hero-btn">Contact Us</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-leaf feature-icon"></i>
                    <h3>Quality Plants</h3>
                    <p>We source the healthiest plants from trusted growers to ensure your garden thrives.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-truck feature-icon"></i>
                    <h3>Fast Delivery</h3>
                    <p>Get your garden supplies delivered right to your doorstep with our efficient delivery service.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-tools feature-icon"></i>
                    <h3>Expert Advice</h3>
                    <p>Our team of garden experts is always ready to help you with personalized gardening tips.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-calendar-alt feature-icon"></i>
                    <h3>Regular Events</h3>
                    <p>Join our workshops and gardening events to enhance your gardening skills.</p>
                </div>
            </div>
        </div>
    </section>
</main>

<style>
 /* Hero Section */
.hero {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
    background: #343a40;
    background-size: cover;
    padding: 5rem 0;
    color: white;
}

.hero h1 {
    font-size: 3rem;
    font-weight: bold;
}

.hero p {
    font-size: 1.25rem;
    margin-top: 1rem;
}

.hero-buttons {
    color:  #28a745;
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1.5rem;
}

.hero-buttons .btn {
    padding: 0.75rem 1.5rem;
}

.hero-buttons .btn:hover {
    opacity: 0.9;
}

/* CTA Section */
.cta-section {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
    background-color: #343a40;
    padding: 4rem 0;
}

.cta-content h2 {
    font-size: 2.5rem;
    color: #2e7d32;
    margin-bottom: 1rem;
}

.cta-buttons {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1.5rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .hero-buttons, .cta-buttons {
        flex-direction: column;
        align-items: center;
    }

    .hero-buttons .btn, .cta-buttons .btn {
        width: 80%;
        margin-top: 1rem;
    }
}

/* Features Section */
.features {
        background-color: #f3f3f3;
        padding: 4rem 0;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 2rem;
    }

    .feature-card {
        background-color: white;
        padding: 2rem;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
    }

    .feature-icon {
        font-size: 2.5rem;
        color: #2e7d32;
        margin-bottom: 1rem;
    }

    .feature-card h3 {
        margin-bottom: 1rem;
        color: #2e7d32;
    }

    @media (max-width: 768px) {
        .hero-buttons {
            flex-direction: column;
            align-items: center;
        }

        .hero-buttons .btn {
            width: 80%;
        }
    }
</style>

<?php
include 'includes/footer.php';
?>
