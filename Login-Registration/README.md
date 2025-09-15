
# Simple Login & Registration System

This is a simple **Login and Registration system** built using **PHP** and **MySQL**. Users can register by providing a username, email, and password, and later log in using their credentials. The password is stored in plain text in the database for demonstration purposes.

> ⚠ **Important:** Storing passwords as plain text is insecure. This system is only for learning or testing and should not be used in real applications.

## Features

- User registration with form validation.
- User login with validation and session management.
- Passwords stored as plain text.
- Error messages shown for invalid inputs.
- Simple user interface using Bootstrap 5.

## Technologies Used

- PHP
- MySQL
- HTML / CSS (Bootstrap 5)

## Setup Instructions

### 1. Database Setup

Create a database and a table named `users` using the following SQL:

```sql
CREATE DATABASE my_database;

USE my_database;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
```

### 2. Configure Database Connection

Create a file named `db.php` with the following content and update it with your database credentials:

```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "my_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
```

### 3. Run the Project

1. Install a local server environment like **XAMPP**, **WAMP**, or **MAMP**.
2. Place all the project files inside the `htdocs` or equivalent folder.
3. Import or create the database using the provided SQL script.
4. Open your browser and access:
   - `http://localhost/your_project_folder/registration.php` to register.
   - `http://localhost/your_project_folder/login.php` to log in.

## Notes

- Passwords are stored and compared as plain text — this is only for learning purposes.
- For production applications, always hash passwords using `password_hash()` and `password_verify()` to secure user data.

## License

This project is open-source and free to use for educational purposes.


## contact me
checkout homepage 