<?php 
include '../includes/header.php'; // Include the header
include_once '../database/db_connect.php'; // Database connection
?>

<div class="container">
    <h1>Contact Us</h1>

    <h2>Our Location</h2>
    <p>1 Kirschner Rd, Westwood AH, Boksburg, 1459</p>
    <iframe 
        class="map"
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3583.6526448305956!2d28.228158015027165!3d-26.227297566697814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1e956f91c20ad6cf%3A0xab9ab08e5b15a57a!2s1%20Kirschner%20Rd%2C%20Westwood%20AH%2C%20Boksburg%2C%201459!5e0!3m2!1sen!2sza!4v1690300368707!5m2!1sen!2sza" 
        allowfullscreen 
        loading="lazy">
    </iframe>

    <h2>Contact Form</h2>
    <form action="index.php" method="POST">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" placeholder="Enter your name" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="message">Your Message:</label>
        <textarea id="message" name="message" rows="5" placeholder="Write your message here" required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

<style>
    .container h1 {
        color: var(--primary-dark);
        margin-bottom: 20px;
    }
    
    h2 {
        margin-top: 20px;
        color: var(--primary);
    }
    
    .map {
        margin-top: 20px;
        border: 0;
        width: 100%;
        height: 300px;
        border-radius: 5px;
    }
    
    form {
        display: flex;
        flex-direction: column;
        margin-top: 20px;
    }
    
    label {
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    input, textarea {
        margin-bottom: 15px;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }
    
    button {
        background-color: var(--primary);
        color: white;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }
    
    button:hover {
        background-color: var(--primary-dark);
    }
</style>

<?php include '../includes/footer.php'; // Include the footer ?>
