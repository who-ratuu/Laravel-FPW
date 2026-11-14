<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SalesDataSheet implements FromCollection, WithHeadings, WithMapping
{
    protected $start;
    protected $end;
    protected $cashier;

    public function __construct($start, $end, $cashier = null)
    {
        $this->start = $start;
        $this->end = $end;
        $this->cashier = $cashier;
    }

    public function collection(): Collection
    {
        $query = Transaction::with('user')
            ->whereBetween('created_at', [$this->start, $this->end]);

        if ($this->cashier) {
            $query->where('user_id', $this->cashier);
        }

        return $query->latest()->get();
    }

    public function headings(): array
    {
        return [
            'No. Invoice',
            'Tanggal',
            'Kasir',
            'Total'
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->invoice_number,
            $transaction->created_at->format('d-m-Y H:i'),
            $transaction->user->name ?? '-',
            $transaction->total
        ];
    }
}
