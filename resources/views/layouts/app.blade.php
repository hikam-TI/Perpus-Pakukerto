<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pakukerto Library | @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900">
    <header class="relative bg-white/70 shadow-sm backdrop-blur-xl">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(circle_at_top_left,_rgba(56,189,248,0.16),_transparent_24%),radial-gradient(circle_at_bottom_right,_rgba(168,85,247,0.12),_transparent_22%),linear-gradient(180deg,_#ffffff,_#eef2ff)]"></div>
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-6 sm:px-8">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-slate-900">
                <div class="h-10 w-10 rounded-full bg-cyan-500/15 border border-cyan-200/30 flex items-center justify-center text-lg font-bold text-cyan-700">PK</div>
                <span class="text-2xl font-semibold tracking-wide">Pakukerto</span>
            </a>
            <button id="navToggle" class="block rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-100 sm:hidden">Menu</button>
            <nav id="navMenu" class="hidden items-center gap-4 text-sm sm:flex">
                @auth
                    <a href="{{ route('dashboard') }}" class="transition hover:text-cyan-200">Dashboard</a>
                    <a href="{{ route('dashboard') }}#katalog" class="transition hover:text-cyan-200">Daftar Buku</a>
                    <a href="{{ route('dashboard') }}#peminjaman" class="transition hover:text-cyan-200">Peminjaman</a>
                    <a href="{{ route('dashboard') }}#pengembalian" class="transition hover:text-cyan-200">Pengembalian</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('books.create') }}" class="transition hover:text-cyan-200">Tambah Buku</a>
                    @endif
                    <button id="searchToggle" class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-700 transition hover:bg-slate-200" aria-label="Cari Buku">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                            <path fill-rule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5Zm-8.25 6.75a8.25 8.25 0 1 1 14.03 5.78l4.47 4.47a.75.75 0 0 1-1.06 1.06l-4.47-4.47A8.25 8.25 0 0 1 2.25 10.5Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="transition hover:text-cyan-200">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="transition hover:text-cyan-200">Masuk</a>
                    <a href="{{ route('register') }}" class="transition hover:text-cyan-200">Daftar</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="mx-auto max-w-7xl px-6 py-10 sm:px-8">
        @yield('content')
    </main>

    <div id="searchModal" class="fixed inset-0 z-50 hidden items-center justify-center px-4 py-6 sm:px-6">
        <div class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>
        <div class="relative w-full max-w-3xl rounded-[2rem] border border-slate-200 bg-white/95 p-8 shadow-2xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-slate-500">Cari Buku</p>
                    <h2 class="mt-2 text-3xl font-semibold text-slate-900">Temukan buku yang Anda butuhkan</h2>
                    <p class="mt-2 text-slate-600">Cari berdasarkan judul, penulis, kategori, atau kata kunci lainnya.</p>
                </div>
                <button id="searchModalClose" class="inline-flex h-11 w-11 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200" aria-label="Tutup pencarian">
                    ✕
                </button>
            </div>

            <form action="{{ route('dashboard') }}" method="GET" class="mt-8 grid gap-4 sm:grid-cols-[1fr_auto]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul, penulis, atau kategori" class="h-16 w-full rounded-[1.75rem] border border-slate-300 bg-slate-50 px-6 text-lg text-slate-900 outline-none transition focus:border-cyan-400/80" autofocus />
                <button type="submit" class="btn-primary h-16 rounded-[1.75rem] text-base font-semibold">Cari Buku</button>
            </form>
        </div>
    </div>

    @include('components.modal')
    @include('components.toast')

    @if(session('success'))
        <script>window.__PAKUKERTO_TOAST = {type: 'success', message: @json(session('success'))};</script>
    @endif
    @if(session('error'))
        <script>window.__PAKUKERTO_TOAST = {type: 'error', message: @json(session('error'))};</script>
    @endif
</body>
</html>
