<?php require_once __DIR__ . '/../layout/header.php'; ?>

<!-- 2. Hero Section -->
<div class="hero-fullscreen">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h1>Discover your next journey</h1>
        <p>Search low prices on hotels, flights, and much more.</p>
    </div>

    <!-- 3. Floating Search Card (Widget Wrapper) -->
    <div class="floating-search-wrapper">
        <div class="search-tabs-container">
            <button class="search-tab active" onclick="switchSearchTab('flights', this)"><i class="fa-solid fa-plane"></i> Flights</button>
            <button class="search-tab" onclick="switchSearchTab('hotels', this)"><i class="fa-solid fa-bed"></i> Hotels</button>
        </div>
        <div class="search-card-glass">
            <!-- Flights Pane -->
            <div id="tpwl-search" class="search-pane">
                <!-- Travelpayouts widget will load here -->
            </div>
            <!-- Required for widget initialization -->
            <div id="tpwl-tickets" style="display: none;"></div>
            <!-- Hotels Pane -->
            <div id="local-hotel-search" class="search-pane" style="display: none;">
                <form action="/EasyTrip/public/hotels" method="GET" class="hotel-search-form">
                    <div class="form-field-group" style="flex-grow: 1;">
                        <label class="form-label" style="font-size: 1rem;">Destination</label>
                        <div style="position:relative;">
                            <i class="fa-solid fa-bed" style="position:absolute; left:16px; top:50%; transform:translateY(-50%); color:var(--text-muted);"></i>
                            <input type="text" name="destination" class="form-control" placeholder="Where are you going?" style="padding-left: 45px; height: 50px;">
                        </div>
                    </div>
                    <div class="form-field-group">
                        <label class="form-label" style="font-size: 1rem;">Check-in - Check-out</label>
                        <input type="text" name="dates" id="dateRange" class="form-control" placeholder="Select dates" style="height: 50px;">
                    </div>
                    <div class="form-field-group dropdown" style="position: relative;">
                        <label class="form-label" style="font-size: 1rem;">Guests</label>
                        <div class="form-control" style="height: 50px; display: flex; align-items: center; cursor: pointer; justify-content: space-between;" id="guestDropdownToggle" onclick="toggleGuestDropdown(event)">
                            <span id="guestSummary">2 adults, 0 children, 1 room</span>
                            <i class="fa-solid fa-chevron-down" style="font-size: 12px; color: var(--text-muted);"></i>
                        </div>
                        
                        <div id="guestDropdownMenu" class="custom-guest-dropdown">
                            <div class="guest-row">
                                <span>Adults</span>
                                <div class="guest-controls">
                                    <button type="button" class="guest-btn" onclick="updateGuest('adults', -1)">-</button>
                                    <span class="guest-count" id="adultsCount">2</span>
                                    <button type="button" class="guest-btn" onclick="updateGuest('adults', 1)">+</button>
                                </div>
                            </div>
                            <div class="guest-row">
                                <span>Children</span>
                                <div class="guest-controls">
                                    <button type="button" class="guest-btn" onclick="updateGuest('children', -1)">-</button>
                                    <span class="guest-count" id="childrenCount">0</span>
                                    <button type="button" class="guest-btn" onclick="updateGuest('children', 1)">+</button>
                                </div>
                            </div>
                            <div class="guest-row" style="margin-bottom: 0;">
                                <span>Rooms</span>
                                <div class="guest-controls">
                                    <button type="button" class="guest-btn" onclick="updateGuest('rooms', -1)">-</button>
                                    <span class="guest-count" id="roomsCount">1</span>
                                    <button type="button" class="guest-btn" onclick="updateGuest('rooms', 1)">+</button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Hidden inputs for form submission -->
                        <input type="hidden" name="adults" id="inputAdults" value="2">
                        <input type="hidden" name="children" id="inputChildren" value="0">
                        <input type="hidden" name="rooms" id="inputRooms" value="1">
                    </div>
                    <div class="form-field-btn">
                        <button type="submit" class="btn btn-primary btn-lg" style="height: 50px; padding: 0 2rem; width: 100%;">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="spacer-after-hero"></div>

