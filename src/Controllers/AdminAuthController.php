<?php
namespace EasyTrip\Controllers;

class AdminAuthController {

    public function login() {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Include db.php locally so $conn is available in this scope
            require __DIR__ . '/../../db.php';

            $username = $conn->real_escape_string($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            $result = $conn->query("SELECT * FROM admins WHERE username = '$username'");
            if ($result && $result->num_rows > 0) {
                $admin = $result->fetch_assoc();
                // For demonstration/migration we check direct string matching first, then hash if implemented
                if ($password === $admin['password']) {
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_username'] = $admin['username'];
                    header("Location: /EasyTrip/public/admin");
                    exit;
                } else {
                    $error = 'Invalid credentials';
                }
            } else {
                $error = 'Invalid credentials';
            }
        }
        
        require_once __DIR__ . '/../../views/admin/pages/login.php';
    }

    public function logout() {
        session_destroy();
        header("Location: /EasyTrip/public/admin/login");
        exit;
    }
}
?>
