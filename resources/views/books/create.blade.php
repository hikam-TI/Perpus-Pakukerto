@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="max-w-3xl rounded-[2rem] border border-white/10 bg-slate-900/80 p-8 shadow-2xl shadow-slate-950/30">
    <div class="space-y-4">
        <p class="text-sm uppercase tracking-[0.35em] text-cyan-300/80">Tambah Koleksi</p>
        <h1 class="text-3xl font-semibold text-white">Tambahkan buku baru ke perpustakaan</h1>
        <p class="text-slate-400">Formulir cepat untuk menambahkan judul, penulis, kategori, dan stok buku.</p>
    </div>

    <form action="{{ route('books.store') }}" method="POST" class="mt-8 space-y-6">
        @csrf
        <label class="block space-y-2 text-sm text-slate-200">
            <span>Judul Buku</span>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
        </label>
        <label class="block space-y-2 text-sm text-slate-200">
            <span>Penulis</span>
            <input type="text" name="author" value="{{ old('author') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
        </label>
        <label class="block space-y-2 text-sm text-slate-200">
            <span>Kategori</span>
            <input type="text" name="category" value="{{ old('category') }}" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
        </label>
        <label class="block space-y-2 text-sm text-slate-200">
            <span>Stok</span>
            <input type="number" name="copies" value="{{ old('copies', 1) }}" min="1" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80" required>
        </label>
        <label class="block space-y-2 text-sm text-slate-200">
            <span>Deskripsi</span>
            <textarea name="description" rows="4" class="w-full rounded-3xl border border-slate-700 bg-slate-950/80 px-4 py-3 text-slate-100 outline-none transition focus:border-cyan-400/80">{{ old('description') }}</textarea>
        </label>
        <button type="submit" class="w-full rounded-3xl bg-cyan-500 px-6 py-3 font-semibold text-slate-950 transition hover:bg-cyan-400">Simpan Buku</button>
    </form>
</div>
@endsection
