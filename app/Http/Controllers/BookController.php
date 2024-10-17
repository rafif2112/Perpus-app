<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function adminDashboard() {
        $totalBooks = Book::count();
        $totalUsers = User::where('role', 'user')->count();
        return view('admin.view.dashboard', compact('totalBooks', 'totalUsers'));
    }

    public function index() {
        $books = Book::all();
        return view('user.view.daftar-buku', compact('books'));
    }

    public function adminIndex() {
        $books = Book::paginate(10);
        return view('admin.view.daftar-buku.index', compact('books'));
    }

    public function create() {
        return view('admin.view.daftar-buku.create');
    }

    public function show($id) {
        $book = Book::find($id);
        $loanId = $book->loan_id;
        return view('user.view.detail-buku', compact('book', 'loanId'));
    }

    public function store(Request $request) {
        $request->validate ([
            'judul' => 'required',
            'penulis' => 'required',
            'kategori' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|max:1000',
        ], [
            'judul.required' => 'Judul buku wajib diisi',
            'penulis.required' => 'Penulis buku wajib diisi',
            'kategori.required' => 'Kategori buku wajib diisi',
            'gambar.required' => 'Gambar buku wajib diisi',
            'gambar.image' => 'Gambar harus berupa file gambar',
            'gambar.mimes' => 'Gambar harus berformat jpeg, png, jpg',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
            'deskripsi.required' => 'Deskripsi buku wajib diisi',
            'deskripsi.max' => 'Deskripsi buku maksimal 1000 karakter',
        ]
        );

        $gambar = $request->file('gambar');
        $nama_gambar = time()."_".$gambar->getClientOriginalName();
        $gambar->move(public_path('assets/images/buku'), $nama_gambar);

        Book::create([
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'kategori' => $request->kategori,
            'gambar' => $nama_gambar,
            'deskripsi' => $request->deskripsi,
        ]);
        
        return redirect()->route('admin.daftar-buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit($id) {
        $book = Book::find($id);
        return view('admin.view.daftar-buku.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|max:1000',
        ], [
            'judul.required' => 'Judul buku wajib diisi',
            'penulis.required' => 'Penulis buku wajib diisi',
            'kategori.required' => 'Kategori buku wajib diisi',
            'gambar.required' => 'Gambar buku wajib diisi',
            'gambar.image' => 'Gambar harus berupa file gambar',
            'gambar.mimes' => 'Gambar harus berformat jpeg, png, jpg',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
            'deskripsi.required' => 'Deskripsi buku wajib diisi',
            'deskripsi.max' => 'Deskripsi buku maksimal 1000 karakter',
        ]);

        $book = Book::find($id);

        if ($request->hasFile('gambar')) {
            $imageName = time().'.'.$request->gambar->extension();  
            $request->gambar->move(public_path('assets/images/buku'), $imageName);
            $book->gambar = $imageName;
        }

        $book->judul = $request->judul;
        $book->penulis = $request->penulis;
        $book->kategori = $request->kategori;
        $book->deskripsi = $request->deskripsi;
        $book->save();

        return redirect()->route('admin.daftar-buku.index')->with('success', 'Book updated successfully');
    }

    public function destroy($id) {
        $book = Book::find($id);
        if ($book) {
            $gambar_path = public_path('assets/images/buku/' . $book->gambar);
            if (file_exists($gambar_path)) {
            unlink($gambar_path);
            }
            $book->delete();
        }
        return redirect()->route('admin.daftar-buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
