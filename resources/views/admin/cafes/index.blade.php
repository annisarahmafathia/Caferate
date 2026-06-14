@extends('layouts.admin')
@section('title', 'Kelola Café')
@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold text-amber-800">🏪 Kelola Café</h1>
    <a href="{{ route('admin.cafes.create') }}"
        class="bg-amber-700 text-white px-4 py-2 rounded-lg hover:bg-amber-800 font-semibold transition">
        + Tambah Café
    </a>
</div>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-amber-50 text-amber-800 border-b">
            <tr>
                <th class="px-4 py-3 text-left">Nama</th>
                <th class="px-4 py-3 text-left">Kota</th>
                <th class="px-4 py-3 text-left">WiFi</th>
                <th class="px-4 py-3 text-left">Outlet</th>
                <th class="px-4 py-3 text-left">Status</th>
                <th class="px-4 py-3 text-left">Review</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($cafes as $cafe)
            <tr class="border-t hover:bg-gray-50 transition">
                <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                        @if($cafe->thumbnail)
                            <img src="{{ Storage::url($cafe->thumbnail) }}"
                                class="w-10 h-10 rounded-lg object-cover">
                        @else
                            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center">☕</div>
                        @endif
                        <div>
                            <div class="font-medium text-gray-800">{{ $cafe->name }}</div>
                            <div class="text-xs text-gray-400 truncate max-w-[180px]">{{ $cafe->address }}</div>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-3 text-gray-500">{{ $cafe->city }}</td>
                <td class="px-4 py-3">
                    @if($cafe->wifi_quality)
                        <span class="px-2 py-0.5 rounded-full text-xs
                            @if($cafe->wifi_quality === 'good') bg-green-100 text-green-700
                            @elseif($cafe->wifi_quality === 'medium') bg-yellow-100 text-yellow-700
                            @else bg-red-100 text-red-700 @endif">
                            {{ ucfirst($cafe->wifi_quality) }}
                        </span>
                    @else
                        <span class="text-gray-400">-</span>
                    @endif
                </td>
                <td class="px-4 py-3 text-gray-600">{{ ucfirst($cafe->power_outlet ?? '-') }}</td>
                <td class="px-4 py-3">
                    <span class="px-2 py-0.5 rounded-full text-xs font-medium
                        @if($cafe->status === 'active') bg-green-100 text-green-700
                        @else bg-red-100 text-red-700 @endif">
                        {{ ucfirst($cafe->status) }}
                    </span>
                </td>
                <td class="px-4 py-3 text-amber-700 font-semibold">{{ $cafe->reviews_count }}</td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        <a href="{{ route('cafes.show', $cafe) }}" target="_blank"
                            class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-xs hover:bg-gray-200 transition">
                            Lihat
                        </a>
                        <a href="{{ route('admin.cafes.edit', $cafe) }}"
                            class="bg-blue-600 text-white px-3 py-1 rounded text-xs hover:bg-blue-700 transition">
                            Edit
                        </a>
                        <form method="POST" action="{{ route('admin.cafes.destroy', $cafe) }}"
                            onsubmit="return confirm('Yakin ingin menghapus café {{ $cafe->name }}? Semua review juga akan terhapus.')">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700 transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-gray-400 py-12">
                    Belum ada café. <a href="{{ route('admin.cafes.create') }}" class="text-amber-600 hover:underline">Tambah sekarang</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4 border-t">{{ $cafes->links() }}</div>
</div>

@endsection
