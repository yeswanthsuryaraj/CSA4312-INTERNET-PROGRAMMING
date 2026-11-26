# Online Beauty Parlour Appointment Booking System

A responsive PHP + MySQL appointment booking starter application for a beauty salon.

## Features
- Customer registration, login and personal dashboard
- Service catalogue with price and appointment duration
- Stylist selection and appointment requests
- Date/time selection with overlapping-booking prevention per stylist
- Customer cancellation and appointment history
- Admin/staff dashboard with reservation list, date filter and status updates
- Add services and create stylist/staff accounts
- Customer feedback and ratings
- Optional Stripe Checkout deposit integration (20% deposit)
- Responsive HTML/CSS and vanilla JavaScript

## Requirements
- XAMPP (Apache + PHP 8.0+ + MySQL/MariaDB)
- PHP PDO MySQL extension
- PHP cURL extension (only for Stripe)
- Modern browser

## Install on Windows with XAMPP
1. Extract this ZIP into `C:\\xampp\\htdocs\\beauty_parlour_booking`.
2. Start **Apache** and **MySQL** from XAMPP Control Panel.
3. Open `http://localhost/phpmyadmin`.
4. Import `database.sql`. It creates the `beauty_parlour` database and sample services.
5. Open `config.php` and confirm DB_HOST, DB_NAME, DB_USER and DB_PASS. The defaults match a standard local XAMPP install.
6. Visit `http://localhost/beauty_parlour_booking/setup.php` once to create demo admin and stylist accounts.
7. **Delete `setup.php` immediately after running it.**
8. Open `http://localhost/beauty_parlour_booking`.

## Demo accounts
- Admin: `admin@glowandgo.test` / `admin12345`
- Stylist: `stylist@glowandgo.test` / `stylist12345`
- Stylist: `mira@glowandgo.test` / `mira12345`

Change demo passwords before using this application outside a local demo.

## Optional Stripe payments
1. Create a Stripe account and use test mode first.
2. Put your Stripe **secret test key** in `STRIPE_SECRET_KEY` in `config.php`.
3. Add a payment link/button for pending bookings in the customer dashboard if desired. The `payment.php?booking=BOOKING_ID` endpoint creates a Stripe Checkout Session for the deposit; the success endpoint verifies the Checkout Session with Stripe before updating payment status.
4. Configure HTTPS and a production-grade webhook before going live. Do not use live keys until you have tested the full flow.

The application does not store card details. Stripe handles card entry and processing. If Stripe is not configured, booking requests still work but online payment is disabled.

## Important notes / production checklist
This is a functional academic/demo project, not a fully audited commercial booking platform. Before public deployment:
- Set a strong database password and protect configuration secrets outside the web root.
- Use HTTPS, secure cookie settings and a production PHP configuration.
- Add email/SMS provider credentials and notification jobs; this starter currently displays booking information in the dashboards but does not send real emails or SMS.
- Add a proper weekly stylist schedule/holiday management screen and server-side closed-hour rules. The demo uses a basic 09:00–18:30 slot window.
- Add Stripe webhooks for reliable asynchronous payment updates and refund handling.
- Add rate limiting, audit logs, account recovery, staff permissions and automated tests.
- Review local privacy, tax and payment compliance requirements.

## Main files
- `index.php` — homepage
- `register.php`, `login.php`, `logout.php` — authentication
- `services.php`, `book.php` — service listing and booking
- `dashboard.php` — customer account, cancellation and feedback
- `admin.php` — salon manager/staff management panel
- `payment.php`, `payment_success.php` — optional Stripe Checkout
- `database.sql` — schema and sample services
- `config.php` — database and application configuration
