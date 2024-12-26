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

            // Debug logging
            error_log("Signup attempt - Email: $email, Username: $username, Role: $role");

            if (empty($email) || empty($username) || empty($password) || empty($role)) {
                $error = "All fields are required.";
                require_once 'app/views/signup.php';
                exit;
            }

            try {
                $existingUser = $this->userModel->findUserByEmail($email);
                if ($existingUser) {
                    throw new Exception("User with this email already exists.");
                }

                $existingUsername = $this->userModel->findUserByUsername($username);
                if ($existingUsername) {
                    throw new Exception("Username already exists.");
                }

                $insertData = [
                    'username' => $username,
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_BCRYPT),
                    'role' => $role
                ];

                // Debug logging
                error_log("Insert data: " . print_r($insertData, true));

                if ($this->userModel->insertUser($insertData)) {
                    // Debug logging
                    error_log("User inserted successfully");
                    header('Location: index.php?action=success');
                    exit;
                } else {
                    // Debug logging
                    error_log("Failed to insert user");
                    throw new Exception("Unable to create account. Try again.");
                }
            } catch (Exception $e) {
                // Debug logging
                error_log("Signup error: " . $e->getMessage());
                $error = $e->getMessage();
                require_once 'app/views/signup.php';
                exit;
            }
        }
    }
}
