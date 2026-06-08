# Setup Google OAuth untuk Perpustakaan Pakukerto

Panduan ini menjelaskan cara setup Google OAuth jika Anda ingin menambahkan fitur login dengan Google.

## Langkah 1: Buat Google Cloud Project

1. Buka https://console.cloud.google.com/
2. Klik **"Create a new project"** atau pilih project yang ada
3. Nama project: `Perpustakaan Pakukerto`
4. Klik **Create**

## Langkah 2: Enable Google+ API

1. Di dashboard Cloud Console, cari **"Google+ API"**
2. Klik **Enable** untuk mengaktifkan API

## Langkah 3: Create OAuth 2.0 Credentials

1. Pergi ke **Credentials** di sidebar kiri
2. Klik **Create Credentials** → **OAuth 2.0 Client ID**
3. Pilih **Web application**
4. Di bagian **Authorized redirect URIs**, tambahkan:
   - `http://localhost:8000/auth/google/callback` (untuk development)
   - `https://yourdomain.com/auth/google/callback` (untuk production)
5. Klik **Create**

## Langkah 4: Copy Credentials ke `.env`

Setelah membuat credentials, Anda akan mendapat:
- **Client ID**
- **Client Secret**

Tambahkan ke file `.env`:

```env
GOOGLE_CLIENT_ID=your-client-id-here
GOOGLE_CLIENT_SECRET=your-client-secret-here
GOOGLE_REDIRECT=http://localhost:8000/auth/google/callback
```

## Langkah 5: Aktifkan Google Login di UI

Edit file `resources/views/auth/login.blade.php` dan uncomment baris berikut di dalam form:

```blade
<div class="space-y-4">
    <a href="{{ route('google.redirect') }}" class="inline-flex w-full items-center justify-center gap-3 rounded-2xl border border-slate-300 bg-slate-50 px-5 py-3 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-100">
        <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="h-5 w-5" />
        Masuk dengan Google
    </a>
    <div class="flex items-center gap-3 text-sm text-slate-500">
        <span class="h-px flex-1 bg-slate-300"></span>
        <span>atau</span>
        <span class="h-px flex-1 bg-slate-300"></span>
    </div>
</div>
```

## Langkah 6: Test Google OAuth

1. Restart Laravel server: `php artisan serve`
2. Klik tombol **"Masuk dengan Google"** di halaman login
3. Anda akan diarahkan ke Google untuk login
4. Setelah sukses, Anda akan di-redirect ke dashboard perpustakaan

## Troubleshooting

### Error: `invalid_request` atau `Missing required parameter: client_id`

- Pastikan `GOOGLE_CLIENT_ID` dan `GOOGLE_CLIENT_SECRET` sudah diisi di `.env`
- Restart Laravel server setelah mengubah `.env`

### Error: `Redirect URI mismatch`

- Pastikan redirect URI di Google Cloud Console sama dengan yang di `.env`
- Untuk development, gunakan `http://localhost:8000/auth/google/callback`

### User tidak berhasil create/login

- Periksa log di `storage/logs/laravel.log`
- Pastikan email user belum terdaftar di sistem

## References

- [Laravel Socialite Documentation](https://laravel.com/docs/socialite)
- [Google OAuth 2.0 Setup](https://developers.google.com/identity/protocols/oauth2)
