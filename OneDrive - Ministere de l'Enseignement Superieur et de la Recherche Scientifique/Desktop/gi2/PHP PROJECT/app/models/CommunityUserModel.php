<?php
require_once "config/database.php";

class CommunityUserModel {
    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance()->getConnection();
    }

    public function getAstroUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT id, username, email, password FROM astro_users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Check if user already exists
    public function findAstroUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM astro_users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Insert a new user into the database
    public function insertAstroUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO astro_users (full_name, email, role, interests) VALUES (:username, :email, :role, :interests)");
        return $stmt->execute($data);
    }
}