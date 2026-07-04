<?php require_once __DIR__ . '/../layout/header.php'; ?>

<style>
    :root {
        --c-surface: #ffffff;
        --c-surface-hover: #f7f9fa;
        --c-border: #e7e7e7;
        --c-text-main: #1a1a1a;
        --c-text-light: #6b6b6b;
        --c-primary: #0071c2;
        --c-primary-hover: #005999;
        --c-accent: #008234;
        --radius-lg: 12px;
        --radius-md: 8px;
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
        --shadow-lg: 0 8px 24px rgba(0,0,0,0.12);
        --font-stack: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    }

    body {
        background-color: #f7f9fa;
        font-family: var(--font-stack);
        color: var(--c-text-main);
    }

    .hotel-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 24px;
    }

    /* Breadcrumbs */
    .breadcrumb-area {
        margin-bottom: 24px;
        font-size: 14px;
        color: var(--c-text-light);
    }
    .breadcrumb-area a {
        color: var(--c-primary);
        text-decoration: none;
        font-weight: 500;
    }
    .breadcrumb-area a:hover {
        text-decoration: underline;
    }

    /* Hero Gallery */
    .hero-gallery {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        grid-template-rows: 250px 250px;
        gap: 12px;
        border-radius: var(--radius-lg);
        overflow: hidden;
        margin-bottom: 32px;
    }
    .hero-gallery-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.4s ease, filter 0.3s ease;
    }
    .hero-gallery-item {
        overflow: hidden;
        position: relative;
    }
    .hero-gallery-item:hover .hero-gallery-img {
        transform: scale(1.05);
        filter: brightness(0.9);
    }
    .hero-gallery-item:first-child {
        grid-row: 1 / -1;
    }
    
    .gallery-overlay-btn {
        position: absolute;
        bottom: 16px;
        right: 16px;
        background: rgba(255, 255, 255, 0.95);
        border: none;
        padding: 8px 16px;
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        box-shadow: var(--shadow-sm);
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background 0.2s;
    }
    .gallery-overlay-btn:hover {
        background: #fff;
    }

    /* Header Actions */
    .header-actions {
        display: flex;
        gap: 12px;
    }
    .btn-icon {
        background: transparent;
        border: none;
        color: var(--c-primary);
        font-size: 20px;
        cursor: pointer;
        padding: 8px;
        border-radius: 50%;
        transition: background 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .btn-icon:hover {
        background: var(--c-surface-hover);
    }

    /* Main Layout */
    .hotel-layout {
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 32px;
        align-items: start;
    }

    /* Typography & Core Elements */
    .hotel-title {
        font-size: 32px;
        font-weight: 800;
        margin: 0 0 8px 0;
        line-height: 1.2;
    }
    .hotel-meta {
        display: flex;
        align-items: center;
        gap: 16px;
        color: var(--c-text-light);
        margin-bottom: 24px;
        font-size: 15px;
    }
    .star-rating {
        color: #febb02;
        font-size: 14px;
    }
    .badge-type {
        background: #f0f0f0;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        color: var(--c-text-main);
    }
    
    .section-block {
        background: var(--c-surface);
        padding: 32px;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-sm);
        margin-bottom: 32px;
        border: 1px solid var(--c-border);
    }
    .section-title {
        font-size: 24px;
        font-weight: 700;
        margin: 0 0 24px 0;
    }

    /* Highlights */
    .highlights-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 16px;
    }
    .highlight-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        border: 1px solid var(--c-border);
        border-radius: var(--radius-md);
        font-weight: 500;
    }
    .highlight-card i {
        color: var(--c-primary);
        font-size: 20px;
        width: 24px;
        text-align: center;
    }

    /* Room Table */
    .room-card {
        border: 1px solid var(--c-border);
        border-radius: var(--radius-md);
        margin-bottom: 16px;
        display: grid;
        grid-template-columns: 200px 1fr 200px;
        overflow: hidden;
    }
    .room-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .room-details {
        padding: 20px;
        border-right: 1px solid var(--c-border);
    }
    .room-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0 0 12px 0;
    }
    .room-amenities ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
        font-size: 14px;
        color: var(--c-text-light);
    }
    .room-amenities li::before {
        content: "✓";
        color: var(--c-accent);
        margin-right: 8px;
        font-weight: bold;
    }
    .room-price-action {
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        background: var(--c-surface-hover);
    }
    .room-price {
        font-size: 24px;
        font-weight: 800;
        color: var(--c-text-main);
        margin-bottom: 4px;
    }

    /* Sticky Sidebar */
    .sticky-sidebar {
        position: sticky;
        top: 24px;
    }
    .booking-card {
        background: var(--c-surface);
        padding: 24px;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--c-border);
    }
    .booking-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        padding-bottom: 24px;
        border-bottom: 1px solid var(--c-border);
    }
    .booking-price {
        font-size: 28px;
        font-weight: 800;
    }
    .form-group {
        margin-bottom: 16px;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--c-text-main);
    }
    .form-control {
        width: 100%;
        padding: 12px;
        border: 1px solid var(--c-border);
        border-radius: var(--radius-md);
        font-size: 15px;
        font-family: inherit;
    }
    .form-control:focus {
        outline: none;
        border-color: var(--c-primary);
        box-shadow: 0 0 0 3px rgba(0,113,194,0.1);
    }
    .btn-reserve {
        width: 100%;
        background: var(--c-primary);
        color: white;
        border: none;
        padding: 16px;
        font-size: 16px;
        font-weight: 700;
        border-radius: var(--radius-md);
        cursor: pointer;
        transition: background 0.2s;
        margin-top: 8px;
    }
    .btn-reserve:hover {
        background: var(--c-primary-hover);
    }

    .urgency-badge {
        background: #fdf3f2;
        color: #d32f2f;
        padding: 8px 12px;
        border-radius: var(--radius-md);
        font-size: 13px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 16px;
    }

    /* Reviews */
    .review-summary {
        display: flex;
        align-items: center;
        gap: 24px;
        margin-bottom: 32px;
    }
    .review-score-box {
        background: var(--c-primary);
        color: white;
        width: 80px;
        height: 80px;
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        font-weight: 800;
    }
    .review-text h3 {
        margin: 0 0 4px 0;
        font-size: 20px;
    }
    .progress-bar-bg {
        background: var(--c-border);
        height: 8px;
        border-radius: 4px;
        overflow: hidden;
        margin-top: 8px;
    }
    .progress-bar-fill {
        background: var(--c-primary);
        height: 100%;
    }

    /* Accordion */
    .accordion-item {
        border-bottom: 1px solid var(--c-border);
        padding: 16px 0;
    }
    .accordion-header {
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    @media (max-width: 992px) {
        .hotel-layout {
            grid-template-columns: 1fr;
        }
        .hero-gallery {
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 200px 200px;
        }
        .hero-gallery-item:first-child {
            grid-column: 1 / -1;
            grid-row: 1;
        }
        .room-card {
            grid-template-columns: 1fr;
        }
        .room-img {
            height: 200px;
        }
    }
</style>

<div class="hotel-container">
    <!-- Breadcrumbs -->
    <div class="breadcrumb-area">
        <a href="/EasyTrip/public/">Home</a> > 
        <a href="#"><?= htmlspecialchars($hotel['city']) ?></a> > 
        <span><?= htmlspecialchars($hotel['name']) ?></span>
    </div>

    <!-- Title & Header Actions -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 24px;">
        <div>
            <span class="badge-type"><?= htmlspecialchars($hotel['property_type'] ?? 'Hotel') ?></span>
            <div class="star-rating" style="margin: 8px 0;">
                <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
            </div>
            <h1 class="hotel-title"><?= htmlspecialchars($hotel['name']) ?></h1>
            <div class="hotel-meta">
                <span><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($hotel['address']) ?>, <?= htmlspecialchars($hotel['city']) ?></span>
                <?php if(!empty($hotel['distance_from_center'])): ?>
                    <span><i class="fa-solid fa-person-walking"></i> <?= htmlspecialchars($hotel['distance_from_center']) ?> to center</span>
                <?php endif; ?>
            </div>
        </div>
        <div class="header-actions">
            <button class="btn-icon" title="Save to Wishlist"><i class="fa-regular fa-heart"></i></button>
            <button class="btn-icon" title="Share"><i class="fa-solid fa-share-nodes"></i></button>
        </div>
    </div>

    <!-- Masonry Hero Gallery -->
    <div class="hero-gallery">
        <?php 
            $imgs = [];
            if (isset($images[0])) $imgs[] = $images[0];
            if (isset($images[1])) $imgs[] = $images[1];
            else $imgs[] = 'https://images.unsplash.com/photo-1582719508461-905c673771fd?w=800';
            if (isset($images[2])) $imgs[] = $images[2];
            else $imgs[] = 'https://images.unsplash.com/photo-1542314831-c6a4d27ece50?w=800';
            if (isset($images[3])) $imgs[] = $images[3];
            else $imgs[] = 'https://images.unsplash.com/photo-1551882547-ff40c0d129df?w=800';
            if (isset($images[4])) $imgs[] = $images[4];
            else $imgs[] = 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800';
        ?>
        <div class="hero-gallery-item"><img src="<?= htmlspecialchars($imgs[0]) ?>" class="hero-gallery-img" alt="Main"></div>
        <div class="hero-gallery-item"><img src="<?= htmlspecialchars($imgs[1]) ?>" class="hero-gallery-img" alt="Sub 1"></div>
        <div class="hero-gallery-item"><img src="<?= htmlspecialchars($imgs[2]) ?>" class="hero-gallery-img" alt="Sub 2"></div>
        <div class="hero-gallery-item"><img src="<?= htmlspecialchars($imgs[3]) ?>" class="hero-gallery-img" alt="Sub 3"></div>
        <div class="hero-gallery-item">
            <img src="<?= htmlspecialchars($imgs[4]) ?>" class="hero-gallery-img" alt="Sub 4">
            <button class="gallery-overlay-btn"><i class="fa-solid fa-images"></i> Show all photos</button>
        </div>
    </div>

    <!-- Main Layout Grid -->
    <div class="hotel-layout">
        <!-- Left Content Area -->
        <div class="main-content">
            
            <!-- Property Highlights -->
            <div class="section-block">
                <h2 class="section-title">Property Highlights</h2>
                <div class="highlights-grid">
                    <?php if (!empty($facilities)): ?>
                        <?php foreach($facilities as $fac): ?>
                        <div class="highlight-card">
                            <i class="fa-solid <?= htmlspecialchars($fac['icon_name']) ?>"></i>
                            <span><?= htmlspecialchars($fac['facility_name']) ?></span>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Fallback Highlights -->
                        <div class="highlight-card"><i class="fa-solid fa-wifi"></i><span>Free High-Speed WiFi</span></div>
                        <div class="highlight-card"><i class="fa-solid fa-water"></i><span>Outdoor Pool</span></div>
                        <div class="highlight-card"><i class="fa-solid fa-spa"></i><span>Luxury Spa</span></div>
                        <div class="highlight-card"><i class="fa-solid fa-square-parking"></i><span>Free Parking</span></div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Description -->
            <div class="section-block">
                <h2 class="section-title">About this property</h2>
                <div style="font-size: 16px; line-height: 1.7; color: var(--c-text-light);">
                    <?= nl2br(htmlspecialchars($hotel['description'])) ?>
                    <br><br>
                    <strong>Perfect for:</strong> Business travelers, couples, and family vacations seeking a premium experience with world-class hospitality.
                </div>
            </div>

            <!-- Room Selection -->
            <div class="section-block" id="rooms-section">
                <h2 class="section-title">Available Rooms</h2>
                
                <?php if(!empty($hotelRooms)): ?>
                    <?php foreach($hotelRooms as $room): ?>
                    <div class="room-card">
                        <div>
                            <img src="<?= htmlspecialchars($imgs[1]) ?>" class="room-img" alt="Room">
                        </div>
                        <div class="room-details">
                            <h3 class="room-title"><?= htmlspecialchars($room['room_type']) ?></h3>
                            <div style="margin-bottom: 16px; font-size: 14px; color: var(--c-text-light);">
                                <i class="fa-solid fa-user"></i> Max Guests: <?= $room['max_guests'] ?? 2 ?> | <i class="fa-solid fa-bed"></i> 1 Large Double Bed
                            </div>
                            <div class="room-amenities">
                                <ul>
                                    <li>City view</li>
                                    <li>Air conditioning</li>
                                    <li>Flat-screen TV</li>
                                    <li>Free WiFi</li>
                                </ul>
                            </div>
                            <div style="margin-top: 16px; color: var(--c-accent); font-weight: 600; font-size: 14px;">
                                <i class="fa-solid fa-check"></i> Free cancellation before check-in<br>
                                <i class="fa-solid fa-mug-hot"></i> Breakfast included
                            </div>
                        </div>
                        <div class="room-price-action">
                            <div style="text-align: center;">
                                <div class="room-price">US$<?= number_format($room['price_per_night'], 0) ?></div>
                                <div style="font-size: 13px; color: var(--c-text-light); margin-bottom: 16px;">includes taxes & fees</div>
                                <!-- Instead of form, we scroll to sticky widget or redirect to checkout with this room ID -->
                                <button class="btn-reserve" style="padding: 10px;" onclick="document.getElementById('checkout-form').submit();">Select Room</button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No rooms currently available.</p>
                <?php endif; ?>
            </div>

            <!-- Guest Reviews (Mock Data for UI UX) -->
            <div class="section-block">
                <h2 class="section-title">Guest Reviews</h2>
                <div class="review-summary">
                    <div class="review-score-box"><?= $hotel['rating_score'] ?></div>
                    <div class="review-text">
                        <h3>Exceptional</h3>
                        <p style="color: var(--c-text-light); margin: 0;">Based on <?= $hotel['total_reviews'] ?> verified reviews</p>
                    </div>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px;">
                    <div>
                        <div style="display: flex; justify-content: space-between; font-size: 14px;"><span>Cleanliness</span><span>9.8</span></div>
                        <div class="progress-bar-bg"><div class="progress-bar-fill" style="width: 98%;"></div></div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; font-size: 14px;"><span>Comfort</span><span>9.5</span></div>
                        <div class="progress-bar-bg"><div class="progress-bar-fill" style="width: 95%;"></div></div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; font-size: 14px;"><span>Staff</span><span>9.6</span></div>
                        <div class="progress-bar-bg"><div class="progress-bar-fill" style="width: 96%;"></div></div>
                    </div>
                    <div>
                        <div style="display: flex; justify-content: space-between; font-size: 14px;"><span>Location</span><span>9.9</span></div>
                        <div class="progress-bar-bg"><div class="progress-bar-fill" style="width: 99%;"></div></div>
                    </div>
                </div>
            </div>

            <!-- Policies & FAQs (Mock Data for UI UX) -->
            <div class="section-block">
                <h2 class="section-title">Hotel Policies & FAQs</h2>
                <div class="accordion-item">
                    <div class="accordion-header">Check-in / Check-out Times <i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header">Cancellation & Prepayment <i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header">Children & Extra Beds <i class="fa-solid fa-chevron-down"></i></div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header">Pets Policy <i class="fa-solid fa-chevron-down"></i></div>
                </div>
            </div>

        </div>

        <!-- Right Sticky Booking Sidebar -->
        <div class="sidebar">
            <div class="sticky-sidebar">
                <div class="booking-card">
                    <div class="booking-header">
                        <?php 
                        $minPrice = (!empty($hotelRooms)) ? min(array_column($hotelRooms, 'price_per_night')) : 199;
                        ?>
                        <div>
                            <span style="font-size: 14px; color: var(--c-text-light);">Starting from</span>
                            <div class="booking-price">US$<?= number_format($minPrice, 0) ?></div>
                        </div>
                        <div style="background: #e6f9ed; color: var(--c-accent); padding: 4px 8px; border-radius: 4px; font-size: 13px; font-weight: 700;">
                            Best Value
                        </div>
                    </div>

                    <form id="checkout-form" action="/EasyTrip/public/checkout" method="POST">
                        <input type="hidden" name="hotel_id" value="<?= $hotel['id'] ?>">
                        
                        <input type="hidden" name="dates" value="<?= htmlspecialchars($dates) ?>">
                        
                        <div style="display: flex; gap: 12px;">
                            <div class="form-group" style="flex: 1;">
                                <label class="form-label">Adults</label>
                                <select name="adults" class="form-control">
                                    <option value="1" <?= $adults==1?'selected':'' ?>>1 Adult</option>
                                    <option value="2" <?= $adults==2?'selected':'' ?>>2 Adults</option>
                                    <option value="3" <?= $adults==3?'selected':'' ?>>3 Adults</option>
                                    <option value="4" <?= $adults==4?'selected':'' ?>>4 Adults</option>
                                </select>
                            </div>
                            <div class="form-group" style="flex: 1;">
                                <label class="form-label">Children</label>
                                <select name="children" class="form-control">
                                    <option value="0" <?= $children==0?'selected':'' ?>>0 Children</option>
                                    <option value="1" <?= $children==1?'selected':'' ?>>1 Child</option>
                                    <option value="2" <?= $children==2?'selected':'' ?>>2 Children</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Rooms</label>
                            <select name="rooms" class="form-control">
                                <option value="1" <?= $rooms==1?'selected':'' ?>>1 Room</option>
                                <option value="2" <?= $rooms==2?'selected':'' ?>>2 Rooms</option>
                            </select>
                        </div>

                        <button type="submit" class="btn-reserve">Reserve Now</button>
                    </form>

                    <div class="urgency-badge">
                        <i class="fa-solid fa-fire"></i> In high demand! Booked 12 times today.
                    </div>
                    
                    <div style="margin-top: 24px; font-size: 14px; color: var(--c-text-light); display: flex; align-items: center; gap: 12px;">
                        <i class="fa-solid fa-lock" style="font-size: 18px;"></i>
                        <span>Secure booking. Your data is protected by industry-standard encryption.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
