<?php require_once __DIR__ . '/../layout/header.php'; ?>

<style>
    .checkout-container {
        max-width: 1000px;
        margin: 40px auto;
        display: flex;
        gap: 32px;
        flex-wrap: wrap;
    }
    .checkout-form {
        flex: 2;
        min-width: 300px;
    }
    .checkout-summary {
        flex: 1;
        min-width: 300px;
        background: #fff;
        border: 1px solid #e7e7e7;
        border-radius: 8px;
        padding: 24px;
        height: fit-content;
    }
    .form-section {
        background: #fff;
        border: 1px solid #e7e7e7;
        border-radius: 8px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .form-section h3 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e7e7e7;
    }
    .hotel-img-small {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 16px;
    }
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 14px;
    }
    .summary-total {
        display: flex;
        justify-content: space-between;
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #e7e7e7;
        font-size: 18px;
        font-weight: bold;
    }
    .payment-option {
        display: flex;
        align-items: center;
        padding: 16px;
        border: 1px solid #0071c2;
        background: #f0f8ff;
        border-radius: 8px;
        cursor: pointer;
    }
    .payment-option input {
        margin-right: 12px;
        transform: scale(1.2);
    }
</style>

<div class="checkout-container">
    <div class="checkout-form">
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 24px;">Secure your booking</h1>

        <form action="<?= BASE_URL ?>/book" method="POST">
            <input type="hidden" name="hotel_id" value="<?= $hotel_id ?>">
            <input type="hidden" name="room_id" value="<?= $room_id ?>">
            <input type="hidden" name="dates" value="<?= htmlspecialchars($dates) ?>">
            <input type="hidden" name="total_price" value="<?= $total_price ?>">

            <!-- Guest Details -->
            <div class="form-section">
                <h3>Enter your details</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    <div>
                        <label class="form-label">First Name *</label>
                        <input type="text" name="guest_first_name" class="form-control" required placeholder="John">
                    </div>
                    <div>
                        <label class="form-label">Last Name *</label>
                        <input type="text" name="guest_last_name" class="form-control" required placeholder="Doe">
                    </div>
                    <div style="grid-column: span 2;">
                        <label class="form-label">Email Address *</label>
                        <input type="email" name="guest_email" class="form-control" required placeholder="john.doe@example.com">
                    </div>
                    <div style="grid-column: span 2;">
                        <label class="form-label">Phone Number *</label>
                        <input type="text" name="guest_phone" class="form-control" required placeholder="+1 234 567 890">
                    </div>
                </div>
            </div>

            <!-- Payment -->
            <div class="form-section">
                <h3>How do you want to pay?</h3>
                <label class="payment-option">
                    <input type="radio" name="payment_method" value="pay_at_hotel" checked>
                    <div>
                        <strong>Pay at Hotel</strong>
                        <p style="margin: 4px 0 0; font-size: 14px; color: var(--text-muted);">No credit card needed right now. Pay when you arrive.</p>
                    </div>
                </label>
            </div>

            <div style="text-align: right;">
                <p style="font-size: 14px; color: var(--text-muted); margin-bottom: 12px;">By completing this booking, you agree to the Terms & Conditions.</p>
                <button type="submit" class="btn btn-primary" style="padding: 16px 32px; font-size: 18px; font-weight: bold; width: 100%; max-width: 300px;">Complete Booking</button>
            </div>
        </form>
    </div>

    <div class="checkout-summary">
        <h3 style="font-size: 18px; font-weight: bold; margin-bottom: 16px;">Booking Summary</h3>
        <?php 
            $images = json_decode($hotel['image_urls']);
            $img = (!empty($images) && isset($images[0])) ? $images[0] : 'https://via.placeholder.com/300x200';
        ?>
        <img src="<?= htmlspecialchars($img) ?>" class="hotel-img-small" alt="<?= htmlspecialchars($hotel['hotel_name']) ?>">
        
        <div style="margin-bottom: 16px;">
            <p style="font-size: 12px; color: var(--text-muted); text-transform: uppercase; margin-bottom: 4px;">Hotel</p>
            <h4 style="font-weight: bold; font-size: 16px; margin: 0;"><?= htmlspecialchars($hotel['hotel_name']) ?></h4>
            <p style="font-size: 14px; color: var(--text-muted); margin-top: 4px;"><?= htmlspecialchars($hotel['address']) ?>, <?= htmlspecialchars($hotel['city']) ?></p>
        </div>

        <div class="summary-row">
            <span style="color: var(--text-muted);">Check-in</span>
            <span style="font-weight: 500;"><?= date('D, M j, Y', strtotime($check_in)) ?></span>
        </div>
        <div class="summary-row">
            <span style="color: var(--text-muted);">Check-out</span>
            <span style="font-weight: 500;"><?= date('D, M j, Y', strtotime($check_out)) ?></span>
        </div>
        <div class="summary-row">
            <span style="color: var(--text-muted);">Total Length of Stay:</span>
            <span style="font-weight: 500;"><?= $nights ?> night<?= $nights > 1 ? 's' : '' ?></span>
        </div>
        
        <hr style="border: 0; border-top: 1px solid #e7e7e7; margin: 16px 0;">

        <div class="summary-row">
            <span style="color: var(--text-muted);">Guests</span>
            <span style="font-weight: 500;"><?= $adults ?> adults, <?= $children ?> children</span>
        </div>
        <div class="summary-row">
            <span style="color: var(--text-muted);">Rooms</span>
            <span style="font-weight: 500;"><?= $rooms ?> <?= htmlspecialchars($hotel['room_type']) ?></span>
        </div>

        <div class="summary-total">
            <span>Price</span>
            <span style="color: #008234;">US$<?= number_format($total_price, 2) ?></span>
        </div>
        <p style="font-size: 12px; color: var(--text-muted); text-align: right; margin-top: 4px;">Includes taxes and charges</p>
    </div>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
