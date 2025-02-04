<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Book;
use App\Models\User;
use App\Models\Save;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LoanExport;

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
            $now = Carbon::now();
            $jatuhTempo = Carbon::parse($loan->tanggal_jatuh_tempo);

            if ($now->greaterThan($jatuhTempo)) {
                $denda = abs($now->diffInDays($jatuhTempo)) * 1000; // Contoh denda Rp 1000 per hari
                $formattedDenda = number_format($denda, 0, ',', '.');
                return back()->with('telat', 'Pengembalian buku terlambat. Anda dikenakan denda sebesar Rp ' . $formattedDenda);
            }

            $loan->update(['status_pengembalian' => 'dikembalikan']);
            return back()->with('success', 'Buku berhasil dikembalikan');
        } else {
            return back()->withErrors(['message' => 'Data peminjaman tidak ditemukan atau Anda tidak memiliki izin untuk mengembalikan buku ini']);
        }
    }

    public function bayarDenda($loan_id) {
        $loan = Loan::find($loan_id);

        if ($loan && $loan->user_id == Auth::id()) {
            $loan->update(['status_pengembalian' => 'dikembalikan']);
            return back()->with('success', 'Buku berhasil dikembalikan');
        } else {
            return back()->withErrors(['message' => 'Data peminjaman tidak ditemukan atau Anda tidak memiliki izin untuk membayar denda']);
        }
    }

    public function riwayat() {
        if (Auth::user()->role === 'admin') {
            $loans = Loan::all();
        } else {
            $loans = Loan::where('user_id', Auth::id())->get();
        }
        $bukuDipinjam = Loan::where('status_pengembalian', 'dipinjam')->count();
        $bukuDikembalikan = Loan::where('status_pengembalian', 'dikembalikan')->count();

        return view('admin.view.peminjaman.index', compact('loans', 'bukuDipinjam', 'bukuDikembalikan'));
    }

    public function deleteHistoryPengembalian() {
        $userId = Auth::id();
        $loans = Loan::where('user_id', $userId)
            ->where('status_pengembalian', 'dikembalikan')
            ->delete();
        return back()->with('success', 'Histori pengembalian berhasil dihapus');
    }

    public function printPdf($id) {
        $loan = Loan::with('user', 'book')->find($id);
        $pdf = Pdf::loadView('admin.view.peminjaman.print-pdf', compact('loan'));
        return $pdf->stream('bukti-peminjaman.pdf');
    }

    public function exportExcel() {
        return Excel::download(new LoanExport, 'riwayat-peminjaman.xlsx');
    }
}