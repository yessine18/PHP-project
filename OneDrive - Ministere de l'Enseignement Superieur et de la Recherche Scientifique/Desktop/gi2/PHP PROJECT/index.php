<?php
session_start();

require_once 'config/database.php';
require_once 'app/models/UserModel.php';
require_once 'app/controllers/LoginController.php';
require_once 'app/controllers/SignupController.php';
require_once 'app/controllers/UserController.php';

$page = $_GET['page'] ?? 'login';

switch ($page) {
    case 'login':
        $controller = new LoginController();
        $controller->index();
        break;
    case 'authenticate':
        $controller = new LoginController();
        $controller->authenticate();
        break;
    case 'solar_system':
        $controller = new UserController();
        $controller->solarSystem();
        break;
    case 'logout': // Add this case
        $controller = new UserController();
        $controller->logout();
        break;
    case 'add':
        $controller = new SignupController();
        $controller->handleSignup();
    break;
    case 'signup':
        $controller = new SignupController();
        $controller->index();
    break;
    case 'explore':
        $controller = new UserController();
        $controller->explore();
    break;
    case 'astronomy':
        $controller = new UserController();
        $controller->astronomy();
    break;
    case 'application':
        $controller = new AstroSignupController();
        $controller->join();
    break;
    default:
        include 'views/error.php';
        break;
}
