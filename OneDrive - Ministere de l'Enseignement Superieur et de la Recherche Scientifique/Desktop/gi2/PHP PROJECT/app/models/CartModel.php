<?php
class CartModel {
    private $db;

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    public function addToCart($userId, $productId, $quantity = 1) {
        try {
            // First, verify the product exists 
            $stmt = $this->db->prepare("SELECT * FROM products WHERE product_id = :product_id");
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            // Enhanced logging
            error_log("Add to Cart Debug: Product Query Result - " . print_r($product, true));

            if (!$product) {
                error_log("Product not found: $productId");
                return false;
            }

            // Log product details
            error_log("Product Details: ID={$product['product_id']}, Name={$product['name']}, Stock={$product['stock']}");

            // Check if product already exists in cart
            $stmt = $this->db->prepare("SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();
            $existingCartItem = $stmt->fetch(PDO::FETCH_ASSOC);

            // Log existing cart item
            error_log("Existing Cart Item: " . print_r($existingCartItem, true));

            $this->db->beginTransaction();

            if ($existingCartItem) {
                // Update quantity if product exists
                $stmt = $this->db->prepare("
                    UPDATE cart SET quantity = quantity + :quantity 
                    WHERE user_id = :user_id AND product_id = :product_id
                ");
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            } else {
                // Insert new cart item
                $stmt = $this->db->prepare("
                    INSERT INTO cart (user_id, product_id, quantity) 
                    VALUES (:user_id, :product_id, :quantity)
                ");
                $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            }

            $result = $stmt->execute();
            
            // Log execution result
            error_log("Cart Operation Result: " . ($result ? 'Success' : 'Failure'));

            // Optional: Reduce product stock if needed
            if ($product['stock'] > 0) {
                $stmt = $this->db->prepare("
                    UPDATE products 
                    SET stock = stock - :quantity 
                    WHERE product_id = :product_id
                ");
                $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
                $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
                $stockResult = $stmt->execute();
                
                // Log stock update
                error_log("Stock Update Result: " . ($stockResult ? 'Success' : 'Failure'));
            }

            if ($result) {
                $this->db->commit();
                return true;
            } else {
                $this->db->rollBack();
                error_log("Failed to add product to cart: UserID=$userId, ProductID=$productId");
                return false;
            }
        } catch (PDOException $e) {
            if (isset($this->db)) {
                $this->db->rollBack();
            }
            error_log("Database error in addToCart: " . $e->getMessage());
            return false;
        }
    }

    public function getCartItems($userId) {
        $stmt = $this->db->prepare("
            SELECT c.cart_id, c.quantity, p.product_id, p.name, p.price, p.image_url 
            FROM cart c 
            JOIN products p ON c.product_id = p.product_id 
            WHERE c.user_id = :user_id
        ");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function removeCartItem($cartId) {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE cart_id = :cart_id");
        $stmt->bindParam(':cart_id', $cartId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function clearCart($userId) {
        $stmt = $this->db->prepare("DELETE FROM cart WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function calculateCartTotal($userId) {
        $stmt = $this->db->prepare("
            SELECT SUM(c.quantity * p.price) as total 
            FROM cart c 
            JOIN products p ON c.product_id = p.product_id 
            WHERE c.user_id = :user_id
        ");
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
}
