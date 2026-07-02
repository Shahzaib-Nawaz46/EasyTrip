<?php require_once __DIR__ . '/../layout/header.php'; ?>
<?php require_once __DIR__ . '/../layout/sidebar.php'; ?>

<main class="admin-content">
    <h1>Hotel Categories</h1>
    <p>Manage local hotel categories (e.g., Luxury, Budget, Near Airport).</p>
    
    <div style="margin-top: 2rem;">
        <button class="btn btn-primary" onclick="alert('Category creation form will open here.')">+ Add New Category</button>
    </div>

    <table style="width:100%; margin-top: 2rem; background:white; border-radius:8px; border-collapse: collapse;">
        <tr style="border-bottom: 1px solid var(--border-color); text-align: left;">
            <th style="padding: 1rem;">ID</th>
            <th style="padding: 1rem;">Name</th>
            <th style="padding: 1rem;">Actions</th>
        </tr>
        <tr>
            <td style="padding: 1rem;" colspan="3">No categories found.</td>
        </tr>
    </table>
</main>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>
