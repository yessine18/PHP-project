<?php
require_once "config/database.php";

class UserModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT id, username, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Check if user already exists
    public function findUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Check if user already exists by username
    public function findUserByUsername($username) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Insert a new user into the database
    public function insertUser($data) {
        // Check if username already exists
        if ($this->findUserByUsername($data['username'])) {
            throw new Exception("Username already exists. Please choose a different username.");
        }

        // Check if email already exists
        if ($this->findUserByEmail($data['email'])) {
            throw new Exception("Email already exists. Please use a different email.");
        }

        // Set approval status to 0 (pending) for both users and admins
        $data['approval_status'] = 0;
        
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password, role, approval_status) VALUES (:username, :email, :password, :role, :approval_status)");
        return $stmt->execute($data);
    }

    public function getCurrentUserId() {
        // Check if user is logged in via session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        // Return user ID if logged in, otherwise return null
        return isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : null;
    }
}