<!-- 4. Popular Destinations -->
<div class="container section-padding">
    <h2 class="section-title">Popular Destinations</h2>
    <p class="section-subtitle">Most popular choices for travelers from your location</p>
    
    <div class="grid-4">
        <!-- Destination 1 -->
        <div class="premium-dest-card">
            <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?q=80&w=800&auto=format&fit=crop" alt="Dubai">
            <div class="premium-dest-overlay">
                <h3 class="premium-dest-title">Dubai</h3>
                <span class="premium-dest-subtitle"><img src="https://flagcdn.com/w20/ae.png" alt="AE" style="display:inline; width:16px;"> United Arab Emirates</span>
            </div>
        </div>
        <!-- Destination 2 -->
        <div class="premium-dest-card">
            <img src="https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?q=80&w=800&auto=format&fit=crop" alt="Switzerland">
            <div class="premium-dest-overlay">
                <h3 class="premium-dest-title">Zurich</h3>
                <span class="premium-dest-subtitle"><img src="https://flagcdn.com/w20/ch.png" alt="CH" style="display:inline; width:16px;"> Switzerland</span>
            </div>
        </div>
        <!-- Destination 3 -->
        <div class="premium-dest-card">
            <img src="https://images.unsplash.com/photo-1514282401047-d79a71a590e8?q=80&w=800&auto=format&fit=crop" alt="Maldives">
            <div class="premium-dest-overlay">
                <h3 class="premium-dest-title">Maldives</h3>
                <span class="premium-dest-subtitle"><img src="https://flagcdn.com/w20/mv.png" alt="MV" style="display:inline; width:16px;"> Maldives</span>
            </div>
        </div>
        <!-- Destination 4 -->
        <div class="premium-dest-card">
            <img src="https://images.unsplash.com/photo-1496442226666-8d4d0e62e6e9?q=80&w=800&auto=format&fit=crop" alt="New York">
            <div class="premium-dest-overlay">
                <h3 class="premium-dest-title">New York</h3>
                <span class="premium-dest-subtitle"><img src="https://flagcdn.com/w20/us.png" alt="US" style="display:inline; width:16px;"> United States</span>
            </div>
        </div>
        <!-- Destination 5 -->
        <div class="premium-dest-card">
            <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?q=80&w=800&auto=format&fit=crop" alt="Paris">
            <div class="premium-dest-overlay">
                <h3 class="premium-dest-title">Paris</h3>
                <span class="premium-dest-subtitle"><img src="https://flagcdn.com/w20/fr.png" alt="FR" style="display:inline; width:16px;"> France</span>
            </div>
        </div>
        <!-- Destination 6 -->
        <div class="premium-dest-card">
            <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?q=80&w=800&auto=format&fit=crop" alt="Tokyo">
            <div class="premium-dest-overlay">
                <h3 class="premium-dest-title">Tokyo</h3>
                <span class="premium-dest-subtitle"><img src="https://flagcdn.com/w20/jp.png" alt="JP" style="display:inline; width:16px;"> Japan</span>
            </div>
        </div>
        <!-- Destination 7 -->
        <div class="premium-dest-card">
            <img src="https://images.unsplash.com/photo-1522083111811-9a742da09b8c?q=80&w=800&auto=format&fit=crop" alt="London">
            <div class="premium-dest-overlay">
                <h3 class="premium-dest-title">London</h3>
                <span class="premium-dest-subtitle"><img src="https://flagcdn.com/w20/gb.png" alt="UK" style="display:inline; width:16px;"> United Kingdom</span>
            </div>
        </div>
        <!-- Destination 8 -->
        <div class="premium-dest-card">
            <img src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?q=80&w=800&auto=format&fit=crop" alt="Istanbul">
            <div class="premium-dest-overlay">
                <h3 class="premium-dest-title">Istanbul</h3>
                <span class="premium-dest-subtitle"><img src="https://flagcdn.com/w20/tr.png" alt="TR" style="display:inline; width:16px;"> Turkey</span>
            </div>
        </div>
    </div>
</div>

<!-- 7. Travel Categories -->
<div class="container section-padding">
    <h2 class="section-title">Explore by Category</h2>
    <div class="grid-6">
        <div class="category-card">
            <i class="fa-solid fa-gem category-icon"></i>
            <div class="category-title">Luxury</div>
        </div>
        <div class="category-card">
            <i class="fa-solid fa-wallet category-icon"></i>
            <div class="category-title">Budget</div>
        </div>
        <div class="category-card">
            <i class="fa-solid fa-umbrella-beach category-icon"></i>
            <div class="category-title">Beach</div>
        </div>
        <div class="category-card">
            <i class="fa-solid fa-mountain category-icon"></i>
            <div class="category-title">Mountain</div>
        </div>
        <div class="category-card">
            <i class="fa-solid fa-users category-icon"></i>
            <div class="category-title">Family</div>
        </div>
        <div class="category-card">
            <i class="fa-solid fa-briefcase category-icon"></i>
            <div class="category-title">Business</div>
        </div>
    </div>
</div>

