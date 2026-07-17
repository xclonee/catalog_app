# Smart-Catalog UMKM

Smart-Catalog UMKM adalah aplikasi katalog produk berbasis **Laravel 13**, **MySQL**, **AdminLTE**, dan **SweetAlert**. Aplikasi ini menyediakan login merchant, dashboard, CRUD kategori, CRUD produk, dan upload image produk.

## Requirement

Pastikan environment berikut sudah tersedia:

- PHP 8.3 atau lebih baru
- Composer
- MySQL
- Node.js dan npm
- Laragon, XAMPP, atau web server lokal lain
- Git

## Instalasi

Clone atau buka folder project:

```bash
cd C:\laragon\www\smart-catalog
```

Install dependency PHP:

```bash
composer install
```

Install dependency frontend:

```bash
npm install
```

Salin file environment jika belum ada:

```bash
copy .env.example .env
```

Generate app key:

```bash
php artisan key:generate
```

## Konfigurasi Database

Buat database MySQL:

```sql
CREATE DATABASE smart_catalog;
```

Atur `.env`:

```env
APP_NAME="Smart-Catalog UMKM"
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smart_catalog
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan konfigurasi MySQL lokal Anda.

## Menjalankan Migration dan Seeder

Jalankan migration:

```bash
php artisan migrate
```

Jalankan seeder:

```bash
php artisan db:seed
```

Akun demo:

```text
Email: merchant@example.com
Password: password
```

## Storage Upload

Buat symbolic link agar image produk dapat diakses dari browser:

```bash
php artisan storage:link
```

File upload produk akan disimpan di:

```text
storage/app/public/products
```

dan diakses melalui:

```text
public/storage
```

## Menjalankan Aplikasi

Jalankan server Laravel:

```bash
php artisan serve
```

Buka aplikasi:

```text
http://127.0.0.1:8000
```

## Build Asset Frontend

Untuk development:

```bash
npm run dev
```

Untuk build production:

```bash
npm run build
```

Catatan: layout aplikasi saat ini menggunakan CDN AdminLTE dan SweetAlert, jadi aplikasi tetap dapat berjalan tanpa build Vite untuk fitur utama.

## Dump SQL Database

Folder dump SQL database disiapkan di:

```text
sql_dump_db
```

Silakan letakkan file dump database di folder tersebut, misalnya:

```text
sql_dump_db/smart_catalog.sql
```

Contoh import dump SQL:

```bash
mysql -u root -p smart_catalog < sql_dump_db/smart_catalog.sql
```

Jika password MySQL kosong di Laragon, gunakan:

```bash
mysql -u root smart_catalog < sql_dump_db/smart_catalog.sql
```

## Fitur Utama

- Register merchant
- Login merchant
- Logout merchant
- Dashboard merchant
- CRUD kategori
- CRUD produk
- Upload image produk
- Proteksi halaman dengan middleware auth dan merchant
- Validasi form dengan Laravel Form Request
- Notifikasi SweetAlert
- Template dashboard AdminLTE


## Troubleshooting

Jika halaman upload image tidak tampil:

```bash
php artisan storage:link
```

Jika konfigurasi `.env` berubah:

```bash
php artisan config:clear
```

Jika ingin reset database saat development:

```bash
php artisan migrate:fresh --seed
```
