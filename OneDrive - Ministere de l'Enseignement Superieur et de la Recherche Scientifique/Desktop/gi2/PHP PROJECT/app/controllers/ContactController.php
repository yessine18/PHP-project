<?php
require_once 'app/models/ContactRequestModel.php';
require_once 'app/models/UserModel.php'; // Assuming you have a UserModel to get current user

class ContactController {
    private $contactRequestModel;
    private $userModel;

    public function __construct() {
        // Remove any unnecessary initialization
    }

    public function handleContactSubmission() {
        // Check if form is submitted via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate input
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';

            // Basic validation
            if (empty($name) || empty($email) || empty($message)) {
                // Redirect back with error
                header('Location: index.php?page=astro&error=missing_fields');
                exit();
            }

            // Get current user's ID (you'll need to implement session management)
            $userModel = new UserModel();
            $user_id = $userModel->getCurrentUserId();

            // If no user is logged in, redirect to login
            if (!$user_id) {
                header('Location: index.php?page=login&error=login_required');
                exit();
            }

            // Attempt to create contact request
            $contactRequestModel = new ContactRequestModel();
            $result = $contactRequestModel->createContactRequest(
                $user_id, 
                $name, 
                $email, 
                $message
            );

            if ($result) {
                // Successful submission
                header('Location: index.php?page=astronomy&success=message_sent');
            } else {
                // Failed submission
                header('Location: index.php?page=astronomy&error=submission_failed');
            }
            exit();
        }
    }
}
?>
