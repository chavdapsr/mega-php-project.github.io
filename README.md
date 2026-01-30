# Mega PHP Learning Project

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)
[![PHP Version](https://img.shields.io/badge/php-%3E%3D7.4-blue.svg)](https://www.php.net/)
[![Composer](https://img.shields.io/badge/composer-installed-green.svg)](https://getcomposer.org/)

A comprehensive PHP learning project demonstrating modern PHP development practices, MVC architecture, authentication, CRUD operations, and RESTful APIs.

## Features

- 🔐 **Authentication System** - User registration, login, logout with secure password hashing
- 📝 **CRUD Operations** - Full Create, Read, Update, Delete functionality for posts
- 🌐 **RESTful API** - JSON API endpoints for posts and users
- 🏗️ **MVC Architecture** - Clean separation of concerns
- 🔒 **Security** - CSRF protection, prepared statements, password hashing
- 💾 **Database** - PDO-based database abstraction with singleton pattern
- 🎨 **Modern UI** - Clean, responsive design with CSS Grid and Flexbox

## Project Structure

```
.
├── app/
│   ├── Core/           # Core classes (Database, Router, Controller, etc.)
│   ├── Controllers/    # Controllers (Auth, Post, Home, API)
│   └── Models/         # Models (User, Post)
├── config/             # Configuration files
├── database/           # Database schema
├── public/             # Public assets and entry point
│   ├── assets/
│   │   └── css/
│   └── index.php
├── views/              # View templates
│   ├── auth/
│   ├── posts/
│   ├── errors/
│   └── layouts/
├── composer.json
└── README.md
```

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher (or MariaDB)
- Composer (for autoloading)
- Apache with mod_rewrite (or Nginx with proper configuration)

## Installation

1. **Clone or download the project**

2. **Install dependencies** (if using Composer):
   ```bash
   composer install
   ```

3. **Create the database**:
   ```bash
   mysql -u root -p < database/schema.sql
   ```

4. **Configure database connection**:
   Edit `config/database.php` with your database credentials:
   ```php
   'host' => 'localhost',
   'dbname' => 'php_learning_db',
   'username' => 'your_username',
   'password' => 'your_password',
   ```

5. **Start the development server**:
   ```bash
   php -S localhost:8000 -t public
   ```
   
   Or use Composer:
   ```bash
   composer serve
   ```

6. **Access the application**:
   Open your browser and navigate to `http://localhost:8000`

## Usage

### Web Interface

- **Home**: `/` - Landing page with project overview
- **Register**: `/register` - Create a new account
- **Login**: `/login` - Login to your account
- **Posts**: `/posts` - View all posts
- **Create Post**: `/posts/create` - Create a new post (requires login)
- **View Post**: `/posts/{id}` - View a specific post
- **Edit Post**: `/posts/{id}/edit` - Edit a post (requires ownership)
- **Delete Post**: `/posts/{id}/delete` - Delete a post (requires ownership)

### API Endpoints

All API endpoints return JSON responses:

- `GET /api/posts` - Get all posts
- `GET /api/posts/{id}` - Get a specific post
- `POST /api/posts` - Create a new post (requires authentication)
  ```json
  {
    "title": "Post Title",
    "content": "Post content here"
  }
  ```
- `GET /api/users` - Get all users
- `GET /api/users/{id}` - Get a specific user

## Learning Concepts Demonstrated

1. **Object-Oriented Programming (OOP)**
   - Classes and objects
   - Namespaces
   - Autoloading with PSR-4

2. **Design Patterns**
   - Singleton pattern (Database)
   - MVC pattern
   - Dependency Injection concepts

3. **Security**
   - Password hashing with `password_hash()`
   - CSRF token protection
   - Prepared statements (SQL injection prevention)
   - Input validation and sanitization

4. **Database**
   - PDO (PHP Data Objects)
   - Database abstraction layer
   - Foreign key relationships
   - Transactions (can be extended)

5. **Routing**
   - Custom router implementation
   - URL parameter extraction
   - RESTful routing

6. **Session Management**
   - Session handling
   - Flash messages
   - User authentication state

7. **API Development**
   - JSON responses
   - HTTP status codes
   - RESTful API design

## Extending the Project

### Adding New Features

1. **Create a Model**: Add a new class in `app/Models/`
2. **Create a Controller**: Add a new controller in `app/Controllers/`
3. **Create Views**: Add view files in `views/`
4. **Add Routes**: Register routes in `public/index.php`

### Example: Adding Comments Feature

1. Create `app/Models/Comment.php`
2. Create `app/Controllers/CommentController.php`
3. Add routes in `public/index.php`
4. Create view files in `views/comments/`
5. Update database schema

## Security Notes

- Change default database credentials
- Use environment variables for sensitive data (consider adding `.env` support)
- Enable HTTPS in production
- Set `secure` flag to `true` in session config for HTTPS
- Implement rate limiting for API endpoints
- Add input validation middleware
- Consider using a framework like Laravel or Symfony for production

## License

This project is created for educational purposes. Feel free to use and modify as needed.

## Contributing

This is a learning project. Feel free to fork, modify, and experiment!

## Resources

- [PHP Manual](https://www.php.net/manual/en/)
- [PDO Documentation](https://www.php.net/manual/en/book.pdo.php)
- [PSR-4 Autoloading](https://www.php-fig.org/psr/psr-4/)
# mega-php-project.github.io
# mega-php-project.github.io
