@props(['status'])

@php
    $warna = match ($status) {
        'Aman' => 'bg-green-100 text-green-700',
        'Menipis' => 'bg-yellow-100 text-yellow-700',
        'Habis' => 'bg-red-100 text-red-700',
        default => 'bg-gray-100 text-gray-700',
    };
@endphp

<span class="px-2 py-1 rounded text-sm {{ $warna }}">
    {{ $status }}
</span>

