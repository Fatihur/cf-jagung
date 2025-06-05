# 🚀 Deployment Guide - Sistem Pakar Jagung

## 📋 Prerequisites

- PHP 8.1+
- Composer
- Node.js 18+
- NPM/Yarn
- MySQL/PostgreSQL

## 🔧 Local Development

### 1. Clone & Setup
```bash
git clone <repository-url>
cd cf-jagung
cp .env.example .env
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Generate Key & Setup Database
```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### 4. Start Development Server
```bash
# Terminal 1: Laravel Server
php artisan serve

# Terminal 2: Vite Dev Server
npm run dev
```

## 🌐 Production Deployment

### Method 1: Using Deployment Script

#### Windows (PowerShell)
```powershell
.\deploy.ps1
```

#### Linux/Mac (Bash)
```bash
chmod +x deploy.sh
./deploy.sh
```

### Method 2: Manual Steps

#### 1. Install Dependencies
```bash
composer install --optimize-autoloader --no-dev
npm ci
```

#### 2. Build Assets
```bash
npm run build
```

#### 3. Laravel Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

#### 4. Set Permissions
```bash
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

## 📦 Available NPM Scripts

```bash
npm run dev          # Start Vite dev server
npm run build        # Build for production
npm run prod         # Build with production mode
npm run watch        # Build and watch for changes
npm run preview      # Preview production build
npm run clean        # Clean build directory
npm run fresh-build  # Clean and build
```

## 🔍 Troubleshooting

### Vite Manifest Not Found
```bash
# Solution 1: Build assets
npm run build

# Solution 2: Fresh build
npm run fresh-build

# Solution 3: Check if in development
npm run dev
```

### Permission Issues
```bash
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### Cache Issues
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

## 🌍 Environment Configuration

### Production (.env)
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Cache
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
```

### Development (.env)
```env
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cf_jagung
DB_USERNAME=root
DB_PASSWORD=
```

## 📊 Performance Tips

### 1. Enable OPcache (Production)
```ini
; php.ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=4000
opcache.revalidate_freq=2
opcache.fast_shutdown=1
```

### 2. Use Redis for Cache (Optional)
```env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 3. Queue Workers (Optional)
```bash
php artisan queue:work --daemon
```

## 🔐 Security Checklist

- [ ] Set `APP_DEBUG=false` in production
- [ ] Use HTTPS in production
- [ ] Set proper file permissions
- [ ] Configure firewall
- [ ] Regular backups
- [ ] Update dependencies regularly

## 📝 Maintenance

### Regular Tasks
```bash
# Update dependencies
composer update
npm update

# Clear caches
php artisan optimize:clear

# Backup database
mysqldump -u username -p database_name > backup.sql
```

### Monitoring
- Check error logs: `storage/logs/laravel.log`
- Monitor disk space
- Check database performance
- Monitor response times
