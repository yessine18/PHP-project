<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../../config/Database.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // Authenticate user (dummy logic here, replace with real authentication)
            if ($this->authenticateUser($username, $password)) {
                // Redirect to the solar system page upon successful login
                header("Location: index.php?controller=solarSystem&action=index");
                exit();
            } else {
                // Redirect back to login with an error message
                $_SESSION['error'] = 'Invalid credentials';
                header("Location: index.php?controller=auth&action=login");
                exit();
            }
        }

        // Load the login view (GET request)
        require_once APP_PATH . 'views/auth/login.php';
    }

    private function authenticateUser($username, $password) {
        // Dummy authentication logic - replace with your database query
        return $username === 'admin' && $password === 'password';
    }

    public function logout() {
        // Destroy the session and redirect to the login page
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
}
