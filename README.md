# 🏆 e-Prestasi: Sistem Pendataan Prestasi Siswa Modern

![Maintanance](https://img.shields.io/badge/Maintained%3F-yes-green.svg)
![CodeIgniter 4](https://img.shields.io/badge/CodeIgniter-4.7.2-EF4223?style=flat&logo=codeigniter&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-v4.0-38B2AC?style=flat&logo=tailwind-css&logoColor=white)

Sebuah platform web berbasis _Role-Based Access Control_ (RBAC) yang dirancang untuk membantu instansi pendidikan dalam mencatat, melacak, dan mengelola data pencapaian siswa secara _seamless_ dan terstruktur.

---

## 👨‍💻 Tentang Proyek Ini (Portofolio)

Proyek ini dikembangkan oleh **Muhamad Ihsan Kurniawan** sebagai bagian dari portofolio pengembangan web _Full-Stack_. Fokus utama dalam pengembangan aplikasi ini adalah implementasi **Modern Tech Stack** di atas _framework_ PHP tradisional, serta penerapan praktik keamanan standar industri.

Dalam proyek ini, saya mendemonstrasikan kemampuan:

1. **Keamanan & Autentikasi:** Membangun sistem login yang aman dengan _Password Hashing_ (Bcrypt), implementasi _Middleware/Filters_ CI4 untuk memproteksi rute dari akses ilegal, dan aktivasi perlindungan CSRF (_Cross-Site Request Forgery_) secara global.
2. **Modern UI/UX:** Meninggalkan arsitektur CSS tradisional dan menggunakan **Tailwind CSS versi terbaru (v4)** untuk UI yang responsif, _clean_, dan sangat _customizable_.
3. **Interaktivitas Ringan:** Menggunakan **Alpine.js** dan **HTMX** untuk memberikan pengalaman layaknya _Single Page Application_ (SPA) yang dinamis tanpa _overhead_ JavaScript yang berat.
4. **Database Management:** Menggunakan fitur _Migrations_ dan _Seeders_ untuk _version control_ struktur _database_, sehingga aplikasi mudah di-_deploy_ di berbagai lingkungan kerja.

---

## ✨ Fitur Utama (Fase Pengembangan)

- 🔐 **Sistem Autentikasi Multi-Peran:** Login aman yang membedakan hak akses antara _Admin_ (pengelola sekolah) dan _Siswa_.
- 🛡️ **Rute Terproteksi:** Seluruh aplikasi diamankan dan tidak dapat diakses tanpa sesi login yang valid.
- 🎨 **Antarmuka Intuitif:** Desain UI/UX yang modern, _mobile-friendly_, dan interaktif.
- 📊 **Manajemen Data (Akan Datang):** Fitur CRUD (Create, Read, Update, Delete) untuk mendata berbagai kategori prestasi akademik maupun non-akademik.

---

## 🛠️ Teknologi yang Digunakan

- **Backend:** PHP 8.x, CodeIgniter 4 (v4.7.2)
- **Frontend:** HTML5, Tailwind CSS v4, Alpine.js, HTMX
- **Database:** MySQL / MariaDB
- **Architecture:** MVC (Model-View-Controller)

---

## 🚀 Cara Menjalankan Aplikasi Secara Lokal

Jika Anda ingin menjalankan proyek ini di mesin lokal Anda untuk keperluan _review_ atau pengujian, silakan ikuti langkah-langkah berikut:

### 1. Kebutuhan Sistem

Pastikan Anda sudah menginstal:

- PHP ^8.1
- Composer
- Node.js & npm (untuk _compile_ Tailwind CSS)
- MySQL/MariaDB

### 2. Instalasi

Clone repositori ini dan masuk ke dalam folder proyek:

```bash
git clone [https://github.com/username-anda/prestasi-siswa.git](https://github.com/username-anda/prestasi-siswa.git)
cd prestasi-siswa
```

Install dependensi backend (PHP) dan frontend (Node):

```bash
composer install
npm install
```

3. Konfigurasi Environment
   Salin file .env contoh:

```bash
cp env .env
```

Buka file .env dan atur kredensial database Anda pada bagian DATABASE. Jangan lupa ubah CI_ENVIRONMENT menjadi development.

4. Setup Database
   Jalankan migrasi untuk membuat tabel dan seeder untuk mengisi data akun awal:

```bash
php spark migrate
php spark db:seed InitialDataSeeder
```

5. Kompilasi Aset & Jalankan Server
   Buka dua tab terminal.
   Di terminal pertama, jalankan compiler Tailwind:

```bash
npx @tailwindcss/cli -i ./src/input.css -o ./public/css/style.css --watch
```

Di terminal kedua, jalankan server CodeIgniter:

```bash
php spark serve
```

Aplikasi sekarang dapat diakses melalui http://localhost:8080.
Akun Default untuk Login:

```bash
Username: admin

Password: admin123
```
