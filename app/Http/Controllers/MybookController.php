<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Mybook;
use Illuminate\Http\Request;
use App\Models\Loan;
use Illuminate\Support\Facades\Auth;

class MybookController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $loans = Loan::where('user_id', $userId)->get(); 
        $bookIds = $loans->pluck('book_id'); // Mengambil ID buku dari data peminjaman
        $pinjamBuku = Book::whereIn('id', $bookIds)->get(); // Mengambil data buku berdasarkan ID buku
        return view('user.view.buku-saya', compact('loans', 'pinjamBuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Mybook $mybook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mybook $mybook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mybook $mybook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mybook $mybook)
    {
        //
    }
}
