# Panduan Lengkap: Dari Clone Sampai Website Berjalan

Dokumen ini menjelaskan step-by-step cara setup Ria Busana 85 dari awal sampai website bisa diakses.

**⏱️ Estimasi waktu: 5-10 menit (tergantung internet speed)**

---

## 📋 Daftar Isi

1. [Prerequisites](#prerequisites)
2. [Metode 1: Docker (Recommended)](#metode-1-docker-recommended)
3. [Metode 2: Manual Setup](#metode-2-manual-setup)
4. [Troubleshooting](#troubleshooting)

---

## Prerequisites

Pilih salah satu metode setup di bawah. Sebelumnya, pastikan:

✅ **Git** sudah terinstall
```bash
git --version
```

✅ **Internet connection** stabil

---

## Metode 1: Docker (Recommended)

### Mengapa Docker?
- ✅ Setup otomatis, tidak ribet
- ✅ Semua dependency terinstall otomatis
- ✅ Tidak perlu install PHP, MySQL manual
- ✅ Paling cepat

### Prerequisites Docker
```bash
# Windows/Mac: Download Docker Desktop
https://www.docker.com/products/docker-desktop

# Linux: Install dengan package manager
sudo apt-get install docker.io docker-compose
```

### Step-by-Step Setup

#### 1️⃣ Clone Repository

Buka **Command Prompt** atau **PowerShell**, lalu jalankan:

```bash
# Clone repo
git clone https://github.com/elfata123/web-baru.git
cd web-baru
```

**Output yang diharapkan:**
```
Cloning into 'web-baru'...
remote: Enumerating objects: 150, done.
...
```

---

#### 2️⃣ Copy Environment File

```bash
cp .env.docker .env
```

**Penjelasan:** File `.env` berisi konfigurasi database, cache, etc. Kita copy dari `.env.docker` yang sudah disesuaikan untuk Docker.

---

#### 3️⃣ Start Docker Services

```bash
docker-compose up -d
```

**Penjelasan:** 
- `-d` = run in background (daemon)
- Ini akan start 5 services sekaligus:
  - PHP-FPM (aplikasi)
  - Nginx (web server)
  - MySQL (database)
  - PHPMyAdmin (database UI)
  - Redis (cache)

**Output yang diharapkan:**
```
Creating ria_busana_db ... done
Creating ria_busana_app ... done
Creating ria_busana_nginx ... done
Creating ria_busana_phpmyadmin ... done
Creating ria_busana_redis ... done
```

**Tunggu 30 detik sampai MySQL siap!**

---

#### 4️⃣ Cek Status Container

```bash
docker-compose ps
```

**Output yang diharapkan:**
```
NAME                    STATUS
ria_busana_app          Up 20 seconds
ria_busana_nginx        Up 20 seconds
ria_busana_db           Up 20 seconds (healthy)
ria_busana_phpmyadmin   Up 20 seconds
ria_busana_redis        Up 20 seconds
```

**Jika ada yang "Exited", jalankan:**
```bash
docker-compose logs app  # Lihat error message
```

---

#### 5️⃣ Generate App Key

```bash
docker-compose exec app php artisan key:generate
```

**Penjelasan:** Generate encryption key untuk Laravel.

**Output yang diharapkan:**
```
Application key set successfully.
```

---

#### 6️⃣ Setup Database & Seed

```bash
docker-compose exec app php artisan migrate:fresh --seed
```

**Penjelasan:**
- `migrate` = create tables di database
- `--fresh` = hapus table lama dulu (jika ada)
- `--seed` = isi data sample (admin, counters, products, staff, promos)

**Output yang diharapkan:**
```
Database seeding completed successfully!
Admin login: admin@gmail.com / password
```

---

#### 7️⃣ Akses Website

```
Website:       http://localhost
Admin Panel:   http://localhost/admin
PHPMyAdmin:    http://localhost:8080
```

**Login Admin:**
- Email: `admin@gmail.com`
- Password: `password`

---

### 🎉 Done! Website Sudah Berjalan!

Jika ada error, lihat bagian [Troubleshooting](#troubleshooting) di bawah.

---

## Metode 2: Manual Setup

Untuk yang tidak punya Docker atau lebih suka traditional setup.

### Prerequisites
- **PHP 8.1+** → [Download](https://www.php.net/downloads)
- **MySQL 8.0+** → [Download](https://dev.mysql.com/downloads/mysql/)
- **Composer** → [Download](https://getcomposer.org/download/)
- **Node.js** → [Download](https://nodejs.org/)

### Step-by-Step Setup

#### 1️⃣ Clone Repository

```bash
git clone https://github.com/elfata123/web-baru.git
cd web-baru
```

---

#### 2️⃣ Copy Environment File

```bash
cp .env.example .env
```

Edit `.env` file:
```env
APP_NAME="Ria Busana 85"
APP_ENV=local
APP_KEY=              # Will be generated later
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ria_busana_85
DB_USERNAME=root
DB_PASSWORD=          # Your MySQL password
```

---

#### 3️⃣ Install Dependencies

```bash
# PHP Dependencies
composer install

# Node Dependencies
npm install
```

**Waktu: 2-3 menit** (tergantung internet)

---

#### 4️⃣ Generate App Key

```bash
php artisan key:generate
```

**Output yang diharapkan:**
```
Application key set successfully.
```

---

#### 5️⃣ Create Database

Buka MySQL client atau PHPMyAdmin:

```sql
CREATE DATABASE ria_busana_85;
```

---

#### 6️⃣ Run Migrations & Seed

```bash
php artisan migrate:fresh --seed
```

**Output yang diharapkan:**
```
Database seeding completed successfully!
Admin login: admin@gmail.com / password
```

---

#### 7️⃣ Build Frontend Assets

```bash
npm run dev
```

---

#### 8️⃣ Start Laravel Server

```bash
php artisan serve
```

**Output yang diharapkan:**
```
Laravel development server started: http://127.0.0.1:8000
```

---

#### 9️⃣ Akses Website

```
Website:       http://localhost:8000
Admin Panel:   http://localhost:8000/admin
```

**Login Admin:**
- Email: `admin@gmail.com`
- Password: `password`

---

## 🔄 Setiap Kali Membuka Aplikasi

### Docker
```bash
# Start services
docker-compose up -d

# Akses: http://localhost

# Untuk stop:
docker-compose down
```

### Manual
```bash
# Terminal 1: Start Laravel
php artisan serve

# Terminal 2: Build assets (jika ada perubahan CSS/JS)
npm run dev

# Akses: http://localhost:8000
```

---

## 📝 Verifikasi Setup Berhasil

### 1. Homepage Buka dengan Sempurna
- Lihat katalog produk per counter
- Lihat promo dengan diskon
- Lihat staff list

### 2. Admin Panel Bisa Diakses
- Buka http://localhost/admin (Docker) atau http://localhost:8000/admin (Manual)
- Login dengan admin@gmail.com / password
- Lihat dashboard dengan stats

### 3. Database Terisi dengan Benar
**Docker:**
```bash
docker-compose exec phpmyadmin phpmyadmin
# Akses: http://localhost:8080
# Username: ria_busana
# Password: password
```

**Manual:**
```bash
mysql -uroot -p ria_busana_85
SELECT COUNT(*) FROM counters;  # Should return 2
SELECT COUNT(*) FROM products;  # Should return 3
SELECT COUNT(*) FROM staff;     # Should return 5
SELECT COUNT(*) FROM promos;    # Should return 2
```

---

## ⚠️ Troubleshooting

### Docker Issues

#### Error: "Cannot connect to Docker daemon"
```bash
# Windows/Mac: Start Docker Desktop application manually

# Linux: Start Docker service
sudo systemctl start docker
```

#### Error: "Port 80 already in use"
```bash
# Change port in docker-compose.yml
# Edit line: ports: - "8080:80"
# Then restart:
docker-compose down
docker-compose up -d
```

#### MySQL container not healthy
```bash
# Tunggu lebih lama (30-60 detik)
# Atau restart:
docker-compose restart db
docker-compose logs db
```

#### Permission denied error
```bash
# Linux only:
sudo chown -R $USER:$USER .
```

---

### Manual Setup Issues

#### Error: "Laravel application key missing"
```bash
php artisan key:generate
```

#### Error: "Connection refused to 127.0.0.1:3306"
- MySQL belum jalan?
  - Windows: Start XAMPP / WAMP
  - Linux: `sudo systemctl start mysql`
  - Mac: Start MySQL via preferences

#### Error: "SQLSTATE[HY000]: General error"
```bash
# Drop dan create ulang database
mysql -uroot -p
DROP DATABASE ria_busana_85;
CREATE DATABASE ria_busana_85;

# Kemudian:
php artisan migrate:fresh --seed
```

#### Port 8000 already in use
```bash
# Gunakan port lain:
php artisan serve --port=8001
```

---

### General Issues

#### Seeder tidak jalan, admin tidak terbuat
```bash
# Docker:
docker-compose exec app php artisan db:seed

# Manual:
php artisan db:seed
```

#### Lupa password admin
```bash
# Docker:
docker-compose exec app php artisan tinker
>>> Admin::first()->update(['password' => Hash::make('password')])

# Manual:
php artisan tinker
>>> Admin::first()->update(['password' => Hash::make('password')])
```

#### Assets (CSS/JS) tidak load
```bash
# Docker:
docker-compose exec app npm run build

# Manual:
npm run build
```

---

## 📞 Tidak Ada yang Berhasil?

### Cek logs:

**Docker:**
```bash
docker-compose logs -f app      # App logs
docker-compose logs -f db       # Database logs
docker-compose logs -f nginx    # Web server logs
```

**Manual:**
```bash
tail -f storage/logs/laravel.log
```

### Common Commands untuk Debug

**Docker:**
```bash
# Enter PHP container
docker-compose exec app bash

# Run artisan commands
docker-compose exec app php artisan tinker
docker-compose exec app php artisan migrate:status
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
```

**Manual:**
```bash
php artisan migrate:status
php artisan cache:clear
php artisan config:clear
composer dump-autoload
```

---

## ✅ Checklist Setup Berhasil

- [ ] Repository ter-clone di folder
- [ ] `.env` file sudah dibuat
- [ ] Docker containers running (atau PHP/MySQL jalan)
- [ ] Database sudah di-migrate
- [ ] Admin user sudah ter-seed
- [ ] Website bisa dibuka (http://localhost)
- [ ] Admin panel bisa diakses
- [ ] Bisa login dengan admin@gmail.com / password
- [ ] Data sample (counters, products, staff, promos) ada

---

## 🎯 Next Steps Setelah Setup

1. **Explore Admin Panel**
   - Lihat Dashboard dengan statistik
   - Lihat list Counters, Products, Staff, Promos

2. **Create Sample Data**
   - Tambah counter baru
   - Tambah product dengan upload gambar
   - Tambah staff
   - Buat promo

3. **Lihat Public Website**
   - Homepage menampilkan katalog
   - Klik counter untuk lihat detail
   - Klik staff untuk lihat daftar lengkap
   - Klik discount untuk lihat promosi

4. **Customize untuk Bisnis Anda**
   - Edit informasi counter
   - Upload produk real
   - Manage staff
   - Set promo sesuai kebutuhan

---

**Last Updated:** November 30, 2025 | **Status:** ✅ Production Ready
