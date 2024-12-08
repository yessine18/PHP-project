-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS planetsfacts;
USE planetsfacts;

-- Create users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  -- Will store hashed passwords
    role ENUM('user', 'superadmin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert a default superadmin user (password: admin123)
-- The password is hashed using PHP's password_hash function with PASSWORD_DEFAULT
INSERT INTO users (email, password, role) VALUES 
('yessine.fakhfakh@enis.tn', '$2y$10$74jwo/K21ZNlmP3LifGeoOaqUGY.AbRRpdK4RxXA22FCwZLW3WZVq', 'user');

-- Insert a default regular user (password: user123)
INSERT INTO users (email, password, role) VALUES 
('user@planetsfacts.com', '$2y$10$lQv3c1yqBWVHxkd0LHAkCOYz6TtxMQJqhN8/LewLxNdgGFhXHSp3S', 'user');
