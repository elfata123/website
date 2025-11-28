# 📊 Database Schema - Ria Busana 85

## Entity Relationship Diagram (ERD)

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                          RIAS BUSANA 85 DATABASE                            │
└─────────────────────────────────────────────────────────────────────────────┘


                              ┌──────────────────┐
                              │     ADMINS       │
                              ├──────────────────┤
                              │ id (PK)          │
                              │ nama             │
                              │ email (UNIQUE)   │
                              │ password         │
                              │ timestamps       │
                              └──────────────────┘


                              ┌──────────────────┐
                              │    COUNTERS      │
                              ├──────────────────┤
                              │ id (PK)          │
                              │ nama             │
                              │ lokasi           │
                              │ pegawai (legacy) │
                              │ timestamps       │
                              └────────┬─────────┘
                                       │
                  ┌────────────────────┼────────────────────┐
                  │                    │                    │
                  │ (1 : M)            │ (1 : M)            │
                  │                    │                    │
        ┌─────────▼──────────┐  ┌──────▼────────────┐
        │    PRODUCTS        │  │      STAFF       │
        ├────────────────────┤  ├──────────────────┤
        │ id (PK)            │  │ id (PK)          │
        │ counter_id (FK)    │  │ counter_id (FK)* │
        │ nama               │  │ nama             │
        │ deskripsi          │  │ jabatan          │
        │ harga              │  │ timestamps       │
        │ gambar             │  │                  │
        │ timestamps         │  │ * nullable       │
        └─────────┬──────────┘  │   (staff umum)   │
                  │             └──────────────────┘
                  │
          (1 : M) │
                  │
        ┌─────────▼──────────┐
        │     PROMOS         │
        ├────────────────────┤
        │ id (PK)            │
        │ product_id (FK)    │
        │ deskripsi          │
        │ harga_asli         │
        │ diskon             │
        │ harga_setelah_diskon
        │ mulai (date)       │
        │ berakhir (date)    │
        │ timestamps         │
        └────────────────────┘
