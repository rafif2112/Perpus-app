<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function pinjam($book_id) {
        $book = Book::find($book_id);

        // Cek apakah buku sudah dipinjam
        if ($book->isBorrowed()) {
            return back()->withErrors(['message' => 'Buku ini sedang dipinjam oleh pengguna lain']);
        }

        Loan::create([
            'user_id' => Auth::id(),
            'book_id' => $book->id,
            'tanggal_pinjam' => Carbon::now(),
            'tanggal_jatuh_tempo' => Carbon::now()->addWeeks(1),
            'status_pengembalian' => 'dipinjam',
        ]);

        return back()->with('success', 'Buku berhasil dipinjam');
    }

    public function kembalikan($loan_id) {
        $loan = Loan::find($loan_id);

        if ($loan && $loan->user_id == Auth::id()) {
            $loan->update(['status_pengembalian' => 'dikembalikan']);
            return back()->with('success', 'Buku berhasil dikembalikan');
        } else {
            return back()->withErrors(['message' => 'Data peminjaman tidak ditemukan atau Anda tidak memiliki izin untuk mengembalikan buku ini']);
        }
    }

    public function riwayat() {
        if (Auth::user()->role === 'admin') {
            $loans = Loan::all();
        } else {
            $loans = Loan::where('user_id', Auth::id())->get();
        }

        return view('admin.view.peminjaman.index', compact('loans'));
    }

    public function laporan() {
        $loans = Loan::all();
        $bukuDipinjam = Loan::where('status_pengembalian', 'dipinjam')->count();
        $bukuDikembalikan = Loan::where('status_pengembalian', 'dikembalikan')->count();

        return view('admin.reports.index', compact('loans', 'bukuDipinjam', 'bukuDikembalikan'));
    }

    public function deleteHistoryPengembalian() {
        $userId = Auth::id();
        $loans = Loan::where('user_id', $userId)
            ->where('status_pengembalian', 'dikembalikan')
            ->delete();
        return back()->with('success', 'Histori pengembalian berhasil dihapus');
    }
}