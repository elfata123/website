# Docker Setup untuk Ria Busana 85

Panduan lengkap untuk menjalankan project dengan Docker.

## 📋 Prerequisites

- Docker Desktop (https://www.docker.com/products/docker-desktop)
- Docker Compose (included dengan Docker Desktop)

## 🚀 Quick Start

### 1. Clone & Setup

```bash
git clone <repo-url>
cd web-baru
cp .env.docker .env
```

### 2. Generate APP_KEY

```bash
docker-compose run --rm app php artisan key:generate
```

### 3. Start Containers

```bash
docker-compose up -d
```

Tunggu sampai semua services running (30-60 detik).

### 4. Run Migrations

```bash
docker-compose exec app php artisan migrate
```

### 5. Seed Database (Automatic)
```bash
docker-compose exec app php artisan migrate:fresh --seed
```

Ini akan:
- Hapus dan buat ulang semua tables
- Seed admin user + sample data (counters, products, staff, promos)
- Siap pakai langsung!

**Default Admin Credentials:**
- Email: `admin@riabusana.co.id`
- Password: `password`

### 6. Build Frontend Assets

```bash
docker-compose exec app npm install
docker-compose exec app npm run build
```

---

## ✅ Akses Aplikasi

| Service | URL |
|---------|-----|
| Website | http://localhost |
| Admin Panel | http://localhost/admin |
| PHPMyAdmin | http://localhost:8080 |
| Redis | localhost:6379 |

**Default Admin Credentials (Auto-seeded):**
- Email: `admin@gmail.com`
- Password: `password`

**Sample Data yang di-seed:**
- 2 Counters (Studio, Dewasa Pria)
- 3 Products dengan gambar
- 5 Staff (2 umum, 3 counter-specific)
- 2 Active Promos

---

## 🐳 Docker Commands

### Lihat Status Container
```bash
docker-compose ps
```

### Lihat Logs
```bash
# Semua containers
docker-compose logs -f

# Specific container
docker-compose logs -f app
docker-compose logs -f nginx
docker-compose logs -f db
```

### Masuk ke Container
```bash
# PHP Container
docker-compose exec app bash

# Database Container
docker-compose exec db mysql -uroot -proot ria_busana_85

# Nginx Container
docker-compose exec nginx sh
```

### Jalankan Artisan Commands
```bash
docker-compose exec app php artisan <command>

# Contoh:
docker-compose exec app php artisan tinker
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan migrate:fresh --seed
```

### Jalankan NPM Commands
```bash
docker-compose exec app npm run dev
docker-compose exec app npm run build
```

### Stop Containers
```bash
# Stop saja
docker-compose stop

# Stop & remove containers (data tetap di volume)
docker-compose down

# Stop & remove containers + volumes (data hilang!)
docker-compose down -v
```

---

## 📁 Struktur Docker

```
docker/
├── nginx/
│   ├── conf.d/
│   │   └── app.conf          (Nginx configuration)
│   └── ssl/                  (SSL certificates - optional)
├── mysql/
│   └── init/                 (Database init scripts - optional)
└── ...

Dockerfile                     (PHP-FPM image)
docker-compose.yml            (Services configuration)
.dockerignore                 (Files to ignore)
.env.docker                   (Environment for Docker)
```

---

## 🔧 Services

### PHP-FPM (app)
- **Image:** php:8.1-fpm
- **Port:** 9000 (internal)
- **Volumes:** ./:/app

### Nginx
- **Image:** nginx:alpine
- **Port:** 80, 443
- **Config:** docker/nginx/conf.d/app.conf

### MySQL
- **Image:** mysql:8.0
- **Port:** 3306
- **Volume:** dbdata (persistent)
- **Database:** ria_busana_85
- **User:** ria_busana
- **Password:** password (edit di .env)

### PHPMyAdmin
- **Image:** phpmyadmin:latest
- **Port:** 8080
- **URL:** http://localhost:8080

### Redis
- **Image:** redis:7-alpine
- **Port:** 6379

---

## 🛡️ Security Tips untuk Production

1. **Ubah Passwords**
   ```bash
   # Edit .env sebelum docker-compose up
   DB_PASSWORD=your_secure_password
   DB_ROOT_PASSWORD=your_secure_root_password
   ```

2. **Disable PHPMyAdmin**
   - Comment out service di docker-compose.yml

3. **Setup SSL/HTTPS**
   - Place SSL certs di docker/nginx/ssl/
   - Update app.conf dengan SSL config

4. **Environment Variables**
   - Gunakan secret manager (Docker Secrets atau environment files)
   - Jangan commit .env file

5. **Database Backup**
   ```bash
   docker-compose exec db mysqldump -uroot -proot ria_busana_85 > backup.sql
   ```

6. **Restore Database**
   ```bash
   docker-compose exec -T db mysql -uroot -proot ria_busana_85 < backup.sql
   ```

---

## 📝 Custom Configuration

### Ubah Database Name
Edit `.env`:
```env
DB_DATABASE=nama_database_baru
```

### Ubah PHP Version
Edit `Dockerfile` line 1:
```dockerfile
FROM php:8.2-fpm  # Ubah ke 8.2, 8.3, etc
```

### Tambah PHP Extension
Edit `Dockerfile`, di bagian `docker-php-ext-install`:
```dockerfile
RUN docker-php-ext-install pdo pdo_mysql gd mbstring redis
```

### Ubah Port
Edit `docker-compose.yml`:
```yaml
ports:
  - "8000:80"  # Akses via http://localhost:8000
```

---

## ⚠️ Common Issues

### Port Already in Use
```bash
# Cek port yang digunakan
netstat -ano | findstr :80

# Kill process (Windows)
taskkill /PID <PID> /F

# Atau ubah port di docker-compose.yml
```

### Database Connection Error
```bash
# Tunggu sampai MySQL fully ready
docker-compose logs db

# Restart db service
docker-compose restart db
```

### File Permission Error
```bash
# Fix permissions
docker-compose exec app chown -R www-data:www-data /app/storage
docker-compose exec app chmod -R 755 /app/storage
```

### Out of Disk Space
```bash
# Clean up unused Docker resources
docker system prune -a --volumes
```

---

## 🎯 Production Deployment

### Build Production Image
```bash
docker build -t ria-busana:1.0 .
```

### Push to Docker Registry
```bash
docker tag ria-busana:1.0 your-registry/ria-busana:1.0
docker push your-registry/ria-busana:1.0
```

### Deploy dengan Docker Swarm atau Kubernetes
Dokumentasi tersedia di Docker & Kubernetes official docs.

---

## 📞 Troubleshooting

**Container exited?**
```bash
docker-compose logs app
```

**Need to debug PHP?**
```bash
docker-compose exec app php -v
docker-compose exec app php -m
```

**Clear everything & start fresh?**
```bash
docker-compose down -v
docker-compose up -d
docker-compose exec app php artisan migrate:fresh --seed
```

---

**Last Updated:** November 30, 2025
