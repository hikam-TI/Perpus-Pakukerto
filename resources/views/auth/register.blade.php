@extends('layouts.app')

@section('title', 'Daftar')

@section('content')
<div class="mx-auto max-w-6xl space-y-8 px-4 py-8 sm:px-6 lg:px-8">
    <div class="rounded-[2rem] border border-slate-200 bg-white/95 p-10 shadow-2xl shadow-slate-200/10 backdrop-blur-xl">
        <div class="grid gap-8 lg:grid-cols-[1.05fr_0.95fr]">
            <div class="space-y-6">
                <div class="space-y-3">
                    <span class="text-xs uppercase tracking-[0.35em] text-cyan-500">Gabung dengan Pakukerto</span>
                    <h1 class="text-4xl font-semibold tracking-tight text-slate-900">Buat akun baru dengan mudah</h1>
                    <p class="max-w-xl text-slate-600">Daftar menggunakan email Gmail Anda untuk pengalaman meminjam buku yang lebih cepat dan rapi.</p>
                </div>
                <div class="grid gap-4 rounded-[2rem] bg-slate-50 p-5 text-slate-700">
                    <div class="flex items-start gap-3">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700">1</span>
                        <div>
                            <p class="font-semibold">Form sederhana</p>
                            <p class="text-sm text-slate-500">Cukup nama lengkap, Gmail, dan password untuk mulai menggunakan.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="inline-flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">2</span>
                        <div>
                            <p class="font-semibold">Tampilan elegan</p>
                            <p class="text-sm text-slate-500">Desain rapi untuk pengalaman pendaftaran yang modern.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-[2rem] bg-slate-950/90 p-8 text-slate-100 shadow-2xl shadow-slate-950/20">
                <div class="space-y-5">
                    <div class="text-center">
                        <p class="text-sm uppercase tracking-[0.35em] text-cyan-300/80">Daftar akun baru</p>
                        <h2 class="mt-2 text-3xl font-semibold text-white">Mulai petualangan baca Anda</h2>
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

                    <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                        @csrf
                        <label class="block text-sm text-slate-200">
                            <span class="mb-2 block">Nama Lengkap</span>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
                        </label>
                        <label class="block text-sm text-slate-200">
                            <span class="mb-2 block">Gmail</span>
                            <input type="email" name="email" value="{{ old('email') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" placeholder="contoh@gmail.com" required>
                        </label>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <label class="block text-sm text-slate-200">
                                <span class="mb-2 block">Password</span>
                                <input type="password" name="password" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
                            </label>
                            <label class="block text-sm text-slate-200">
                                <span class="mb-2 block">Konfirmasi Password</span>
                                <input type="password" name="password_confirmation" class="w-full rounded-3xl border border-slate-700 bg-slate-900 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
                            </label>
                        </div>
                        <button type="submit" class="w-full rounded-3xl bg-cyan-500 px-6 py-3 font-semibold text-slate-950 transition hover:bg-cyan-400">Daftar Sekarang</button>
                    </form>

                    <p class="text-center text-sm text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-cyan-300 hover:text-cyan-200">Masuk di sini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
