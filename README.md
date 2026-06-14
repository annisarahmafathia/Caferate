# ☕ CaféRate — Sistem Review Café Berbasis Web

## 📌 Deskripsi Singkat

CaféRate adalah aplikasi web yang memungkinkan pengguna mencari café, melihat detail café, memberikan review, serta mengunggah foto pengalaman mereka. Sistem juga menyediakan dashboard admin untuk mengelola data café dan memoderasi review pengguna.

---

## 🎯 Tujuan Pengembangan

* Membantu pengguna menemukan café yang sesuai dengan preferensi mereka.
* Menyediakan platform berbagi pengalaman melalui review dan foto.
* Mempermudah pengelolaan data café melalui dashboard admin.
* Menyediakan informasi dan penilaian café sebagai referensi bagi pengguna lain.

---

## ✨ Fitur Utama

### User

* Registrasi akun
* Login & Logout
* Melihat daftar café
* Filter dan pencarian café
* Melihat detail café
* Menulis review
* Upload foto review
* Melihat review pengguna lain

### Admin

* Login Admin
* Dashboard statistik
* Kelola data café (CRUD)
* Moderasi review pengguna

---

## 🛠 Teknologi yang Digunakan

| Kategori           | Teknologi                     |
| ------------------ | ----------------------------- |
| Backend            | Laravel 11                    |
| Bahasa Pemrograman | PHP 8.2+                      |
| Frontend           | Blade Template                |
| Styling            | Tailwind CSS                  |
| Database           | MySQL                         |
| Storage            | Laravel Storage (Public Disk) |
| Middleware         | Admin Middleware              |
| Version Control    | Git & GitHub                  |

---

## 🗄 Struktur Database

### users

* id
* name
* email
* password
* role

### cafes

* id
* name
* location
* description
* image

### reviews

* id
* user_id
* cafe_id
* rating
* comment

### review_photos

* id
* review_id
* photo_path

### Relasi

* User → Review (1:M)
* Café → Review (1:M)
* Review → Review Photo (1:M)

---

## 🔄 Alur Sistem

### User

Register/Login → Lihat Daftar Café → Filter Café → Buka Detail Café → Tulis Review → Upload Foto → Review Ditampilkan

### Admin

Login → Dashboard Statistik → Kelola Data Café (CRUD) → Moderasi Review

---

## 🚀 Instalasi

### 1. Install Dependency

```bash
composer install
```

### 2. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 3. Konfigurasi Database

Edit file `.env`

```env
DB_DATABASE=caferate
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi Database dan Seeder

```bash
php artisan migrate --seed
```

### 5. Storage Link

```bash
php artisan storage:link
```

### 6. Jalankan Aplikasi

```bash
php artisan serve
```

Akses melalui:

```text
http://localhost:8000
```

---

## 👤 Akun Default

| Role  | Email                                           | Password |
| ----- | ----------------------------------------------- | -------- |
| Admin | [admin@caferate.com](mailto:admin@caferate.com) | admin123 |
| User  | [user@caferate.com](mailto:user@caferate.com)   | user123  |

---

## 📷 Screenshot Aplikasi

### Halaman Daftar
![Login](Screenshots%20Caferate/daftar.png)

### Halaman Login
![Login](Screenshots%20Caferate/login.png)

### Dashboard User
![Login](Screenshots%20Caferate/dashboarduser.png)

### Dashboard Admin
![Login](Screenshots%20Caferate/dashboardadmin.png)

### Halaman Detail Cafe & Review
![Login](Screenshots%20Caferate/detailcafedanreview.png)

### Halaman Review Café
![Login](Screenshots%20Caferate/review.png)

### Halaman CRUD Café
![Login](Screenshots%20Caferate/CRUDcafe.png)

