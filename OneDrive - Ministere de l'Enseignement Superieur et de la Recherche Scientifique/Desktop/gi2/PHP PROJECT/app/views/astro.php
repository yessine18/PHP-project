<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Astronomy Shop</title>
    <link rel="stylesheet" href="./inc/css/astro.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <ul>
            <li><a href="index.php?page=solar_system">HOME</a></li>
            <li><a href="index.php?page=explore">ASTRO-FACTS</a></li>
            <li><a href="index.php?page=cart">CART</a></li>
            <li><a href="index.php?page=logout">LOGOUT</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <section class="shopping-section">
            <h2>Shop Astronomy Materials</h2>
            
            <div class="product-grid">
                <?php 
                // Dynamically render products
                if (!empty($products)) {
                    foreach ($products as $product): 
                        // Prepare image path
                        $imageUrl = $product['image_url'] ?? '';
                        $imagePath = 'inc/ressources/' . $imageUrl;
                ?>
                    <div class="product-card">
                        <img src="<?= htmlspecialchars($imagePath) ?>" 
                             alt="<?= htmlspecialchars($product['name']) ?>" 
                             class="product-image">
                        
                        <h3><?= htmlspecialchars($product['name']); ?></h3>
                        
                        <p class="product-description">
                            <?= htmlspecialchars($product['description']); ?>
                        </p>
                        
                        <div class="product-footer">
                            <p class="price">$<?= number_format($product['price'], 2); ?></p>
                            
                            <form action="index.php?page=add-to-cart" method="POST">
                                <input type="hidden" name="productId" value="<?= $product['product_id']; ?>">
                                <button type="submit" class="add-to-cart">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                <?php 
                    endforeach; 
                } else {
                    echo '<p style="color: red;">No products available</p>';
                }
                ?>
            </div>
        </section>

        <!-- Blogs Section -->
        <section class="blogs-section">
            <h2>Astronomy Blogs</h2>
            <p>Read and share your thoughts on space explorations, discoveries, and missions.</p>
            <div class="blogs">
                <?php 
                // Dynamically render approved blogs
                if (!empty($approvedBlogs)) {
                    foreach ($approvedBlogs as $blog): 
                ?>
                    <div class="blog-card">
                        <h3><?= htmlspecialchars($blog['title']); ?></h3>
                        <p class="blog-author">By <?= htmlspecialchars($blog['username']); ?></p>
                        <p class="blog-excerpt"><?= substr(htmlspecialchars($blog['content']), 0, 200) . '...'; ?></p>
                        <a href="#" class="read-more">Read More</a>
                    </div>
                <?php 
                    endforeach; 
                } else {
                    echo '<p style="color: #666;">No blogs available. Be the first to write one!</p>';
                }
                ?>
            </div>
            <a href="index.php?page=write_blog" class="write-blog">Write Your Own Blog</a>
        </section>

        <!-- Contact Section -->
        <section class="contact-section">
            <h2>Contact Us</h2>
            <form action="index.php?page=submit_contact" method="POST">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </section>
    </div>

    <script>
        // Debugging script to log product information
        document.addEventListener('DOMContentLoaded', function() {
            var products = <?= json_encode($products); ?>;
            console.log('Products loaded:', products);

            var forms = document.querySelectorAll('form');
            forms.forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    var productId = form.querySelector('input[name="productId"]').value;
                    console.log('Attempting to add product to cart:', {
                        productId: productId,
                        productDetails: products.find(p => p.product_id == productId)
                    });
                });
            });
        });
    </script>
</body>
</html>
