<?php
include 'db.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="sign_up.css">

    <script>
        window.onload = function() {
            <?php if ($signup_success): ?>
                alert("Thank you for signing up with GS Sports. You can now log in and start exploring our products.");
            <?php endif; ?>
        };
    </script>
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
        <div class="sign-up-container">
            <h1>Create Account</h1>
            <form action="process_sign_up.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="sign-up-btn">Sign Up</button>
            </form>
            <p>Already have an account? <a href="sign_in.php">Sign In</a></p>
        </div>
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
