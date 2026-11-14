<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Transaction;
use App\Models\User;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function sales(Request $request)
    {
        $start = $request->filled('start')
            ? Carbon::parse($request->start)
            : now()->subDays(6)->startOfDay();

        $end = $request->filled('end')
            ? Carbon::parse($request->end)->endOfDay()
            : now()->endOfDay();

        $selectedCashier = $request->input('cashier');

        $query = Transaction::with('user')
            ->whereBetween('created_at', [$start, $end]);

        if ($request->filled('cashier')) {
            $query->where('user_id', $selectedCashier);
        }

        $transactions = $query->latest()->get();

        $totalPenjualan = $transactions->sum('total');
        $jumlahTransaksi = $transactions->count();

        $cashiers = User::orderBy('name')->get();

        return view('reports.sales', compact(
            'transactions',
            'totalPenjualan',
            'jumlahTransaksi',
            'start',
            'end',
            'cashiers',
            'selectedCashier'
        ));
    }

    public function export(Request $request)
    {
        $start = $request->filled('start')
            ? Carbon::parse($request->start)
            : now()->subDays(6)->startOfDay();

        $end = $request->filled('end')
            ? Carbon::parse($request->end)->endOfDay()
            : now()->endOfDay();

        $cashier = $request->input('cashier');

        $filename = 'laporan-penjualan-' .
            $start->format('Ymd') . '-' .
            $end->format('Ymd') . '.xlsx';

        return Excel::download(
            new SalesExport($start, $end, $cashier),
            $filename
        );
    }
}
