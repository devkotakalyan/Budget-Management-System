CREATE DATABASE budgetmanag;

USE budgetmanag;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,       
    fullname VARCHAR(100) NOT NULL,          
    email VARCHAR(100) UNIQUE NOT NULL,      
    password VARCHAR(255) NOT NULL,     
    role ENUM('user', 'admin') DEFAULT 'user',
    image VARCHAR(400)
);


insert into users (fullname, email, password, role) values ('Kalyan Devkota', 'Admin@gmail.com', 'admin', 'admin'); 

CREATE TABLE budgets (
    b_id INT AUTO_INCREMENT PRIMARY KEY,
    b_name VARCHAR(100) NOT NULL,
    total INT NOT NULL,
    rnd INT DEFAULT 0, 
    machinery INT DEFAULT 0,
    utilities INT DEFAULT 0,
    marketing INT DEFAULT 0,
    rem INT DEFAULT 0
);

CREATE TABLE asked_budgets (
    b_id INT AUTO_INCREMENT PRIMARY KEY,
    sent_by VARCHAR(400),
    b_name VARCHAR(100) NOT NULL,
    total INT NOT NULL,
    rnd INT DEFAULT 0, 
    machinery INT DEFAULT 0,
    utilities INT DEFAULT 0,
    marketing INT DEFAULT 0,
    rem INT DEFAULT 0
);

CREATE TABLE stored_budgets (
    b_id INT AUTO_INCREMENT PRIMARY KEY,
    b_name VARCHAR(100) NOT NULL,
    total INT NOT NULL,
    rnd INT DEFAULT 0, 
    machinery INT DEFAULT 0,
    utilities INT DEFAULT 0,
    marketing INT DEFAULT 0,
    rem INT DEFAULT 0,
    status VARCHAR(100)
);

CREATE TABLE user_review (
    id INT AUTO_INCREMENT PRIMARY KEY,
    review VARCHAR(400),
    sent_by VARCHAR(100)
);