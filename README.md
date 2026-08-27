# WargaKita — Sistem Administrasi RT

Aplikasi Laravel 12 untuk digitalisasi administrasi RT 09 / RW 10, Citra Indah City,
Bukit Angsana: data warga, data rumah, billing IPL, pembayaran, pengajuan surat
(dengan cetak PDF), berita acara, surat undangan, dan surat keluar.

Tema tampilan: gradient **pink → putih**.

## Fitur

- **Autentikasi & Role** — Admin (Pengurus RT) dan Warga.
- **Data Warga & Data Rumah** — dikelola Admin, relasi Warga → Rumah → Billing IPL.
- **Billing IPL** — status Belum Bayar → Menunggu Verifikasi → Lunas.
- **Pembayaran** — warga unggah bukti transfer, admin verifikasi.
- **Pengajuan Surat** — Surat Kematian, Domisili, Pengantar, Lainnya. Setelah
  disetujui admin, warga bisa unduh surat dalam bentuk PDF.
- **Berita Acara, Surat Undangan (bisa dicetak), dan Surat Keluar** — dikelola Admin.
- **Dashboard** berbeda untuk Admin dan Warga.

## Instalasi

```bash
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite   # jika belum ada (DB_CONNECTION=sqlite)
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

Seeder di atas membuat satu akun Admin (Pengurus RT) default:

- Email: `admin@wargakita.test`
- Password: `password`

**Segera ganti password ini setelah login pertama kali.**

Akun **Warga** dibuat sendiri oleh warga melalui halaman **Daftar** (register),
lalu diverifikasi statusnya oleh Admin di menu **Data Warga**.

## Catatan

- Versi awal menggunakan pembayaran manual (transfer DANA + upload bukti),
  belum ada payment gateway otomatis — sesuai batasan versi awal WargaKita.
- Untuk menampilkan QR Code pembayaran DANA, simpan gambar QR di
  `public/images/qr-dana.png`. Jika belum ada, halaman pembayaran akan
  menampilkan placeholder.
- Generate PDF surat menggunakan `barryvdh/laravel-dompdf`. Pastikan
  `composer install` berhasil sebelum mencoba fitur unduh PDF.
