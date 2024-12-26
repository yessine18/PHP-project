<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Blog Management</title>
    <link rel="stylesheet" href="../inc/css/adminDash.css">
</head>
<body>
<div class="admin-container">
    <h1>Manage Orders</h1>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <div class="no-orders">
            <p>No orders found.</p>
        </div>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Username</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?php echo htmlspecialchars($order['order_id']); ?></td>
                    <td><?php echo htmlspecialchars($order['username']); ?></td>
                    <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                    <td>
                        <span class="order-status <?php echo strtolower($order['status']); ?>">
                            <?php echo htmlspecialchars(ucfirst($order['status'])); ?>
                        </span>
                    </td>
                    <td><?php echo date('Y-m-d H:i', strtotime($order['created_at'])); ?></td>
                    <td>
                        <a href="index.php?page=details&orderId=<?php echo $order['order_id']; ?>" 
                           class="role-button">View Details</a>
                        <?php if ($order['status'] === 'pending'): ?>
                        <a href="index.php?page=markOrderShipped&orderId=<?php echo $order['order_id']; ?>" 
                           class="role-button role-button-shipped" 
                           onclick="return confirm('Are you sure you want to mark this order as shipped?');">Shipped</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <div class="admin-navigation">
        <a href="index.php?page=admin/dashboard">Back to Dashboard</a>
    </div>
</div>
</body>
</html>
