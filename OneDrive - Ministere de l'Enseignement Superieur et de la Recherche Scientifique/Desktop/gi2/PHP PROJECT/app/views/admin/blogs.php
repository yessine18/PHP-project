<?php
require_once 'app/controllers/AdminController.php';
$adminController = new AdminController();
$blogs = $adminController->getAllBlogs();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Blog Management</title>
    <link rel="stylesheet" href="../inc/css/adminDash.css">
</head>
<body>
    <div class="admin-container">
        <h1>Blog Management</h1>
        
        <?php if (isset($_GET['success'])): ?>
            <div style="color: green; margin-bottom: 10px;"><?php echo htmlspecialchars($_GET['success']); ?></div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div style="color: red; margin-bottom: 10px;"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>
        
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Blog ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td><?php echo htmlspecialchars($blog['blog_id']); ?></td>
                    <td><?php echo htmlspecialchars($blog['title']); ?></td>
                    <td><?php echo htmlspecialchars($blog['username']); ?></td>
                    <td><?php echo htmlspecialchars($blog['status']); ?></td>
                    <td><?php echo htmlspecialchars($blog['created_at']); ?></td>
                    <td>
                        <a href="index.php?page=admin/blog-details&blogId=<?php echo $blog['blog_id']; ?>" 
                           class="add-to-cart">Details</a>
                        <?php if ($blog['status'] === 'pending'): ?>
                            <a href="index.php?page=approve_blog&blogId=<?php echo $blog['blog_id']; ?>" 
                               class="add-to-cart">Approve</a>
                            <a href="index.php?page=reject_blog&blogId=<?php echo $blog['blog_id']; ?>" 
                               class="add-to-cart" style="background-color: red;">Reject</a>
                        <?php elseif ($blog['status'] === 'approved' || $blog['status'] === 'rejected'): ?>
                            <a href="index.php?page=delete_blog&blogId=<?php echo $blog['blog_id']; ?>" 
                               class="add-to-cart" style="background-color: red;" 
                               onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="role-buttons" style="margin-top: 20px;">
            <a href="index.php?page=admin/dashboard" class="add-to-cart">Back to Dashboard</a>
        </div>
    </div>
</body>
</html>
