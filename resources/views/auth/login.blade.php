@extends('layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="mx-auto max-w-lg space-y-8 px-4 py-16 sm:px-6 lg:px-8">
    <div class="rounded-[2rem] border border-slate-200 bg-white/95 p-10 shadow-2xl shadow-slate-200/10 backdrop-blur-xl">
        <div class="space-y-8">
            <div class="space-y-3 text-center">
                <span class="text-xs uppercase tracking-[0.35em] text-cyan-500">Perpustakaan Pakukerto</span>
                <h1 class="text-3xl font-semibold tracking-tight text-slate-900">Masuk ke akun Anda</h1>
                <p class="text-slate-600">Akses dashboard perpustakaan dan mulai meminjam buku.</p>
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
                <label class="block text-sm text-slate-700">
                    <span class="mb-2 block font-medium">Username atau Email</span>
                    <input type="text" name="username" value="{{ old('username') }}" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20" placeholder="Masukkan username atau email" required>
                </label>
                <label class="block text-sm text-slate-700">
                    <span class="mb-2 block font-medium">Password</span>
                    <input type="password" name="password" class="w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/20" placeholder="Masukkan password Anda" required>
                </label>
                <button type="submit" class="w-full rounded-2xl bg-cyan-500 px-6 py-3 font-semibold text-white transition hover:bg-cyan-600">Masuk Sekarang</button>
            </form>

            <div class="border-t border-slate-200 pt-6">
                <p class="text-center text-sm text-slate-600">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-cyan-600 hover:text-cyan-700">Daftar di sini</a></p>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4 text-center text-sm text-slate-600">
                <p class="font-medium text-slate-700">Demo Account:</p>
                <p class="mt-1 font-mono text-xs">admin@pakukerto.local / admin1234</p>
            </div>
        </div>
    </div>
</div>
@endsection
