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

6. Jalankan migrasi database
```bash
php artisan migrate
```

7. Setup Storage:
```bash
# Buat symbolic link dari public/storage ke storage/app/public
php artisan storage:link

# Buat folder-folder berikut di storage/app/public:
mkdir storage/app/public/uploads
mkdir storage/app/public/uploads/barbers
mkdir storage/app/public/uploads/collections
mkdir storage/app/public/uploads/services
```

8. Copy Assets Default:
- Buat folder baru bernama 'default_assets' di root project
- Copy semua gambar ke folder yang sesuai:
  ```
  default_assets/
  ├── barbers/
  │   ├── barbers-684856a32a86c.jpeg
  │   ├── barbers-684856ef11411.jpeg
  │   └── ...
  ├── collections/
  │   ├── collections-68485776c652f.jpeg
  │   ├── collections-684857a44cc2d.jpeg
  │   └── ...
  └── services/
      └── ...
  ```
- Copy semua gambar ke folder storage yang sesuai:
  ```bash
  # Windows
  xcopy "default_assets\barbers\*" "storage\app\public\uploads\barbers\" /E /I /Y
  xcopy "default_assets\collections\*" "storage\app\public\uploads\collections\" /E /I /Y
  xcopy "default_assets\services\*" "storage\app\public\uploads\services\" /E /I /Y
  ```

9. Verifikasi Permissions:
- Pastikan folder storage dan semua subfolder memiliki permission yang benar
- Untuk Windows, pastikan folder dapat diakses untuk read/write

10. Verifikasi Assets:
- Buka browser dan akses: http://127.0.0.1:8000/storage/uploads/barbers/
- Seharusnya Anda dapat melihat gambar-gambar barber
- Lakukan hal yang sama untuk collections dan services

11. Install dependensi JavaScript
```bash
npm install
```

12. Compile asset
```bash
npm run dev
```

13. Jalankan server
```bash
php artisan serve
```

## Troubleshooting Assets

### Gambar Tidak Muncul
1. Periksa symbolic link:
```bash
ls -l public/storage
```

2. Jika symbolic link rusak, hapus dan buat ulang:
```bash
rm public/storage
php artisan storage:link
```

3. Periksa permissions folder:
```bash
# Windows
icacls "storage" /T
```

4. Periksa path gambar di database:
- Path harus relatif ke storage/app/public
- Contoh path yang benar: uploads/barbers/nama-file.jpg

### Pesan Error "File Not Found"
1. Periksa keberadaan file:
```bash
dir storage\app\public\uploads\barbers
```

2. Periksa URL yang diakses di browser:
- URL yang benar: http://127.0.0.1:8000/storage/uploads/barbers/nama-file.jpg

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
