<?php
require_once 'app/models/AdminModel.php';

class AdminController {
    private $adminModel;

    public function __construct() {
        // Ensure only admin can access
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin') {
            header('Location: index.php?page=login');
            exit();
        }
        $this->adminModel = new AdminModel();
    }

    public function dashboard() {
        $data = [
            'userCount' => $this->adminModel->getUserCount(),
            'pendingBlogs' => $this->adminModel->getPendingBlogsCount(),
            'pendingOrders' => $this->adminModel->getPendingOrdersCount()
        ];
        
        include 'app/views/admin/dashboard.php';
    }

    public function manageUsers() {
        $users = $this->adminModel->getAllUsers();
        $pendingUsers = $this->adminModel->getPendingUsers();
        include 'app/views/admin/users.php';
    }

    public function deleteUser($userId) {
        if ($this->adminModel->deleteUser($userId)) {
            header('Location: index.php?page=admin/users&success=User deleted successfully');
        } else {
            header('Location: index.php?page=admin/users&error=Failed to delete user');
        }
        exit();
    }

    public function approveUser($userId) {
        if ($this->adminModel->approveUser($userId)) {
            header('Location: index.php?page=admin/users&success=User approved successfully');
        } else {
            header('Location: index.php?page=admin/users&error=Failed to approve user');
        }
        exit();
    }

    public function rejectUser($userId) {
        if ($this->adminModel->rejectUser($userId)) {
            header('Location: index.php?page=admin/users&success=User rejected successfully');
        } else {
            header('Location: index.php?page=admin/users&error=Failed to reject user');
        }
        exit();
    }

    public function manageBlogs() {
        $blogs = $this->adminModel->getAllBlogs();
        include 'app/views/admin/blogs.php';
    }

    public function processBlog($blogId, $action) {
        if ($action === 'approve') {
            $result = $this->adminModel->approveBlog($blogId);
        } else {
            $result = $this->adminModel->rejectBlog($blogId);
        }

        header('Location: index.php?page=admin/blogs&' . ($result ? 'success=Blog processed' : 'error=Failed to process blog'));
        exit();
    }

    public function manageOrders() {
        $orders = $this->adminModel->getAllOrders();
        include 'app/views/admin/orders.php';
    }

    public function logout() {
        // Destroy session
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        session_destroy();
        header('Location: index.php?page=login');
        exit();
    }

    public function getAllUsers() {
        return $this->adminModel->getAllUsers();
    }

    public function getAllBlogs() {
        return $this->adminModel->getAllBlogs();
    }

    public function manageFeedbacks() {
        require_once 'app/models/ContactRequestModel.php';
        $contactRequestModel = new ContactRequestModel();
        $feedbacks = $contactRequestModel->getAllContactRequests();
        include 'app/views/admin/feedbacks.php';
    }

    public function viewFeedbackDetails($requestId) {
        require_once 'app/models/ContactRequestModel.php';
        $contactRequestModel = new ContactRequestModel();
        $feedback = $contactRequestModel->getContactRequestById($requestId);
        include 'app/views/admin/feedback_details.php';
    }
}
