CREATE DATABASE BudgetManagement;

USE BudgetManagement;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,       
    fullname VARCHAR(100) NOT NULL,          
    email VARCHAR(100) UNIQUE NOT NULL,      
    password_hash VARCHAR(255) NOT NULL,     
    role ENUM('user', 'admin') DEFAULT 'user' 
);


