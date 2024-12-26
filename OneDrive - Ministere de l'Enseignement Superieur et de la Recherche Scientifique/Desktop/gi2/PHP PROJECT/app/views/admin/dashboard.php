<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../inc/css/adminDash.css">
</head>
<body>
    <div class="admin-container">
        <h1>Admin Dashboard</h1>
        
        <div class="admin-dashboard-stats">
            <div class="stat-card">
                <h3>Total Users</h3>
                <div class="stat-number"><?php echo $data['userCount']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Pending Blogs</h3>
                <div class="stat-number"><?php echo $data['pendingBlogs']; ?></div>
            </div>
            <div class="stat-card">
                <h3>Orders details</h3>
                <div class="stat-number"><?php echo $data['pendingOrders']; ?></div>
            </div>
        </div>

        <div class="admin-navigation">
            <a href="index.php?page=admin/users" class="add-to-cart">Manage Users</a>
            <a href="index.php?page=admin/blogs" class="add-to-cart">Manage Blogs</a>
            <a href="index.php?page=admin/orders" class="add-to-cart">Manage Orders</a>
            <a href="index.php?page=admin/feedbacks" class="add-to-cart">Manage Feedbacks</a>
            <a href="index.php?page=admin/logout" class="add-to-cart" style="background-color: red;">Logout</a>
        </div>
    </div>
</body>
</html>
