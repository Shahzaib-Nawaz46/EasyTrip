-- Drop existing tables to ensure clean update (Reverse dependency order)
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS bookings;
DROP TABLE IF EXISTS hotel_blocked_dates;
DROP TABLE IF EXISTS hotel_facilities;
DROP TABLE IF EXISTS rooms;
DROP TABLE IF EXISTS hotel_availability;
DROP TABLE IF EXISTS hotels;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS admins;

-- Admin table
CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Users table (Customers)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Hotels table (Updated for 11-Step Process)
CREATE TABLE hotels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    property_type VARCHAR(50) DEFAULT 'Hotel', -- Hotel, Resort, Villa
    description TEXT,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(50) NOT NULL,
    distance_from_center VARCHAR(50), -- e.g. '2.5 km'
    image_urls TEXT,
    check_in_time VARCHAR(50) DEFAULT '14:00',
    check_out_time VARCHAR(50) DEFAULT '12:00',
    cancellation_policy TEXT,
    rating_score DECIMAL(3,1) DEFAULT 0.0,
    total_reviews INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Hotel Facilities
CREATE TABLE hotel_facilities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT NOT NULL,
    facility_name VARCHAR(100) NOT NULL,
    icon_name VARCHAR(50),
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
);

-- Hotel Rooms
CREATE TABLE rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT NOT NULL,
    room_type VARCHAR(100) NOT NULL, -- e.g., 'Deluxe Room'
    bed_type VARCHAR(100),
    room_size VARCHAR(50),
    max_guests INT NOT NULL DEFAULT 2,
    price_per_night DECIMAL(10,2) NOT NULL,
    room_facilities TEXT,
    total_rooms_available INT NOT NULL DEFAULT 1,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE
);

-- Hotel Blocked Dates
CREATE TABLE hotel_blocked_dates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT NOT NULL,
    room_id INT,
    blocked_date DATE NOT NULL,
    reason VARCHAR(255), 
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

-- Bookings table (Updated for detailed booking process)
CREATE TABLE bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_reference VARCHAR(20) NOT NULL UNIQUE, -- e.g., HTL-785421
    user_id INT, -- Optional if guest checkout is allowed
    hotel_id INT NOT NULL,
    room_id INT NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    
    -- Guest Info
    guest_first_name VARCHAR(100) NOT NULL,
    guest_last_name VARCHAR(100) NOT NULL,
    guest_email VARCHAR(100) NOT NULL,
    guest_phone VARCHAR(20) NOT NULL,
    special_requests TEXT,
    
    -- Pricing
    room_cost DECIMAL(10,2) NOT NULL,
    taxes DECIMAL(10,2) NOT NULL,
    service_fee DECIMAL(10,2) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    
    -- Payment & Status
    payment_method VARCHAR(50) NOT NULL, -- Credit Card, JazzCash, Pay at Hotel
    payment_status ENUM('Pending', 'Paid', 'Failed') DEFAULT 'Pending',
    booking_status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending',
    
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

-- Reviews table
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT NOT NULL,
    user_id INT NOT NULL,
    score DECIMAL(3,1) NOT NULL,
    review_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (hotel_id) REFERENCES hotels(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ==========================================
-- DUMMY DATA INSERTIONS
-- ==========================================

INSERT INTO admins (username, password) VALUES ('admin', 'admin123');

INSERT INTO users (name, email, password, phone) VALUES 
('Mohammad', 'mohammad@example.com', 'pass123', '03001234567'),
('Osama', 'osama@example.com', 'pass123', '03007654321');

INSERT INTO hotels (name, property_type, description, address, city, distance_from_center, image_urls, cancellation_policy, rating_score, total_reviews) VALUES 
('Pearl Continental Karachi', 'Hotel', 'Luxurious 5-star hotel in the heart of Karachi with premium amenities.', 'Club Road', 'Karachi', '1.5 km', '["https://images.unsplash.com/photo-1566073771259-6a8506099945", "https://images.unsplash.com/photo-1582719478250-c89cae4dc85b", "https://images.unsplash.com/photo-1542314831-c6a4d14d8373"]', 'Free cancellation before 48 hours of check-in.', 9.2, 340),
('Shelton Rezidor House F-8', 'Guest House', 'Comfortable family rooms with air-conditioning, private bathrooms, and free WiFi.', 'Street 05 House 54, Sector F-8/3', 'Islamabad', '3.1 km', '["https://images.unsplash.com/photo-1542314831-c6a4d14d8373", "https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9"]', 'Non-refundable.', 9.4, 144);

INSERT INTO hotel_facilities (hotel_id, facility_name, icon_name) VALUES 
(1, 'Free Wifi', 'fa-wifi'), (1, 'Swimming Pool', 'fa-water'), (1, 'Restaurant', 'fa-utensils'), (1, 'Spa', 'fa-spa'),
(2, 'Free Wifi', 'fa-wifi'), (2, 'Airport shuttle', 'fa-plane'), (2, 'Free parking', 'fa-car');

INSERT INTO rooms (hotel_id, room_type, bed_type, room_size, max_guests, price_per_night, room_facilities, total_rooms_available) VALUES 
(1, 'Standard Room', '1 Queen Bed', '30 m²', 2, 80.00, 'AC, TV, Minibar', 10),
(1, 'Deluxe Room', '1 King Bed', '45 m²', 2, 120.00, 'AC, TV, Minibar, Bathtub, City View', 5),
(2, 'Deluxe Double Room', '1 Full Bed', '42 m²', 2, 49.00, 'AC, TV, Minibar', 6),
(2, 'Superior Family Room', '2 Full Beds', '46 m²', 4, 52.00, 'AC, TV, Minibar', 5);

INSERT INTO bookings (booking_reference, user_id, hotel_id, room_id, check_in_date, check_out_date, guest_first_name, guest_last_name, guest_email, guest_phone, special_requests, room_cost, taxes, service_fee, total_amount, payment_method, payment_status, booking_status) VALUES 
('HTL-785421', 1, 1, 2, '2026-07-10', '2026-07-12', 'Mohammad', 'Ali', 'mohammad@example.com', '03001234567', 'Early check-in requested.', 240.00, 24.00, 5.00, 269.00, 'Credit Card', 'Paid', 'Confirmed');

INSERT INTO reviews (hotel_id, user_id, score, review_text) VALUES 
(2, 1, 9.0, 'A small but nice place with good service.');
