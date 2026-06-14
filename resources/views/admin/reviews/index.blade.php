@extends('layouts.admin')
@section('title', 'Review Café')
@section('content')

<h1 class="text-2xl font-bold mb-6 text-amber-800">💬 Semua Review</h1>

<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-amber-50 text-amber-800 border-b">
            <tr>
                <th class="px-4 py-3 text-left">User</th>
                <th class="px-4 py-3 text-left">Café</th>
                <th class="px-4 py-3 text-left">Rating</th>
                <th class="px-4 py-3 text-left">Komentar</th>
                <th class="px-4 py-3 text-left">Foto</th>
                <th class="px-4 py-3 text-left">Tanggal</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($reviews as $review)
            <tr class="border-t hover:bg-gray-50 transition align-top">

                <td class="px-4 py-3">
                    <div class="font-medium">{{ $review->user->name }}</div>
                    <div class="text-xs text-gray-400">
                        {{ $review->user->email }}
                    </div>
                </td>

                <td class="px-4 py-3">
                    <a href="{{ route('cafes.show', $review->cafe) }}"
                        target="_blank"
                        class="text-amber-700 hover:underline font-medium">
                        {{ $review->cafe->name }}
                    </a>
                </td>

                <td class="px-4 py-3">
                    <div class="font-bold text-amber-600">
                        ⭐ {{ $review->avgRating() }}/5
                    </div>

                    <div class="text-xs text-gray-400 mt-1 space-y-0.5">
                        @if($review->rating_wifi)
                            <div>📶 WiFi: {{ $review->rating_wifi }}</div>
                        @endif

                        @if($review->rating_seat)
                            <div>🪑 Seat: {{ $review->rating_seat }}</div>
                        @endif

                        @if($review->rating_food)
                            <div>🍵 Food: {{ $review->rating_food }}</div>
                        @endif

                        @if($review->rating_ambience)
                            <div>🌿 Ambience: {{ $review->rating_ambience }}</div>
                        @endif

                        @if($review->rating_price)
                            <div>💰 Price: {{ $review->rating_price }}</div>
                        @endif
                    </div>
                </td>

                <td class="px-4 py-3 max-w-[200px]">
                    <p class="text-xs text-gray-600 line-clamp-3">
                        {{ $review->comment ?: '-' }}
                    </p>
                </td>

                <td class="px-4 py-3">
                    @if($review->photos->isNotEmpty())
                        <div class="flex gap-1 flex-wrap">
                            @foreach($review->photos->take(3) as $photo)
                                <img
                                    src="{{ Storage::url($photo->photo_path) }}"
                                    class="w-12 h-12 object-cover rounded">
                            @endforeach
                        </div>

                        @if($review->photos->count() > 3)
                            <p class="text-xs text-gray-400 mt-1">
                                +{{ $review->photos->count() - 3 }} lagi
                            </p>
                        @endif
                    @else
                        <span class="text-gray-400 text-xs">-</span>
                    @endif
                </td>

                <td class="px-4 py-3 text-xs text-gray-400">
                    {{ $review->created_at->format('d M Y') }}
                    <br>
                    {{ $review->created_at->format('H:i') }}
                </td>

                <td class="px-4 py-3">
                    <form method="POST"
                        action="{{ route('admin.reviews.destroy', $review) }}"
                        onsubmit="return confirm('Yakin hapus review ini permanen?')">
                        @csrf
                        @method('DELETE')

                        <button
                            class="w-full bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700 transition">
                            🗑 Hapus
                        </button>
                    </form>
                </td>

            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-gray-400 py-12">
                    Tidak ada review ditemukan.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-4 border-t">
        {{ $reviews->links() }}
    </div>
</div>

@endsection