```

---

## 📋 Tabel Detail

### 1️⃣ **ADMINS Table**
```sql
CREATE TABLE admins (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Penjelasan:**
- Menyimpan data admin/user sistem
- Email unik untuk login
- Password di-hash menggunakan bcrypt
- Digunakan oleh AdminAuthController untuk autentikasi

---

### 2️⃣ **COUNTERS Table**
```sql
CREATE TABLE counters (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(255) NOT NULL,
    lokasi VARCHAR(255) NULLABLE,
    pegawai VARCHAR(255) NULLABLE,    -- Legacy field (deprecated)
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

**Penjelasan:**
- Merepresentasikan toko/outlet Ria Busana
- Setiap counter memiliki nama toko dan lokasi geografis
- Relasi: 1 counter → banyak products & staff
- Field `pegawai` sudah deprecated (gunakan staff table)

---

### 3️⃣ **PRODUCTS Table**
```sql
CREATE TABLE products (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    counter_id BIGINT UNSIGNED NOT NULL,
    nama VARCHAR(255) NOT NULL,
    deskripsi TEXT NULLABLE,
    harga INT NOT NULL,                -- Harga dalam Rupiah
    gambar VARCHAR(255) NULLABLE,      -- Nama file gambar
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    CONSTRAINT fk_products_counter
        FOREIGN KEY (counter_id) 
        REFERENCES counters(id) 
        ON DELETE CASCADE
);
```

**Penjelasan:**
- Menyimpan produk busana di setiap counter
- FK ke counters (produk milik counter mana)
- Gambar disimpan di folder: `public/upload/produk/`
- Cascade delete: hapus counter → hapus semua produknya

---

### 4️⃣ **STAFF Table**
```sql
CREATE TABLE staff (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    counter_id BIGINT UNSIGNED NULLABLE,    -- Nullable untuk staff umum
    nama VARCHAR(255) NOT NULL,
    jabatan VARCHAR(255) NULLABLE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    CONSTRAINT fk_staff_counter
        FOREIGN KEY (counter_id) 
        REFERENCES counters(id) 
        ON DELETE CASCADE
);
```

**Penjelasan:**
- Menyimpan data karyawan Ria Busana
- Dua tipe staff:
  - **Staff Counter**: counter_id terisi (staff khusus satu counter)
  - **Staff Umum**: counter_id NULL (staff general/admin)
- Filtering: `Staff::where('counter_id', null)->get()` = staff umum
- Cascade delete: hapus counter → hapus staff-nya

---

### 5️⃣ **PROMOS Table**
```sql
CREATE TABLE promos (
    id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    product_id BIGINT UNSIGNED NOT NULL,
    deskripsi TEXT NULLABLE,
    harga_asli INT NOT NULL,              -- Harga normal
    diskon INT NULLABLE,                  -- Persentase (0-100)
    harga_setelah_diskon INT NOT NULL,    -- Harga final
    mulai DATE NOT NULL,                  -- Tanggal mulai
    berakhir DATE NOT NULL,               -- Tanggal berakhir
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    
    CONSTRAINT fk_promos_product
        FOREIGN KEY (product_id) 
        REFERENCES products(id) 
        ON DELETE CASCADE
);
```

**Penjelasan:**
- Menyimpan promosi/diskon untuk produk
- FK ke products (promo untuk produk mana)
- Periode berlaku: mulai ~ berakhir
- Diskon otomatis dihitung: `harga_asli - (harga_asli * diskon/100)`
- Filtering promo aktif: `Promo::where('berakhir', '>=', date('Y-m-d'))->get()`

---

## 🔗 Relasi Data

### **One-to-Many (1:M) Relationships**

```
COUNTERS (1) ──────────────────────────── (M) PRODUCTS
   id              fk_products_counter        counter_id
   
Arti: Satu counter punya banyak produk
Query: Counter::with('products')->get()
```

```
COUNTERS (1) ──────────────────────────── (M) STAFF
   id              fk_staff_counter          counter_id
   
Arti: Satu counter punya banyak staff
Query: Counter::with('staff')->get()
```

```
PRODUCTS (1) ──────────────────────────── (M) PROMOS
   id              fk_promos_product         product_id
   
Arti: Satu produk punya banyak promo
Query: Product::with('promos')->get()
```

---

## 🎯 Contoh Data Flow

### **Skenario 1: Tampilkan Homepage**

```
GET / (Route)
    ↓
Counter::with('products', 'staff')->get()
    ↓
┌─────────────────────────────────────────┐
│ Counter 1: "Toko Pusat"                 │
│  ├─ Products:                           │
│  │   ├─ Hijab Premium (Rp 50.000)      │
│  │   ├─ Gamis Motif (Rp 100.000)       │
│  │   └─ Jilbab Katun (Rp 25.000)       │
│  │                                     │
│  ├─ Staff (counter-specific):           │
│  │   ├─ Siti Nurhaliza (Manager)        │
│  │   └─ Ahmad Rifai (Sales)             │
│  │                                     │
├─ Counter 2: "Mall XYZ"                  │
│  ├─ Products: ...                       │
│  └─ Staff: ...                          │
│                                         │
└─ General Staff (counter_id = null):     │
│   ├─ Ibu Suwanti (Admin)                │
│   └─ Pak Bambang (Direktur)             │
└─────────────────────────────────────────┘
```

---

### **Skenario 2: Login Admin**

```
POST /admin/login (email, password)
    ↓
AdminAuthController::login()
    ↓
Admin::where('email', email)->first()
    ↓
Hash::check(password, admin.password)
    ↓
session(['admin_id' => admin.id])
    ↓
Redirect /admin (Dashboard)
```

---

### **Skenario 3: Tambah Produk ke Counter**

```
GET /admin/counters/{id}/products/create
    ↓
ProductController::createForCounter()
    ↓
Tampilkan form dengan counter_id pre-filled
    ↓
POST /admin/products (name, desc, price, image, counter_id)
    ↓
Validate & Upload image ke public/upload/produk/
    ↓
Product::create([
    'counter_id' => $counter_id,
    'nama' => $request->nama,
    'deskripsi' => $request->deskripsi,
    'harga' => $request->harga,
    'gambar' => $filename
])
    ↓
Redirect ke counter detail
```

---

## 📐 Database Statistics

| Tabel | Jumlah Kolom | Tipe Data Utama | Relasi |
|-------|--------------|-----------------|--------|
| admins | 5 | STRING, PASSWORD | - |
| counters | 4 | STRING, NULLABLE | Parent (2 children) |
| products | 7 | INT, STRING, FK | Child (1), Parent (1) |
| staff | 5 | STRING, FK (nullable) | Child (1) |
| promos | 8 | INT, DATE, FK | Child (1) |

---

## 🔐 Foreign Key Constraints

```
products.counter_id     → counters.id        (CASCADE DELETE)
staff.counter_id        → counters.id        (CASCADE DELETE, NULLABLE)
promos.product_id       → products.id        (CASCADE DELETE)
```

**Artinya:**
- Hapus counter → otomatis hapus products & staff-nya
- Hapus product → otomatis hapus promos-nya
- Staff bisa null (staff umum, tidak dihapus saat counter dihapus)

---

## 📊 Index untuk Performa

```sql
-- Foreign Key Indexes (auto-created)
CREATE INDEX idx_products_counter_id ON products(counter_id);
CREATE INDEX idx_staff_counter_id ON staff(counter_id);
CREATE INDEX idx_promos_product_id ON promos(product_id);

-- Unique Indexes
CREATE UNIQUE INDEX idx_admins_email ON admins(email);

-- Optional Performance Indexes
CREATE INDEX idx_promos_berakhir ON promos(berakhir);
CREATE INDEX idx_staff_counter_null ON staff(counter_id);
```

---

## 🛠️ Migrasi & Setup

### Urutan Setup Database:
1. ✅ Create `admins` table (no dependencies)
2. ✅ Create `counters` table (no dependencies)
3. ✅ Create `products` table (FK ke counters)
4. ✅ Create `staff` table (FK nullable ke counters)
5. ✅ Create `promos` table (FK ke products)

### Seeding Data:
```php
// Seed Admin
Admin::create([
    'nama' => 'Admin Ria Busana',
    'email' => 'admin@ria.com',
    'password' => Hash::make('password123')
]);

// Seed Counter
Counter::create(['nama' => 'Toko Pusat', 'lokasi' => 'Bandung']);
Counter::create(['nama' => 'Mall XYZ', 'lokasi' => 'Jakarta']);

// Seed Products
Product::create([
    'counter_id' => 1,
    'nama' => 'Hijab Premium',
    'harga' => 50000
]);

// Seed Staff
Staff::create([
    'counter_id' => 1,
    'nama' => 'Siti Nurhaliza',
    'jabatan' => 'Manager'
]);

Staff::create([
    'counter_id' => null,    // Staff umum
    'nama' => 'Ibu Suwanti',
    'jabatan' => 'Admin'
]);
```

---

## 🎓 Kesimpulan

**Database Ria Busana 85** dirancang dengan:
- ✅ Proper foreign key constraints
- ✅ Cascade delete untuk data integrity
- ✅ Nullable fields untuk flexibility (staff umum)
- ✅ Timestamp fields untuk audit trail
- ✅ Unique constraint untuk email admin
- ✅ Scalable structure untuk growth

Struktur ini memudahkan:
- Penambahan counter/toko baru
- Manajemen produk per counter
- Organisasi staff (counter-specific & general)
- Pengelolaan promosi aktif
- Admin authentication & security
