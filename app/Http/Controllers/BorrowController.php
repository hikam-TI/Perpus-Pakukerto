<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function borrow(Book $book)
    {
        $user = auth()->user();

        if ($user->role !== 'user') {
            return back()->with('error', 'Hanya user yang dapat meminjam buku.');
        }

        if ($book->copies < 1) {
            return back()->with('error', 'Maaf, stok buku tidak tersedia.');
        }

        $existing = Borrow::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah meminjam buku ini dan belum mengembalikannya.');
        }

        Borrow::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrowed_at' => now(),
            'status' => 'borrowed',
        ]);

        $book->decrement('copies');

        return back()->with('success', 'Buku berhasil dipinjam.');
    }

    public function return(Book $book)
    {
        $user = auth()->user();

        $borrow = Borrow::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->whereNull('returned_at')
            ->first();

        if (! $borrow) {
            return back()->with('error', 'Tidak ditemukan peminjaman aktif untuk buku ini.');
        }

        $borrow->update([
            'returned_at' => now(),
            'status' => 'returned',
        ]);

        $book->increment('copies');

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }
}
