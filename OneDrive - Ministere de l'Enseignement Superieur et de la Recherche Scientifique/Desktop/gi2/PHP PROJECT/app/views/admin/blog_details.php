<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Blog Details</title>
    <link rel="stylesheet" href="../inc/css/adminDash.css">
    <style>
        .blog-details-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(15, 15, 15, 0.8);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .blog-details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .blog-details-content {
            background: rgba(30, 30, 30, 0.9);
            padding: 20px;
            border-radius: 5px;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="blog-details-container">
        <div class="blog-details-header">
            <h1><?php echo htmlspecialchars($blog['title']); ?></h1>
            <span class="order-status <?php echo strtolower($blog['status']); ?>">
                <?php echo htmlspecialchars(ucfirst($blog['status'])); ?>
            </span>
        </div>
        
        <div class="blog-details-meta">
            <p>Author: <?php echo htmlspecialchars($blog['username']); ?></p>
            <p>Created at: <?php echo date('Y-m-d H:i', strtotime($blog['created_at'])); ?></p>
        </div>

        <div class="blog-details-content">
            <?php echo htmlspecialchars($blog['content']); ?>
        </div>

        <div class="role-buttons">
            <a href="index.php?page=admin/blogs" class="add-to-cart">Back to Blogs</a>
            <?php if ($blog['status'] === 'pending'): ?>
                <a href="index.php?page=approve_blog&blogId=<?= $blog['blog_id'] ?>" class="add-to-cart">Approve</a>
                <a href="index.php?page=reject_blog&blogId=<?= $blog['blog_id'] ?>" class="add-to-cart" style="background-color: red;">Reject</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
