@extends('layouts.app')
@section('title', $cafe->name)
@section('content')

{{-- Back link --}}
<a href="{{ route('cafes.index') }}" class="text-amber-700 hover:underline text-sm mb-4 inline-block">← Kembali ke daftar</a>

{{-- Cafe Header --}}
<div class="bg-white rounded-xl shadow overflow-hidden mb-6">
    @if($cafe->thumbnail)
        <img src="{{ Storage::url($cafe->thumbnail) }}"
            class="w-full h-64 object-cover" alt="{{ $cafe->name }}">
    @else
        <div class="w-full h-64 bg-gradient-to-br from-amber-100 to-amber-200
            flex items-center justify-center text-7xl">☕</div>
    @endif

    <div class="p-6">
        <div class="flex justify-between items-start flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-amber-900">{{ $cafe->name }}</h1>
                <p class="text-gray-500 mt-1">📍 {{ $cafe->address }}, {{ $cafe->city }}</p>
            </div>
            <div class="text-right">
                <div class="text-3xl font-bold text-amber-600">⭐ {{ $cafe->avgRating() ?: '-' }}</div>
                <div class="text-sm text-gray-400">dari 5.0 · {{ $reviews->count() }} review</div>
            </div>
        </div>

        @if($cafe->description)
        <p class="text-gray-700 mt-4 leading-relaxed">{{ $cafe->description }}</p>
        @endif

        <div class="flex gap-3 flex-wrap mt-4">
            @if($cafe->wifi_quality)
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                    📶 WiFi: {{ ucfirst($cafe->wifi_quality) }}
                </span>
            @endif
            @if($cafe->noise_level)
                <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm">
                    🔊 {{ ucfirst($cafe->noise_level) }}
                </span>
            @endif
            @if($cafe->power_outlet)
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                    🔌 Outlet: {{ ucfirst($cafe->power_outlet) }}
                </span>
            @endif
            @if($cafe->price_range_min > 0)
                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">
                    💰 Rp {{ number_format($cafe->price_range_min, 0, ',', '.') }}
                    – {{ number_format($cafe->price_range_max, 0, ',', '.') }}
                </span>
            @endif
        </div>
    </div>
</div>

{{-- Rating Summary --}}
@if($reviews->count() > 0)
<div class="bg-white rounded-xl shadow p-5 mb-6">
    <h2 class="font-bold text-lg text-amber-800 mb-4">Ringkasan Rating</h2>
    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
        @php
            $aspects = ['wifi' => '📶 WiFi', 'seat' => '🪑 Tempat', 'food' => '🍵 Makanan', 'ambience' => '🌿 Suasana', 'price' => '💰 Harga'];
        @endphp
        @foreach($aspects as $key => $label)
        @php
            $avg = round($reviews->whereNotNull("rating_$key")->avg("rating_$key"), 1);
        @endphp
        @if($avg)
        <div class="text-center bg-amber-50 rounded-lg p-3">
            <div class="text-xl font-bold text-amber-700">{{ $avg }}</div>
            <div class="text-xs text-gray-500 mt-0.5">{{ $label }}</div>
            <div class="flex justify-center gap-0.5 mt-1">
                @for($i = 1; $i <= 5; $i++)
                    <span class="{{ $i <= round($avg) ? 'text-amber-400' : 'text-gray-200' }} text-xs">★</span>
                @endfor
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endif

{{-- Review Form --}}
@auth
<div class="bg-white rounded-xl shadow p-6 mb-6">
    <h2 class="text-xl font-bold mb-4 text-amber-700">✍️ Tulis Reviewmu</h2>
    <form method="POST" action="{{ route('reviews.store', $cafe) }}" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            @foreach(['wifi' => '📶 Kualitas WiFi', 'seat' => '🪑 Tempat Duduk', 'food' => '🍵 Makanan/Minuman', 'ambience' => '🌿 Suasana', 'price' => '💰 Harga'] as $key => $label)
            <div>
                <label class="block text-sm font-medium mb-1 text-gray-700">{{ $label }}</label>
                <select name="rating_{{ $key }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400">
                    <option value="">Pilih rating...</option>
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} ⭐ {{ ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Baik', 'Sangat Baik'][$i] }}</option>
                    @endfor
                </select>
            </div>
            @endforeach
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1 text-gray-700">Komentar</label>
            <textarea name="comment" rows="3"
                placeholder="Ceritakan pengalamanmu di café ini..."
                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 resize-none">{{ old('comment') }}</textarea>
        </div>

        <div class="mb-5">
            <label class="block text-sm font-medium mb-1 text-gray-700">Upload Foto (maks. 5 foto)</label>
            <input type="file" name="photos[]" multiple accept="image/*"
                class="block w-full text-sm text-gray-500 border rounded-lg px-3 py-2
                    file:mr-4 file:py-1 file:px-3 file:rounded file:border-0
                    file:text-sm file:font-semibold file:bg-amber-100 file:text-amber-700
                    hover:file:bg-amber-200">
            <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, max 2MB per foto</p>
        </div>

        <button type="submit"
            class="bg-amber-700 text-white px-6 py-2.5 rounded-lg hover:bg-amber-800 font-semibold transition">
            Kirim Review
        </button>
    </form>
</div>
@else
<div class="bg-amber-50 border border-amber-200 p-5 rounded-xl mb-6 text-center">
    <p class="text-gray-600">
        <a href="{{ route('login') }}" class="text-amber-700 font-semibold hover:underline">Login</a>
        untuk menulis review di café ini.
    </p>
</div>
@endauth

{{-- Review List --}}
<h2 class="text-xl font-bold mb-4 text-amber-800">💬 Review ({{ $reviews->count() }})</h2>

@forelse($reviews as $review)
<div class="bg-white rounded-xl shadow p-5 mb-4">
    <div class="flex justify-between items-start mb-3">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-amber-200 flex items-center justify-center font-bold text-amber-800">
                {{ strtoupper(substr($review->user->name, 0, 1)) }}
            </div>
            <div>
                <p class="font-semibold text-sm">{{ $review->user->name }}</p>
                <p class="text-xs text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
            </div>
        </div>
        <span class="text-amber-600 font-bold text-lg">⭐ {{ $review->avgRating() }}/5</span>
    </div>

    {{-- Rating breakdown --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-2 mb-3 text-xs text-gray-600">
        @foreach(['wifi' => '📶 WiFi', 'seat' => '🪑 Seat', 'food' => '🍵 Food', 'ambience' => '🌿 Ambience', 'price' => '💰 Price'] as $key => $label)
            @if($review->{"rating_$key"})
            <div class="bg-gray-50 rounded-lg p-2 text-center">
                <div class="text-gray-500">{{ $label }}</div>
                <div class="font-bold text-amber-700 mt-0.5">{{ $review->{"rating_$key"} }}/5</div>
            </div>
            @endif
        @endforeach
    </div>

    @if($review->comment)
    <p class="text-gray-700 text-sm mb-3 leading-relaxed">{{ $review->comment }}</p>
    @endif

    @if($review->photos->isNotEmpty())
    <div class="flex gap-2 flex-wrap">
        @foreach($review->photos as $photo)
        <img src="{{ Storage::url($photo->photo_path) }}"
            class="h-24 w-24 object-cover rounded-lg cursor-pointer hover:opacity-90 transition"
            alt="Foto review">
        @endforeach
    </div>
    @endif
</div>
@empty
<div class="text-center py-16 text-gray-400">
    <div class="text-5xl mb-3">💬</div>
    <p>Belum ada review. Jadilah yang pertama!</p>
</div>
@endforelse

@endsection
