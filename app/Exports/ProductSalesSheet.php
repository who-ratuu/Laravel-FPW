<?php

namespace App\Exports;

use App\Models\TransactionDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductSalesSheet implements FromCollection, WithHeadings
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
        return TransactionDetail::with('product')
            ->whereHas('transaction', function ($query) {
                $query->whereBetween('created_at', [
                    $this->start,
                    $this->end
                ]);

                if ($this->cashier) {
                    $query->where('user_id', $this->cashier);
                }
            })
            ->get()
            ->groupBy('product_id')
            ->map(function ($details) {
                return [
                    'nama_produk' => $details->first()->product->name ?? '-',
                    'total_terjual' => $details->sum('qty'),
                    'total_pendapatan' => $details->sum('subtotal'),
                ];
            })
            ->sortByDesc('total_terjual')
            ->values();
    }

    public function headings(): array
    {
        return [
            'Nama Produk',
            'Jumlah Terjual',
            'Total Pendapatan',
        ];
    }
}
