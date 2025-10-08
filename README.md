# 🚗 Autos Database Project

A simple web-based application for tracking automobile records, built with **PHP**, **MySQL**, and **Bootstrap**. This project allows users to log in, add new automobile records, and view all autos in a responsive, styled table.

## 🔹 Features

### User Authentication: 
- Secure login system with session-based access control. Only logged-in users can add or view records.
### Add New Autos: 
- Users can add automobile records with Make, Year, and Mileage.
1. Validation for numeric Year and Mileage.
2. Make is required.

### View Autos:
- Displays all saved automobiles in a clean, responsive table.
1. Alternating row colors for readability.
2. Session-based status messages for success/error notifications.
3. Fallback message if no records exist.

### Logout Functionality:
- Users can securely log out, ending their session.

### Modern UI/UX:

- Responsive design using Bootstrap 5.
- Gradient backgrounds, card-style forms, and hover animations.
- Smooth fade-in animations for forms and tables.

## 🔹 Tech Stack

- Backend: PHP 8+
- Database: MySQL
- Frontend: HTML5, CSS3, Bootstrap 5
- Tools: XAMPP / Laragon, VS Code

## 🔹 Installation & Setup
- Clone the repository:
```bash 
git clone https://github.com/satyasaadhika/autos-add-operation.git
cd autos-add-operation
```
### Set up MySQL Database:
- Create a database called autosdb.
- Run the following SQL to create the autos table:
```bash
CREATE TABLE autos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    make VARCHAR(255),
    year INT,
    mileage INT
);
```
### Configure PHP:
- Ensure PHP and a local server like XAMPP or Laragon is installed.
- Update database credentials in PHP files if needed:
```bash
$pdo = new PDO('mysql:host=localhost;dbname=autosdb', 'root', '');
```
- Run the application:
- Start your local server and navigate to:
```bash
http://localhost/autos-add-operation/index.php
```

### 🔹 Usage

#### Landing Page (index.php):
- Provides a welcome message and login button. Users are prompted to log in before accessing other pages.

#### Login (login.php):
- Enter your email and password (php123 as default password).
- Invalid attempts show error messages using sessions.
#### Add New Auto (add.php):
- Fill in Make, Year, and Mileage.
- Validations ensure data integrity.
- After submission, the user is redirected to view.php with a success message.

#### View Autos (view.php):
- Displays all automobile records in a table.
- Users can add new autos or log out.

#### Logout (logout.php):
- Ends the session and redirects the user back to the landing page.

### 🔹 Project Structure

```bash
autos-add-operation/
│
├── index.php        # Landing page
├── login.php        # User login page
├── add.php          # Add new auto page
├── view.php         # View all autos
├── logout.php       # Logout script
├── README.md        # Project documentation
└── assets/          # (Optional) Images, CSS, JS
```
### 🔹 Notes

- Password hint for default login:
- The password is the sound a cat makes (php) followed by 123 → php123.
- Ensure the session is enabled in PHP (session_start()) for proper functioning.
- For security, consider using hashed passwords and prepared statements (already used in add.php for inserts).
---

### 🔹 License
This project is open-source and free to use for learning and demonstration purposes.

