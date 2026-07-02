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
                        <input type="text" class="form-control" placeholder="Select dates" style="height: 50px;">
                    </div>
                    <div class="form-field-group">
                        <label class="form-label" style="font-size: 1rem;">Guests</label>
                        <input type="text" class="form-control" placeholder="2 adults, 1 room" style="height: 50px;">
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
        <!-- Hotel 1 -->
        <div class="hotel-card">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?q=80&w=600&auto=format&fit=crop" class="hotel-card-img" alt="Hotel">
            <div class="hotel-card-body">
                <div class="hotel-rating">
                    <span class="rating-badge">9.2</span>
                    <span class="fw-medium">Superb</span>
                    <span class="hotel-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                </div>
                <h3 class="hotel-title">Grand Resort Maldives</h3>
                <p class="hotel-location"><i class="fa-solid fa-location-dot"></i> Male City, Maldives</p>
                <div class="hotel-price-row">
                    <div>
                        <span style="font-size: var(--font-size-sm); color: var(--text-muted);">Starting from</span>
                        <div class="hotel-price">$450 <span style="font-size:var(--font-size-sm); font-weight:normal;">/night</span></div>
                    </div>
                    <button class="btn btn-primary btn-sm">View Deal</button>
                </div>
            </div>
        </div>

        <!-- Hotel 2 -->
        <div class="hotel-card">
            <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?q=80&w=600&auto=format&fit=crop" class="hotel-card-img" alt="Hotel">
            <div class="hotel-card-body">
                <div class="hotel-rating">
                    <span class="rating-badge">8.8</span>
                    <span class="fw-medium">Fabulous</span>
                    <span class="hotel-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                </div>
                <h3 class="hotel-title">Burj Al Arab</h3>
                <p class="hotel-location"><i class="fa-solid fa-location-dot"></i> Jumeirah, Dubai</p>
                <div class="hotel-price-row">
                    <div>
                        <span style="font-size: var(--font-size-sm); color: var(--text-muted);">Starting from</span>
                        <div class="hotel-price">$1,200 <span style="font-size:var(--font-size-sm); font-weight:normal;">/night</span></div>
                    </div>
                    <button class="btn btn-primary btn-sm">View Deal</button>
                </div>
            </div>
        </div>

        <!-- Hotel 3 -->
        <div class="hotel-card">
            <img src="https://images.unsplash.com/photo-1542314831-c6a4d27ece50?q=80&w=600&auto=format&fit=crop" class="hotel-card-img" alt="Hotel">
            <div class="hotel-card-body">
                <div class="hotel-rating">
                    <span class="rating-badge">9.5</span>
                    <span class="fw-medium">Exceptional</span>
                    <span class="hotel-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                </div>
                <h3 class="hotel-title">The Ritz London</h3>
                <p class="hotel-location"><i class="fa-solid fa-location-dot"></i> Mayfair, London</p>
                <div class="hotel-price-row">
                    <div>
                        <span style="font-size: var(--font-size-sm); color: var(--text-muted);">Starting from</span>
                        <div class="hotel-price">$890 <span style="font-size:var(--font-size-sm); font-weight:normal;">/night</span></div>
                    </div>
                    <button class="btn btn-primary btn-sm">View Deal</button>
                </div>
            </div>
        </div>

        <!-- Hotel 4 -->
        <div class="hotel-card">
            <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?q=80&w=600&auto=format&fit=crop" class="hotel-card-img" alt="Hotel">
            <div class="hotel-card-body">
                <div class="hotel-rating">
                    <span class="rating-badge">8.5</span>
                    <span class="fw-medium">Very Good</span>
                    <span class="hotel-stars"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                </div>
                <h3 class="hotel-title">Swissôtel Zurich</h3>
                <p class="hotel-location"><i class="fa-solid fa-location-dot"></i> Oerlikon, Zurich</p>
                <div class="hotel-price-row">
                    <div>
                        <span style="font-size: var(--font-size-sm); color: var(--text-muted);">Starting from</span>
                        <div class="hotel-price">$320 <span style="font-size:var(--font-size-sm); font-weight:normal;">/night</span></div>
                    </div>
                    <button class="btn btn-primary btn-sm">View Deal</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 10. Newsletter Section -->
<div class="newsletter-section">
    <h2>Save time, save money!</h2>
    <p style="margin-top: 8px; font-size: var(--font-size-lg); opacity: 0.9;">Sign up and we'll send the best deals to you</p>
    <div class="newsletter-form">
        <input type="email" class="form-control" placeholder="Your email address" style="flex-grow: 1;">
        <button class="btn btn-primary">Subscribe</button>
    </div>
</div>

<!-- Travelpayouts Script -->
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
</script>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
