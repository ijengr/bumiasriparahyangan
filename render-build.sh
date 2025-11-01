#!/usr/bin/env bash

echo "Running deployment script..."

# Install dependencies
composer install --no-dev --optimize-autoloader --no-interaction

# Install Node dependencies and build assets
npm ci
npm run build

# Create storage link
php artisan storage:link || true

# Run migrations
php artisan migrate --force

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Seed database if needed (only first time)
# php artisan db:seed --force

echo "Deployment complete!"
