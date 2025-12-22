# Docker Documentation

## Overview

This project includes complete Docker support for both development and production environments.

## Files Included

- **Dockerfile** - PHP 8.1 + Apache configuration with custom entrypoint
- **docker-entrypoint.sh** - Startup script that initializes database on container start
- **docker-compose.yml** - Multi-service orchestration (Web, MySQL, PHPMyAdmin)
- **database/init.php** - Database initialization script (creates DB, tables, and admin user)
- **database/schema.sql** - Database schema definition (reference only)
- **.dockerignore** - Files to exclude from Docker build

## Quick Start

### Using Docker (Recommended)

1. **Configure `.env` file:**

   ```env
   DB_HOST=mysql
   DB_NAME=adzintsxsi_miniProject
   DB_USER=root
   DB_PASS=password
   APP_ENV=docker
   ADMIN_DEFAULT_PASSWORD=ChangeMe123!
   ```

2. **Start all services:**

   ```bash
   docker-compose up -d
   ```

   The startup process is automatic:

   - MySQL container starts and waits for readiness
   - Web container waits for MySQL
   - `docker-entrypoint.sh` script runs automatically on startup
   - `php database/init.php` is executed, which:
     - Creates the database
     - Creates all tables (SN_users, SN_categories, SN_news, SN_comments)
     - Seeds the default admin user with password from `ADMIN_DEFAULT_PASSWORD`
   - Apache starts and app is ready

3. **Login to the application:**

   - Web app: http://localhost:8080
   - Default username: `admin`
   - Default password: `ChangeMe123!` (from `ADMIN_DEFAULT_PASSWORD` in `.env`)
   - **⚠️ Important: Change password on first login!**

4. **Access the database:**
   - PHPMyAdmin: http://localhost:8081
   - Username: `root`
   - Password: same as `DB_PASS` in `.env`

### Local Development (without Docker - with MySQL)

If you don't use Docker but have MySQL installed locally:

1. **Configure `.env` file:**

   ```bash
   cp example.env .env
   ```

   Edit `.env`:

   ```env
   DB_HOST=localhost
   DB_PORT=3306
   DB_NAME=adzintsxsi_miniProject
   DB_USER=root
   DB_PASS=password
   APP_ENV=development
   ADMIN_DEFAULT_PASSWORD=ChangeMe123!
   ```

2. **Initialize database:**

   Run the PHP initialization script which will:

   - Create the database
   - Create all tables
   - Seed the default admin user with password from `ADMIN_DEFAULT_PASSWORD`

   ```bash
   php database/init.php
   ```

3. **Start development server:**

   ```bash
   php -S localhost:8000 index.php
   ```

4. **Login:**
   - Open http://localhost:8000
   - Default username: `admin`
   - Default password: `ChangeMe123!` (from `ADMIN_DEFAULT_PASSWORD`)
   - **Change password on first login!**

## Services

### 1. Web Service (simply-news-app)

- **Image:** PHP 8.1 with Apache
- **Port:** 8080
- **Volumes:** Project root mounted at `/var/www/html`
- **Dependencies:** MySQL (health check)
- **Entrypoint:** Custom `docker-entrypoint.sh` script:
  1. Waits for MySQL to be ready
  2. Runs `php database/init.php` to initialize database
  3. Starts Apache in foreground

### 2. MySQL Service (simply-news-mysql)

- **Image:** MySQL 8.0
- **Port:** 3306
- **Volume:** `mysql_data` (persistent storage)
- **Health Check:** Enabled with retries
- **Auto-initialization:** Not used (handled by init.php in web container)

### 3. PHPMyAdmin Service (simply-news-phpmyadmin)

- **Image:** PHPMyAdmin (latest)
- **Port:** 8081
- **Access:** Use root credentials from `.env`

## Environment Variables

All database settings are read from your `.env` file:

```env
DB_HOST=mysql                          # Service name in docker-compose
DB_PORT=3306
DB_NAME=adzintsxsi_miniProject
DB_USER=root
DB_PASS=password                       # MySQL root password
APP_ENV=docker                         # Set to 'development' or 'docker', blocks init in production
ADMIN_DEFAULT_PASSWORD=ChangeMe123!    # Default admin password on first run
```

⚠️ **Security Note:** `init.php` only runs when `APP_ENV` is NOT set to `production`. In production, you must initialize the database manually before deployment.

## Common Commands

### Start Services

```bash
docker-compose up -d
```

### Stop Services

```bash
docker-compose stop
```

### View Logs

```bash
docker-compose logs -f web
docker-compose logs -f mysql
```

### Execute Commands in Container

```bash
docker-compose exec web php -v
docker-compose exec mysql mysql -u root -p adzintsxsi_miniProject
```

### Rebuild Image

```bash
docker-compose up -d --build
```

