<?php

/**
 * Simply News App - Database Initialization Script
 * 
 * This script creates the database, initializes tables, and seeds default admin user.
 * It reads database credentials from .env file.
 * 
 * Security: Only runs in development/docker environment. Blocked in production.
 * 
 * Usage: php database/init.php
 */

declare(strict_types=1);

// ============================================
// SECURITY CHECK
// ============================================
$envFile = __DIR__ . '/../.env';
if (!file_exists($envFile)) {
    die("Error: .env file not found at: " . $envFile . "\n");
}

// Load APP_ENV first to check if we should run
$env = [];
$lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
foreach ($lines as $line) {
    $line = trim($line);
    if ($line === '' || strpos($line, '#') === 0) {
        continue;
    }
    if (strpos($line, '=') === false) {
        continue;
    }
    list($name, $value) = explode('=', $line, 2);
    $name = trim($name);
    $value = trim($value);
    $env[$name] = $value;
}

$appEnv = $env['APP_ENV'] ?? 'development';

// Block in production
if ($appEnv === 'production') {
    die("❌ ERROR: Database initialization is disabled in production environment!\n");
}

// ============================================
// CONFIGURATION
// ============================================
$dbHost = $env['DB_HOST'] ?? 'localhost';
$dbPort = $env['DB_PORT'] ?? '3306';
$dbName = $env['DB_NAME'] ?? 'simplyNewsDB';
$dbUser = $env['DB_USER'] ?? 'root';
$dbPass = $env['DB_PASS'] ?? '';
$adminPassword = $env['ADMIN_DEFAULT_PASSWORD'] ?? 'ChangeMe123!';

echo "🚀 Simply News App - Database Initialization\n";
echo "============================================\n\n";
echo "Environment: $appEnv\n";
echo "Database Configuration:\n";
echo "  Host: $dbHost:$dbPort\n";
echo "  Database: $dbName\n";
echo "  User: $dbUser\n\n";

try {
    // ============================================
    // STEP 1: Connect to MySQL (without database)
    // ============================================
    echo "📝 Step 1: Connecting to MySQL server...\n";

    $dsn = "mysql:host=$dbHost;port=$dbPort";
    $pdo = new PDO($dsn, $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    echo "✅ Connected to MySQL server\n\n";

    // ============================================
    // STEP 2: Create Database
    // ============================================
    echo "📝 Step 2: Creating database '{$dbName}'...\n";

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$dbName}` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;");
    $pdo->exec("USE `{$dbName}`;");

    echo "✅ Database created/verified\n\n";

    // ============================================
    // STEP 3: Create Tables
    // ============================================
    echo "📝 Step 3: Creating tables...\n";

    // Table: SN_users
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `SN_users` (
          `id` int NOT NULL AUTO_INCREMENT,
          `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
          `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
          `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
          `surname` varchar(70) COLLATE utf8mb4_general_ci NOT NULL,
          `active` tinyint(1) NOT NULL DEFAULT '1',
          `is_admin` tinyint(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`),
          UNIQUE KEY `username` (`username`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // Table: SN_categories
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `SN_categories` (
          `id` int NOT NULL AUTO_INCREMENT,
          `name` varchar(50) NOT NULL,
          `is_active` bit(1) NOT NULL DEFAULT b'1',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // Table: SN_news
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `SN_news` (
          `id` int NOT NULL AUTO_INCREMENT,
          `user_id` int NOT NULL,
          `category_id` int NOT NULL,
          `title` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
          `content` longtext COLLATE utf8mb4_general_ci NOT NULL,
          `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
          `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`),
          KEY `user_id` (`user_id`),
          KEY `category_id` (`category_id`),
          CONSTRAINT `SN_news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `SN_users` (`id`) ON DELETE CASCADE,
          CONSTRAINT `SN_news_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `SN_categories` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    // Table: SN_comments
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `SN_comments` (
          `id` int NOT NULL AUTO_INCREMENT,
          `user_id` int NOT NULL,
          `news_id` int NOT NULL,
          `content` text COLLATE utf8mb4_general_ci NOT NULL,
          `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
          `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`),
          KEY `user_id` (`user_id`),
          KEY `news_id` (`news_id`),
          CONSTRAINT `SN_comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `SN_users` (`id`) ON DELETE CASCADE,
          CONSTRAINT `SN_comments_ibfk_2` FOREIGN KEY (`news_id`) REFERENCES `SN_news` (`id`) ON DELETE CASCADE
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    ");

    echo "✅ All tables created/verified\n";
    echo "   - SN_users\n";
    echo "   - SN_categories\n";
    echo "   - SN_news\n";
    echo "   - SN_comments\n\n";

    // ============================================
    // STEP 4: Seed Default Admin User
    // ============================================
    echo "📝 Step 4: Seeding default admin user...\n";

    // Hash the password using bcrypt
    $adminPasswordHash = password_hash($adminPassword, PASSWORD_DEFAULT);

    // Insert admin if doesn't exist
    $stmt = $pdo->prepare("
        INSERT IGNORE INTO `SN_users` (id, username, password, name, surname, is_admin, active)
        VALUES (1, 'admin', :password, 'Admin', 'User', 1, 1)
    ");

    $stmt->execute([':password' => $adminPasswordHash]);

    echo "✅ Default admin user created\n";
    echo "   Username: admin\n";
    echo "   Password: {$adminPassword}\n\n";

    // ============================================
    // SUCCESS
    // ============================================
    echo "🎉 Database initialized successfully!\n\n";

    if ($appEnv === 'docker') {
        echo "📌 Docker Container Ready:\n";
        echo "   - Open http://localhost:8080\n";
        echo "   - Login with: admin / {$adminPassword}\n";
        echo "   - ⚠️  Change password immediately!\n\n";
    } else {
        echo "🎯 Next steps:\n";
        echo "   1. Start the web server: php -S localhost:8000 index.php\n";
        echo "   2. Open http://localhost:8000 in your browser\n";
        echo "   3. Login with: admin / {$adminPassword}\n";
        echo "   4. Change password immediately!\n\n";
    }

    echo "✨ Done! Happy coding!\n";
} catch (PDOException $e) {
    echo "❌ Database Error: " . $e->getMessage() . "\n";
    echo "   Make sure MySQL is running and credentials are correct.\n";
    exit(1);
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
