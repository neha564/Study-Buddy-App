-- Create the database
CREATE DATABASE IF NOT EXISTS feedback_system;

-- Use the created database
USE feedback_system;

-- Create the feedback table
CREATE TABLE IF NOT EXISTS feedback (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Auto-incrementing primary key
    name VARCHAR(255) NOT NULL,        -- User's name
    email VARCHAR(255) NOT NULL,       -- User's email
    rating INT NOT NULL,               -- User's rating (to be validated in PHP)
    message TEXT NOT NULL,             -- Feedback message
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Auto-generated submission timestamp
);