### Remove All (including volumes)

```bash
docker-compose down -v
```

## Access Your Application

Once running:

| Service         | URL                   | Credentials      |
| --------------- | --------------------- | ---------------- |
| Simply News App | http://localhost:8080 | -                |
| PHPMyAdmin      | http://localhost:8081 | From `.env` file |
| MySQL           | localhost:3306        | From `.env` file |

## Database Files

### `docker-entrypoint.sh`

- Custom startup script for Docker container
- Automatically runs on container start
- Steps:
  1. Waits for MySQL service to be healthy
  2. Runs `php database/init.php`
  3. Starts Apache in foreground
- Never fails silently - exits with error if MySQL not ready

### `database/init.php`

- Main database initialization script
- Creates database, tables, and seeds admin user
- **Runs automatically on Docker startup** via `docker-entrypoint.sh`
- Also works for **local development** (without Docker)
- Reads all settings from `.env` file
- **Security:** Only runs when `APP_ENV ≠ production`

**What it does:**

1. Checks `APP_ENV` - blocks if set to `production`
2. Reads credentials from `.env`
3. Creates database (if doesn't exist)
4. Creates 4 tables:
   - `SN_users` - users and admins
   - `SN_categories` - news categories
   - `SN_news` - news articles
   - `SN_comments` - article comments
5. Seeds default admin user:
   - Username: `admin`
   - Password: `ChangeMe123!` (hashed with bcrypt)
   - Password source: `ADMIN_DEFAULT_PASSWORD` from `.env`

**Usage (local development):**

```bash
php database/init.php
```

### `database/schema.sql`

- Database schema only (no CREATE DATABASE)
- Reference file for understanding table structure
- Useful for manual imports or migrations

## Security Notes

### APP_ENV Protection

The initialization script checks `APP_ENV` to prevent accidental database reset in production:

```env
APP_ENV=docker          # ✅ Allows init.php to run
APP_ENV=development     # ✅ Allows init.php to run
APP_ENV=production      # ❌ Blocks init.php execution
```

In production, you **must**:

1. Set `APP_ENV=production` in your `.env`
2. Initialize the database manually before deployment
3. Never allow the web container to have write access to `.env`

### Default Password

- Default admin password: `ChangeMe123!`
- Source: `ADMIN_DEFAULT_PASSWORD` environment variable
- Hashed with **bcrypt** (PHP `PASSWORD_DEFAULT`)
- User is forced to change password on first login (**TODO: implement in application**)

### Password Change on First Login (TODO)

⚠️ **Important Security Feature (To be implemented by user):**

The application should force users to change their default password on first login:

- Check if password was changed (add `password_changed_at` column to track)
- Redirect admin users with default password to password change form
- Block access to dashboard/features until password is changed
- Send email notification with temporary password for new admins

### Changing Admin Password

To change the default password hash in the database manually:

```bash
# 1. Generate new bcrypt hash
php -r "echo password_hash('YourNewPassword', PASSWORD_DEFAULT);"

# 2. Connect to database via PHPMyAdmin or MySQL CLI
mysql -u root -p adzintsxsi_miniProject

# 3. Update password
UPDATE SN_users SET password = '$2y$10$...' WHERE username = 'admin';
```

### Database Backups

Persistent MySQL data is stored in Docker volume `mysql_data`. To backup:

```bash
# Backup database
docker-compose exec mysql mysqldump -u root -p adzintsxsi_miniProject > backup.sql

# Restore database
docker-compose exec -T mysql mysql -u root -p adzintsxsi_miniProject < backup.sql
```

## Development

### File Changes

Since volumes are mounted, any file changes on your host machine are immediately reflected in the container.

### View Initialization Logs

To see what happened during database initialization:

```bash
docker-compose logs web
```

Look for "🚀 Simply News App - Database Initialization" section.

## Production

For production deployments:

1. **Security**: Change all default passwords in `docker-compose.yml`
2. **Environment**: Set `APP_DEBUG=false` and `APP_ENV=production`
3. **Volumes**: Use external database instead of containerized
4. **Networking**: Use production-grade networking setup

## Troubleshooting

### MySQL Connection Refused

```bash
docker-compose logs mysql
```

Wait for MySQL health check to pass.

### Permission Issues

```bash
docker-compose down
docker-compose up -d --build
```

### Port Already in Use

Change port mappings in `docker-compose.yml`:

```yaml
ports:
  - "8082:80" # Change 8080 to 8082
```

### Clear Everything

```bash
docker-compose down -v
docker system prune -a
```

## Resources

- [Docker Documentation](https://docs.docker.com/)
- [Docker Compose Reference](https://docs.docker.com/compose/compose-file/)
- [PHP Official Images](https://hub.docker.com/_/php)
- [MySQL Official Images](https://hub.docker.com/_/mysql)
