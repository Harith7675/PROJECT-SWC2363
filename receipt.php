<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: sign_in.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC LIMIT 1");
$stmt->execute([$user_id]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link rel="stylesheet" href="receipt.css">
</head>
<body>
    <header>
        <h1>Receipt</h1>
    </header>
    <main>
        <section class="receipt-details">
            <h2>Order Summary</h2>

            <?php if ($order): ?>
                <p>Order Number: #<?php echo $order['id']; ?></p>
                <p>Date: <?php echo date('F j, Y', strtotime($order['created_at'])); ?></p>

                <h3>Items Purchased:</h3>
                <ul>
                    <?php 
                    $items = json_decode($order['items'], true);
                    foreach ($items as $item): ?>
                        <li><?php echo htmlspecialchars($item['name']); ?> - Quantity: <?php echo htmlspecialchars($item['quantity']); ?> - RM <?php echo number_format($item['price'], 2); ?></li>
                    <?php endforeach; ?>
                </ul>

                <p>Total Amount: RM <?php echo number_format($order['total_price'], 2); ?></p>
                <p>Payment Method: Credit Card</p>
                <p>Billing Address: <?php echo htmlspecialchars($order['address']); ?></p>
            <?php else: ?>
                <p>No order found.</p>
            <?php endif; ?>
        </section>

        <div class="receipt-actions">
            <a href="homepage.php" class="btn">Continue Shopping</a>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <p>Thank you for shopping with GS Sports!</p>
        </div>
    </footer>
</body>
</html>
