<?php
namespace EasyTrip\Controllers;

require_once __DIR__ . '/../Models/Hotel.php';
use EasyTrip\Models\Hotel;

class HotelController {
    private $hotelModel;
    private $conn;

    public function __construct($dbConnection) {
        $this->hotelModel = new Hotel($dbConnection);
        $this->conn = $dbConnection;
    }

    public function index() {
        $destination = isset($_GET['destination']) ? $_GET['destination'] : '';
        $hotels = $this->hotelModel->searchHotels($destination, $_GET);
        return [
            'destination' => $destination,
            'hotels' => $hotels
        ];
    }

    public function show() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if (!$id) {
            die("Hotel ID not provided.");
        }

        $sql = "SELECT * FROM hotels WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            die("Hotel not found.");
        }

        $hotel = $result->fetch_assoc();
        $images = json_decode($hotel['image_urls']);
        if (empty($images)) {
            $images = ['https://via.placeholder.com/800x400'];
        }

        $dates = isset($_GET['dates']) ? $_GET['dates'] : '';
        $adults = isset($_GET['adults']) ? (int)$_GET['adults'] : 2;
        $children = isset($_GET['children']) ? (int)$_GET['children'] : 0;
        $rooms = isset($_GET['rooms']) ? (int)$_GET['rooms'] : 1;

        // Fetch Facilities
        $facStmt = $this->conn->prepare("SELECT facility_name, icon_name FROM hotel_facilities WHERE hotel_id = ?");
        $facStmt->bind_param("i", $id);
        $facStmt->execute();
        $facilities = $facStmt->get_result()->fetch_all(MYSQLI_ASSOC);

        // Fetch Rooms
        $roomStmt = $this->conn->prepare("SELECT * FROM rooms WHERE hotel_id = ?");
        $roomStmt->bind_param("i", $id);
        $roomStmt->execute();
        $hotelRooms = $roomStmt->get_result()->fetch_all(MYSQLI_ASSOC);

        // Render view
        require_once __DIR__ . '/../../views/pages/hotel-detail.php';
    }
}
?>
