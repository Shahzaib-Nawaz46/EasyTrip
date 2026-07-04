<?php
namespace EasyTrip\Controllers;

class BookingController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function checkout() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /EasyTrip/public/');
            exit;
        }

        $hotel_id = (int)$_POST['hotel_id'];
        $dates = $_POST['dates'] ?? '';
        $adults = $_POST['adults'] ?? 2;
        $children = $_POST['children'] ?? 0;
        $rooms = $_POST['rooms'] ?? 1;

        // Fetch hotel and room
        $sql = "SELECT h.name as hotel_name, h.city, h.address, h.image_urls, r.id as room_id, r.room_type, r.price_per_night 
                FROM hotels h 
                LEFT JOIN rooms r ON h.id = r.hotel_id 
                WHERE h.id = $hotel_id LIMIT 1";
        $res = $this->conn->query($sql);
        $hotel = $res ? $res->fetch_assoc() : null;

        if (!$hotel) {
            die("Hotel not found.");
        }

        $check_in = date('Y-m-d');
        $check_out = date('Y-m-d', strtotime('+1 day'));
        if (strpos($dates, ' to ') !== false) {
            $dateParts = explode(' to ', $dates);
            if (count($dateParts) == 2) {
                $check_in = date('Y-m-d', strtotime($dateParts[0]));
                $check_out = date('Y-m-d', strtotime($dateParts[1]));
            }
        }
        $diff = strtotime($check_out) - strtotime($check_in);
        $nights = round($diff / 86400);
        if ($nights < 1) $nights = 1;

        $room_id = $hotel['room_id'] ?? 1;
        $price_per_night = $hotel['price_per_night'] ?? 199.00;
        $total_price = $price_per_night * $nights * $rooms;

        require_once __DIR__ . '/../../views/pages/checkout.php';
    }

    public function store() {

        $hotel_id = (int)$_POST['hotel_id'];
        $dates = $_POST['dates'] ?? '';
        
        // Parse dates: "M j, Y to M j, Y" (flatpickr range format)
        // Note: flatpickr uses 'to' by default, or depends on config. 
        // If string contains 'to', we split.
        $check_in = date('Y-m-d');
        $check_out = date('Y-m-d', strtotime('+1 day'));

        if (strpos($dates, ' to ') !== false) {
            $dateParts = explode(' to ', $dates);
            if (count($dateParts) == 2) {
                $check_in = date('Y-m-d', strtotime($dateParts[0]));
                $check_out = date('Y-m-d', strtotime($dateParts[1]));
            }
        }

        $user_id = 1; // Default dummy user
        $room_id = 1; // Default fallback room
        $total_price = 199.00; 

        // Fetch a valid room for this hotel
        $room_id = (int)$_POST['room_id'];
        $total_price = (float)$_POST['total_price'];

        $stmt = $this->conn->prepare("INSERT INTO bookings (user_id, hotel_id, room_id, check_in_date, check_out_date, total_price, status) VALUES (?, ?, ?, ?, ?, ?, 'Confirmed')");
        if ($stmt) {
            $stmt->bind_param("iiissd", $user_id, $hotel_id, $room_id, $check_in, $check_out, $total_price);
            
            if ($stmt->execute()) {
                header('Location: /EasyTrip/public/booking-success');
                exit;
            } else {
                echo "<script>alert('Booking Failed. Please try again.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Database Error.'); window.history.back();</script>";
        }
    }
}
?>
