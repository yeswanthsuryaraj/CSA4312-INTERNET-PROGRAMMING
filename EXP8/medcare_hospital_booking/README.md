# MedCare Hospital Appointment Booking System

A PHP + MySQL academic/demo web application with patient, hospital and admin workflows.

## Included features
- Patient signup/login, profile update and appointment history
- Search doctors by specialty and hospital city/location
- Hospital directory/profile with Google Maps search link
- Appointment request with doctor/date/time selection and duplicate-slot prevention
- Patient appointment cancellation and status viewing
- Check-in form submission and check-in history
- Doctor ratings/reviews after completed appointments
- Hospital registration/login, hospital profile/location update and doctor creation
- Admin/hospital appointment management and basic statistics
- Responsive HTML/CSS and JavaScript

## Requirements
- XAMPP or WAMP with PHP 8+ and MySQL/MariaDB
- PDO MySQL extension enabled
- Apache and MySQL running

## Installation (XAMPP / Windows)
1. Extract the folder `medcare_hospital_booking` into `C:\\xampp\\htdocs\\`.
2. Start Apache and MySQL in XAMPP.
3. Open phpMyAdmin at `http://localhost/phpmyadmin`.
4. Import `database.sql`. It creates the `medcare_hospital` database.
5. Check database settings in `config.php` (defaults suit common XAMPP setups).
6. Visit `http://localhost/medcare_hospital_booking/setup.php` once to create demo admin, sample hospital and sample doctors.
7. Delete `setup.php` immediately after setup.
8. Open `http://localhost/medcare_hospital_booking`.

## Demo credentials
- Admin: `admin@medcare.test` / `admin12345`
- Sample doctor accounts: `ananya@medcare.test`, `karthik@medcare.test`, `meera@medcare.test` / `doctor12345`
- Patient: register using the signup page.
- Hospital: register a hospital using the hospital registration link.

## Important limitations and safety
This is a functional educational prototype, not a production healthcare system and **not certified for HIPAA, India's DPDP Act, or any other healthcare/privacy regulation**. Do not enter real patient records or sensitive health information. Before real deployment, obtain legal/security review and implement appropriate privacy controls, encryption, access auditing, consent, backups, secure hosting, retention policies, and incident response.

Email/SMS reminders are not wired to a delivery provider in this starter. Google Maps uses a public Google Maps search URL. Appointment slot conflict checking is a basic demo implementation; production systems should enforce slot integrity transactionally and account for doctor working hours, leave, time zones and appointment durations.

## Main files
- `index.php`: home page
- `register.php`, `login.php`: patient registration/login
- `doctors.php`, `hospital.php`: search and hospital details
- `book.php`, `dashboard.php`: appointment workflow, check-in and history
- `manage.php`: admin/hospital management
- `hospital_register.php`: hospital onboarding
- `profile.php`, `review.php`: patient profile and ratings
- `database.sql`: schema
