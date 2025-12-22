#!/bin/bash

# Simply News App - Docker Entrypoint
# This script runs on container startup before Apache starts
# It waits for MySQL to be ready, then initializes the database

set -e

echo "🚀 Starting Simply News App container..."
echo ""

# Get MySQL connection details from .env
DB_HOST=${DB_HOST:-mysql}
DB_PORT=${DB_PORT:-3306}

# Wait for MySQL to be ready
echo "⏳ Waiting for MySQL to be ready ($DB_HOST:$DB_PORT)..."
max_attempts=30
attempt=0

while [ $attempt -lt $max_attempts ]; do
    if mysqladmin ping -h "$DB_HOST" -P "$DB_PORT" -u root -p"${DB_PASS}" --silent 2>/dev/null; then
        echo "✅ MySQL is ready!"
        break
    fi
    
    attempt=$((attempt + 1))
    if [ $attempt -eq $max_attempts ]; then
        echo "❌ MySQL failed to start after $max_attempts attempts"
        exit 1
    fi
    
    echo "   Attempt $attempt/$max_attempts... waiting..."
    sleep 1
done

echo ""

# Initialize database
echo "📝 Initializing database..."
php /var/www/html/database/init.php

echo ""
echo "✅ Container startup complete!"
echo ""

# Start Apache in foreground
echo "🌐 Starting Apache..."
exec apache2-foreground
