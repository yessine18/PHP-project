<?php
// Session configuration
if (session_status() == PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
}

// Application configuration
define('SITE_URL', 'http://localhost/projet%20PHP/public/');
define('APP_NAME', 'PlanetsFacts');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Session start
