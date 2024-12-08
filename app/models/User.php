<?php
class User {
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $email;
    public $password;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($email, $password) {
        // Debug output
        error_log("Attempting login for email: " . $email);
        
        $query = "SELECT id, username, email, password, role FROM " . $this->table_name . " WHERE email = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        
        try {
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            error_log("Query executed. Found user: " . ($row ? "Yes" : "No"));
            
            if ($row) {
                error_log("Stored hash: " . $row['password']);
                error_log("Attempting to verify password...");
                
                if (password_verify($password, $row['password'])) {
                    error_log("Password verified successfully!");
                    $this->id = $row['id'];
                    $this->username = $row['username'];
                    $this->email = $row['email'];
                    $this->role = $row['role'];
                    return true;
                } else {
                    error_log("Password verification failed!");
                }
            } else {
                error_log("No user found with email: " . $email);
            }
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
        }
        
        return false;
    }
}
