# My Reading Shelf 📚

A web application to track and manage your personal book collection.

## Project Structure

```
project/
├── includes/
│   ├── db.php          # Database connection
│   ├── functions.php   # Helper functions
│   ├── navbar.php      # Shared navbar
│   └── footer.php      # Shared footer
├── auth/
│   ├── register.php    # User registration
│   ├── login.php       # User login
│   └── logout.php      # Logout
├── js/
│   └── script.js       # Frontend JavaScript
├── BookImages/         # Book cover images
├── index.php           # Home page
├── app.php             # Reading list app
├── discover.php        # Discover books
├── contact.php         # Contact form
├── dashboard.php       # User dashboard
├── style.css           # Stylesheet
└── database.sql        # MySQL database dump
```

## Setup Instructions

### 1. Requirements
- XAMPP or WAMP installed
- PHP 7.4+
- MySQL

### 2. Import the Database
1. Open **phpMyAdmin** at `http://localhost/phpmyadmin`
2. Click **Import**
3. Select the `database.sql` file
4. Click **Go**

### 3. Run the Project
1. Copy the project folder to `C:/xampp/htdocs/` (XAMPP) or `C:/wamp/www/` (WAMP)
2. Start **Apache** and **MySQL** from the XAMPP/WAMP control panel
3. Open your browser and go to: `http://localhost/project/`

### 4. Default Database Config
In `includes/db.php`:
- Host: `localhost`
- User: `root`
- Password: `` (empty for XAMPP default)
- Database: `reading_shelf`

## Features
- User registration and login with hashed passwords
- Session-based authentication
- Contact form with database storage
- Personal reading list (Add, Edit, Delete books)
- Book filtering by category and status
- Discover bestseller books
- User dashboard with reading stats
