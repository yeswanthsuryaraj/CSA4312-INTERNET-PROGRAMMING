# PowerPay – Electricity Bill Payment Website

A responsive front-end demonstration of an online electricity billing portal, built with HTML, CSS and vanilla JavaScript.

## Run
1. Extract `PowerPay_Electricity_Bill_WebApp.zip`.
2. Open `index.html` in a modern browser.
3. No package installation or build step is required.

## Demo accounts
- Customer: `customer@powerpay.demo` / `user123`
- Admin: `admin@powerpay.demo` / `admin123`

You can also register a new customer from the login screen.

## Customer features
- Dashboard with current bill, billing period, due date, unit consumption and payment history.
- Domestic or commercial connection selection during registration.
- Progressive slab-wise electricity charge calculation.
- Late fee of ₹10 per day after the configured due date (admin can change the rate).
- Credit card, debit card, net banking and digital wallet payment-method selection.
- Successful demo transaction creates a receipt with download and email-app options.
- Auto-pay, email reminder and SMS reminder preferences.

## Admin features
- Customer directory and customer account creation.
- Update each customer's units consumed in the current billing cycle.
- Edit domestic and commercial tariff rates.
- Configure billing period start/end dates, due date and daily late fine.
- Overview of customers, payments and billed/collected amounts.

## Default tariff slabs
| Units | Domestic | Commercial |
|---|---:|---:|
| First 100 | ₹1/unit | ₹2/unit |
| 101–200 | ₹2.50/unit | ₹4.50/unit |
| 201–500 | ₹4/unit | ₹6/unit |
| Above 500 | ₹6/unit | ₹7/unit |

Rates are applied progressively to each band. For example, 250 domestic units = 100×₹1 + 100×₹2.50 + 50×₹4.

## Important demo limitations
- This is a browser-only prototype. Data is stored in the current browser's localStorage and is not shared between devices or users.
- Payment method selection and confirmation simulate a successful payment; no real card/bank/wallet transaction occurs. A production payment gateway and server-side verification are required.
- Email receipt uses the device's configured email application. Email/SMS reminders are preference toggles only; actual delivery requires an email/SMS provider and backend scheduler.
- Auto-pay is a saved preference only and does not charge a payment method.
- Authentication is for demonstration only. Production use requires secure server-side authentication, password hashing, authorization and database storage.
- The default billing dates are sample dates. Admin can update the cycle and due date.
- The late fine is calculated from the browser's current date and is added for each calendar day after the due date.
