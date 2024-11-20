<?php
session_start();
include 'db.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GS Sports</title>
    <link rel="stylesheet" href="homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <header class="navbar">
        <div class="navbar-logo">
            <a href="homepage.php">
                <img src="logo.png" alt="Store Logo">
            </a>
        </div>
        <div class="navbar-right">
            <div class="profile">
                <a href="sign_in.php">
                    <img src="user.png" alt="Profile">
                </a>
            </div>

        </div>
    </header>

    <main>
        <div class="banner">
            <img src="banner.png" alt="Banner Image" class="banner-img">
        </div>

        <section class="product-grid">
            <div class="product-card">
                <img src="nike-dunk-panda.png" alt="Nike Dunk Panda" class="product-img">
                <p class="product-name">Nike Dunk "Panda"</p>
                <p class="product-size">Size UK 7</p>
                <p class="product-price">RM 359</p>
                <a href="checkout.php" class="btn"><i class="fas fa-shopping-bag"></i> Buy</a>
            </div>

            <div class="product-card">
                <img src="adidas-samba.png" alt="Adidas Samba" class="product-img">
                <p class="product-name">Adidas Samba</p>
                <p class="product-size">Size UK 7.5</p>
                <p class="product-price">RM 512</p>
                <a href="checkout.php" class="btn"><i class="fas fa-shopping-bag"></i> Buy</a>
            </div>

            <div class="product-card">
                <img src="new-balance-530.png" alt="New Balance 530" class="product-img">
                <p class="product-name">New Balance 530</p>
                <p class="product-size">Size UK 7.5</p>
                <p class="product-price">RM 449</p>
                <a href="checkout.php" class="btn"><i class="fas fa-shopping-bag"></i> Buy</a>
            </div>

            <div class="product-card">
                <img src="jordan-air-1.png" alt="Jordan Air 1" class="product-img">
                <p class="product-name">Jordan Air 1</p>
                <p class="product-size">Size UK 8</p>
                <p class="product-price">RM 422</p>
                <a href="checkout.php" class="btn"><i class="fas fa-shopping-bag"></i> Buy</a>
            </div>
        </section>
    </main>

    <section class="about-us">
        <h2>About Us</h2>
        <p>Welcome to GS Sports! We are dedicated to providing high-quality, 
            stylish sneakers and sports apparel at affordable prices. Our passion 
            for sports and fashion drives us to deliver the best products to our customers. 
            Whether you're a sneaker enthusiast or just looking for comfortable sportswear, 
            we have something for everyone. Join us on our journey and step up your style game with GS Sports!</p>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <p>Copyright © 2024 GS Sport</p>
            <p>Follow us on:</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/profile.php?id=61568098847308"><img src="facebook logo black white.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/gs.sports_official"><img src="instagram logo black white.png" alt="Instagram"></a>
            </div>
        </div>
    </footer>

</body>
</html>
