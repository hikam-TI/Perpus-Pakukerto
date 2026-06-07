@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <section class="space-y-6">
        <div class="rounded-[2rem] border border-slate-200 bg-white/85 p-8 shadow-card hero-background">
            <div class="relative z-10 grid gap-6 lg:grid-cols-[1.5fr_0.9fr]">
                <div class="space-y-6">
                    <p class="section-title text-slate-500">Selamat datang, {{ auth()->user()->name }}</p>
                    <h1 class="text-4xl font-semibold leading-tight tracking-tight text-slate-900 sm:text-5xl">Perpustakaan Pakukerto</h1>
                    <p class="max-w-2xl text-slate-600 sm:text-lg">Kelola koleksi buku dengan antarmuka yang bersih, tampilan terstruktur, dan nuansa ringan yang profesional.</p>

                    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        <article class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Buku Tersedia</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $availableBooks }}</p>
                        </article>
                        <article class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Sedang Dipinjam</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $activeBorrowed }}</p>
                        </article>
                        <article class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                            <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Stok Kosong</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $outOfStock }}</p>
                        </article>
                    </div>
                </div>
                <div class="rounded-[2rem] border border-slate-200 bg-slate-50 p-6">
                    <p class="section-title text-slate-500">Ringkasan Status</p>
                    <div class="mt-6 space-y-4">
                        <div class="rounded-3xl border border-slate-200 bg-white p-5">
                            <p class="text-sm text-slate-500">Role saat ini</p>
                            <p class="mt-2 text-xl font-semibold text-slate-900">{{ auth()->user()->role }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-white p-5">
                            <p class="text-sm text-slate-500">Total Koleksi</p>
                            <p class="mt-2 text-xl font-semibold text-slate-900">{{ $totalBooks }}</p>
                        </div>
                        <div class="rounded-3xl border border-slate-200 bg-white p-5">
                            <p class="text-sm text-slate-500">Kategori Tersedia</p>
                            <p class="mt-2 text-xl font-semibold text-slate-900">{{ count($categories) }} kategori</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="katalog" class="rounded-[2rem] border border-slate-200 bg-white/90 p-6 shadow-2xl shadow-slate-200/25">
            <div class="mb-6 flex flex-col gap-4 xl:flex-row xl:items-center xl:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-slate-500">Katalog Buku</p>
                    <h2 class="mt-2 text-2xl font-semibold text-slate-900">Cari & temukan koleksi yang tepat</h2>
                </div>
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('books.create') }}" class="inline-flex items-center rounded-3xl bg-cyan-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-cyan-500">Tambah Buku Baru</a>
                @endif
            </div>

            <div class="mt-5 flex flex-wrap gap-3">
                <a href="{{ route('dashboard') }}" class="status-pill status-pill-available {{ empty($category) ? 'border-cyan-500/80 text-slate-900' : 'text-slate-600' }}">Semua Kategori</a>
                @foreach($categories as $cat)
                    <a href="{{ route('dashboard', ['category' => $cat]) }}" class="status-pill {{ $category === $cat ? 'status-pill-borrowed border-cyan-500/80 text-slate-900' : 'text-slate-600' }}">{{ $cat }}</a>
                @endforeach
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-white/90 p-6 shadow-2xl shadow-slate-200/25">
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-slate-500">Hasil Pencarian</p>
                    <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $books->count() }} koleksi ditemukan</h3>
                </div>
                @if($search || $category)
                    <a href="{{ route('dashboard') }}" class="rounded-3xl bg-slate-100 px-4 py-2 text-sm text-slate-700 transition hover:bg-slate-200">Hapus filter</a>
                @endif
            </div>

            <div class="space-y-4">
                @forelse($books as $book)
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5 sm:p-6">
                        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm uppercase tracking-[0.35em] text-slate-500">{{ $book->category }}</p>
                                <h3 class="mt-2 text-xl font-semibold text-slate-900">{{ $book->title }}</h3>
                                <p class="mt-2 text-sm text-slate-600">Penulis: {{ $book->author }}</p>
                            </div>
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="rounded-full bg-slate-100 px-4 py-2 text-sm text-slate-700">Stok: {{ $book->copies }}</span>
                                <span class="rounded-full bg-emerald-100 px-4 py-2 text-sm text-emerald-700">Dipinjam: {{ $book->borrows_count }}</span>
                            </div>
                        </div>
                        <p class="mt-4 text-slate-600">{{ $book->description ?? 'Deskripsi belum tersedia.' }}</p>
                        <div class="mt-5 flex flex-wrap items-center gap-3">
                            @if(auth()->user()->isAdmin())
                                <span class="rounded-full bg-cyan-100 px-4 py-2 text-sm text-cyan-700">Admin hanya dapat tambah buku</span>
                            @else
                                @if(in_array($book->id, $borrowedBookIds))
                                    <form action="{{ route('books.return', $book) }}" method="POST" class="inline confirm-action" data-action-title="Kembalikan Buku" data-action-message="Anda akan mengembalikan '{{ $book->title }}'. Lanjutkan?">
                                        @csrf
                                        <button type="submit" class="rounded-3xl bg-emerald-500 px-5 py-2 text-sm font-semibold text-white transition hover:bg-emerald-400">Kembalikan</button>
                                    </form>
                                @elseif($book->copies > 0)
                                    <form action="{{ route('books.borrow', $book) }}" method="POST" class="inline confirm-action" data-action-title="Pinjam Buku" data-action-message="Anda akan meminjam '{{ $book->title }}'. Pastikan Anda akan mengembalikannya sesuai aturan.">
                                        @csrf
                                        <button type="submit" class="rounded-3xl bg-cyan-600 px-5 py-2 text-sm font-semibold text-white transition hover:bg-cyan-500">Pinjam Buku</button>
                                    </form>
                                @else
                                    <span class="rounded-3xl bg-rose-100 px-5 py-2 text-sm text-rose-700">Stok habis</span>
                                @endif
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 text-center text-slate-500">Belum ada buku di perpustakaan. Admin dapat menambahkan buku baru.</div>
                @endforelse
            </div>
        </div>

        <div class="rounded-[2rem] border border-slate-200 bg-white/90 p-6 shadow-2xl shadow-slate-200/25">
            <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-sm uppercase tracking-[0.35em] text-slate-500">Aktivitas Terbaru</p>
                    <h3 class="mt-2 text-2xl font-semibold text-slate-900">Peminjaman dan Pengembalian Terbaru</h3>
                    <p class="mt-2 text-slate-600">Lihat ringkasan aktivitas anggota dan detail waktu pada daftar peminjaman dan pengembalian.</p>
                </div>
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-[0.9fr_1.1fr]">
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Peminjaman Aktif</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $currentBorrows->count() }}</p>
                    </div>
                    <div class="rounded-3xl bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.35em] text-slate-500">Pengembalian</p>
                        <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $totalReturns }}</p>
                    </div>
                </div>
            </div>
            <div class="grid gap-6 xl:grid-cols-[1.05fr_1.25fr]">
                <div id="peminjaman" class="rounded-[2rem] bg-white p-6 shadow-sm">
                    <p class="text-sm uppercase tracking-[0.35em] text-slate-500">Daftar Peminjaman</p>
                    <div class="mt-4 space-y-3 text-slate-700">
                        @if(auth()->user()->isAdmin())
                            @if($recentBorrows->isNotEmpty())
                                @foreach($recentBorrows as $borrow)
                                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                        <div class="flex items-center justify-between gap-3">
                                            <div>
                                                <p class="font-semibold">{{ $borrow->book->title }}</p>
                                                <p class="text-sm text-slate-500">Pemilik pinjam: {{ $borrow->user->name }}</p>
                                            </div>
                                            <span class="rounded-full bg-cyan-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-cyan-700">Aktif</span>
                                        </div>
                                        <p class="mt-3 text-sm text-slate-500">Dipinjam pada {{ $borrow->borrowed_at->format('d M Y, H:i') }}</p>
                                    </div>
                                @endforeach
                            @else
                                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-slate-500">Tidak ada peminjaman aktif saat ini.</div>
                            @endif
                        @else
                            @if($currentBorrows->isNotEmpty())
                                @foreach($currentBorrows as $borrow)
                                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                        <div class="flex items-center justify-between gap-3">
                                            <div>
                                                <p class="font-semibold">{{ $borrow->book->title }}</p>
                                                <p class="text-sm text-slate-500">Dipinjam oleh Anda</p>
                                            </div>
                                            <span class="rounded-full bg-cyan-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-cyan-700">Aktif</span>
                                        </div>
                                        <p class="mt-3 text-sm text-slate-500">Dipinjam pada {{ $borrow->borrowed_at->format('d M Y, H:i') }}</p>
                                    </div>
                                @endforeach
                            @else
                                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-slate-500">Tidak ada peminjaman aktif saat ini.</div>
                            @endif
                        @endif
                    </div>
                </div>

                <div id="pengembalian" class="rounded-[2rem] bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm uppercase tracking-[0.35em] text-slate-500">Daftar Pengembalian</p>
                            <p class="mt-2 text-sm text-slate-500">Riwayat terbaru dengan nama peminjam dan waktu.</p>
                        </div>
                        <div class="rounded-full bg-slate-100 px-4 py-2 text-xs uppercase tracking-[0.24em] text-slate-500">{{ $recentReturns->count() }} terbaru</div>
                    </div>
                    <div class="mt-4 space-y-3 text-slate-700">
                        @if($recentReturns->isNotEmpty())
                            @foreach($recentReturns as $return)
                                <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                                    <div class="flex items-center justify-between gap-3">
                                        <div>
                                            <p class="font-semibold">{{ $return->book->title }}</p>
                                            <p class="text-sm text-slate-500">Dikembalikan oleh {{ $return->user->name }}</p>
                                        </div>
                                        <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold uppercase tracking-[0.2em] text-emerald-700">Selesai</span>
                                    </div>
                                    <p class="mt-3 text-sm text-slate-500">Kembali pada {{ $return->returned_at->format('d M Y, H:i') }}</p>
                                </div>
                            @endforeach
                        @else
                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-slate-500">Belum ada pengembalian terbaru.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
