@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="mx-auto max-w-6xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">
    <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr]">
        <div class="rounded-[2rem] border border-slate-200 bg-white/95 p-10 shadow-2xl shadow-slate-200/10 backdrop-blur-xl">
            <div class="space-y-6">
                <div class="space-y-3">
                    <span class="text-xs uppercase tracking-[0.35em] text-cyan-500">Perpustakaan Pakukerto</span>
                    <h1 class="text-4xl font-semibold tracking-tight text-slate-900">Masuk dengan Google atau akun email Anda</h1>
                    <p class="max-w-xl text-slate-600">Akses semua fitur perpustakaan, pinjam buku, dan kelola koleksi dengan tampilan yang bersih dan modern.</p>
                </div>

                <div class="space-y-4">
                    <a href="{{ route('google.redirect') }}" class="inline-flex w-full items-center justify-center gap-3 rounded-3xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-50">
                        <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" class="h-5 w-5" />
                        Masuk dengan Google
                    </a>
                    <div class="flex items-center gap-3 text-sm text-slate-500">
                        <span class="h-px flex-1 bg-slate-200"></span>
                        <span>atau masuk menggunakan email</span>
                        <span class="h-px flex-1 bg-slate-200"></span>
                    </div>
                </div>

                <div class="grid gap-3 rounded-[2rem] bg-slate-50 p-5 text-slate-700">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700">1</span>
                        <div>
                            <p class="font-semibold">Akses cepat</p>
                            <p class="text-sm text-slate-500">Masuk hanya dengan satu klik lewat Google.</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">2</span>
                        <div>
                            <p class="font-semibold">Keamanan</p>
                            <p class="text-sm text-slate-500">Data login aman, tanpa perlu mengingat banyak password.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-slate-950/90 p-10 text-slate-100 shadow-2xl shadow-slate-950/20 backdrop-blur-xl">
            <div class="space-y-6">
                <div class="space-y-3 text-center">
                    <p class="text-sm uppercase tracking-[0.35em] text-cyan-300/80">Selamat datang kembali</p>
                    <h2 class="text-3xl font-semibold text-white">Masuk ke akun Anda</h2>
                    <p class="text-slate-400">Gunakan username atau email yang terdaftar di sistem.</p>
                </div>

                @if($errors->any())
                    <div class="rounded-3xl border border-rose-200 bg-rose-50 p-4 text-rose-700">
                        <ul class="space-y-1 text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <label class="block text-sm text-slate-200">
                        <span class="mb-2 block">Username atau Email</span>
                        <input type="text" name="username" value="{{ old('username') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
                    </label>
                    <label class="block text-sm text-slate-200">
                        <span class="mb-2 block">Password</span>
                        <input type="password" name="password" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
                    </label>
                    <button type="submit" class="w-full rounded-3xl bg-cyan-500 px-6 py-3 font-semibold text-slate-950 transition hover:bg-cyan-400">Masuk Sekarang</button>
                </form>

                <p class="mt-4 text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-cyan-300 hover:text-cyan-200">Daftar sekarang</a></p>
            </div>
        </div>
    </div>
</div>
@endsection
