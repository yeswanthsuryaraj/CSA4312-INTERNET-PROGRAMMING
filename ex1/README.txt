LIBRARY MANAGEMENT SYSTEM - HTML & CSS FRONT-END

FILES
- index.html              Home page
- catalog.html            Book catalog
- book-details.html       Example book details page
- login.html              Student login UI
- register.html           Student registration UI
- student-dashboard.html  Student dashboard UI
- admin-dashboard.html    Admin dashboard UI
- contact.html            Contact form UI
- style.css               Shared responsive styles

HOW TO RUN
1. Extract this ZIP file.
2. Keep all HTML files and style.css in the same folder.
3. Double-click index.html to open the home page in a browser.
4. Use the navigation links to move between the sample pages.
5. Edit text, book examples, colors, and contact details to suit your library.

IMPORTANT LIMITATIONS
This is a static HTML/CSS design. Forms do not submit data, authentication is not implemented,
catalog search is not functional, and dashboard data is sample content.

FUTURE ASP.NET CORE + SQL SERVER INTEGRATION
1. Create an ASP.NET Core MVC or Razor Pages project.
2. Move shared styling into wwwroot/css/style.css.
3. Convert each HTML page into a Razor view/page.
4. Create models such as Book, ApplicationUser/Member, Loan, Fine, and ContactMessage.
5. Use Entity Framework Core with SQL Server for persistence.
6. Implement authentication and role-based authorization for Student and Admin.
7. Connect catalog search to database queries.
8. Implement issue/return transactions and calculate overdue fines on the server.
9. Validate all submitted data on the server; never rely on HTML validation alone.
10. Test security, authorization, and edge cases before deployment.

Do not use the sample dashboard values as real library records.
