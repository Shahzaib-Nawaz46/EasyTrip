<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyTrip - Premium Travel Booking</title>

    <!-- Base & Component CSS -->
    <link rel="stylesheet" href="/EasyTrip/public/assets/css/main.css">
    
    <!-- External Icons (FontAwesome or Similar Placeholder) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<!-- 1. Sticky Navigation Bar -->
<header class="navbar sticky-navbar">
    <div class="navbar-container container">
        <a href="/EasyTrip/public/" class="navbar-logo">
            <i class="fa-solid fa-plane-departure" style="margin-right: 8px;"></i>EasyTrip.
        </a>
        
        <nav class="navbar-menu">
            <ul class="navbar-nav">
                <li><a href="/EasyTrip/public/"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="/EasyTrip/public/"><i class="fa-solid fa-plane"></i> Flights</a></li>
                <li><a href="/EasyTrip/public/hotels"><i class="fa-solid fa-bed"></i> Hotels</a></li>
                <li><a href="#"><i class="fa-solid fa-envelope"></i> Contact</a></li>
            </ul>
        </nav>
        
        <div class="navbar-actions">
            <button class="btn btn-ghost btn-sm fw-medium hide-on-mobile">USD</button>
            <button class="btn btn-ghost btn-sm fw-medium hide-on-mobile"><img src="https://flagcdn.com/w20/us.png" alt="EN" style="display:inline; width:20px; border-radius:2px;"> EN</button>
            <div class="divider hide-on-mobile"></div>
            <a href="#" class="btn btn-ghost btn-sm fw-medium hide-on-mobile">Sign In</a>
            <a href="#" class="btn btn-primary btn-sm">Register</a>
            <button class="hamburger-menu" aria-label="Menu"><i class="fa-solid fa-bars"></i></button>
        </div>
    </div>
</header>

<main class="main-content">
