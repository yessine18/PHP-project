<?php
require_once 'config/Database.php';

class ContactRequestModel {
    private $pdo;
    private $table_name = 'contact_requests';

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function createContactRequest($user_id, $name, $email, $message) {
        try {
            // Prepare SQL statement
            $query = "INSERT INTO " . $this->table_name . " 
                      (user_id, name, email, message) 
                      VALUES (:user_id, :name, :email, :message)";
            
            // Prepare statement
            $stmt = $this->pdo->prepare($query);
            
            // Sanitize and bind parameters
            $name = htmlspecialchars(strip_tags($name));
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $message = htmlspecialchars(strip_tags($message));
            
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':message', $message, PDO::PARAM_STR);
            
            // Execute query
            if($stmt->execute()) {
                return true;
            }
            
            return false;
        } catch(PDOException $exception) {
            // Log error or handle it appropriately
            error_log("Contact Request Error: " . $exception->getMessage());
            return false;
        }
    }

    // Method to get a specific contact request by ID
    public function getContactRequestById($requestId) {
        try {
            $query = "SELECT cr.*, u.username 
                      FROM " . $this->table_name . " cr 
                      JOIN users u ON cr.user_id = u.id 
                      WHERE request_id = :request_id";
            
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':request_id', $requestId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            error_log("Get Contact Request Error: " . $exception->getMessage());
            return false;
        }
    }

    // Method to get all contact requests for admin
    public function getAllContactRequests() {
        try {
            $query = "SELECT cr.request_id, cr.name, u.username, cr.email, cr.created_at 
                      FROM " . $this->table_name . " cr 
                      JOIN users u ON cr.user_id = u.id 
                      ORDER BY cr.created_at DESC";
            
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $exception) {
            error_log("Get All Contact Requests Error: " . $exception->getMessage());
            return [];
        }
    }
}
?>
