<?php
session_start();

require_once 'config/database.php';
require_once 'app/models/UserModel.php';
require_once 'app/controllers/LoginController.php';
require_once 'app/controllers/SignupController.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/AstronomyController.php';
require_once 'app/controllers/AdminController.php';
require_once 'app/controllers/CartController.php';
require_once 'app/controllers/OrderController.php';
require_once 'app/controllers/BlogController.php';
require_once 'app/controllers/ContactController.php';

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
    case 'logout': 
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
        $controller = new AstronomyController();
        $controller->showAstronomyPage();
        break;
    case 'admin/dashboard':
        $adminController = new AdminController();
        $adminController->dashboard();
        break;
    case 'admin/users':
        $adminController = new AdminController();
        $adminController->manageUsers();
        break;
    case 'admin/delete-user':
        $adminController = new AdminController();
        $adminController->deleteUser($_GET['userId']);
        break;
    case 'admin/approve-user':
        $adminController = new AdminController();
        $adminController->approveUser($_GET['userId']);
        break;
    case 'admin/reject-user':
        $adminController = new AdminController();
        $adminController->rejectUser($_GET['userId']);
        break;
    case 'admin/blogs':
        $adminController = new AdminController();
        $adminController->manageBlogs();
        break;
    case 'admin/process-blog':
        $adminController = new AdminController();
        $adminController->processBlog($_GET['blogId'], $_GET['action']);
        break;
    case 'admin/orders':
        $adminController = new AdminController();
        $adminController->manageOrders();
        break;
    case 'admin/logout':
        $adminController = new AdminController();
        $adminController->logout();
        break;
    case 'approve_user':
        $adminController = new AdminController();
        $adminController->approveUser($_GET['id']);
        break;
    case 'reject_user':
        $adminController = new AdminController();
        $adminController->rejectUser($_GET['id']);
        break;
    case 'add-to-cart':
        $cartController = new CartController();
        $productId = $_GET['productId'] ?? $_POST['productId'] ?? null;
        error_log("Index.php Add to Cart Routing: ProductID = " . print_r($productId, true));
        $cartController->addToCart($productId);
        break;
    case 'cart':
        $cartController = new CartController();
        $cartController->viewCart();
        break;
    case 'remove-from-cart':
        $cartController = new CartController();
        $cartController->removeFromCart($_GET['cartId']);
        break;
    case 'place-order':
        $orderController = new OrderController();
        $orderController->placeOrder();
        break;
    case 'confirm-order':
        $orderController = new OrderController();
        $orderController->confirmOrder();
        break;
    case 'details':
        $orderController = new OrderController();
        $orderController->viewOrderDetails($_GET['orderId']);
        break;
    case 'admin/orders':
        $orderController = new OrderController();
        $orderController->listAdminOrders();
        break;
    case 'markOrderShipped':
        $orderController = new OrderController();
        $orderController->markOrderShipped($_GET['orderId']);
        break;
    case 'write_blog':
        $blogController = new BlogController();
        $blogController->showWriteBlogPage();
        break;
    case 'create_blog':
        $blogController = new BlogController();
        $blogController->createBlog();
        break;
    case 'admin/blogs':
        $blogController = new BlogController();
        $blogController->manageBlogsAdmin();
        break;
    case 'blog_details':
        $blogController = new BlogController();
        $blogController->viewBlogDetails($_GET['blogId']);
        break;
    case 'approve_blog':
        $blogController = new BlogController();
        $blogController->approveBlog($_GET['blogId']);
        break;
    case 'reject_blog':
        $blogController = new BlogController();
        $blogController->rejectBlog($_GET['blogId']);
        break;
    case 'delete_blog':
        $blogController = new BlogController();
        $blogController->deleteBlog($_GET['blogId']);
        break;
    case 'admin/blog-details':
        $blogController = new BlogController();
        $blogController->viewBlogDetails($_GET['blogId']);
        break;
    case 'admin/feedbacks':
        $adminController = new AdminController();
        $adminController->manageFeedbacks();
        break;
    case 'admin/feedback_details':
        $adminController = new AdminController();
        $adminController->viewFeedbackDetails($_GET['requestId']);
        break;
    case 'submit_contact':
        $contactController = new ContactController();
        $contactController->handleContactSubmission();
        break;
    default:
        include 'app/views/error.php';
        break;
}
