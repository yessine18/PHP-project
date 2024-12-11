<?php
require_once "app/models/UserModel.php";

class SignupController {
    
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    // Render signup page
    public function index() {
        require_once 'app/views/signup.php';
    }

    // Handle signup logic
    public function handleSignup() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            if (empty($email) || empty($username) || empty($password) || empty($role)) {
                $error = "All fields are required.";
                require_once 'app/view/signup.php';
                exit;
            }

            $existingUser = $this->userModel->findUserByEmail($email);

            if ($existingUser) {
                $error = "User with this email already exists.";
                require_once 'app/view/signup.php';
                exit;
            }

            $insertData = [
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'role' => $role
            ];

            if ($this->userModel->insertUser($insertData)) {
                header('Location: index.php?action=success');
                exit;
            } else {
                $error = "Unable to create account. Try again.";
                require_once 'app/view/signup.php';
            }
        }
    }
}
