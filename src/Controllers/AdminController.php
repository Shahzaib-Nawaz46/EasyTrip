<?php
namespace EasyTrip\Controllers;

class AdminController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function dashboard() {
        // Fetch Stats
        $hotelsResult = $this->conn->query("SELECT COUNT(*) as count FROM hotels");
        $totalHotels = $hotelsResult ? $hotelsResult->fetch_assoc()['count'] : 0;

        $bookingsResult = $this->conn->query("SELECT COUNT(*) as count FROM bookings");
        $totalBookings = $bookingsResult ? $bookingsResult->fetch_assoc()['count'] : 0;

        $revResult = $this->conn->query("SELECT SUM(total_amount) as rev FROM bookings WHERE booking_status='Confirmed'");
        if (!$revResult) {
            $revResult = $this->conn->query("SELECT SUM(total_price) as rev FROM bookings WHERE status='Confirmed'");
        }
        $totalRevenue = $revResult ? ($revResult->fetch_assoc()['rev'] ?? 0) : 0;

        // Fetch Recent Bookings
        $recentBookings = [];
        $res = $this->conn->query("SELECT * FROM bookings ORDER BY created_at DESC LIMIT 5");
        if ($res && $res->num_rows > 0) {
            while ($b = $res->fetch_assoc()) {
                $recentBookings[] = $b;
            }
        }

        // Render View
        require_once __DIR__ . '/../../views/admin/pages/dashboard.php';
    }
}
?>
