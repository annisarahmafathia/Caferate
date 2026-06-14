# ☕ CaféRate — Final Project Web Development

Sistem review café berbasis web menggunakan **Laravel 11** + **Blade** + **Tailwind CSS**.

---

## 🚀 Cara Install

### 1. Clone / Extract Project
```bash
cd caferate
```

### 2. Install Dependencies
```bash
composer install
```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` sesuaikan database:
```env
DB_DATABASE=caferate
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat Database
Buat database MySQL bernama `caferate`, lalu:
```bash
php artisan migrate --seed
```

### 5. Storage Link
```bash
php artisan storage:link
```

### 6. Jalankan Server
```bash
php artisan serve
```

Buka: **http://localhost:8000**

---

## 👤 Akun Default

| Role  | Email                | Password |
|-------|----------------------|----------|
| Admin | admin@caferate.com   | admin123 |
| User  | user@caferate.com    | user123  |

---

## ✅ Fitur yang Tersedia

| No | Fitur                        | Status |
|----|------------------------------|--------|
| 1  | Halaman Registrasi           | ✅     |
| 2  | Halaman Login & Logout       | ✅     |
| 3  | Role User & Admin + Middleware| ✅     |
| 4  | Halaman Daftar Café          | ✅     |
| 5  | Halaman Detail Café          | ✅     |
| 6  | Filter Pencarian Café        | ✅     |
| 7  | Form Review per Aspek        | ✅     |
| 8  | Simpan & Tampil Review       | ✅     |
| 9  | Upload Foto saat Review      | ✅     |
| 10 | Dashboard Admin + Statistik  | ✅     |
| 11 | CRUD Café + Moderasi Review  | ✅     |

---

## 📁 Struktur Project

```
caferate/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── CafeController.php
│   │   │   ├── ReviewController.php
│   │   │   └── Admin/
│   │   │       ├── AdminDashboardController.php
│   │   │       ├── AdminCafeController.php
│   │   │       └── AdminReviewController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   └── Models/
│       ├── User.php
│       ├── Cafe.php
│       ├── Review.php
│       └── ReviewPhoto.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── layouts/
│   │   ├── app.blade.php       (layout publik)
│   │   └── admin.blade.php     (layout admin + sidebar)
│   ├── auth/
│   │   ├── login.blade.php
│   │   └── register.blade.php
│   ├── cafes/
│   │   ├── index.blade.php     (daftar café + filter)
│   │   └── show.blade.php      (detail café + review)
│   └── admin/
│       ├── dashboard.blade.php
│       ├── cafes/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   └── edit.blade.php
│       └── reviews/
│           └── index.blade.php
└── routes/
    └── web.php
```

---

## 🛠 Tech Stack

- **Backend**: Laravel 11 (PHP 8.2+)
- **Frontend**: Blade Template + Tailwind CSS CDN
- **Database**: MySQL
- **Storage**: Laravel Storage (public disk)
