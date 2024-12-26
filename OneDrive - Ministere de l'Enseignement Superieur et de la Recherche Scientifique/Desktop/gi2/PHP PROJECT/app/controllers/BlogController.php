<?php
require_once 'app/models/BlogModel.php';

class BlogController {
    private $blogModel;

    public function __construct() {
        $this->blogModel = new BlogModel();
    }

    public function showWriteBlogPage() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) {
            header('Location: index.php?page=login&error=Please login to write a blog');
            exit();
        }

        require 'app/views/write_blog.php';
    }

    public function createBlog() {
        // Check if user is logged in
        if (!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) {
            header('Location: index.php?page=login&error=Please login to write a blog');
            exit();
        }

        // Validate input
        if (!isset($_POST['title']) || !isset($_POST['content']) || 
            empty(trim($_POST['title'])) || empty(trim($_POST['content']))) {
            header('Location: index.php?page=write_blog&error=Title and content are required');
            exit();
        }

        $userId = $_SESSION['user']['id'] ?? $_SESSION['user_id'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);

        $result = $this->blogModel->createBlog($userId, $title, $content);

        if ($result) {
            header('Location: index.php?page=astronomy&success=Blog submitted for review');
            exit();
        } else {
            header('Location: index.php?page=write_blog&error=Failed to submit blog');
            exit();
        }
    }

    public function manageBlogsAdmin() {
        // Check if user is an admin
        if ((!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) || 
            ($_SESSION['user']['role'] ?? $_SESSION['role'] ?? '') !== 'admin') {
            header('Location: index.php?page=login&error=Unauthorized access');
            exit();
        }

        $blogs = $this->blogModel->getAllBlogs();
        require 'app/views/admin/manage_blogs.php';
    }

    public function viewBlogDetails($blogId) {
        // Check if user is an admin
        if ((!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) || 
            ($_SESSION['user']['role'] ?? $_SESSION['role'] ?? '') !== 'admin') {
            header('Location: index.php?page=login&error=Unauthorized access');
            exit();
        }

        $blog = $this->blogModel->getBlogById($blogId);

        if (!$blog) {
            header('Location: index.php?page=admin/blogs&error=Blog not found');
            exit();
        }

        require 'app/views/admin/blog_details.php';
    }

    public function approveBlog($blogId) {
        // Check if user is an admin
        if ((!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) || 
            ($_SESSION['user']['role'] ?? $_SESSION['role'] ?? '') !== 'admin') {
            header('Location: index.php?page=login&error=Unauthorized access');
            exit();
        }

        $result = $this->blogModel->updateBlogStatus($blogId, 'approved');

        if ($result) {
            header('Location: index.php?page=admin/blogs&success=Blog approved successfully');
            exit();
        } else {
            header('Location: index.php?page=admin/blogs&error=Failed to approve blog');
            exit();
        }
    }

    public function rejectBlog($blogId) {
        // Check if user is an admin
        if ((!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) || 
            ($_SESSION['user']['role'] ?? $_SESSION['role'] ?? '') !== 'admin') {
            header('Location: index.php?page=login&error=Unauthorized access');
            exit();
        }

        $result = $this->blogModel->updateBlogStatus($blogId, 'rejected');

        if ($result) {
            header('Location: index.php?page=admin/blogs&success=Blog rejected successfully');
            exit();
        } else {
            header('Location: index.php?page=admin/blogs&error=Failed to reject blog');
            exit();
        }
    }

    public function deleteBlog($blogId) {
        // Check if user is an admin
        if ((!isset($_SESSION['user_id']) && !isset($_SESSION['user']['id'])) || 
            ($_SESSION['user']['role'] ?? $_SESSION['role'] ?? '') !== 'admin') {
            header('Location: index.php?page=login&error=Unauthorized access');
            exit();
        }

        $result = $this->blogModel->deleteBlog($blogId);

        if ($result) {
            header('Location: index.php?page=admin/blogs&success=Blog deleted successfully');
            exit();
        } else {
            header('Location: index.php?page=admin/blogs&error=Failed to delete blog');
            exit();
        }
    }
}
