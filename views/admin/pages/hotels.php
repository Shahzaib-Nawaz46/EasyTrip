<?php 
require_once __DIR__ . '/../layout/header.php';
require_once __DIR__ . '/../layout/sidebar.php';

$message = '';
// Handle Add Hotel Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_hotel') {
    $name = $conn->real_escape_string($_POST['name']);
    $property_type = $conn->real_escape_string($_POST['property_type']);
    $city = $conn->real_escape_string($_POST['city']);
    $address = $conn->real_escape_string($_POST['address']);
    $description = $conn->real_escape_string($_POST['description']);
    $distance = $conn->real_escape_string($_POST['distance_from_center'] ?? '0 km');
    
    // Check if table has new columns, if not fallback
    $checkCols = $conn->query("SHOW COLUMNS FROM hotels LIKE 'property_type'");
    if ($checkCols && $checkCols->num_rows > 0) {
        $sql = "INSERT INTO hotels (name, property_type, city, address, description, distance_from_center, image_urls) 
                VALUES ('$name', '$property_type', '$city', '$address', '$description', '$distance', '[]')";
    } else {
        // Fallback for old schema
        $sql = "INSERT INTO hotels (name, city, address, description, image_urls) 
                VALUES ('$name', '$city', '$address', '$description', '[]')";
    }
    
    if ($conn->query($sql) === TRUE) {
        $message = "Hotel added successfully!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

// Fetch existing hotels
$hotelsList = $conn->query("SELECT * FROM hotels ORDER BY id DESC");
?>

<main class="admin-content">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h1 style="margin-bottom: 8px;">Local Hotels</h1>
            <p>Manage your own hotel inventory.</p>
        </div>
        <button class="btn btn-primary" style="background: #0071c2; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor:pointer;" onclick="document.getElementById('add-hotel-form').style.display='block';">+ Add New Hotel</button>
    </div>
    
    <?php if($message): ?>
        <div style="background: #e6f9ed; color: #008234; padding: 12px; border-radius: 4px; margin-top: 16px; border: 1px solid #008234;">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <!-- Add Hotel Form (Hidden by default) -->
    <div id="add-hotel-form" style="display: none; background: #fff; padding: 24px; border-radius: 8px; border: 1px solid #e7e7e7; margin-top: 24px;">
        <h3 style="margin-bottom: 16px;">Add New Hotel</h3>
        <form method="POST" action="">
            <input type="hidden" name="action" value="add_hotel">
            <div style="display: flex; gap: 16px; margin-bottom: 16px;">
                <div style="flex: 1;">
                    <label style="display:block; margin-bottom: 6px; font-weight: bold;">Hotel Name</label>
                    <input type="text" name="name" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
                <div style="flex: 1;">
                    <label style="display:block; margin-bottom: 6px; font-weight: bold;">Property Type</label>
                    <select name="property_type" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="Hotel">Hotel</option>
                        <option value="Resort">Resort</option>
                        <option value="Guest House">Guest House</option>
                    </select>
                </div>
            </div>
            
            <div style="display: flex; gap: 16px; margin-bottom: 16px;">
                <div style="flex: 1;">
                    <label style="display:block; margin-bottom: 6px; font-weight: bold;">City</label>
                    <select name="city" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                        <option value="">Select a City...</option>
                        <?php 
                        $cities = $conn->query("SELECT name FROM cities ORDER BY name ASC");
                        if ($cities && $cities->num_rows > 0) {
                            while ($c = $cities->fetch_assoc()) {
                                echo '<option value="' . htmlspecialchars($c['name']) . '">' . htmlspecialchars($c['name']) . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div style="flex: 1;">
                    <label style="display:block; margin-bottom: 6px; font-weight: bold;">Distance from center</label>
                    <input type="text" name="distance_from_center" placeholder="e.g. 2.5 km" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                </div>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display:block; margin-bottom: 6px; font-weight: bold;">Address</label>
                <input type="text" name="address" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="display:block; margin-bottom: 6px; font-weight: bold;">Description</label>
                <textarea name="description" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
            </div>

            <div style="text-align: right;">
                <button type="button" onclick="document.getElementById('add-hotel-form').style.display='none';" style="background: #ccc; border: none; padding: 10px 20px; border-radius: 4px; cursor:pointer; margin-right: 8px;">Cancel</button>
                <button type="submit" style="background: #008234; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor:pointer;">Save Hotel</button>
            </div>
        </form>
    </div>

    <table style="width:100%; margin-top: 2rem; background:white; border-radius:8px; border-collapse: collapse; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
        <thead>
            <tr style="border-bottom: 2px solid #e7e7e7; text-align: left;">
                <th style="padding: 16px; color: #6b6b6b;">ID</th>
                <th style="padding: 16px; color: #6b6b6b;">Hotel Name</th>
                <th style="padding: 16px; color: #6b6b6b;">City</th>
                <th style="padding: 16px; color: #6b6b6b;">Type</th>
                <th style="padding: 16px; color: #6b6b6b;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($hotelsList && $hotelsList->num_rows > 0): ?>
                <?php while($row = $hotelsList->fetch_assoc()): ?>
                <tr style="border-bottom: 1px solid #e7e7e7;">
                    <td style="padding: 16px; font-weight:bold; color: #0071c2;">#<?= $row['id'] ?></td>
                    <td style="padding: 16px; font-weight: bold;"><?= htmlspecialchars($row['name']) ?></td>
                    <td style="padding: 16px;"><?= htmlspecialchars($row['city']) ?></td>
                    <td style="padding: 16px;">
                        <span style="background: #f0f0f0; padding: 4px 8px; border-radius: 4px; font-size:12px;">
                            <?= htmlspecialchars($row['property_type'] ?? 'Hotel') ?>
                        </span>
                    </td>
                    <td style="padding: 16px;">
                        <button style="background: #0071c2; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size:12px; cursor:pointer;">Edit</button>
                        <button style="background: #d9534f; color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size:12px; cursor:pointer;">Delete</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
            <tr>
                <td style="padding: 16px; text-align: center;" colspan="5">No local hotels found.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
