<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../../config/Database.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'user';
            $redirect = $_GET['redirect'] ?? '';

            // Authenticate user
            if ($this->authenticateUser($email, $password, $role)) {
                // Redirect based on the redirect parameter
                if ($redirect === 'solar_system') {
                    header("Location: index.php?controller=solarSystem&action=index");
                    exit();
                } else {
                    // Default redirect if no specific redirect is specified
                    header("Location: index.php?controller=solarSystem&action=index");
                    exit();
                }
            } else {
                // Redirect back to login with an error message
                $_SESSION['login_error'] = 'Invalid credentials';
                header("Location: index.php?controller=auth&action=login");
                exit();
            }
        }

        // Load the login view (GET request)
        require_once APP_PATH . 'views/auth/login.php';
    }

    private function authenticateUser($email, $password, $role) {
        // Connect to the database
        $db = new Database();
        $conn = $db->getConnection();
    
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result && password_verify($password, $result['password']) && $result['role'] === $role) {
            // Store user details in the session
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            return true;
        }
    
        return false;
    }

    public function logout() {
        // Destroy the session and redirect to the login page
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
}