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

        Book::create([
            'judul' => 'Buku F',
            'penulis' => 'Penulis F',
            'kategori' => 'Non-Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku F',
        ]);

        Book::create([
            'judul' => 'Buku G',
            'penulis' => 'Penulis G',
            'kategori' => 'Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku G',
        ]);

        Book::create([
            'judul' => 'Buku H',
            'penulis' => 'Penulis H',
            'kategori' => 'Non-Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku H',
        ]);

        Book::create([
            'judul' => 'Buku I',
            'penulis' => 'Penulis I',
            'kategori' => 'Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku I',
        ]);

        Book::create([
            'judul' => 'Buku J',
            'penulis' => 'Penulis J',
            'kategori' => 'Non-Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku J',
        ]);

        Book::create([
            'judul' => 'Buku K',
            'penulis' => 'Penulis K',
            'kategori' => 'Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku K',
        ]);

        Book::create([
            'judul' => 'Buku L',
            'penulis' => 'Penulis L',
            'kategori' => 'Non-Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku L',
        ]);

        Book::create([
            'judul' => 'Buku M',
            'penulis' => 'Penulis M',
            'kategori' => 'Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku M',
        ]);

        Book::create([
            'judul' => 'Buku N',
            'penulis' => 'Penulis N',
            'kategori' => 'Non-Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku N',
        ]);

        Book::create([
            'judul' => 'Buku O',
            'penulis' => 'Penulis O',
            'kategori' => 'Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku O',
        ]);

        Book::create([
            'judul' => 'Buku P',
            'penulis' => 'Penulis P',
            'kategori' => 'Non-Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku P',
        ]);

        Book::create([
            'judul' => 'Buku Q',
            'penulis' => 'Penulis Q',
            'kategori' => 'Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku Q',
        ]);

        Book::create([
            'judul' => 'Buku R',
            'penulis' => 'Penulis R',
            'kategori' => 'Non-Fiksi',
            'gambar' => 'image.jpg',
            'deskripsi' => 'Deskripsi Buku R',
        ]);
    }
}
