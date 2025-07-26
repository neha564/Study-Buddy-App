-- Create the bookings table (if not already created)
CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255),
    venue VARCHAR(255),
    date DATE,
    start_time TIME,
    end_time TIME,
    details TEXT,
    user_name VARCHAR(255),
    user_email VARCHAR(255),
    user_phone VARCHAR(15),
    videography BOOLEAN,
    photography BOOLEAN
);

-- Create the payments table with the booking_id column
CREATE TABLE IF NOT EXISTS payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    booking_id INT,  -- Add the booking_id column to reference the booking
    payment_method VARCHAR(50),
    payment_status VARCHAR(50),
    payment_amount DECIMAL(10, 2),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    transaction_id VARCHAR(255)
);

