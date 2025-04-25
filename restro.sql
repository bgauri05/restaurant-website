CREATE TABLE table_bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    phone VARCHAR(20),
    location VARCHAR(100),
    people INT,
    reservation_datetime DATETIME
);
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100),
    phone VARCHAR(20),
    address TEXT,
    order_items TEXT, -- store comma-separated items or use a separate table for normalized data
    order_datetime TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE delivery_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    phone_number VARCHAR(20),
    address TEXT
);
CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    birth_date DATE,
    favorite_cuisine VARCHAR(100),
    dietary_preferences TEXT,
    preferred_communication VARCHAR(50),
    wants_promos BOOLEAN
);
CREATE TABLE contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(100),
    phone VARCHAR(20),
    message TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
