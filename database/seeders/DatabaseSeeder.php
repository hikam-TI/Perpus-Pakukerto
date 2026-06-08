<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@pakukerto.local'],
            [
                'name' => 'Admin Pakukerto',
                'username' => 'admin',
                'password' => Hash::make('admin1234'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'user@pakukerto.local'],
            [
                'name' => 'Regular User',
                'username' => 'user',
                'password' => Hash::make('user1234'),
                'role' => 'user',
            ]
        );

        $books = [
            [
                'title' => 'Belajar Laravel 13',
                'author' => 'Asep Kurniawan',
                'category' => 'Pemrograman',
                'copies' => 5,
                'description' => 'Panduan lengkap membangun aplikasi web modern menggunakan Laravel 13.',
            ],
            [
                'title' => 'Mengelola Perpustakaan Digital',
                'author' => 'Dina Rahma',
                'category' => 'Manajemen',
                'copies' => 3,
                'description' => 'Strategi praktis untuk mengelola koleksi buku dan peminjaman digital.',
            ],
            [
                'title' => 'Desain UI & UX Untuk Sistem Informasi',
                'author' => 'Rian Pratama',
                'category' => 'Desain',
                'copies' => 4,
                'description' => 'Prinsip desain antarmuka dan pengalaman pengguna untuk aplikasi web.',
            ],
        ];

        foreach ($books as $book) {
            Book::firstOrCreate(
                ['title' => $book['title'], 'author' => $book['author']],
                $book
            );
        }
    }
}
