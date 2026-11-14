<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Laporan Penjualan
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Filter Tanggal -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
                <form action="{{ route('report.sales') }}" method="GET"
                    class="flex flex-wrap items-end gap-4">

                    <div>
                        <label for="start" class="block text-sm font-medium">
                            Tanggal Awal
                        </label>
                        <input type="date" name="start" id="start"
                            value="{{ request('start', $start->format('Y-m-d')) }}"
                            class="border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label for="end" class="block text-sm font-medium">
                            Tanggal Akhir
                        </label>
                        <input type="date" name="end" id="end"
                            value="{{ request('end', $end->format('Y-m-d')) }}"
                            class="border-gray-300 rounded-md shadow-sm">
                    </div>

                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md">
                        Tampilkan
                    </button>

                    <a href="{{ route('report.export', request()->query()) }}"
                        class="px-4 py-2 bg-green-600 text-white rounded-md">
                        Export Excel
                    </a>
                </form>
            </div>

            <!-- Ringkasan Penjualan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500">Total Penjualan</p>
                    <h3 class="text-2xl font-bold">
                        Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                    </h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-gray-500">Jumlah Transaksi</p>
                    <h3 class="text-2xl font-bold">
                        {{ $jumlahTransaksi }}
                    </h3>
                </div>
            </div>

            <!-- Tabel Transaksi -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">
                    Data Transaksi
                </h3>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left">No. Invoice</th>
                                <th class="px-4 py-3 text-left">Tanggal</th>
                                <th class="px-4 py-3 text-left">Kasir</th>
                                <th class="px-4 py-3 text-left">Total</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse ($transactions as $transaction)
                                <tr>
                                    <td class="px-4 py-3">
                                        {{ $transaction->invoice_number }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $transaction->created_at->format('d-m-Y H:i') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        {{ $transaction->user->name ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-3 text-center text-gray-500">
                                        Tidak ada data transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
