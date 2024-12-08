<?php
// Ensure session is started only once
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Define base paths
define('ROOT_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('APP_PATH', ROOT_PATH . 'app' . DIRECTORY_SEPARATOR);
define('CONFIG_PATH', ROOT_PATH . 'config' . DIRECTORY_SEPARATOR);

// Load configuration
require_once CONFIG_PATH . 'config.php';
require_once CONFIG_PATH . 'database.php';

// Get the controller and action from URL or use defaults
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

error_log("Requested Controller: $controller");
error_log("Requested Action: $action");

// Load and initialize controller
$controllerFile = APP_PATH . 'controllers/' . ucfirst($controller) . 'Controller.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controllerClass = ucfirst($controller) . 'Controller';
    
    if (class_exists($controllerClass)) {
        $controllerInstance = new $controllerClass();
        
        if (method_exists($controllerInstance, $action)) {
            $controllerInstance->$action();
        } else {
            error_log("Method $action does not exist in $controllerClass");
            header("Location: index.php?controller=auth&action=login");
            exit();
        }
    } else {
        error_log("Controller class $controllerClass does not exist");
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
} else {
    error_log("Controller file not found: $controllerFile");
    header("Location: index.php?controller=auth&action=login");
    exit();
}
