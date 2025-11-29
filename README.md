# MiniBlog

A lightweight PHP blog application with user authentication and post management.

## Features

- **User Authentication**
  - User registration with email and password
  - Secure login with session management
  - Password hashing using bcrypt

- **Post Management**
  - Create new blog posts
  - View posts on the home page
  - Styled alert notifications for user feedback

## Project Structure

```
miniblog/
├── config.php              # Database configuration
├── index.php               # Root redirect to home page
├── setup.php               # Database setup (alternative method)
├── database.sql            # Database schema and sample data
├── pages/
│   ├── home.php           # Home page with blog posts
│   ├── post.php           # Create new post page
│   ├── login.php          # User login page
│   └── register.php       # User registration page
├── includes/
│   ├── header.php         # Header template
│   └── footer.php         # Footer template
└── README.md              # This file
```

## Usage

### Register a New Account

1. Click **Sign up here** on the login page
2. Enter username, email, and password
3. Confirm your password
4. Click **Register**

### Login

1. Visit `/pages/login.php`
2. Enter your email and password
3. Click **Login**
4. On success, you'll be redirected to the home page with an active session

### Create a Blog Post

1. Navigate to `/pages/post.php`
2. Enter post **Title**
3. Enter post **Content**
4. Click **Submit**
5. You must be logged in to create posts

### View Posts

1. Visit the home page (`/pages/home.php`)
2. All published posts are displayed with creation dates

## Database Schema

### Users Table

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  -- bcrypt hashed
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### Posts Table

```sql
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content LONGTEXT NOT NULL,
    user VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Security Features

- **Password Hashing:** Passwords use `password_hash()` with bcrypt algorithm
- **SQL Injection Prevention:** All database queries use prepared statements
- **Input Sanitization:** User inputs are filtered using `FILTER_SANITIZE_*`
- **Session Management:** Secure session handling with `$_SESSION`
- **Password Verification:** Uses `password_verify()` for secure authentication

## Technologies Used

- **Backend:** PHP 7.0+
- **Database:** MySQL 5.7+ / MariaDB 10.2+
- **Frontend:** HTML5, CSS3 (inline styling)
- **Authentication:** bcrypt password hashing, PHP Sessions

## Future Enhancements

- [ ] Post editing and deletion
- [ ] User profile pages
- [ ] Comments on posts
- [ ] Search functionality
- [ ] Categories/tags
- [ ] Admin dashboard
- [ ] Email verification
- [ ] Logout functionality
- [ ] Remember me checkbox
- [ ] Dark mode theme
- [ ] Export posts as PDF

## License

This project is open source and available under the **MIT License**.

## Author

[georgepelal](https://github.com/georgepelal)

---

**Happy blogging!** 📝
