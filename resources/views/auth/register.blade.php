@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="rounded-[2rem] border border-white/10 bg-slate-900/80 p-8 shadow-2xl shadow-slate-950/40 sm:p-12">
    <div class="space-y-4 text-center">
        <p class="text-sm uppercase tracking-[0.35em] text-cyan-300/80">Gabung dengan Pakukerto</p>
        <h1 class="text-4xl font-semibold text-white">Buat akun baru</h1>
        <p class="max-w-2xl mx-auto text-slate-400">Daftar untuk meminjam buku dan menikmati pengalaman pengelolaan perpustakaan yang responsif.</p>
    </div>

    <form action="{{ route('register.post') }}" method="POST" class="mt-10 space-y-6">
        @csrf
        <div class="grid gap-4 sm:grid-cols-2">
            <label class="block space-y-2 text-sm text-slate-200">
                <span>Nama Lengkap</span>
                <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
            </label>
            <label class="block space-y-2 text-sm text-slate-200">
                <span>Username</span>
                <input type="text" name="username" value="{{ old('username') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
            </label>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <label class="block space-y-2 text-sm text-slate-200">
                <span>Email</span>
                <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
            </label>
            <label class="block space-y-2 text-sm text-slate-200">
                <span>Role</span>
                <select name="role" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </label>
        </div>
        <div class="grid gap-4 sm:grid-cols-2">
            <label class="block space-y-2 text-sm text-slate-200">
                <span>Password</span>
                <input type="password" name="password" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
            </label>
            <label class="block space-y-2 text-sm text-slate-200">
                <span>Konfirmasi Password</span>
                <input type="password" name="password_confirmation" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
            </label>
        </div>
        <button type="submit" class="w-full rounded-3xl bg-cyan-500 px-6 py-3 font-semibold text-slate-950 transition hover:bg-cyan-400">Daftar Sekarang</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="text-cyan-300 hover:text-cyan-200">Masuk di sini</a></p>
</div>
@endsection
