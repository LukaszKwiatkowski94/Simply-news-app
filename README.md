# 📰 Simply News App

> **A modern, framework-free PHP news portal** built with clean architecture, custom routing, and real-world functionality. Perfect for learning modern PHP development patterns or deploying as a lightweight news management system.

[![PHP Version](https://img.shields.io/badge/PHP-8.0+-blue)](https://www.php.net/)
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
├── 📁 templates/              # View files (MVC templates)
│   └── pages/                 # Page-specific templates
├── 📁 public/                 # Frontend assets
│   ├── css/                   # Stylesheets
│   ├── js/                    # Client-side scripts
│   ├── img/                   # Images
│   └── icon/                  # Icons & favicons
├── 📄 index.php               # Application entry point
└── 📄 .env                    # Environment variables
```

---

## 🚀 Quick Start

### Prerequisites

- PHP 8.0 or higher (8.1 recommended)
- MySQL 8.0 or higher
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

4. **Login to the application:**
   - App: http://localhost:8080
   - Default username: `admin`
   - Default password: `ChangeMe123!`
   - Database: http://localhost:8081 (PHPMyAdmin)
   - **⚠️ Change password on first login!** (feature to be implemented)

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

5. **Login to the application:**

   - Open http://localhost:8000
   - Default username: `admin`
   - Default password: `ChangeMe123!` (from `ADMIN_DEFAULT_PASSWORD`)
   - **Change password on first login!**

6. **Login to the application:**
   - Open http://localhost:8000
   - Default username: `admin`
   - Default password: `ChangeMe123!`
   - **⚠️ Change password on first login!** (feature to be implemented)

---

## 🔑 First Login & Security

### Default Admin Account

When you first start the application, a default admin user is automatically created:

- **Username:** `admin`
- **Password:** `ChangeMe123!` (from `ADMIN_DEFAULT_PASSWORD` env variable)

### ⚠️ Important Security Notes

1. **Change Default Password Immediately** (Feature to be implemented)

   - The application should force password change on first login
   - This prevents unauthorized access to the admin account

2. **Creating Additional Admins**

   - Use the `create-admin.php` script (development environment only)
   - Script is automatically blocked in production environment

3. **Environment Variables**
   - Never commit `.env` to version control
   - Change `ADMIN_DEFAULT_PASSWORD` for production deployments
   - Use strong passwords in production

---

## 🐳 Docker Deployment

### Using Docker Compose

The easiest way to run the entire application stack (Web + MySQL + PHPMyAdmin):

1. **Configure `.env` file:**

   Set `DB_HOST=mysql` in your `.env` file:

   ```env
   DB_HOST=mysql
   DB_NAME=simplyNewsDB
   DB_USER=root
   DB_PASS=password
   ```

2. **Start all services:**

   ```bash
   docker-compose up -d
   ```

3. **Access the application:**

   - **Simply News App:** http://localhost:8080
   - **PHPMyAdmin:** http://localhost:8081
   - **MySQL:** localhost:3306

4. **View logs:**

   ```bash
   docker-compose logs -f web
   ```

5. **Stop services:**

   ```bash
   docker-compose down
   ```

See [DOCKER.md](DOCKER.md) for more detailed Docker documentation and commands.

## 🔧 Configuration

All sensitive configuration is managed through environment variables in the `.env` file:

```env
# Database Configuration
DB_HOST=localhost
DB_USER=root
DB_PASSWORD=your_password
DB_NAME=simply_news
DB_PORT=3306

# Application Settings
APP_DEBUG=true
APP_ENV=development
```

> ⚠️ **Security Note**: Never commit your `.env` file to version control. It's listed in `.gitignore` for your protection.

---

## 💡 Technology Stack

| Technology             | Purpose                | Why It's Great                                      |
| ---------------------- | ---------------------- | --------------------------------------------------- |
| **PHP 8.0+**           | Backend logic          | Type hints, match expressions, nullsafe operators   |
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
