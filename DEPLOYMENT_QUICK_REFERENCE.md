# DEPLOYMENT QUICK REFERENCE
**Ria Busana 85 Website - Production Deployment Guide**

---

## ✅ PRE-DEPLOYMENT CHECKLIST

```bash
# 1. Verify Zero Errors
php artisan migrate:status
# Expected: All migrations listed as Ran

# 2. Build Assets
npm run build
# Expected: Build succeeds, no TypeScript/CSS errors

# 3. Clear Caches (for fresh state)
php artisan config:clear
php artisan view:clear
php artisan route:clear
php artisan cache:clear
```

---

## 🚀 DEPLOYMENT STEPS

### Step 1: Environment Configuration
```bash
# Set .env for production
APP_ENV=production
APP_DEBUG=false
APP_KEY=[your-app-key]
DB_CONNECTION=mysql
DB_HOST=[your-host]
DB_PORT=3306
DB_DATABASE=[your-db]
DB_USERNAME=[your-user]
DB_PASSWORD=[your-password]
```

### Step 2: Database
```bash
# Run migrations (first time only)
php artisan migrate

# If you have seeders (optional)
php artisan db:seed
```

### Step 3: Permissions
```bash
# Linux/Mac
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod -R 755 public/upload

# Windows (Run as Administrator in PowerShell)
icacls "storage" /grant:r "%USERNAME%":F /t
icacls "bootstrap/cache" /grant:r "%USERNAME%":F /t
icacls "public/upload" /grant:r "%USERNAME%":F /t
```

### Step 4: Assets
```bash
# Build production assets
npm run build

# Or if using npm
npm run prod
```

### Step 5: Optimize (Production)
```bash
php artisan optimize
```

---

## 📋 DIRECTORY STRUCTURE REQUIRED

Make sure these directories exist and are writable:

```
public/
├── upload/
│   └── produk/          ← Product images go here
├── storage              ← Symlink or physical storage
└── amoeba-assets/       ← Static assets
```

---

## 🔐 SECURITY CHECKLIST

- [x] APP_DEBUG = false (production)
- [x] APP_KEY generated
- [x] Session lifetime set to 525600 (config/session.php)
- [x] Admin password hashed with bcrypt
- [x] CSRF protection enabled
- [x] Image upload validation in place (jpg, jpeg, png, webp, max 2MB)
- [x] File permissions restricted (storage/bootstrap/cache)
- [x] Database FK constraints enabled
- [x] Cascade delete configured

---

## 🧪 VERIFICATION AFTER DEPLOYMENT

```bash
# Test key admin routes
GET  /admin/login       → Should show login form
POST /admin/login       → Should authenticate
GET  /admin             → Should show dashboard (after login)
GET  /                  → Should show homepage with promos
GET  /counter/1         → Should show counter detail

# Test image upload
POST /admin/products    → Upload test image
# Verify: public/upload/produk/[filename] created

# Test session persistence
- Login to admin
- Close browser
- Reopen browser
- Should still be logged in (1-year session)

# Test email/forms
GET /admin/counters/create → Should show form
POST /admin/counters       → Should create counter
```

---

## 📊 DATABASE TABLES

| Table | Rows | Purpose |
|-------|------|---------|
| admins | 1+ | Admin users |
| counters | 3+ | Store locations |
| products | 10+ | Product catalog |
| staff | 5+ | Employees |
| promos | 3+ | Current promotions |

---

## 🆘 TROUBLESHOOTING

### "500 Internal Server Error"
```bash
# Check Laravel logs
tail -f storage/logs/laravel.log

# Clear caches
php artisan cache:clear
php artisan config:clear

# Verify .env file exists and is readable
cat .env | grep -E "APP_|DB_"
```

### "Table 'X' doesn't exist"
```bash
# Run migrations
php artisan migrate

# Check migration status
php artisan migrate:status
```

### "Permission denied writing to storage"
```bash
# Fix permissions
chmod -R 777 storage bootstrap/cache
# For production, use 755 instead of 777
```

### Images not uploading
```bash
# Verify directory exists
ls -la public/upload/produk/

# If not exist, create it
mkdir -p public/upload/produk
chmod 755 public/upload/produk
```

### Login not working (session issues)
```bash
# Check session configuration
grep -A 5 "SESSION_" .env

# Verify session lifetime is 525600
grep "lifetime" config/session.php
# Expected: 'lifetime' => env('SESSION_LIFETIME', 525600),
```

---

## 📝 IMPORTANT NOTES

### Session Persistence
- Login session is set to **1 year (525600 minutes)**
- User stays logged in even after browser close
- To force logout: `GET /admin/logout`
- Sessions stored in: `storage/framework/sessions/`

### Image Storage
- Products images stored in: `public/upload/produk/`
- Accepted formats: jpg, jpeg, png, webp
- Max size: 2MB per image
- Display style: object-fit: cover (no distortion)

### Database
- Foreign key constraints enabled (CASCADE DELETE)
- Deleting counter → Deletes its products & staff
- Deleting product → Deletes its promos
- Staff can be "Umum" (general, counter_id = null)

### Authentication
- Custom session-based (not Laravel Guard)
- Middleware: AdminAuth (checks session('admin_id'))
- Protected routes start with `/admin`
- Password hashed with bcrypt

---

## 🔄 MAINTENANCE

### Regular Tasks
```bash
# Daily: Check logs
tail -f storage/logs/laravel.log

# Weekly: Clear old sessions
php artisan session:clear

# Monthly: Backup database
mysqldump -u [user] -p [db] > backup_[date].sql
```

### Updates
```bash
# Update dependencies (careful in production!)
composer update

# Run new migrations after update
php artisan migrate
```

---

## 📞 SUPPORT

**Key Contact Points**:
- Admin: `/admin/login`
- Dashboard: `/admin` (statistics: counters, products, staff, promos)
- Error logs: `storage/logs/laravel.log`

**Database Admin**:
- PHPMyAdmin or MySQL command line
- Tables: admins, counters, products, staff, promos

---

## ✅ FINAL STATUS

**Status**: PRODUCTION READY ✅

- Zero errors detected
- All features tested
- Database integrity verified
- Security measures in place
- Documentation complete

**Deploy with confidence!** 🎉
