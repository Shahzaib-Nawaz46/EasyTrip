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

// Basic Routing
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$base_path = '/EasyTrip/public'; // Adjust if needed

// Remove base path from URI
$path = str_replace($base_path, '', $request_uri);
if ($path === '') $path = '/';

switch ($path) {
    case '/':
        require_once __DIR__ . '/../views/pages/home.php';
        break;
    case '/flights':
        require_once __DIR__ . '/../views/pages/flights.php';
        break;
    case '/hotels':
        require_once __DIR__ . '/../views/pages/hotels.php';
        break;
    case '/admin':
        require_once __DIR__ . '/../views/admin/pages/dashboard.php';
        break;
    case '/admin/categories':
        require_once __DIR__ . '/../views/admin/pages/categories.php';
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
