<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; 
// Variables $totalHotels, $totalBookings, $totalRevenue, $recentBookings 
// are passed from AdminController.php
?>

<main class="admin-content">
    <h1 style="font-size: 28px; margin-bottom: 24px; color: #1a1a1a;">Dashboard Overview</h1>
    
    <div style="display: flex; gap: 24px; margin-bottom: 32px;">
        <div style="flex:1; background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #e7e7e7;">
            <h3 style="font-size: 14px; color: #6b6b6b; margin-bottom: 8px; text-transform: uppercase;">Total Local Hotels</h3>
            <div style="font-size: 32px; font-weight: 700; color: #003b95;"><?= $totalHotels ?></div>
        </div>
        <div style="flex:1; background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #e7e7e7;">
            <h3 style="font-size: 14px; color: #6b6b6b; margin-bottom: 8px; text-transform: uppercase;">Total Bookings</h3>
            <div style="font-size: 32px; font-weight: 700; color: #008234;"><?= $totalBookings ?></div>
        </div>
        <div style="flex:1; background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #e7e7e7;">
            <h3 style="font-size: 14px; color: #6b6b6b; margin-bottom: 8px; text-transform: uppercase;">Total Revenue</h3>
            <div style="font-size: 32px; font-weight: 700; color: #1a1a1a;">US$ <?= number_format($totalRevenue, 2) ?></div>
        </div>
    </div>

    <div style="background: #fff; padding: 24px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #e7e7e7;">
        <h3 style="font-size: 18px; margin-bottom: 16px; color: #1a1a1a;">Recent Bookings</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #e7e7e7; text-align: left;">
                    <th style="padding: 12px 0; color: #6b6b6b;">Booking Ref</th>
                    <th style="padding: 12px 0; color: #6b6b6b;">Guest Name</th>
                    <th style="padding: 12px 0; color: #6b6b6b;">Dates</th>
                    <th style="padding: 12px 0; color: #6b6b6b;">Amount</th>
                    <th style="padding: 12px 0; color: #6b6b6b;">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(is_array($recentBookings) && count($recentBookings) > 0): ?>
                    <?php foreach($recentBookings as $b): ?>
                    <tr style="border-bottom: 1px solid #e7e7e7;">
                        <td style="padding: 16px 0; font-weight: 600; color: #0071c2;"><?= $b['booking_reference'] ?? 'N/A' ?></td>
                        <td style="padding: 16px 0;"><?= ($b['guest_first_name'] ?? 'Guest') . ' ' . ($b['guest_last_name'] ?? '') ?></td>
                        <td style="padding: 16px 0;"><?= $b['check_in_date'] ?? '' ?> to <?= $b['check_out_date'] ?? '' ?></td>
                        <td style="padding: 16px 0; font-weight: 700;">US$<?= $b['total_amount'] ?? ($b['total_price'] ?? '0.00') ?></td>
                        <td style="padding: 16px 0;">
                            <span style="background: #e6f9ed; color: #008234; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: 600;">
                                <?= $b['booking_status'] ?? ($b['status'] ?? 'Pending') ?>
                            </span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="5" style="padding: 16px 0; text-align: center; color: #6b6b6b;">No bookings found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
