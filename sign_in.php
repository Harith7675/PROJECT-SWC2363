<?php
session_start();
include 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link rel="stylesheet" href="sign_in.css">
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
        <div class="sign-in-container">
            <h1>Sign In</h1>

            <?php if (isset($_SESSION['login_error'])): ?>
                <p class="error-message"><?php echo $_SESSION['login_error']; ?></p>
                <?php unset($_SESSION['login_error']); ?>
            <?php endif; ?>

            <form action="process_sign_in.php" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="sign-in-btn">Sign In</button>
            </form>
            <p>Don't have an account? <a href="sign_up.php">Sign Up</a></p>
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
