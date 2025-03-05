<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Heckers Gardens</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            background-color: #28a745;
            padding: 10px 20px;
            display: flex;
            align-items: center; /* Aligns logo and title vertically */
            justify-content: flex-start; /* Aligns them to the left */
        }

        .logo img {
            width: 90px; /* Adjust size of logo */
            height: 90px;
            object-fit: contain;
            margin-right: 15px; /* Adds space between logo and title */
        }

        h1 {
            font-size: 2rem; /* Adjust title size */
            margin: 0;
            color: white;
        }

        /* Navigation Menu */
        nav {
            background-color: #343a40;
            padding: 10px 0;
        }

        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin: 0 15px;
        }

        nav ul li a {
            color: white;
            text-decoration: none;
            font-size: 1.2rem;
        }

        nav ul li a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<header>
    <div class="logo">
        <img src="../assets/images/Heckers_logo.png" alt="Heckers Garden Centre Logo">
    </div>
    <h1>Heckers Gardens</h1>
</header>

<nav>
<?php session_start(); ?>
<ul>
    <li><a href="/index.php">Home</a></li>
    <li><a href="/views/products.php">Products</a></li>
    <li><a href="/views/events.php">Events</a></li>

    <?php if (isset($_SESSION['user_id'])): ?>
        <li><a href="/views/cart.php">Cart</a></li>
        <li><a href="/views/logout.php">Logout</a></li>
    <?php else: ?>
        <li><a href="/views/login.php">Login</a></li>
    <?php endif; ?>
</ul>
</nav>
