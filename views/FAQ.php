<?php 
// Start the session at the beginning
session_start();

include '../includes/header.php'; // Include the header
include_once '../database/db_connect.php'; // Database connection
?>

<div class="container">
    <h1>Frequently Asked Questions (FAQ)</h1>
    
    <div class="faq-item">
        <h3>1. What are your opening hours?</h3>
        <p>We are open Monday to Saturday from 8:00 AM to 6:00 PM, and on Sunday from 9:00 AM to 5:00 PM.</p>
    </div>

    <div class="faq-item">
        <h3>2. Do you offer home delivery?</h3>
        <p>Yes, we offer home delivery for orders above R500 within a 30-mile radius. Delivery charges may apply.</p>
    </div>

    <div class="faq-item">
        <h3>3. Can I return or exchange a plant?</h3>
        <p>Yes, we have a 14-day return policy for plants, provided they are in their original condition and accompanied by a receipt.</p>
    </div>

    <div class="faq-item">
        <h3>4. Do you provide gardening advice?</h3>
        <p>Absolutely! Our experts are available in-store to answer your questions. You can also find resources on our website or attend our gardening workshops.</p>
    </div>

    <div class="faq-item">
        <h3>5. How do I sign up for events?</h3>
        <p>You can sign up for events through the <a href="views/events.php">Events page</a>. Simply click on the event you’re interested in and register online.</p>
    </div>

    <div class="faq-item">
        <h3>6. Do you sell gift cards?</h3>
        <p>Yes, gift cards are available for purchase in-store and online. They make a great gift for gardening enthusiasts!</p>
    </div>

    <div class="faq-item">
        <h3>7. Can I create an account to save my purchases?</h3>
        <p>Yes, you can create an account on our website to track your purchases, manage orders, and receive personalized offers.</p>
    </div>

</div>

<style>
    .faq-item {
        margin-bottom: 20px;
    }

    .faq-item h3 {
        color: var(--primary-dark);
        margin: 0;
    }

    .faq-item p {
        margin: 5px 0 0;
        line-height: 1.6;
    }
</style>

<?php include '../includes/footer.php'; // Include the footer ?>