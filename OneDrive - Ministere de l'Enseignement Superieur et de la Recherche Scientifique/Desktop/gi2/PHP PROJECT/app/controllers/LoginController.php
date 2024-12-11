<?php
class LoginController {
    public function index() {
        include 'app/views/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Use the Singleton pattern to get a database connection
            $database = Database::getInstance();
            $db = $database->getConnection();

            $userModel = new UserModel($db);
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Store only necessary user details
                session_start(); // Ensure session is started
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email']
                ];
                header('Location: index.php?page=solar_system');
                exit;
            } else {
                $error = "Invalid credentials";
                include 'app/views/login.php';
            }
        }
    }
}
