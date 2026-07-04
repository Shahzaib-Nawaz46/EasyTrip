<?php require_once __DIR__ . '/../layout/header.php'; 
require_once __DIR__ . '/../../src/Controllers/HotelController.php';

use EasyTrip\Controllers\HotelController;

// Initialize Controller
$controller = new HotelController($conn);
$data = $controller->index();
$destination = $data['destination'];
$hotels = $data['hotels'];
?>

<!-- Inject Custom Listing CSS -->
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/pages/hotel-listing.css">

<div class="container">
    <div class="listing-container">
        <!-- Sidebar Filters -->
        <aside class="filters-sidebar">
            <h3 class="filter-title" style="font-size: 18px; border-bottom: 1px solid #e7e7e7; padding-bottom: 12px; margin-bottom: 16px;">Filter by:</h3>
            
            <form method="GET" action="<?= BASE_URL ?>/hotels" id="filterForm">
                <!-- Keep existing destination/dates if any -->
                <input type="hidden" name="destination" value="<?= htmlspecialchars($_GET['destination'] ?? '') ?>">
                <input type="hidden" name="dates" value="<?= htmlspecialchars($_GET['dates'] ?? '') ?>">

                <div class="filter-section">
                    <h4 class="filter-title">Your budget (per night)</h4>
                    <?php 
                        $budgetFilter = $_GET['budget'] ?? [];
                    ?>
                    <div class="checkbox-group">
                        <input type="checkbox" name="budget[]" value="0-50" id="budget1" onchange="document.getElementById('filterForm').submit();" <?= in_array('0-50', $budgetFilter) ? 'checked' : '' ?>>
                        <label for="budget1">US$0 - US$50</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="budget[]" value="50-100" id="budget2" onchange="document.getElementById('filterForm').submit();" <?= in_array('50-100', $budgetFilter) ? 'checked' : '' ?>>
                        <label for="budget2">US$50 - US$100</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="budget[]" value="100+" id="budget3" onchange="document.getElementById('filterForm').submit();" <?= in_array('100+', $budgetFilter) ? 'checked' : '' ?>>
                        <label for="budget3">US$100 +</label>
                    </div>
                </div>

                <div class="filter-section">
                    <h4 class="filter-title">Property type</h4>
                    <?php 
                        $typeFilter = $_GET['type'] ?? [];
                    ?>
                    <div class="checkbox-group">
                        <input type="checkbox" name="type[]" value="Hotel" id="prop1" onchange="document.getElementById('filterForm').submit();" <?= in_array('Hotel', $typeFilter) ? 'checked' : '' ?>>
                        <label for="prop1">Hotels</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="type[]" value="Guest House" id="prop2" onchange="document.getElementById('filterForm').submit();" <?= in_array('Guest House', $typeFilter) ? 'checked' : '' ?>>
                        <label for="prop2">Guest Houses</label>
                    </div>
                </div>

                <div class="filter-section">
                    <h4 class="filter-title">Facilities</h4>
                    <?php 
                        $facFilter = $_GET['facilities'] ?? [];
                    ?>
                    <div class="checkbox-group">
                        <input type="checkbox" name="facilities[]" value="Free Wifi" id="fac1" onchange="document.getElementById('filterForm').submit();" <?= in_array('Free Wifi', $facFilter) ? 'checked' : '' ?>>
                        <label for="fac1">Free WiFi</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="facilities[]" value="Swimming Pool" id="fac2" onchange="document.getElementById('filterForm').submit();" <?= in_array('Swimming Pool', $facFilter) ? 'checked' : '' ?>>
                        <label for="fac2">Swimming Pool</label>
                    </div>
                    <div class="checkbox-group">
                        <input type="checkbox" name="facilities[]" value="Free parking" id="fac3" onchange="document.getElementById('filterForm').submit();" <?= in_array('Free parking', $facFilter) ? 'checked' : '' ?>>
                        <label for="fac3">Free parking</label>
                    </div>
                </div>
            </form>
        </aside>

        <!-- Results Area -->
        <main class="results-area">
            <div class="results-header">
                <h1 class="results-title">
                    <?= htmlspecialchars($destination ?: 'All Destinations') ?>: <?= count($hotels) ?> properties found
                </h1>
            </div>

            <div class="hotels-list">
                <?php if (count($hotels) > 0): ?>
                    <?php foreach ($hotels as $hotel): 
                        $images = json_decode($hotel['image_urls']);
                        $img = (!empty($images) && isset($images[0])) ? $images[0] : 'https://via.placeholder.com/300x200';
                    ?>
                        <article class="htl-card">
                            <div class="htl-img-wrapper">
                                <a href="<?= BASE_URL ?>/hotel-detail?id=<?= $hotel['id'] ?>" style="display: block; height: 100%;">
                                    <img src="<?= $img ?>" alt="<?= htmlspecialchars($hotel['name']) ?>">
                                </a>
                            </div>
                            <div class="htl-content">
                                <div class="htl-header-row">
                                    <div>
                                        <a href="<?= BASE_URL ?>/hotel-detail?id=<?= $hotel['id'] ?>" class="htl-name">
                                            <?= htmlspecialchars($hotel['name']) ?>
                                        </a>
                                        <div class="htl-location-wrap">
                                            <a href="#" class="htl-location"><?= htmlspecialchars($hotel['city']) ?></a>
                                            <span class="htl-distance"><?= htmlspecialchars($hotel['distance_from_center']) ?> from center</span>
                                        </div>
                                    </div>
                                    <div class="htl-rating-box">
                                        <div class="htl-rating-text">
                                            <div class="htl-rating-word">Excellent</div>
                                            <div class="htl-rating-count"><?= $hotel['total_reviews'] ?> reviews</div>
                                        </div>
                                        <div class="htl-rating-score"><?= $hotel['rating_score'] ?></div>
                                    </div>
                                </div>
                                
                                <p class="htl-desc">
                                    <?= htmlspecialchars(substr($hotel['description'], 0, 150)) ?>...
                                </p>

                                <div class="htl-bottom-row">
                                    <div class="htl-badges">
                                        <?php 
                                        $facCount = 0;
                                        foreach($hotel['facilities'] as $fac): 
                                            if($facCount >= 2) break;
                                        ?>
                                            <div class="htl-badge-item">
                                                <i class="fa-solid <?= $fac['icon_name'] ?>"></i> <?= $fac['facility_name'] ?>
                                            </div>
                                        <?php 
                                            $facCount++;
                                        endforeach; 
                                        ?>
                                        <?php if(isset($hotel['cancellation_policy']) && strpos(strtolower($hotel['cancellation_policy']), 'free') !== false): ?>
                                            <div class="htl-badge-item" style="color: #008234; margin-top: 4px;">
                                                <i class="fa-solid fa-check"></i> Free cancellation
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="htl-price-area">
                                        <?php if($hotel['min_price']): ?>
                                            <div class="htl-price-label">Price from</div>
                                            <div class="htl-price-val">US$<?= $hotel['min_price'] ?></div>
                                        <?php endif; ?>
                                        <a href="<?= BASE_URL ?>/hotel-detail?id=<?= $hotel['id'] ?>" class="htl-btn-primary">See availability <i class="fa-solid fa-chevron-right" style="margin-left:4px; font-size:12px;"></i></a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="padding: 24px; background: #fff; border: 1px solid #e7e7e7; border-radius: 8px;">
                        <h4 style="margin:0; color: #1a1a1a;">No properties found</h4>
                        <p style="margin-top: 8px; color: #6b6b6b;">Try changing your destination or filters.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
