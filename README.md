# Perpustakaan Pakukerto

Aplikasi perpustakaan digital berbasis Laravel untuk manajemen buku, autentikasi pengguna/admin, dan login Google.

## Fitur Utama

- Login / register pengguna dengan email dan password
- Login dengan Google OAuth
- Peran `admin` dan `user`
- Manajemen buku untuk admin
- Pencarian buku dan navigasi halaman responsif
- UI berbasis Tailwind + Vite

## Setup Lokal

1. Salin file environment:

```bash
cp .env.example .env
```

2. Instal dependencies:

```bash
composer install
npm install
```

3. Generate app key:

```bash
php artisan key:generate
```

4. Jalankan migrasi:

```bash
php artisan migrate
```

5. Jalankan server lokal:

```bash
php artisan serve
```

## Konfigurasi Google OAuth

Tambahkan variabel berikut ke file `.env`:

```env
GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT=http://localhost:8000/auth/google/callback
```

Kemudian atur URL callback yang sama di Google Cloud Console.

## Akun Demo

Aplikasi ini sudah disiapkan dengan akun demo berikut:

- Admin: `admin@pakukerto.local` / `admin1234`
- User: `user@pakukerto.local` / `user1234`

## Struktur Repository

- `app/Http/Controllers/AuthController.php` — autentikasi lokal dan Google
- `app/Models/User.php` — model pengguna dengan `google_id`
- `routes/web.php` — route auth dan dashboard
- `resources/views/auth/` — tampilan login/register
- `database/migrations/` — migrasi database

## GitHub

Remote saat ini:

`https://github.com/hikam-TI/Perpus-Pakukerto.git`

### Branch protection

Untuk mengaktifkan proteksi branch, gunakan GitHub web UI atau `gh` CLI:

- Aktifkan required reviews
- Lindungi branch `master`
- Nonaktifkan push langsung jika diperlukan

## Lisensi

Project ini menggunakan lisensi MIT.
