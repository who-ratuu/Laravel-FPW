<style>
    @media print {
        body * {
            visibility: hidden;
        }

        #receipt,
        #receipt * {
            visibility: visible;
        }

        #receipt {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            box-shadow: none;
            margin: 0;
        }

        .no-print {
            display: none !important;
        }
    }
</style>

<x-app-layout>
    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div id="receipt" class="bg-white p-6 rounded-lg shadow">

                <div class="text-center mb-6">
                    <h1 class="text-2xl font-bold">BAROKAH MART</h1>
                    <p class="text-gray-500">Struk Transaksi Penjualan</p>
                </div>

                <hr class="mb-4">

                <div class="mb-4 text-sm">
                    <p>
                        <strong>No. Invoice:</strong>
                        {{ $transaction->invoice_number }}
                    </p>
                    <p>
                        <strong>Tanggal:</strong>
                        {{ $transaction->created_at->format('d-m-Y H:i') }}
                    </p>
                    <p>
                        <strong>Kasir:</strong>
                        {{ $transaction->user->name }}
                    </p>
                </div>

                <hr class="mb-4">

                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left py-2">Produk</th>
                            <th class="text-center py-2">Qty</th>
                            <th class="text-right py-2">Harga</th>
                            <th class="text-right py-2">Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transaction->details as $detail)
                            <tr class="border-b">
                                <td class="py-2">
                                    {{ $detail->product->name }}
                                </td>
                                <td class="text-center py-2">
                                    {{ $detail->qty }}
                                </td>
                                <td class="text-right py-2">
                                    Rp{{ number_format($detail->price, 0, ',', '.') }}
                                </td>
                                <td class="text-right py-2">
                                    Rp{{ number_format($detail->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-5 space-y-2 text-sm">
                    <div class="flex justify-between font-bold">
                        <span>Total</span>
                        <span>
                            Rp{{ number_format($transaction->total, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>Bayar</span>
                        <span>
                            Rp{{ number_format($transaction->pay, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span>Kembalian</span>
                        <span>
                            Rp{{ number_format($transaction->change, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <hr class="my-5">

                <p class="text-center text-sm text-gray-500">
                    Terima kasih sudah berbelanja di Barokah Mart!
                </p>

                <div class="mt-6 text-center no-print">
                    <button type="button" onclick="window.print()"
                        class="inline-block bg-green-600 text-white px-4 py-2 rounded-lg mr-2">
                        Cetak Struk
                    </button>

                    <a href="{{ route('pos.index') }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg">
                        Transaksi Baru
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>