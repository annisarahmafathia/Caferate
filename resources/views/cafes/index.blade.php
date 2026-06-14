@extends('layouts.app')
@section('title', 'Daftar Café')
@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-amber-800">Temukan Café Favoritmu ☕</h1>
    <p class="text-gray-500 mt-1">Cari tempat nongkrong terbaik berdasarkan kebutuhanmu</p>
</div>

{{-- Filter Bar --}}
<form method="GET" action="{{ route('cafes.index') }}"
    class="bg-white p-4 rounded-xl shadow mb-6 flex flex-wrap gap-3 items-end">

    <div class="flex-1 min-w-[150px]">
        <label class="block text-xs font-medium text-gray-500 mb-1">Café</label>
        <input type="text" name="search" placeholder="Cari nama cafe..." ...
            value="{{ request('search') }}"
            class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">
    </div>

    <div>
        <label class="block text-xs font-medium text-gray-500 mb-1">WiFi</label>
        <select name="wifi" class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400">
            <option value="">Semua</option>
            <option value="good"   @selected(request('wifi')=='good')>📶 Good</option>
            <option value="medium" @selected(request('wifi')=='medium')>📶 Medium</option>
            <option value="bad"    @selected(request('wifi')=='bad')>📶 Bad</option>
        </select>
    </div>

    <div>
        <label class="block text-xs font-medium text-gray-500 mb-1">Kebisingan</label>
        <select name="noise" class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400">
            <option value="">Semua</option>
            <option value="quiet"    @selected(request('noise')=='quiet')>🤫 Quiet</option>
            <option value="moderate" @selected(request('noise')=='moderate')>🔉 Moderate</option>
            <option value="noisy"    @selected(request('noise')=='noisy')>🔊 Noisy</option>
        </select>
    </div>

    <div>
        <label class="block text-xs font-medium text-gray-500 mb-1">Colokan</label>
        <select name="outlet" class="border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400">
            <option value="">Semua</option>
            <option value="many" @selected(request('outlet')=='many')>🔌 Banyak</option>
            <option value="few"  @selected(request('outlet')=='few')>🔌 Sedikit</option>
            <option value="none" @selected(request('outlet')=='none')>❌ Tidak Ada</option>
        </select>
    </div>

    <div class="flex gap-2">
        <button type="submit"
            class="bg-amber-700 text-white px-4 py-2 rounded-lg hover:bg-amber-800 text-sm font-semibold transition">
            🔍 Filter
        </button>
        <a href="{{ route('cafes.index') }}"
            class="bg-gray-100 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-200 text-sm transition">
            Reset
        </a>
    </div>
</form>

{{-- Cafe Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($cafes as $cafe)
    <a href="{{ route('cafes.show', $cafe) }}"
        class="bg-white rounded-xl shadow hover:shadow-lg transition-all overflow-hidden group">

        @if($cafe->thumbnail)
            <img src="{{ Storage::url($cafe->thumbnail) }}"
                class="w-full h-44 object-cover group-hover:scale-105 transition-transform duration-300"
                alt="{{ $cafe->name }}">
        @else
            <div class="w-full h-44 bg-gradient-to-br from-amber-100 to-amber-200
                flex items-center justify-center text-5xl">
                ☕
            </div>
        @endif

        <div class="p-4">
            <h2 class="font-bold text-lg text-amber-900 group-hover:text-amber-700 transition">
                {{ $cafe->name }}
            </h2>
            <p class="text-sm text-gray-500 mb-3">📍 {{ $cafe->city }}</p>

            <div class="flex gap-2 flex-wrap text-xs mb-3">
                @if($cafe->wifi_quality)
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">
                        📶 {{ ucfirst($cafe->wifi_quality) }}
                    </span>
                @endif
                @if($cafe->noise_level)
                    <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">
                        🔊 {{ ucfirst($cafe->noise_level) }}
                    </span>
                @endif
                @if($cafe->power_outlet)
                    <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full">
                        🔌 {{ ucfirst($cafe->power_outlet) }}
                    </span>
                @endif
            </div>

            <div class="flex justify-between items-center text-xs text-gray-400">
                <span>{{ $cafe->approved_reviews_count }} review</span>
                <span class="text-amber-600 font-semibold">⭐ {{ $cafe->avgRating() ?: '-' }}/5</span>
            </div>

            @if($cafe->price_range_min > 0)
            <p class="text-xs text-gray-400 mt-1">
                💰 Rp {{ number_format($cafe->price_range_min, 0, ',', '.') }}
                – Rp {{ number_format($cafe->price_range_max, 0, ',', '.') }}
            </p>
            @endif
        </div>
    </a>
    @empty
    <div class="col-span-3 text-center py-20 text-gray-400">
        <div class="text-5xl mb-3">🔍</div>
        <p class="text-lg">Tidak ada café ditemukan.</p>
        <a href="{{ route('cafes.index') }}" class="text-amber-600 hover:underline text-sm mt-2 block">
            Reset filter
        </a>
    </div>
    @endforelse
</div>

<div class="mt-8">{{ $cafes->withQueryString()->links() }}</div>

@endsection
