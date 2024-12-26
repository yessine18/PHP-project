
<link rel="stylesheet" href="./inc/css/adminDash.css">

<div class="container cart-container">
    <h1>Your Cart</h1>

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

    <?php if (empty($cartItems)): ?>
        <div class="empty-cart">
            <p>Your cart is empty. Continue shopping!</p>
            <a href="index.php?page=products" class="add-to-cart">Browse Products</a>
        </div>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cartItems as $item): ?>
                    <tr>
                        <td>
                            <img src="inc/ressources/<?php echo htmlspecialchars($item['image_url']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" class="products-image">
                            <?php echo htmlspecialchars($item['name']); ?>
                        </td>
                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                        <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                        <td>$<?php echo number_format($item['price'] * $item['quantity'], 2); ?></td>
                        <td>
                            <form action="index.php?page=remove-from-cart" method="POST">
                                <input type="hidden" name="cartId" value="<?php echo $item['cart_id']; ?>">
                                <button type="submit" class="add-to-cart" style="background-color: red;" onclick="return confirm('Are you sure you want to remove this item?');">Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3">Total</td>
                    <td>$<?php echo number_format($cartTotal, 2); ?></td>
                    <td>
                        <form action="index.php?page=place-order" method="POST">
                            <button type="submit" class="add-to-cart">Place Order</button>
                        </form>
                    </td>
                </tr>
            </tfoot>
        </table>
    <?php endif; ?>
</div>
