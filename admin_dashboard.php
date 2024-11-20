<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: sign_in.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'update_order') {
    $id = $_POST['id'];
    $address = $_POST['address'];

    $stmt = $pdo->prepare("UPDATE orders SET address = ? WHERE id = ?");
    $stmt->execute([$address, $id]);

    header("Location: admin_dashboard.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'delete_order') {
    $id = $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM orders WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: admin_dashboard.php");
    exit;
}

$productSearch = isset($_GET['product_search']) ? $_GET['product_search'] : '';
$productQuery = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ?";
$stmt = $pdo->prepare($productQuery);
$stmt->execute(['%' . $productSearch . '%', '%' . $productSearch . '%']);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

$userSearch = isset($_GET['user_search']) ? $_GET['user_search'] : '';
$userQuery = "SELECT * FROM users WHERE name LIKE ? OR email LIKE ?";
$stmt = $pdo->prepare($userQuery);
$stmt->execute(['%' . $userSearch . '%', '%' . $userSearch . '%']);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$orderSearch = isset($_GET['order_search']) ? $_GET['order_search'] : '';
$orderQuery = "SELECT orders.id, orders.user_id, orders.total_price, orders.created_at, orders.full_name, orders.address, users.name AS user_name FROM orders JOIN users ON orders.user_id = users.id WHERE orders.full_name LIKE ? OR orders.address LIKE ?";
$stmt = $pdo->prepare($orderQuery);
$stmt->execute(['%' . $orderSearch . '%', '%' . $orderSearch . '%']);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>

    <header>
        <h1>Admin Dashboard</h1>
        <p>Welcome, Admin</p>
    </header>

    <main>
        <section>
            <h2>Add Product</h2>
            <form action="admin_dashboard.php" method="POST">
                <input type="hidden" name="action" value="add">
                <input type="text" name="name" placeholder="Product Name" required>
                <input type="text" name="description" placeholder="Description" required>
                <input type="number" name="price" placeholder="Price" step="0.01" required>
                <input type="number" name="stock" placeholder="Stock" required>
                <button type="submit">Add Product</button>
            </form>
        </section>

        <section>
            <h2>Manage Products</h2>
            <form method="GET" action="admin_dashboard.php">
                <input type="text" name="product_search" placeholder="Search Products" value="<?= htmlspecialchars($productSearch) ?>">
                <button type="submit">Search</button>
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td><?= htmlspecialchars($product['description']) ?></td>
                        <td>RM <?= number_format($product['price'], 2) ?></td>
                        <td><?= $product['stock'] ?></td>
                        <td>
                            <form action="admin_dashboard.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                                <input type="number" name="price" value="<?= number_format($product['price'], 2) ?>" required>
                                <input type="number" name="stock" value="<?= $product['stock'] ?>" required>
                                <button type="submit">Update</button>
                            </form>
                            
                            <form action="admin_dashboard.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <section>
            <h2>Manage Users</h2>
            <form method="GET" action="admin_dashboard.php">
                <input type="text" name="user_search" placeholder="Search Users" value="<?= htmlspecialchars($userSearch) ?>">
                <button type="submit">Search</button>
            </form>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['role']) ?></td>
                        <td>
                            <form action="admin_dashboard.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="update_user">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <select name="role">
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                                    <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
                                </select>
                                <button type="submit">Update</button>
                            </form>
                            
                            <form action="admin_dashboard.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete_user">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <section>
            <h2>Manage Orders</h2>
            <form method="GET" action="admin_dashboard.php">
                <input type="text" name="order_search" placeholder="Search Orders" value="<?= htmlspecialchars($orderSearch) ?>">
                <button type="submit">Search</button>
            </form>
            <table>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= $order['id'] ?></td>
                        <td><?= $order['user_id'] ?></td>
                        <td><?= htmlspecialchars($order['full_name']) ?></td>
                        <td><?= htmlspecialchars($order['address']) ?></td>
                        <td>RM <?= number_format($order['total_price'], 2) ?></td>
                        <td><?= $order['created_at'] ?></td>
                        <td>
                            <form action="admin_dashboard.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="update_order">
                                <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                <input type="text" name="address" value="<?= htmlspecialchars($order['address']) ?>" required>
                                <button type="submit">Update</button>
                            </form>
                            
                            <form action="admin_dashboard.php" method="POST" style="display:inline;">
                                <input type="hidden" name="action" value="delete_order">
                                <input type="hidden" name="id" value="<?= $order['id'] ?>">
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this order?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </section>

        <section>
            <a href="homepage.php"><button>Back to Homepage</button></a>
        </section>

    </main>

</body>
</html>