<!-- 5. Featured Hotels -->
<div class="container section-padding">
    <h2 class="section-title">Featured Hotels</h2>
    <p class="section-subtitle">Top-rated stays highly recommended by guests</p>
    
    <div class="grid-4">
        <?php
        if (isset($featuredHotels) && count($featuredHotels) > 0):
            foreach ($featuredHotels as $hotel):
                $images = json_decode($hotel['image_urls']);
                $img = (!empty($images) && isset($images[0])) ? $images[0] : 'https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=600&auto=format&fit=crop';
        ?>
        <div class="hotel-card">
            <a href="/EasyTrip/public/hotel-detail?id=<?= $hotel['id'] ?>" style="text-decoration: none; color: inherit; display: block;">
                <img src="<?= htmlspecialchars($img) ?>" class="hotel-card-img" alt="<?= htmlspecialchars($hotel['name']) ?>">
            </a>
            <div class="hotel-card-body">
                <div class="hotel-rating">
                    <span class="rating-badge"><?= $hotel['rating_score'] ?></span>
                    <span class="fw-medium">Excellent</span>
                </div>
                <h3 class="hotel-title">
                    <a href="/EasyTrip/public/hotel-detail?id=<?= $hotel['id'] ?>" style="text-decoration: none; color: inherit;">
                        <?= htmlspecialchars($hotel['name']) ?>
                    </a>
                </h3>
                <p class="hotel-location"><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($hotel['city']) ?></p>
                <div class="hotel-price-row">
                    <div>
                        <span style="font-size: var(--font-size-sm); color: var(--text-muted);">Starting from</span>
                        <!-- Default price for now -->
                        <div class="hotel-price">$199 <span style="font-size:var(--font-size-sm); font-weight:normal;">/night</span></div>
                    </div>
                    <a href="/EasyTrip/public/hotel-detail?id=<?= $hotel['id'] ?>" class="btn btn-primary btn-sm">View Deal</a>
                </div>
            </div>
        </div>
        <?php 
            endforeach;
        else:
        ?>
            <p>No featured hotels available at the moment.</p>
        <?php endif; ?>
    </div>
</div>




<!-- Bootstrap Bundle (required for dropdowns) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Flatpickr (Date Picker) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<style>
    .custom-guest-dropdown {
        display: none;
        position: absolute;
        top: calc(100% + 5px);
        left: 0;
        width: 320px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.15);
        border: 1px solid #e7e7e7;
        z-index: 1050;
        padding: 20px;
        color: #1a1a1a;
    }
    .custom-guest-dropdown.show {
        display: block;
    }
    .guest-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-weight: 500;
    }
    .guest-controls {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .guest-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid #0071c2;
        background: transparent;
        color: #0071c2;
        font-size: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: background 0.2s;
    }
    .guest-btn:hover {
        background: #f0f8ff;
    }
    .guest-count {
        min-width: 20px;
        text-align: center;
    }
</style>

<script
    data-noptimize="1"
    data-cfasync="false"
    data-wpfc-render="false"
    seraph-accel-crit="1"
    data-no-defer="1">
    window.TPWL_CONFIGURATION = {
        resultsURL: '/EasyTrip/public/flights'
    };
    
    (function () {
        var script = document.createElement("script");
        script.async = true;
        script.type = "module";
        script.src = "https://tpemb.com/wl_web/main.js?wl_id=19335";
        document.head.appendChild(script);
    })();

    // Tab Switching Logic
    function switchSearchTab(tab, element) {
        // Update active class on buttons
        document.querySelectorAll('.search-tab').forEach(btn => btn.classList.remove('active'));
        element.classList.add('active');
        
        // Toggle panes
        if (tab === 'flights') {
            document.getElementById('tpwl-search').style.display = 'block';
            document.getElementById('local-hotel-search').style.display = 'none';
        } else {
            document.getElementById('tpwl-search').style.display = 'none';
            document.getElementById('local-hotel-search').style.display = 'block';
        }
    }

    // Initialize Date Range Picker
    if(document.getElementById("dateRange")) {
        flatpickr("#dateRange", {
            mode: "range",
            minDate: "today",
            dateFormat: "M j, Y",
            altInput: true,
            altFormat: "D, M j",
            showMonths: 2
        });
    }

    // Custom Guest Dropdown Logic
    function toggleGuestDropdown(e) {
        e.stopPropagation();
        document.getElementById('guestDropdownMenu').classList.toggle('show');
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        let menu = document.getElementById('guestDropdownMenu');
        let toggleBtn = document.getElementById('guestDropdownToggle');
        if (menu && menu.classList.contains('show') && !menu.contains(e.target) && !toggleBtn.contains(e.target)) {
            menu.classList.remove('show');
        }
    });

    let guests = { adults: 2, children: 0, rooms: 1 };
    window.updateGuest = function(type, change) {
        let newValue = guests[type] + change;
        if(type === 'adults' && newValue < 1) return;
        if(type === 'children' && newValue < 0) return;
        if(type === 'rooms' && newValue < 1) return;
        
        guests[type] = newValue;
        document.getElementById(type + 'Count').innerText = newValue;
        document.getElementById('input' + type.charAt(0).toUpperCase() + type.slice(1)).value = newValue;
        
        let summary = `${guests.adults} adults, ${guests.children} children, ${guests.rooms} room${guests.rooms > 1 ? 's' : ''}`;
        document.getElementById('guestSummary').innerText = summary;
    }
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
