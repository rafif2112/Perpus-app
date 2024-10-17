<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@tes',
            'email_verified_at' => now(),
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Siswa',
            'email' => 'siswa@tes',
            'email_verified_at' => now(),
            'password' => bcrypt('siswa'),
            'role' => 'user',
        ]);

        Book::create([
            'judul' => 'Buku A',
            'penulis' => 'Penulis A',
            'kategori' => 'Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku A',
        ]);

        Book::create([
            'judul' => 'Buku B',
            'penulis' => 'Penulis B',
            'kategori' => 'Non-Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku B',
        ]);

        Book::create([
            'judul' => 'Buku C',
            'penulis' => 'Penulis C',
            'kategori' => 'Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku C',
        ]);

        Book::create([
            'judul' => 'Buku D',
            'penulis' => 'Penulis D',
            'kategori' => 'Non-Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku D',
        ]);

        Book::create([
            'judul' => 'Buku E',
            'penulis' => 'Penulis E',
            'kategori' => 'Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku E',
        ]);
    }
}
