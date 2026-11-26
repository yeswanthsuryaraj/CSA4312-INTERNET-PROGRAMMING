CREATE DATABASE IF NOT EXISTS flight_reservation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE flight_reservation;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(120) NOT NULL,
 email VARCHAR(160) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL,
 is_admin TINYINT(1) DEFAULT 0, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE flights (
 id INT AUTO_INCREMENT PRIMARY KEY, airline VARCHAR(120) NOT NULL,
 flight_no VARCHAR(30) NOT NULL, origin VARCHAR(100) NOT NULL,
 destination VARCHAR(100) NOT NULL, departure DATETIME NOT NULL,
 arrival DATETIME NOT NULL, travel_class VARCHAR(30) NOT NULL,
 fare DECIMAL(10,2) NOT NULL, total_seats INT NOT NULL,
 available_seats INT NOT NULL
);
CREATE TABLE bookings (
 id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, flight_id INT NOT NULL,
 passenger_name VARCHAR(120) NOT NULL, passenger_age INT NOT NULL,
 seat_no VARCHAR(10) NOT NULL, amount DECIMAL(10,2) NOT NULL,
 status VARCHAR(30) DEFAULT 'CONFIRMED', booking_code VARCHAR(30) NOT NULL UNIQUE,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id),
 FOREIGN KEY(flight_id) REFERENCES flights(id)
);
CREATE TABLE feedback (
 id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL,
 message TEXT NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY(user_id) REFERENCES users(id)
);

INSERT INTO users(name,email,password,is_admin) VALUES
('Administrator','admin@example.com','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2yp5fS5Z7eK',1);
INSERT INTO flights(airline,flight_no,origin,destination,departure,arrival,travel_class,fare,total_seats,available_seats) VALUES
('SkyWays','SW101','Chennai','Delhi','2026-12-05 08:00:00','2026-12-05 11:00:00','Economy',5200,120,120),
('SkyWays','SW205','Chennai','Mumbai','2026-12-06 10:30:00','2026-12-06 12:30:00','Economy',4100,100,100),
('Aero India','AI330','Bengaluru','Chennai','2026-12-07 16:00:00','2026-12-07 17:00:00','Business',7800,40,40);
