<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LoanExport implements FromCollection, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Loan::with('user', 'book')->get();
    }

    public function map($loan): array
    {
        return [
            $loan->id,
            $loan->user->name,
            $loan->book->judul,
            $loan->tanggal_pinjam,
            $loan->tanggal_jatuh_tempo,
            $loan->status_pengembalian,
        ];
    }
}
