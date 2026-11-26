# InsureEasy Web App

A responsive, browser-based insurance management demo with Admin, Agent and User workspaces.

## Run it
1. Extract `InsureEasy_WebApp.zip`.
2. Open `index.html` in a modern browser. No build tools or server are required.
3. Data is stored in your browser using `localStorage`.

## Demo roles
- **Admin:** choose Admin, use name `Admin User`, email `admin@insureeasy.demo`.
- **Agent:** register a new agent, approve the registration from the Admin workspace, then sign in using the same email and name.
- **User:** choose User, use name `Rohan Kumar`, email `rohan@example.com`.

The demo does not use password authentication. Role selection is for demonstration only.

## Included features
- Admin dashboard, agent approval and agent directory
- Agent registration, customer creation and policy management
- Reminder/SMS alert log
- User policy dashboard, policy catalogue and payment-history view
- Responsive layout and browser-persisted sample data

## Important production notes
This is a front-end prototype, not a production insurance platform. SMS reminders are logged locally and are **not delivered**. Payments are not processed. Before production use, add a secure backend, password hashing, role-based authorization, database, audit logs, validated insurance product data, an SMS provider, a payment gateway, HTTPS, privacy controls and applicable regulatory/compliance review.