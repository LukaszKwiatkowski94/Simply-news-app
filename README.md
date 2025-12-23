# 📰 Simply News App

> **A modern, framework-free PHP news portal** built with clean architecture, custom routing, and real-world functionality. Perfect for learning modern PHP development patterns or deploying as a lightweight news management system.

[![PHP Version](https://img.shields.io/badge/PHP-8.1+-blue)](https://www.php.net/)
[![License](https://img.shields.io/badge/License-MIT-green)](LICENSE)
[![GitHub](https://img.shields.io/badge/GitHub-LukaszKwiatkowski94-lightgrey)](https://github.com/LukaszKwiatkowski94/Simply-news-app)

---

## 🎯 About

**Simply News App** is a full-featured news management system built entirely in PHP without relying on any framework. This project demonstrates professional PHP development practices including MVC architecture, custom routing, exception handling, and database abstraction.

Whether you're a student learning PHP, a developer exploring framework-free architecture, or someone needing a lightweight news portal—this application is designed to be **simple, readable, and extensible**.

---

## ✨ Features

- 📰 **Multi-Category News** - Organize articles by topics and categories
- 👤 **User Authentication** - Secure login/signup with session management
- 🔐 **Role-Based Access Control** - Separate permissions for admins and regular users
- ✏️ **Content Management** - Create, edit, and publish news articles
- 💬 **Comment System** - Readers can engage with articles via comments
- 🎨 **Responsive UI** - Modern, mobile-friendly design with vanilla CSS & JavaScript
- 🛣️ **Custom Router** - Lightweight HTTP routing engine without framework overhead
- 🗄️ **Database Abstraction** - Clean model layer with PDO for database operations
- 🚀 **Docker Ready** - Easily deployable with Docker containers
- 🔧 **Configuration Management** - Environment-based settings via `.env` file

---

## 📦 What's Included

```
Simply News App/
├── 📁 src/                    # Core application logic
│   ├── Controllers/           # Request handlers
│   ├── Models/                # Database layer
│   ├── Classes/               # Utility classes
│   ├── Exception/             # Custom exceptions
│   ├── Router.php             # Custom routing engine
│   ├── Request.php            # HTTP request wrapper
│   ├── Response.php           # HTTP response wrapper
│   └── View.php               # Template renderer
├── 📁 config/                 # Application configuration
│   ├── routes.php             # Route definitions
│   ├── configuration.php      # App settings
│   ├── database.php           # DB configuration
│   └── env.php                # Environment variables
├── 📁 database/               # Database initialization
│   ├── init.php               # Database setup script
│   └── schema.sql             # Schema reference
├── 📁 templates/              # View files (MVC templates)
│   └── pages/                 # Page-specific templates
├── 📁 public/                 # Frontend assets
│   ├── css/                   # Stylesheets
│   ├── js/                    # Client-side scripts
│   ├── img/                   # Images
│   └── icon/                  # Icons & favicons
├── 📄 docker-entrypoint.sh    # Docker startup script
├── 📄 Dockerfile              # Docker image definition
├── 📄 docker-compose.yml      # Multi-container setup
├── 📄 index.php               # Application entry point
└── 📄 .env                    # Environment variables
```

---

## 🚀 Quick Start

### Prerequisites

- PHP 8.1 or higher
- MySQL 8.0 or higher
- Docker & Docker Compose (for Docker deployment)
- Git

### Installation & Setup

#### Option 1: Using Docker (Recommended)

1. **Clone the repository:**

   ```bash
   git clone https://github.com/LukaszKwiatkowski94/Simply-news-app.git
   cd Simply-news-app
   ```

2. **Configure `.env`:**

   ```bash
   cp example.env .env
   ```

   Edit `.env` and set:

   ```env
   DB_HOST=mysql
   DB_NAME=simplyNewsDB
   DB_USER=root
   DB_PASS=password
   APP_ENV=docker
   ADMIN_DEFAULT_PASSWORD=ChangeMe123!
   ```

3. **Start Docker:**

   ```bash
   docker-compose up -d
   ```

   The startup process handles everything automatically:

   - MySQL container starts and waits for readiness
   - Web container runs `docker-entrypoint.sh`
   - `php database/init.php` creates database, tables, and admin user
   - Apache starts and app is ready

4. **Access the application:**
   - **Web App:** http://localhost:8080
   - **PHPMyAdmin:** http://localhost:8081
   - **Default login:** `admin` / `ChangeMe123!`
   - **⚠️ Change password immediately!** (feature to be implemented)

#### Option 2: Local Development (without Docker - with MySQL)

If you have MySQL installed locally:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/LukaszKwiatkowski94/Simply-news-app.git
   cd Simply-news-app
   ```

2. **Configure environment variables:**

   ```bash
   cp example.env .env
   ```

   Edit `.env`:

   ```env
   DB_HOST=localhost
   DB_PORT=3306
   DB_NAME=simplyNewsDB
   DB_USER=root
   DB_PASS=password
   APP_ENV=development
   ADMIN_DEFAULT_PASSWORD=ChangeMe123!
   ```

3. **Initialize database:**

   ```bash
   php database/init.php
   ```

   This script will:

   - Create the database
   - Create all tables
   - Seed the default admin user with password from `ADMIN_DEFAULT_PASSWORD`

4. **Start the development server:**

   ```bash
   php -S localhost:8000 index.php
   ```

5. **Access the application:**
   - Open http://localhost:8000
   - Default login: `admin` / `ChangeMe123!`
   - **⚠️ Change password immediately!**

---

## 🔑 First Login & Security

### Default Admin Account

When you first start the application, a default admin user is automatically created:

- **Username:** `admin`
- **Password:** `ChangeMe123!` (from `ADMIN_DEFAULT_PASSWORD` env variable)

### ⚠️ Important Security Notes

1. **Change Default Password Immediately**

   - The default password is `ChangeMe123!` from `ADMIN_DEFAULT_PASSWORD` env variable
   - **TODO:** Application should force password change on first login
   - Change it via user profile or database:
     ```bash
     php -r "echo password_hash('NewPassword', PASSWORD_DEFAULT);"
     # Then update in database via PHPMyAdmin or MySQL CLI
     ```

2. **Creating Additional Admin Users**

   - Create regular users via signup page
   - Grant admin privileges via database:
     ```sql
     UPDATE SN_users SET is_admin = 1 WHERE username = 'username';
     ```
   - Or modify `database/init.php` before first run

3. **Production Deployment**

   - Set `APP_ENV=production` to block init.php execution
   - Initialize database manually before deployment
   - Change `ADMIN_DEFAULT_PASSWORD` to a strong, unique password
   - Never commit `.env` to version control
   - Use environment-specific configurations

---

## 🐳 Docker Deployment

### Using Docker Compose

The easiest way to run the entire application stack (Web + MySQL + PHPMyAdmin):

1. **Configure `.env` file:**

   ```bash
   cp example.env .env
   ```

   Edit `.env`:

   ```env
   DB_HOST=mysql
   DB_NAME=simplyNewsDB
   DB_USER=root
   DB_PASS=password
   APP_ENV=docker
   ADMIN_DEFAULT_PASSWORD=ChangeMe123!
   ```

2. **Start all services:**

   ```bash
   docker-compose up -d
   ```

   **What happens on startup:**

   - MySQL container initializes
   - Web container runs `docker-entrypoint.sh`:
     - Waits for MySQL health check
     - Executes `php database/init.php`
     - Creates database and tables
     - Seeds admin user with `ADMIN_DEFAULT_PASSWORD`
     - Starts Apache

3. **Access the application:**

   - **Simply News App:** http://localhost:8080
   - **PHPMyAdmin:** http://localhost:8081
   - **MySQL:** localhost:3306
   - **Default login:** `admin` / `ChangeMe123!`

4. **View initialization logs:**

   ```bash
   docker-compose logs web
   ```

   Look for "🚀 Simply News App - Database Initialization" section.

5. **Stop services:**

   ```bash
   docker-compose down
   ```

6. **Rebuild after changes:**

   ```bash
   docker-compose up -d --build
   ```

See [DOCKER.md](DOCKER.md) for more detailed Docker documentation and commands.

## 🔧 Configuration

All sensitive configuration is managed through environment variables in the `.env` file:

```env
# Database Configuration
DB_HOST=localhost
DB_PORT=3306
DB_NAME=simplyNewsDB
DB_USER=root
DB_PASS=your_password

# Application Settings
APP_ENV=development
ADMIN_DEFAULT_PASSWORD=ChangeMe123!
```

> ⚠️ **Security Note**: Never commit your `.env` file to version control. It's listed in `.gitignore` for your protection.

---

## 💡 Technology Stack

| Technology             | Purpose                | Why It's Great                                      |
| ---------------------- | ---------------------- | --------------------------------------------------- |
| **PHP 8.1+**           | Backend logic          | Type hints, match expressions, nullsafe operators   |
| **MySQL/MariaDB**      | Data persistence       | Reliable, scalable database                         |
| **PDO**                | Database abstraction   | Secure, parameterized queries prevent SQL injection |
| **Vanilla JavaScript** | Frontend interactivity | No heavy dependencies, lightweight                  |
| **CSS3**               | Styling                | Modern, responsive design                           |
| **Docker**             | Containerization       | Consistent development & production environments    |

---

## 📁 Architecture

This project follows the **Model-View-Controller (MVC)** pattern:

- **Models** (`src/Models/`) - Database interactions and business logic
- **Views** (`templates/`) - User interface templates
- **Controllers** (`src/Controllers/`) - Request handling and logic orchestration
- **Router** (`src/Router.php`) - Custom HTTP routing without external dependencies

---

## 🤝 Contributing

Contributions are welcome! Feel free to:

- Report bugs via GitHub Issues
- Submit feature requests

---

## 📝 License

This project is licensed under the MIT License - see the LICENSE file for details.

---

## 🔗 Links & Resources

- **Live Demo:** [Coming Soon]
- **GitHub Repository:** [https://github.com/LukaszKwiatkowski94/Simply-news-app](https://github.com/LukaszKwiatkowski94/Simply-news-app)
- **Author:** [Łukasz Kwiatkowski](https://github.com/LukaszKwiatkowski94)

---

**Happy coding!** 🎉 If you found this project useful, please give it a ⭐ on GitHub!
