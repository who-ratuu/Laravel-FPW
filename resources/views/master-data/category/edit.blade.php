<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800">
                Ubah Kategori
            </h2>

            <a href="{{ route('categories.index') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded-md text-sm">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-card>

                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded-md text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('categories.update', $category) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name"
                               class="block text-sm font-medium text-gray-700 mb-1">
                            Nama Kategori
                        </label>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $category->name) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Masukkan nama kategori"
                               required>
                    </div>

                    <div class="mb-6">
                        <label for="description"
                               class="block text-sm font-medium text-gray-700 mb-1">
                            Deskripsi
                        </label>

                        <textarea name="description"
                                  id="description"
                                  rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Masukkan deskripsi kategori">{{ old('description', $category->description) }}</textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <button type="submit"
                                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('categories.index') }}"
                           class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm">
                            Batal
                        </a>
                    </div>

                </form>

            </x-card>
        </div>
    </div>
</x-app-layout>
