# TaxWise Income Tax Calculator

## Run
Extract the ZIP and open `index.html` in a modern browser. No install required.

## Demo accounts
- Employee: employee@demo.com / employee123
- Admin: admin@taxwise.demo / admin123

## Employee functions
Enter monthly gross pay, annual bonus, other taxable income, monthly HRA, monthly pension contribution and monthly health insurance premium. Calculate gross annual income, deductions, net taxable income, tax and net income after tax. Download a text summary report.

## Admin functions
Enable/disable employee input fields, edit field labels and update standard deduction, pension cap, nil-tax threshold, slab thresholds, slab rates and base tax amounts. Settings are stored in local browser storage.

## Rules transcribed from the project brief
Gross annual income = monthly gross pay × 12 + annual bonus + other taxable income.
Net taxable income = gross annual income − (HRA × 12) − standard deduction − pension deduction (monthly × 12, capped) − (health insurance × 12).
Tax is nil if net taxable income is below ₹500,000. Otherwise:
- ₹0–₹250,000: 0%
- ₹250,001–₹500,000: 5% on amount above ₹250,000
- ₹500,001–₹1,000,000: ₹12,500 + 20% on amount above ₹500,000
- Above ₹1,000,000: ₹112,500 + 30% on amount above ₹1,000,000

## Interpretation and limitations
The brief contains a conflict: it states tax is nil below ₹500,000, while also specifying a 5% slab from ₹250,001 to ₹500,000. The app applies the explicit nil-tax-below-₹500,000 condition first; the admin can adjust this threshold if a different interpretation is required.
These are the rules supplied in the assignment, not verified current Indian tax law. No live government update, cess, surcharge, regime selection or official return filing is implemented. Google/social login is represented by demo credentials only; production authentication, secure server-side storage and multi-user access require a backend. Educational prototype only.
