<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Blogs</title>
    <link rel="stylesheet" href="../inc/css/adminDash.css">
</head>
<body>
<div class="admin-container">
    <h1>Manage Blogs</h1>

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

    <?php if (empty($blogs)): ?>
        <div class="no-blogs">
            <p>No blogs found.</p>
        </div>
    <?php else: ?>
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Blog ID</th>
                    <th>Username</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($blogs as $blog): ?>
                <tr>
                    <td><?php echo htmlspecialchars($blog['blog_id']); ?></td>
                    <td><?php echo htmlspecialchars($blog['username']); ?></td>
                    <td><?php echo htmlspecialchars($blog['title']); ?></td>
                    <td>
                        <span class="order-status <?php echo strtolower($blog['status']); ?>">
                            <?php echo htmlspecialchars(ucfirst($blog['status'])); ?>
                        </span>
                    </td>
                    <td>
                        <a href="index.php?page=blog_details&blogId=<?php echo $blog['blog_id']; ?>" 
                           class="role-button">Details</a>
                        
                        <?php if ($blog['status'] === 'pending'): ?>
                            <a href="index.php?page=approve_blog&blogId=<?php echo $blog['blog_id']; ?>" 
                               class="role-button approve-btn">Approve</a>
                            <a href="index.php?page=reject_blog&blogId=<?php echo $blog['blog_id']; ?>" 
                               class="role-button reject-btn">Reject</a>
                        <?php elseif ($blog['status'] === 'approved' || $blog['status'] === 'rejected'): ?>
                            <a href="index.php?page=delete_blog&blogId=<?php echo $blog['blog_id']; ?>" 
                               class="role-button delete-btn" 
                               onclick="return confirm('Are you sure you want to delete this blog?');">Delete</a>
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
