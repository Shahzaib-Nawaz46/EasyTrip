<?php
namespace EasyTrip\Controllers;

class HomeController {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function index() {
        // Fetch featured properties
        $sql = "SELECT id, name, city, image_urls, rating_score, total_reviews FROM hotels ORDER BY id DESC LIMIT 4";
        $featuredHotels = [];
        if ($result = $this->conn->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $featuredHotels[] = $row;
            }
        }

        // Fetch distinct cities for the destination dropdown
        $citiesQuery = "SELECT DISTINCT city FROM hotels ORDER BY city";
        $availableCities = [];
        if ($res = $this->conn->query($citiesQuery)) {
            while ($row = $res->fetch_assoc()) {
                if (!empty($row['city'])) {
                    $availableCities[] = $row['city'];
                }
            }
        }

        // Pass data to view by requiring it
        require_once __DIR__ . '/../../views/pages/home.php';
    }
}
?>
