<?php
$order = $orderDetails[0]; // Main order details
?>
    <link rel="stylesheet" href="./inc/css/adminDash.css">

<div class="container order-details-container">
    <h1>Order Details</h1>

    <div class="order-info">
        <h2>Order #<?php echo htmlspecialchars($order['order_id']); ?></h2>
        <p>Date: <?php echo date('F j, Y, g:i a', strtotime($order['created_at'])); ?></p>
        <p>Status: <?php echo htmlspecialchars(ucfirst($order['status'])); ?></p>
    </div>

    <div class="customer-info">
        <h3>Customer Information</h3>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($order['name'] . ' ' . $order['lastname']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
        <p><strong>Delivery Address:</strong> <?php echo htmlspecialchars($order['location']); ?></p>
    </div>

    <div class="order-items">
        <h3>Order Items</h3>
        <table class="order-items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderDetails as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>$<?php echo number_format($item['product_price'], 2); ?></td>
                        <td>$<?php echo number_format($item['quantity'] * $item['product_price'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>$<?php echo number_format($order['total_price'], 2); ?></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="order-actions">
        <a href="index.php?page=astronomy" class="add-to-cart">Continue stargazing</a>
    </div>
</div>
