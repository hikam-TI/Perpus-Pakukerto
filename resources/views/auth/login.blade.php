@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="rounded-[2rem] border border-white/10 bg-slate-900/80 p-8 shadow-2xl shadow-slate-950/40 sm:p-12">
    <div class="space-y-4 text-center">
        <p class="text-sm uppercase tracking-[0.35em] text-cyan-300/80">Perpustakaan Pakukerto</p>
        <h1 class="text-4xl font-semibold text-white">Selamat datang kembali</h1>
        <p class="max-w-2xl mx-auto text-slate-400">Masuk dengan username/email dan password untuk mengelola buku atau meminjam koleksi terbaik kami.</p>
    </div>

    <form action="{{ route('login.post') }}" method="POST" class="mt-10 space-y-6">
        @csrf
        <label class="block space-y-2 text-sm text-slate-200">
            <span>Username atau Email</span>
            <input type="text" name="username" value="{{ old('username') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
        </label>
        <label class="block space-y-2 text-sm text-slate-200">
            <span>Password</span>
            <input type="password" name="password" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
        </label>
        <button type="submit" class="w-full rounded-3xl bg-cyan-500 px-6 py-3 font-semibold text-slate-950 transition hover:bg-cyan-400">Masuk Sekarang</button>
    </form>

    <p class="mt-6 text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="text-cyan-300 hover:text-cyan-200">Daftar di sini</a></p>
</div>
@endsection
