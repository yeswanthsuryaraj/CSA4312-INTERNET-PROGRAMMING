# Online Flight Reservation System

A starter web application built with PHP, MySQL, HTML, CSS and JavaScript.

## Requirements
- PHP 8+
- MySQL 5.7+ / MariaDB
- Apache (XAMPP/WAMP recommended)

## Setup
1. Copy this folder into your XAMPP `htdocs` directory.
2. Start Apache and MySQL.
3. Open phpMyAdmin and import `database.sql`.
4. Update database credentials in `config.php` if needed.
5. Visit `http://localhost/online_flight_reservation_system/`.

## Default administrator
Email: admin@example.com  
Password: admin123

Change the default password before using this outside a local demo.

## Included modules
- Customer registration and login
- Admin login
- Flight search by origin, destination, date and class
- Flight listing with remaining seat inventory
- Booking with passenger details
- Demo payment flow (not connected to a real payment gateway)
- My tickets, booking status, cancellation and printable ticket
- Customer feedback
- Admin flight management and booking report
- Forgot-password page (demo instructions; configure email delivery for production)

This is an educational starter project. Real-time global airline inventory, live payment processing,
and transactional email require external provider/API credentials and are not enabled by default.
