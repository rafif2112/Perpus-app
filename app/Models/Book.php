<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'penulis', 'kategori', 'gambar', 'deskripsi'];

    // Relasi dengan model Loan
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    // Metode untuk memeriksa apakah buku sedang dipinjam
    public function isBorrowed()
    {
        return $this->loans()->where('status_pengembalian', 'dipinjam')->exists();
    }
}