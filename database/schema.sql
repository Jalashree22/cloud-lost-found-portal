-- Database schema for the Cloud Lost & Found Portal (MySQL / Amazon RDS)
-- Rebuilt from the queries used in the PHP code.

CREATE DATABASE IF NOT EXISTS lostfound;
USE lostfound;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    usn VARCHAR(50) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS lost_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    item_name VARCHAR(150) NOT NULL,
    description TEXT,
    location VARCHAR(150),
    image_url VARCHAR(500),
    labels TEXT,
    status VARCHAR(30) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS found_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    item_name VARCHAR(150) NOT NULL,
    description TEXT,
    location VARCHAR(150),
    image_url VARCHAR(500),
    labels TEXT,
    status VARCHAR(30) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
