# EasyToll demo web application

## Run
Extract the ZIP and open `index.html` in a modern browser. No build step is needed.

## Features
- Driver registration/login, vehicle management and eWallet demo top-ups.
- Buy toll eTickets for a selected toll gate, vehicle and travel date.
- Apply for monthly/quarterly/annual toll passes and request renewal.
- Admin approval of pass applications, QR-style pass/ticket display and toll details management.
- Admin user/pass management and ticket invalidation.
- Toll gate operator login, manual QR/reference ID verification, verification log and current toll location update.
- Public toll gate directory and dashboard counts.
- Browser localStorage persistence.

## Demo accounts
- User: `user@easytoll.demo` / `user123`
- Toll gate operator: `gate@easytoll.demo` / `gate123`
- Admin: `admin@easytoll.demo` / `admin123`

## Important limitations
This is a front-end prototype. Wallet top-ups and toll payments are simulated; no money is charged and no real toll authority is contacted. QR display is a demo visual/reference token, not a production cryptographic QR credential. Real QR scanning, toll plaza integration, automatic recurring payments, SMS/email notifications, secure authentication, payment gateway, server-side database and live balance updates require a secure backend and integrations. Do not enter real payment or sensitive information.
