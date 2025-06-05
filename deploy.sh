#!/bin/bash

# Laravel Deployment Script
echo "🚀 Starting Laravel deployment..."

# 1. Install/Update Composer dependencies
echo "📦 Installing Composer dependencies..."
composer install --optimize-autoloader --no-dev

# 2. Install/Update NPM dependencies
echo "📦 Installing NPM dependencies..."
npm ci

# 3. Build assets
echo "🔨 Building assets..."
npm run build

# 4. Clear and cache Laravel
echo "🧹 Clearing Laravel cache..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo "💾 Caching Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 5. Run migrations (optional - uncomment if needed)
# echo "🗄️ Running migrations..."
# php artisan migrate --force

# 6. Set permissions
echo "🔐 Setting permissions..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache

echo "✅ Deployment completed successfully!"
echo "🌐 Your application is ready!"
