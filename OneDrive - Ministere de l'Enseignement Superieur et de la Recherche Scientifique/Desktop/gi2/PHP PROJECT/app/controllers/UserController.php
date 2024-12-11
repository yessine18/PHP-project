<?php
class UserController {
    public function solarSystem() {
            include 'app/views/solar_system.php';
    }
    public function logout()
    {
        // Destroy the session
        session_start();
        session_unset();
        session_destroy();

        // Redirect to login page
        header("Location: index.php?page=login");
        exit();
    }
    public function explore() {
        include 'app/views/explore.php';
    }
    public function astronomy() {
        include 'app/views/CommunityLogin.php';
    }
}
