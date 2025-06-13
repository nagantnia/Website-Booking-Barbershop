# Website Booking Barbershop

## Deskripsi Projek
Website Booking Barbershop adalah aplikasi berbasis web yang dikembangkan menggunakan framework Laravel untuk memudahkan pelanggan dalam melakukan reservasi layanan potong rambut secara online.

## Fitur Utama
- Sistem Autentikasi (Login/Register)
- Booking layanan barbershop
- Manajemen jadwal booking
- Panel admin untuk mengelola reservasi
- Pengelolaan layanan dan harga
- Riwayat transaksi

## Teknologi yang Digunakan
- Laravel 10
- PHP 8.1
- MySQL
- Bootstrap 5
- JavaScript/jQuery
- HTML5/CSS3

## Persyaratan Sistem
- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM
- Web Server (Apache/Nginx)

## Cara Instalasi
1. Clone repository ini
```bash
git clone https://github.com/nagantnia/Website-Booking-Barbershop.git
```

2. Install dependensi PHP
```bash
composer install
```

3. Copy file .env.example ke .env
```bash
copy .env.example .env
```

4. Generate application key
```bash
php artisan key:generate
```

5. Import database
- Buat database baru bernama 'barbershop'
- Import file SQL dari folder 'Hasil_Ekstrak_Database'

6. Jalankan migrasi database
```bash
php artisan migrate
```

7. Install dependensi JavaScript
```bash
npm install
```

8. Compile asset
```bash
npm run dev
```

9. Jalankan server
```bash
php artisan serve
```

## Struktur Database
Database terdiri dari beberapa tabel utama:
- users: Menyimpan data pengguna
- bookings: Menyimpan data reservasi
- services: Menyimpan data layanan
- transactions: Menyimpan data transaksi

## API Documentation

### Public Endpoints
- GET /api/collections - Daftar koleksi
- GET /api/services - Daftar layanan
- GET /api/pricings - Daftar harga
- GET /api/barbers - Daftar tukang cukur

### Protected Endpoints (Admin)
- CRUD /api/admin/collections
- CRUD /api/admin/services
- CRUD /api/admin/pricings
- CRUD /api/admin/barbers
- CRUD /api/admin/bookings
- CRUD /api/admin/users

## Kontributor
- Danu Prasetya(23091397061)
- Ariel Pramudya(23091397069)
- Andhika Abdillah(23091397046)

## Lisensi
The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
