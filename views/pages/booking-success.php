<?php require_once __DIR__ . '/../layout/header.php'; ?>

<div style="min-height: 70vh; display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; background-color: #f5f7fa; padding: 40px 20px;">
    
    <div style="background: #fff; padding: 40px; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); max-width: 500px; width: 100%;">
        
        <div style="width: 80px; height: 80px; background-color: #e6f8ec; color: #008234; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin: 0 auto 24px; font-size: 40px;">
            <i class="fa-solid fa-check"></i>
        </div>
        
        <h1 style="font-size: 28px; font-weight: bold; margin-bottom: 12px; color: #1a1a1a;">Booking Confirmed!</h1>
        <p style="font-size: 16px; color: #6b6b6b; margin-bottom: 24px; line-height: 1.5;">
            Thank you for booking with EasyTrip. Your reservation has been successfully confirmed. An email with your booking details has been sent to you.
        </p>

        <div style="background: #f0f8ff; border: 1px solid #cce0f5; border-radius: 8px; padding: 16px; margin-bottom: 32px; text-align: left;">
            <p style="margin: 0 0 8px; font-size: 14px; color: #0071c2; font-weight: bold;"><i class="fa-solid fa-circle-info" style="margin-right: 8px;"></i> What's next?</p>
            <p style="margin: 0; font-size: 14px; color: #1a1a1a;">You chose to <strong>Pay at Hotel</strong>. Please ensure you have a valid payment method upon arrival. Safe travels!</p>
        </div>
        
        <a href="/EasyTrip/public/" class="btn btn-primary" style="padding: 14px 32px; font-size: 16px; font-weight: bold; border-radius: 8px; text-decoration: none;">Return to Home</a>
        
    </div>

</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
