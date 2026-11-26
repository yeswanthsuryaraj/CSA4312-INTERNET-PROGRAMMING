CREATE DATABASE IF NOT EXISTS beauty_parlour CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE beauty_parlour;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(100) NOT NULL, email VARCHAR(190) NOT NULL UNIQUE,
 phone VARCHAR(30) NULL, password_hash VARCHAR(255) NOT NULL,
 role ENUM('customer','stylist','staff','admin') NOT NULL DEFAULT 'customer',
 speciality VARCHAR(150) NULL, active TINYINT(1) NOT NULL DEFAULT 1,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE services (
 id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(120) NOT NULL, description TEXT NULL,
 price DECIMAL(10,2) NOT NULL, duration_minutes INT NOT NULL DEFAULT 30,
 active TINYINT(1) NOT NULL DEFAULT 1, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE bookings (
 id INT AUTO_INCREMENT PRIMARY KEY, user_id INT NOT NULL, service_id INT NOT NULL, stylist_id INT NOT NULL,
 appointment_date DATE NOT NULL, appointment_time TIME NOT NULL, duration_minutes INT NOT NULL,
 total_amount DECIMAL(10,2) NOT NULL, deposit_amount DECIMAL(10,2) NOT NULL DEFAULT 0,
 status ENUM('pending','confirmed','completed','cancelled','no_show') NOT NULL DEFAULT 'pending',
 payment_status ENUM('unpaid','deposit_paid','paid','refunded') NOT NULL DEFAULT 'unpaid',
 payment_reference VARCHAR(190) NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_booking_user FOREIGN KEY(user_id) REFERENCES users(id),
 CONSTRAINT fk_booking_service FOREIGN KEY(service_id) REFERENCES services(id),
 CONSTRAINT fk_booking_stylist FOREIGN KEY(stylist_id) REFERENCES users(id),
 INDEX idx_booking_day_stylist(stylist_id,appointment_date,status)
) ENGINE=InnoDB;

CREATE TABLE feedback (
 id INT AUTO_INCREMENT PRIMARY KEY, booking_id INT NOT NULL, user_id INT NOT NULL,
 rating TINYINT NOT NULL, comment TEXT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_feedback_booking FOREIGN KEY(booking_id) REFERENCES bookings(id),
 CONSTRAINT fk_feedback_user FOREIGN KEY(user_id) REFERENCES users(id)
) ENGINE=InnoDB;

INSERT INTO services(name,description,price,duration_minutes) VALUES
('Signature Haircut','A tailored haircut and finish to suit your style.',650,45),
('Hair Spa','A relaxing nourishing treatment for healthy-looking hair.',1200,60),
('Classic Facial','A refreshing cleanse and facial care experience.',950,60),
('Manicure','Nail shaping, cuticle care and polish.',500,40),
('Pedicure','A relaxing foot-care treatment with polish.',650,50),
('Party Makeup','A polished makeup look for your special occasion.',2500,90),
('Threading','Precise brow and facial threading.',150,15);

-- Demo admin and stylist accounts are created by setup.php.
