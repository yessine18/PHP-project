<?php
require_once "app/models/CommunityUserModel.php";

class AstroSignupController {
    public function index() {
        include 'app/views/login.php';
    }

        public function join() {
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

            if ($this->CommunityUserModel->insertUser($insertData)) {
                header('Location: index.php?action=success');
                exit;
            } else {
                $error = "Unable to create account. Try again.";
                require_once 'app/view/signup.php';
            }
        }
    }
}