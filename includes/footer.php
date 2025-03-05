<footer>
    <div class="container">
        <div class="footer-container">
            <div class="footer-section">
                <h3>About Heckers Gardens</h3>
                <p>We are a family-owned garden center dedicated to providing high-quality plants, tools, and expert advice to help your garden thrive.</p>
                <p>Serving the community since 1985.</p>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="../index.php">Home</a></li>
                    <li><a href="../views/products.php">Products</a></li>
                    <li><a href="../views/events.php">Events</a></li>
                    <li><a href="../views/about_us.php">About Us</a></li>
                    <li><a href="../views/FAQ.php">FAQ</a></li>
                    <li><a href="../views/contact.php">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p><i class="fas fa-map-marker-alt"></i> 123 Garden Street, Pretoria</p>
                <p><i class="fas fa-phone"></i> (012) 345-6789</p>
                <p><i class="fas fa-envelope"></i> info@heckersgardens.com</p>
            </div>
            
            <div class="footer-section">
                <h3>Connect With Us</h3>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-pinterest"></i></a>
                </div>
                <p>Subscribe to our newsletter for updates and special offers!</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email address">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; <?php echo date("Y"); ?> Heckers Garden Centre. All Rights Reserved.</p>
        </div>
    </div>
    
    <style>
        footer {
            background-color: #111111;
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: 3rem;
        }
        
        .footer-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .footer-section h3 {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 1.2rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .footer-section h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background-color: #2e7d32;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 0.5rem;
        }
        
        .footer-links a {
            color: #b0bec5;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-links a:hover {
            color: #2e7d32;
        }
        
        .footer-section p {
            color: #b0bec5;
            margin-bottom: 0.8rem;
        }
        
        .footer-section i {
            margin-right: 0.5rem;
            color: #2e7d32;
        }
        
        .social-icons {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }
        
        .social-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color:#343a40 ;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-icon:hover {
            background-color: #2e7d32;
            transform: translateY(-3px);
        }
        
        .newsletter-form {
            display: flex;
            margin-top: 1rem;
        }
        
        .newsletter-form input {
            flex-grow: 1;
            padding: 0.5rem;
            border: none;
            border-radius: 4px 0 0 4px;
            outline: none;
        }
        
        .newsletter-form button {
            padding: 0.5rem 1rem;
            background-color: #2e7d32;
            color: white;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .newsletter-form button:hover {
            background-color: #60ad5e;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 1.5rem;
            border-top: 1px solid #343a40);
            color: #b0bec5;
            font-size: 0.9rem;
        }
        
        @media (max-width: 768px) {
            .footer-container {
                grid-template-columns: 1fr;
                text-align: center;
            }
            
            .footer-section h3::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .social-icons {
                justify-content: center;
            }
            
            .newsletter-form {
                max-width: 300px;
                margin: 1rem auto 0;
            }
        }
    </style>
</footer>
