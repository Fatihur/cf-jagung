# Laravel Deployment Script for Windows
Write-Host "🚀 Starting Laravel deployment..." -ForegroundColor Green

try {
    # 1. Install/Update Composer dependencies
    Write-Host "📦 Installing Composer dependencies..." -ForegroundColor Yellow
    composer install --optimize-autoloader --no-dev
    if ($LASTEXITCODE -ne 0) { throw "Composer install failed" }

    # 2. Install/Update NPM dependencies
    Write-Host "📦 Installing NPM dependencies..." -ForegroundColor Yellow
    npm ci
    if ($LASTEXITCODE -ne 0) { throw "NPM install failed" }

    # 3. Build assets
    Write-Host "🔨 Building assets..." -ForegroundColor Yellow
    npm run build
    if ($LASTEXITCODE -ne 0) { throw "Asset build failed" }

    # 4. Clear and cache Laravel
    Write-Host "🧹 Clearing Laravel cache..." -ForegroundColor Yellow
    php artisan config:clear
    php artisan cache:clear
    php artisan route:clear
    php artisan view:clear

    Write-Host "💾 Caching Laravel..." -ForegroundColor Yellow
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache

    # 5. Run migrations (optional - uncomment if needed)
    # Write-Host "🗄️ Running migrations..." -ForegroundColor Yellow
    # php artisan migrate --force

    Write-Host "✅ Deployment completed successfully!" -ForegroundColor Green
    Write-Host "🌐 Your application is ready!" -ForegroundColor Green

} catch {
    Write-Host "❌ Deployment failed: $_" -ForegroundColor Red
    exit 1
}
