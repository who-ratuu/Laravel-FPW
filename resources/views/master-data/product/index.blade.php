<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">Data Produk</h2>

            <a href="{{ route('products.create') }}"
               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                + Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>
                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-700 rounded-md text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="GET"
                      action="{{ route('products.index') }}"
                      class="flex flex-col md:flex-row gap-3 mb-4">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari nama atau kode produk..."
                           class="flex-1 rounded-md border-gray-300 shadow-sm">

                    <select name="category_id"
                            class="rounded-md border-gray-300 shadow-sm">
                        <option value="">Semua Kategori</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                @selected(request('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    <select name="stock_status"
                            class="rounded-md border-gray-300 shadow-sm">
                        <option value="">Semua Status Stok</option>

                        <option value="menipis"
                            @selected(request('stock_status') == 'menipis')>
                            Menipis
                        </option>

                        <option value="habis"
                            @selected(request('stock_status') == 'habis')>
                            Habis
                        </option>
                    </select>

                    <select name="per_page"
                            class="rounded-md border-gray-300 shadow-sm">
                        <option value="10"
                            @selected(request('per_page', 10) == 10)>
                            10 data
                        </option>

                        <option value="25"
                            @selected(request('per_page', 10) == 25)>
                            25 data
                        </option>

                        <option value="50"
                            @selected(request('per_page', 10) == 50)>
                            50 data
                        </option>
                    </select>

                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md">
                        Cari
                    </button>

                    <a href="{{ route('products.index') }}"
                       class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-center">
                        Reset
                    </a>
                </form>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Kode</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Nama Produk</th>
                                <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Kategori</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">Harga</th>
                                <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">Total Nilai Stok</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">Stok</th>
                                <th class="px-4 py-2 text-center text-xs font-medium text-gray-500">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @forelse ($products as $product)
                                <tr class="@if ($product->stock == 0) bg-red-50 @elseif ($product->stock < config('stock.low_stock_threshold')) bg-yellow-50 @endif">

                                    <td class="px-4 py-2 text-sm">
                                        {{ $product->code }}
                                    </td>

                                    <td class="px-4 py-2 text-sm">
                                        {{ $product->name }}
                                    </td>

                                    <td class="px-4 py-2 text-sm">
                                        {{ $product->category->name }}
                                    </td>

                                    <td class="px-4 py-2 text-sm text-right">
                                        Rp{{ number_format($product->price, 0, ',', '.') }}
                                    </td>

                                    <td class="px-4 py-2 text-sm text-right">
                                        Rp{{ number_format($product->stock * $product->price, 0, ',', '.') }}
                                    </td>

                                    <td class="px-4 py-2 text-sm text-center font-semibold">
                                        {{ $product->stock }}

                                        @if ($product->stock == 0)
                                            <span class="text-red-600 text-xs block">
                                                Habis
                                            </span>
                                        @elseif ($product->stock < config('stock.low_stock_threshold'))
                                            <span class="text-yellow-600 text-xs block">
                                                Menipis
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-4 py-2 text-sm text-center">
                                        <div class="flex justify-center items-center gap-2">

                                            <a href="{{ route('products.edit', $product) }}"
                                               class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md">
                                                Ubah
                                            </a>

                                            <form action="{{ route('products.destroy', $product) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md">
                                                    Hapus
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7"
                                        class="px-4 py-6 text-center text-gray-500">
                                        Produk tidak ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $products->links() }}
                </div>

            </x-card>
        </div>
    </div>
</x-app-layout>