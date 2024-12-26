<?php
class BlogModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function createBlog($userId, $title, $content) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO blogs (user_id, title, content, status, created_at) 
                VALUES (:user_id, :title, :content, 'pending', NOW())
            ");
            
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':content', $content, PDO::PARAM_STR);
            
            $result = $stmt->execute();
            
            return $result ? $this->pdo->lastInsertId() : false;
        } catch (PDOException $e) {
            error_log("Error creating blog: " . $e->getMessage());
            return false;
        }
    }

    public function getBlogById($blogId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT b.*, u.username 
                FROM blogs b 
                JOIN users u ON b.user_id = u.id 
                WHERE b.blog_id = :blog_id
            ");
            
            $stmt->bindParam(':blog_id', $blogId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching blog: " . $e->getMessage());
            return null;
        }
    }

    public function getAllBlogs() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT b.blog_id, u.username, b.title, b.status 
                FROM blogs b 
                JOIN users u ON b.user_id = u.id 
                ORDER BY b.created_at DESC
            ");
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching blogs: " . $e->getMessage());
            return [];
        }
    }

    public function getApprovedBlogs() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT b.*, u.username 
                FROM blogs b 
                JOIN users u ON b.user_id = u.id 
                WHERE b.status = 'approved' 
                ORDER BY b.created_at DESC
            ");
            
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error fetching approved blogs: " . $e->getMessage());
            return [];
        }
    }

    public function updateBlogStatus($blogId, $newStatus) {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE blogs 
                SET status = :status 
                WHERE blog_id = :blog_id
            ");
            
            $stmt->bindParam(':status', $newStatus, PDO::PARAM_STR);
            $stmt->bindParam(':blog_id', $blogId, PDO::PARAM_INT);
            
            $result = $stmt->execute();
            
            return $result && $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error updating blog status: " . $e->getMessage());
            return false;
        }
    }

    public function deleteBlog($blogId) {
        try {
            $stmt = $this->pdo->prepare("
                DELETE FROM blogs 
                WHERE blog_id = :blog_id
            ");
            
            $stmt->bindParam(':blog_id', $blogId, PDO::PARAM_INT);
            
            $result = $stmt->execute();
            
            return $result && $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Error deleting blog: " . $e->getMessage());
            return false;
        }
    }
}
