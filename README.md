# 🏠 Eazy Kost

**Eazy Kost** adalah platform marketplace berbasis web modern yang menghubungkan pemilik kost dengan pencari kost. Dibangun menggunakan **Laravel**, aplikasi ini menawarkan pengalaman pengguna yang mulus untuk manajemen properti, pencarian hunian, dan pengelolaan penyewaan.

![Eazy Kost Preview](public/preview.png) ## ✨ Fitur Utama

### 👤 Untuk Pencari Kost (Penyewa)
* **Pencarian Real-time:** Mencari kost berdasarkan nama tanpa reload halaman (menggunakan **Alpine.js**).
* **Detail Lengkap:** Melihat galeri foto (carousel), fasilitas, deskripsi, dan opsi harga (Harian/Bulanan/Tahunan).
* **Ajukan Sewa:** Mengirim permintaan sewa ke pemilik hanya dengan satu klik.
* **Riwayat Pengajuan:** Memantau status pengajuan sewa pada halaman khusus (`/my-requests`).
* **Kontak Langsung:** Terintegrasi dengan **WhatsApp** untuk menghubungi pemilik secara langsung.

### 🏢 Untuk Pemilik Kost (Owner)
* **Dashboard Statistik:** Memantau jumlah properti, total kamar, dan permintaan sewa baru vs arsip.
* **Manajemen Kost (CRUD):** Tambah, edit, dan hapus data kost beserta foto-fotonya.
* **Manajemen Permintaan:**
    * Menerima notifikasi permintaan sewa baru (Pending).
    * Menghubungi peminat via WhatsApp (otomatis mengubah status menjadi *Contacted* & masuk Arsip).
    * Fitur **Arsip** untuk melihat riwayat peminat yang sudah dihubungi agar dashboard tetap bersih.
* **Smart Upload:** Sistem upload gambar dengan validasi slot maksimal 10 foto, fitur hapus, dan pengaturan urutan foto (*sorting*).

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel 11 (PHP Framework)
* **Frontend:** Blade Templates
* **Styling:** Tailwind CSS (via CDN)
* **Interactivity:** Alpine.js (via CDN)
* **Database:** MySQL / SQLite

## 🚀 Panduan Instalasi (Lokal)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda:

### 1. Clone Repositori
```bash
git clone [https://github.com/username/eazy-kost.git](https://github.com/username/eazy-kost.git)
cd eazy-kost
````

### 2\. Install Dependencies

Pastikan Anda memiliki PHP dan Composer yang terinstal.

```bash
composer install
npm install && npm run build
```

### 3\. Konfigurasi Environment

Salin file contoh `.env` dan buat kunci aplikasi.

```bash
cp .env.example .env
php artisan key:generate
```

*Catatan: Pastikan Anda mengatur konfigurasi database (`DB_DATABASE`, `DB_USERNAME`, dll) di dalam file `.env`.*

### 4\. Setup Database

Jalankan migrasi untuk membuat tabel dan seeder (opsional) untuk data awal.

```bash
php artisan migrate --seed
```

### 5\. Konfigurasi Penyimpanan Gambar (PENTING) ⚠️

Agar foto yang diupload dapat muncul, Anda harus membuat *symbolic link*.

**Jika Anda baru saja memindahkan project dari komputer lain atau foto tidak muncul:**

1.  Hapus folder `public/storage` secara manual.
2.  Jalankan perintah berikut di terminal:

<!-- end list -->

```bash
php artisan storage:link
```

### 6\. Jalankan Server

```bash
php artisan serve
```

Buka browser dan akses: `http://localhost:8000`

## 📝 Catatan Penggunaan

  * **Registrasi:** Pengguna baru dapat mendaftar dan memilih peran sebagai **Penyewa** atau **Pemilik**.
  * **Akses Role:**
      * Akun **Pemilik** memiliki akses ke Dashboard Pemilik, Tambah Kost, dan Manajemen Request.
      * Akun **Penyewa** hanya memiliki akses ke Beranda, Pencarian, Detail Kost, dan Riwayat Pengajuan.

## 📄 Lisensi

[MIT license](https://opensource.org/licenses/MIT).

```