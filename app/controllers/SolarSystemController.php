<?php
require_once __DIR__ . '/../models/User.php';

class SolarSystemController {
    public function index() {
        // Ensure the user is authenticated
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        // Load the solar system view
        $username = $_SESSION['username'] ?? 'Guest';
        require_once APP_PATH . 'views/solar_system.php';
    }
}
