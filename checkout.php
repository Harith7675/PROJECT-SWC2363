<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: sign_in.php');
    exit;
}

$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
</head>
<body>

    <header class="navbar">
        <div class="navbar-logo">
            <a href="homepage.php">
                <img src="logo.png" alt="Store Logo">
            </a>
        </div>
    </header>

    <main>
        <h1>Checkout</h1>
        <section class="checkout-form">
            <form action="process_checkout.php" method="POST">
                <h2>Shipping Details</h2>
                <div class="form-group">
                    <label for="full-name">Full Name:</label>
                    <input type="text" id="full-name" name="full-name" required>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" required>
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" required>
                </div>
                <div class="form-group">
                    <label for="postal-code">Postal Code:</label>
                    <input type="text" id="postal-code" name="postal-code" required>
                </div>
                <div class="form-group">
                    <label for="country">Country:</label>
                    <input type="text" id="country" name="country" required>
                </div>

                <h2>Payment Details</h2>
                <div class="form-group">
                    <label for="card-number">Card Number:</label>
                    <input type="text" id="card-number" name="card-number" required>
                </div>
                <div class="form-group">
                    <label for="expiry-date">Expiry Date:</label>
                    <input type="text" id="expiry-date" name="expiry-date" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" required>
                </div>

                <button type="submit" class="checkout-btn">Complete Purchase</button>
            </form>
        </section>
    </main>

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
