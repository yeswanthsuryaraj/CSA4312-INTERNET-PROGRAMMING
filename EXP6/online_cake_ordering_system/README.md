# Online Cake Ordering System
Responsive PHP + MySQL educational project.

## Requirements
- PHP 8+
- MySQL / MariaDB
- XAMPP, WAMP, or another Apache/PHP stack

## Setup
1. Extract this folder into XAMPP's `htdocs` directory.
2. Start Apache and MySQL.
3. Open phpMyAdmin and import `database.sql`.
4. Check database credentials in `config.php`.
5. Visit `http://localhost/online_cake_ordering_system/`.

## Demo admin account
Email: admin@cake.com
Password: admin123

## Included
- Student/customer registration and login
- Admin login and dashboard
- Cake categories and subcategories
- Cake catalogue with search, category and price filters
- Cake details and image upload
- Cart and checkout
- Shipping address entry and update
- Demo payment confirmation (not a live payment gateway)
- My orders and shipping status
- Admin product, order and status management

Uploaded cake images are stored in `uploads/`. Create that folder with write permission if your server does not allow uploads automatically.

This is a local educational starter project. Live payment processing, transactional emails, delivery-provider tracking, and production security hardening require external services and additional configuration.
