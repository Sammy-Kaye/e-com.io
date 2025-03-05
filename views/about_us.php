<?php 
// Start the session at the beginning
session_start();

include '../includes/header.php'; // Include the header
include_once '../database/db_connect.php'; // Database connection
?>

<div class="container">
    <h1>About Us</h1>
    <p>
        Welcome to Heckers Garden Centre, where passion for gardening meets exceptional customer service! 
        Since our establishment in 1985, we've been dedicated to inspiring gardeners of all skill levels, 
        providing high-quality plants, tools, and expert advice.
    </p>
    <p>
        <strong>Our Mission:</strong> To nurture the love of gardening in our community by offering a wide range 
        of top-notch gardening products, hosting educational events, and promoting sustainable practices.
    </p>
    <p>
        <strong>Our Values:</strong>
        <ul>
            <li><strong>Quality:</strong> We provide the best plants and gardening supplies to ensure our customers' success.</li>
            <li><strong>Community:</strong> We believe in fostering a connection with nature and people through gardening.</li>
            <li><strong>Sustainability:</strong> We are committed to eco-friendly practices for a greener future.</li>
        </ul>
    </p>
    <p>
        Thank you for choosing Heckers Garden Centre. We look forward to growing with you!
    </p>
</div>

<style>
    .container h1 {
        color: var(--primary-dark);
        margin-bottom: 20px;
    }
    
    .container p {
        margin: 10px 0;
        line-height: 1.6;
    }
    
    .container ul {
        margin-left: 20px;
    }
    
    .container li {
        margin-bottom: 10px;
    }
</style>

<?php include '../includes/footer.php'; // Include the footer ?>