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

- PHP 8.0 or higher
- MySQL/MariaDB
- Git

### Installation & Setup

1. **Clone the repository:**

   ```bash
   git clone https://github.com/LukaszKwiatkowski94/Simply-news-app.git
   cd Simply-news-app
   ```

2. **Configure environment variables:**

   - Copy `example.env` to `.env`
   - Edit `.env` with your database credentials:
     ```
     DB_HOST=localhost
     DB_USER=your_db_user
     DB_PASSWORD=your_db_password
     DB_NAME=simply_news
     DB_PORT=3306
     ```

3. **Create database and tables:**

   - Import the provided SQL schema:
     ```bash
     mysql -u your_db_user -p your_db_name < database.sql
     ```
   - Or manually run the SQL commands from the `docs/database.sql` file

4. **Start the development server:**

   ```bash
   php -S localhost:8000 index.php
   ```

5. **Access the application:**
   - Open your browser and navigate to `http://localhost:8000`
   - Register a new account
   - Login to explore the app

### First Administrator User

To create an admin user, you need to:

1. Create a regular user account via the signup form
2. Access your database directly and update the user's `is_admin` field:
   ```sql
   UPDATE users SET is_admin = 1 WHERE username = 'your_username';
   ```

---

## 🐳 Docker Deployment

Deploy the application easily using Docker:

```bash
docker build -t simply-news-app .
docker run -p 8000:8000 \
  -e DB_HOST=mysql \
  -e DB_USER=root \
  -e DB_PASSWORD=password \
  -e DB_NAME=simply_news \
  simply-news-app
```

For production deployments with Docker Compose, see the `docker-compose.yml` file in the repository.

---

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
