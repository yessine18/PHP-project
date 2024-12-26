<?php
class OrderModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function createOrder($userId, $totalPrice, $name, $lastname, $phone, $location) {
        // Start transaction
        $this->pdo->beginTransaction();

        try {
            // Validate input parameters
            if (empty($userId) || empty($totalPrice) || empty($name) || empty($lastname) || empty($phone) || empty($location)) {
                throw new Exception("Missing required order parameters");
            }

            // Check if user has items in cart
            $cartCheckStmt = $this->pdo->prepare("SELECT COUNT(*) FROM cart WHERE user_id = :user_id");
            $cartCheckStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $cartCheckStmt->execute();
            $cartItemCount = $cartCheckStmt->fetchColumn();

            if ($cartItemCount == 0) {
                throw new Exception("No items in cart for user");
            }

            // Insert order
            $stmt = $this->pdo->prepare("INSERT INTO orders (user_id, total_price, name, lastname, phone, location, created_at) 
                                         VALUES (:user_id, :total_price, :name, :lastname, :phone, :location, NOW())");
            
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':total_price', $totalPrice, PDO::PARAM_STR);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':location', $location, PDO::PARAM_STR);
            
            $result = $stmt->execute();
            
            if (!$result) {
                $errorInfo = $stmt->errorInfo();
                throw new Exception("Failed to insert order: " . print_r($errorInfo, true));
            }
            
            // Get the last inserted order ID
            $orderId = $this->pdo->lastInsertId();
            
            // Retrieve cart items for this user
            $cartStmt = $this->pdo->prepare("SELECT product_id, quantity FROM cart WHERE user_id = :user_id");
            $cartStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $cartStmt->execute();
            $cartItems = $cartStmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Insert order items
            $orderItemStmt = $this->pdo->prepare("INSERT INTO order_details(order_id, product_id, quantity) 
                                                  VALUES (:order_id, :product_id, :quantity)");
            
            foreach ($cartItems as $item) {
                $orderItemStmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
                $orderItemStmt->bindParam(':product_id', $item['product_id'], PDO::PARAM_INT);
                $orderItemStmt->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);
                $result = $orderItemStmt->execute();
                
                if (!$result) {
                    $errorInfo = $orderItemStmt->errorInfo();
                    throw new Exception("Failed to insert order details: " . print_r($errorInfo, true));
                }
            }
            
            // Clear the user's cart
            $clearCartStmt = $this->pdo->prepare("DELETE FROM cart WHERE user_id = :user_id");
            $clearCartStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $result = $clearCartStmt->execute();
            
            if (!$result) {
                $errorInfo = $clearCartStmt->errorInfo();
                throw new Exception("Failed to clear cart: " . print_r($errorInfo, true));
            }
            
            // Commit transaction
            $this->pdo->commit();
            
            return $orderId;
        } catch (Exception $e) {
            // Rollback transaction on error
            $this->pdo->rollBack();
            error_log("Order creation failed: " . $e->getMessage());
            return false;
        }
    }

    public function getOrderDetails($orderId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT o.*, od.product_id, od.quantity, p.price as product_price, p.name as product_name 
                FROM orders o 
                JOIN order_details od ON o.order_id = od.order_id 
                JOIN products p ON od.product_id = p.product_id 
                WHERE o.order_id = :order_id
            ");
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($results)) {
                error_log("No order details found for order ID: $orderId");
                return [];
            }

            return $results;
        } catch (PDOException $e) {
            error_log("Error fetching order details: " . $e->getMessage());
            return [];
        }
    }

    public function getUserOrders($userId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM orders 
                WHERE user_id = :user_id 
                ORDER BY created_at DESC
            ");
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching user orders: " . $e->getMessage());
            return [];
        }
    }

    public function getAllOrders() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT o.*, u.username 
                FROM orders o 
                JOIN users u ON o.user_id = u.id 
                ORDER BY o.created_at DESC
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching all orders: " . $e->getMessage());
            return [];
        }
    }

    public function updateOrderStatus($orderId, $newStatus) {
        try {
            $stmt = $this->pdo->prepare("UPDATE orders SET status = :status WHERE order_id = :order_id");
            $stmt->bindParam(':status', $newStatus, PDO::PARAM_STR);
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            
            $result = $stmt->execute();
            
            if (!$result) {
                $errorInfo = $stmt->errorInfo();
                error_log("Failed to update order status: " . print_r($errorInfo, true));
                return false;
            }
            
            return true;
        } catch (PDOException $e) {
            error_log("Error updating order status: " . $e->getMessage());
            return false;
        }
    }
}
