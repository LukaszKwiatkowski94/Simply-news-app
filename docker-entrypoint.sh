#!/bin/bash

# Simply News App - Docker Entrypoint
# This script runs on container startup after MySQL is healthy
# It initializes the database and starts Apache

set -e

echo "Starting Simply News App container..."
echo ""

# MySQL is already healthy (docker-compose depends_on ensures this)
echo "MySQL connection confirmed by Docker health check"
echo ""

# Initialize database
echo "Initializing database..."
php /var/www/html/database/init.php

echo ""
echo "Container startup complete!"
echo ""

# Start Apache in foreground
echo "Starting Apache..."
exec apache2-foreground
