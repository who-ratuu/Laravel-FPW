<x-app-layout>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow">

                <h2 class="text-xl font-bold mb-6">
                    Riwayat Transaksi Saya
                </h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3">No. Invoice</th>
                                <th class="text-left py-3">Tanggal</th>
                                <th class="text-right py-3">Total</th>
                                <th class="text-right py-3">Bayar</th>
                                <th class="text-right py-3">Kembalian</th>
                                <th class="text-center py-3">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($transactions as $transaction)
                                <tr class="border-b">
                                    <td class="py-3">
                                        {{ $transaction->invoice_number }}
                                    </td>
                                    <td class="py-3">
                                        {{ $transaction->created_at->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="text-right py-3">
                                        Rp{{ number_format($transaction->total, 0, ',', '.') }}
                                    </td>
                                    <td class="text-right py-3">
                                        Rp{{ number_format($transaction->pay, 0, ',', '.') }}
                                    </td>
                                    <td class="text-right py-3">
                                        Rp{{ number_format($transaction->change, 0, ',', '.') }}
                                    </td>
                                    <td class="text-center py-3">
                                        <a href="{{ route('pos.struk', $transaction) }}"
                                            class="text-blue-600 hover:underline">
                                            Lihat Struk
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        Belum ada transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    <a href="{{ route('pos.index') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Kembali ke Kasir
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
