<?php
require_once 'config/database.php';

class AdminModel {
    private $db;

    public function __construct() {
        $database = Database::getInstance();
        $this->db = $database->getConnection();
    }

    public function getUserCount() {
        $stmt = $this->db->query("SELECT COUNT(*) FROM users WHERE role = 'user'");
        return $stmt->fetchColumn();
    }

    public function getPendingBlogsCount() {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) FROM blogs WHERE status = 'pending'");
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            return 0;
        }
    }

    public function getPendingOrdersCount() {
        try {
            $stmt = $this->db->query("SELECT COUNT(*) FROM cart WHERE status = 'pending'");
            return $stmt->fetchColumn();
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            return 0;
        }
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM users WHERE role = 'user'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        return $stmt->execute([$userId]);
    }

    public function getAllBlogs() {
        try {
            $stmt = $this->db->query("
                SELECT blogs.*, users.username 
                FROM blogs 
                JOIN users ON blogs.user_id = users.id 
                ORDER BY blogs.created_at DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            return [];
        }
    }

    public function approveBlog($blogId) {
        try {
            $stmt = $this->db->prepare("UPDATE blogs SET status = 'approved' WHERE blog_id = ?");
            return $stmt->execute([$blogId]);
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            return false;
        }
    }

    public function rejectBlog($blogId) {
        $stmt = $this->db->prepare("UPDATE blogs SET status = 'rejected' WHERE blog_id = ?");
        return $stmt->execute([$blogId]);
    }

    public function getAllOrders() {
        try {
            $stmt = $this->db->query("
                SELECT o.*, u.username, 
                       COUNT(od.product_id) as total_items, 
                       SUM(od.quantity) as total_quantity
                FROM orders o
                JOIN users u ON o.user_id = u.id
                LEFT JOIN order_details od ON o.order_id = od.order_id
                GROUP BY o.order_id
                ORDER BY o.created_at DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching all orders: " . $e->getMessage());
            return [];
        }
    }

    public function getOrderDetails($orderId) {
        try {
            $stmt = $this->db->prepare("
                SELECT o.*, 
                       od.product_id, 
                       od.quantity, 
                       p.name as product_name, 
                       p.price as product_price
                FROM orders o
                JOIN order_details od ON o.order_id = od.order_id
                JOIN products p ON od.product_id = p.product_id
                WHERE o.order_id = :order_id
            ");
            $stmt->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching order details: " . $e->getMessage());
            return [];
        }
    }

    public function getPendingUsers() {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE approval_status = 0");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function approveUser($userId) {
        $stmt = $this->db->prepare("UPDATE users SET approval_status = 1 WHERE id = ?");
        return $stmt->execute([$userId]);
    }

    public function rejectUser($userId) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ? AND approval_status = 0");
        return $stmt->execute([$userId]);
    }
}
