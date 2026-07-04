</main> <!-- End of main-content -->

<!-- 11. Professional Footer -->
<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-col brand-col">
            <h3 class="footer-brand"><i class="fa-solid fa-plane-departure"></i> EasyTrip.</h3>
            <p class="footer-desc">Your ultimate travel partner. Book flights, hotels, and experiences worldwide with confidence and ease.</p>
            <div class="social-links">
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
        </div>
        
        <div class="footer-col">
            <h4>Company</h4>
            <ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Press & Media</a></li>
                <li><a href="#">Sustainability</a></li>
            </ul>
        </div>
        
        <div class="footer-col">
            <h4>Support</h4>
            <ul>
                <li><a href="#">Help Center</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Cancellation Policy</a></li>
                <li><a href="#">Trust & Safety</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Explore</h4>
            <ul>
                <li><a href="#">Destinations</a></li>
                <li><a href="#">Flights</a></li>
                <li><a href="#">Hotels</a></li>
                <li><a href="#">Car Rentals</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Legal & Partners</h4>
            <ul>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Affiliate Program</a></li>
                <li><a href="#">Travel Agents</a></li>
            </ul>
        </div>
    </div>
    
    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <p>&copy; <?php echo date('Y'); ?> EasyTrip Booking Company. All rights reserved.</p>
            <div class="payment-methods">
                <i class="fa-brands fa-cc-visa"></i>
                <i class="fa-brands fa-cc-mastercard"></i>
                <i class="fa-brands fa-cc-amex"></i>
                <i class="fa-brands fa-cc-paypal"></i>
            </div>
        </div>
    </div>
</footer>

<!-- Base JS -->
<script src="<?= BASE_URL ?>/assets/js/main.js"></script>

<script>
    const exchangeRates = {
        'USD': 1,
        'EUR': 0.93,
        'PKR': 278
    };

    const symbols = {
        'USD': 'US$',
        'EUR': '€',
        'PKR': 'Rs '
    };

    function updateCurrency(curr) {
        localStorage.setItem('selectedCurrency', curr);
        applyCurrency();
    }

    function applyCurrency() {
        const curr = localStorage.getItem('selectedCurrency') || 'USD';
        const selector = document.getElementById('currencySelector');
        if (selector) selector.value = curr;

        // Only apply to hotel prices (assuming hotel pages have .htl-price-val, .room-price, .booking-price, etc.)
        const priceElements = document.querySelectorAll('.htl-price-val, .room-price, .booking-price, .hotel-price');
        
        priceElements.forEach(el => {
            // Save original USD price if not already saved
            if (!el.hasAttribute('data-usd')) {
                // Extract number from US$199 or $199
                let text = el.innerText;
                let num = text.replace(/[^0-9.]/g, '');
                if (num) {
                    el.setAttribute('data-usd', num);
                    // Also save any suffix like "/night"
                    if (text.includes('/night')) {
                        el.setAttribute('data-suffix', '/night');
                    }
                }
            }
            
            const usdVal = parseFloat(el.getAttribute('data-usd'));
            if (!isNaN(usdVal)) {
                let converted = usdVal * exchangeRates[curr];
                let formatted = Math.round(converted).toLocaleString();
                let suffix = el.getAttribute('data-suffix') || '';
                
                el.innerHTML = `${symbols[curr]}${formatted} <span style="font-size:var(--font-size-sm); font-weight:normal;">${suffix}</span>`;
            }
        });

        // Also update filter labels
        const filterLabels = document.querySelectorAll('.checkbox-group label');
        filterLabels.forEach(label => {
            if (label.innerText.includes('US$')) {
                if (!label.hasAttribute('data-original-text')) {
                    label.setAttribute('data-original-text', label.innerText);
                }
            }
            
            if (label.hasAttribute('data-original-text')) {
                let originalText = label.getAttribute('data-original-text');
                
                // e.g. "US$0 - US$50" or "US$100 +"
                let newText = originalText.replace(/US\$([0-9]+)/g, (match, p1) => {
                    let num = parseInt(p1);
                    let converted = Math.round(num * exchangeRates[curr]);
                    return symbols[curr] + converted.toLocaleString();
                });
                
                label.innerText = newText;
            }
        });
    }

    document.addEventListener('DOMContentLoaded', applyCurrency);
</script>

</body>
</html>
