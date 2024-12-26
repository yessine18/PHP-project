<?php
class LoginController {
    public function index() {
        include 'app/views/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $login_type = $_POST['login_type'] ?? 'user';

            // Use the Singleton pattern to get a database connection
            $database = Database::getInstance();
            $db = $database->getConnection();

            // Modify the query to get the role and approval status
            $stmt = $db->prepare("SELECT id, username, email, password, role, approval_status FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Check if the login type matches the user's role
                $userRole = $user['role'] ?? 'user';
                $approvalStatus = $user['approval_status'] ?? 'pending';

                // Check role and approval status
                if (($login_type === 'admin' && $userRole === 'admin') || 
                    ($login_type === 'user' && $userRole === 'user')) {
                    
                    // Check approval status for all roles
                    if ($approvalStatus !== 1) {
                        $error = "Your account is pending approval. Please contact an administrator.";
                        include 'app/views/login.php';
                        exit;
                    }

                    // Store user details
                    session_start(); // Ensure session is started
                    $_SESSION['user'] = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $userRole,
                        'approval_status' => $approvalStatus
                    ];

                    // Redirect based on role
                    if ($login_type === 'admin') {
                        header('Location: index.php?page=admin/dashboard');
                    } else {
                        header('Location: index.php?page=solar_system');
                    }
                    exit;
                } else {
                    $error = "Invalid login type for this account";
                    include 'app/views/login.php';
                }
            } else {
                $error = "Invalid credentials";
                include 'app/views/login.php';
            }
        }
    }
}
