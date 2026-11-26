# StyleHub Fashion E-commerce Website

A PHP/MySQL academic/demo e-commerce project using HTML, CSS and JavaScript.

## Features
- Responsive fashion storefront with Men, Women, Kids, Footwear and Accessories categories
- Product catalogue, subcategories, search, category and price filters, sorting
- Product details, images, descriptions, size guide and customer reviews
- Customer registration/login and account page
- Shopping cart: add, edit quantity, remove and checkout
- Wishlist
- Order history, order details and status display
- Admin dashboard to add/edit/deactivate products, update price/description/stock and view customer orders
- Session-based cart and wishlist

## Requirements
- XAMPP/WAMP with PHP 8+ and MySQL/MariaDB
- PDO MySQL extension enabled

## Installation (XAMPP)
1. Extract `stylehub_ecommerce` into `C:\\xampp\\htdocs\\`.
2. Start Apache and MySQL.
3. Open phpMyAdmin (`http://localhost/phpmyadmin`) and import `database.sql`.
4. Confirm database credentials in `config.php` (defaults are standard XAMPP values).
5. Open `http://localhost/stylehub_ecommerce/setup.php` once to create categories, sample products and admin.
6. Delete `setup.php` immediately after setup.
7. Open `http://localhost/stylehub_ecommerce`.

## Demo administrator
- Email: `admin@stylehub.test`
- Password: `admin12345`

Register a customer account through the website to test customer features.

## Important notes
- This is an educational prototype, not a production-ready payment platform.
- Checkout creates an order but does not charge a card or integrate a payment provider. Add and test a provider such as Stripe or PayPal in a compliant server-side flow before accepting payments.
- Product photos use remote Unsplash image URLs and require internet access. Replace with locally licensed images if desired.
- Order status is visible to customers; the included basic admin area currently displays orders but does not provide a status-edit control.
- For production, add stronger operational security, rate limiting, email verification, password reset, inventory locking, tax/shipping calculations, privacy policy, backups and deployment hardening.
