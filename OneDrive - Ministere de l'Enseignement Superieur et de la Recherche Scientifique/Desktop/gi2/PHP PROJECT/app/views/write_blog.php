<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Write Your Blog</title>
    <link rel="stylesheet" href="./inc/css/adminDash.css">
    <style>
        .write-blog-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background: rgba(15, 15, 15, 0.8);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }
        .write-blog-form {
            display: flex;
            flex-direction: column;
        }
        .write-blog-form input, 
        .write-blog-form textarea {
            margin-bottom: 20px;
            padding: 10px;
            background: rgba(30, 30, 30, 0.9);
            border: 1px solid #ffcc00;
            color: white;
            border-radius: 5px;
        }
        .write-blog-form textarea {
            min-height: 300px;
            resize: vertical;
        }
        .publish-btn {
            background-color: #ffcc00;
            color: black;
            border: none;
            padding: 15px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .publish-btn:hover {
            background-color: #ffd633;
            box-shadow: 0 5px 15px rgba(255, 204, 0, 0.4);
        }
    </style>
</head>
<body>
    <div class="write-blog-container">
        <h1>Write Your Blog</h1>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <form action="index.php?page=create_blog" method="POST" class="write-blog-form">
            <input type="text" name="title" placeholder="Blog Title" required>
            <textarea name="content" placeholder="Write your blog content here..." required></textarea>
            <div class="form-actions">
                <button type="submit" class="add-to-cart">Submit Blog</button>
                <a href="index.php?page=blogs" class="add-to-cart" style="background-color: red;">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
