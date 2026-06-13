-- Run this file in phpMyAdmin or MySQL CLI to create the database and table

CREATE DATABASE IF NOT EXISTS hospital_db;
USE hospital_db;

CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    gender VARCHAR(10) NOT NULL,
    disease VARCHAR(150) NOT NULL,
    doctor_assigned VARCHAR(100) NOT NULL,
    admitted_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data (optional)
INSERT INTO patients (name, age, gender, disease, doctor_assigned) VALUES
('Ali Raza', 34, 'Male', 'Fever', 'Dr. Ahmed'),
('Sara Khan', 28, 'Female', 'Fracture', 'Dr. Bilal'),
('Usman Tariq', 45, 'Male', 'Diabetes', 'Dr. Sana');
