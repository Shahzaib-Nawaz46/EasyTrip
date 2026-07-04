<?php

/**
 * EasyTrip Main Entry Point
 */

// Enable strict typing for better architecture
declare(strict_types=1);

// Error reporting for development
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Initialize Session
session_start();

// Database connection
require_once __DIR__ . '/../config/db.php';

// Basic Routing
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base_path = '/EasyTrip/public'; // Adjust if needed

// Remove base path from URI
$path = str_replace($base_path, '', $request_uri);
if ($path === '') $path = '/';

// Admin Authentication Middleware
if (strpos($path, '/admin') === 0 && $path !== '/admin/login') {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header("Location: $base_path/admin/login");
        exit;
    }
}

// Controller routing
switch ($path) {
    case '/':
        require_once __DIR__ . '/../src/Controllers/HomeController.php';
        $controller = new \EasyTrip\Controllers\HomeController($conn);
        $controller->index();
        break;
        
    case '/flights':
        require_once __DIR__ . '/../views/pages/flights.php';
        break;
        
    case '/hotels':
        require_once __DIR__ . '/../views/pages/hotels.php';
        break;
        
    case '/hotel-detail':
        require_once __DIR__ . '/../src/Controllers/HotelController.php';
        $controller = new \EasyTrip\Controllers\HotelController($conn);
        $controller->show();
        break;

    case '/checkout':
        require_once __DIR__ . '/../src/Controllers/BookingController.php';
        $controller = new \EasyTrip\Controllers\BookingController($conn);
        $controller->checkout();
        break;

    case '/book':
        require_once __DIR__ . '/../src/Controllers/BookingController.php';
        $controller = new \EasyTrip\Controllers\BookingController($conn);
        $controller->store();
        break;
        
    case '/booking-success':
        require_once __DIR__ . '/../views/pages/booking-success.php';
        break;
        
    case '/admin/login':
        require_once __DIR__ . '/../src/Controllers/AdminAuthController.php';
        $authController = new \EasyTrip\Controllers\AdminAuthController();
        $authController->login();
        break;
        
    case '/admin/logout':
        require_once __DIR__ . '/../src/Controllers/AdminAuthController.php';
        $authController = new \EasyTrip\Controllers\AdminAuthController();
        $authController->logout();
        break;
        
    case '/admin':
        require_once __DIR__ . '/../src/Controllers/AdminController.php';
        $adminController = new \EasyTrip\Controllers\AdminController($conn);
        $adminController->dashboard();
        break;
        
    case '/admin/hotels':
        require_once __DIR__ . '/../views/admin/pages/hotels.php';
        break;
        
    default:
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        break;
}
?>
