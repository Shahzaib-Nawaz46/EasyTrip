<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyTrip Admin Dashboard</title>
    <!-- We can reuse some base CSS and add admin specific CSS later -->
    <link rel="stylesheet" href="/EasyTrip/public/assets/css/main.css">
    <style>
        .admin-layout { display: flex; min-height: 100vh; }
        .admin-sidebar { width: 250px; background: var(--primary-dark-blue); color: white; padding: 2rem; }
        .admin-sidebar a { color: white; display: block; margin-bottom: 1rem; }
        .admin-content { flex-grow: 1; padding: 2rem; background: var(--light-gray); }
    </style>
</head>
<body>
<div class="admin-layout">
