CREATE DATABASE budgetmanagement;

USE budgetmanagement;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,       
    fullname VARCHAR(100) NOT NULL,          
    email VARCHAR(100) UNIQUE NOT NULL,      
    password_hash VARCHAR(255) NOT NULL,     
    role ENUM('user', 'admin') DEFAULT 'user' 
);


CREATE TABLE budgets (
    b_id INT AUTO_INCREMENT PRIMARY KEY,
    b_name VARCHAR(100) NOT NULL,
    total INT NOT NULL,
    rnd INT DEFAULT 0, 
    machinery INT DEFAULT 0,
    utilities INT DEFAULT 0,
    marketing INT DEFAULT 0
);

CREATE TABLE asked_budgets (
    b_id INT AUTO_INCREMENT PRIMARY KEY,
    b_name VARCHAR(100) NOT NULL,
    total INT NOT NULL,
    rnd INT DEFAULT 0, 
    machinery INT DEFAULT 0,
    utilities INT DEFAULT 0,
    marketing INT DEFAULT 0
);

