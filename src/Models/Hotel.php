<?php
namespace EasyTrip\Models;

class Hotel {
    private $db;

    public function __construct($dbConnection) {
        $this->db = $dbConnection;
    }

    public function searchHotels($destination, $filters = []) {
        $destination = $this->db->real_escape_string($destination);
        
        $sql = "SELECT h.*, MIN(r.price_per_night) as min_price 
                FROM hotels h 
                LEFT JOIN rooms r ON h.id = r.hotel_id ";

        $whereClauses = [];
        if (!empty($destination)) {
            $whereClauses[] = "(h.city LIKE '%$destination%' OR h.name LIKE '%$destination%')";
        }
        
        // Property Type Filter
        if (!empty($filters['type']) && is_array($filters['type'])) {
            $types = array_map(function($t) { return "'" . $this->db->real_escape_string($t) . "'"; }, $filters['type']);
            $whereClauses[] = "h.property_type IN (" . implode(',', $types) . ")";
        }

        // Facilities Filter (Requires a subquery or join, simplest is EXISTS for now)
        if (!empty($filters['facilities']) && is_array($filters['facilities'])) {
            foreach ($filters['facilities'] as $fac) {
                $facSafe = $this->db->real_escape_string($fac);
                $whereClauses[] = "EXISTS (SELECT 1 FROM hotel_facilities hf WHERE hf.hotel_id = h.id AND hf.facility_name = '$facSafe')";
            }
        }

        if (count($whereClauses) > 0) {
            $sql .= " WHERE " . implode(' AND ', $whereClauses);
        }

        $sql .= " GROUP BY h.id";

        // Budget Filter (using HAVING since it's an aggregated min_price)
        if (!empty($filters['budget']) && is_array($filters['budget'])) {
            $havingClauses = [];
            foreach ($filters['budget'] as $b) {
                if ($b === '0-50') $havingClauses[] = "min_price <= 50";
                if ($b === '50-100') $havingClauses[] = "(min_price > 50 AND min_price <= 100)";
                if ($b === '100+') $havingClauses[] = "min_price > 100";
            }
            if (count($havingClauses) > 0) {
                $sql .= " HAVING " . implode(' OR ', $havingClauses);
            }
        }

        $result = $this->db->query($sql);
        $hotels = [];
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Fetch facilities for this hotel
                $facSql = "SELECT facility_name, icon_name FROM hotel_facilities WHERE hotel_id = " . $row['id'] . " LIMIT 4";
                $facResult = $this->db->query($facSql);
                $facilities = [];
                while ($fac = $facResult->fetch_assoc()) {
                    $facilities[] = $fac;
                }
                $row['facilities'] = $facilities;
                $hotels[] = $row;
            }
        }
        return $hotels;
    }
    
    public function getHotelById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM hotels WHERE id = $id";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
}
?>
