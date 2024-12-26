<link rel="stylesheet" href="./inc/css/adminDash.css">

<div class="container order-container">
    <h1>Place Your Order</h1>

    <?php 
    // Display any error messages
    if (isset($_GET['error'])) {
        echo '<div class="alert alert-danger">' . htmlspecialchars($_GET['error']) . '</div>';
    }
    ?>

    <div class="order-summary">
        <h2>Order Summary</h2>
        <p>Total Amount: $<?php echo number_format($cartTotal, 2); ?></p>
    </div>

    <form action="index.php?page=confirm-order" method="POST" class="order-form">
        <div class="form-group">
            <label for="name">First Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="lastname">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>

        <div class="form-group">
            <label for="phone">Phone Number</label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="location">Delivery Address</label>
            <textarea class="form-control" id="location" name="location" required></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="add-to-cart">Confirm Order</button>
            <a href="index.php?page=cart" class="add-to-cart" style="background-color: red;">Cancel</a>
        </div>
    </form>
</div>
