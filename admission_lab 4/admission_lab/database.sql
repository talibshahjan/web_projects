-- Task 1: Database and table for the admission lab
CREATE DATABASE IF NOT EXISTS admission_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE admission_db;

CREATE TABLE IF NOT EXISTS applications (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    full_name   VARCHAR(100) NOT NULL,
    father_name VARCHAR(100) NOT NULL,
    email       VARCHAR(100) NOT NULL,
    phone       VARCHAR(20)  NOT NULL,   -- text keeps leading zeros and the + sign
    program     VARCHAR(100) NOT NULL
);
