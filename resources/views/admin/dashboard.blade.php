@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<h1 class="text-2xl font-bold mb-6 text-amber-800">📊 Dashboard Admin</h1>

{{-- Stats Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">

    <div class="bg-white rounded-xl shadow p-5 text-center border-l-4 border-amber-500">
        <div class="text-3xl font-bold text-amber-600">
            {{ $stats['total_cafes'] }}
        </div>
        <div class="text-sm text-gray-500 mt-1">
            🏪 Total Café
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-5 text-center border-l-4 border-blue-500">
        <div class="text-3xl font-bold text-blue-600">
            {{ $stats['total_reviews'] }}
        </div>
        <div class="text-sm text-gray-500 mt-1">
            💬 Total Review
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-5 text-center border-l-4 border-green-500">
        <div class="text-3xl font-bold text-green-600">
            {{ $stats['total_users'] }}
        </div>
        <div class="text-sm text-gray-500 mt-1">
            👤 Total User
        </div>
    </div>

</div>

<div class="grid md:grid-cols-2 gap-6">

    {{-- Recent Reviews --}}
    <div class="bg-white rounded-xl shadow p-5">
        <h2 class="font-bold text-lg mb-4 text-amber-700 flex items-center gap-2">
            💬 Review Terbaru
        </h2>

        @forelse($recentReviews as $r)
        <div class="flex justify-between items-center py-2.5 border-b last:border-0">

            <div>
                <span class="font-medium text-sm">
                    {{ $r->user->name }}
                </span>

                <span class="text-gray-400 text-xs">
                    → {{ $r->cafe->name }}
                </span>

                <div class="text-xs text-gray-400 mt-0.5">
                    {{ $r->created_at->diffForHumans() }}
                </div>
            </div>

            <span class="text-amber-700 text-xs font-medium">
                ⭐ {{ number_format($r->avgRating(), 1) }}/5
            </span>

        </div>
        @empty
        <p class="text-gray-400 text-sm text-center py-4">
            Belum ada review.
        </p>
        @endforelse

        <a href="{{ route('admin.reviews.index') }}"
            class="block text-center text-amber-700 text-sm mt-3 hover:underline">
            Lihat semua review →
        </a>
    </div>

    {{-- Top Cafes --}}
    <div class="bg-white rounded-xl shadow p-5">
        <h2 class="font-bold text-lg mb-4 text-amber-700 flex items-center gap-2">
            🏆 Top Café by Review
        </h2>

        @forelse($topCafes as $i => $c)
        <div class="flex justify-between items-center py-2.5 border-b last:border-0">

            <div class="flex items-center gap-3">
                <span class="w-6 h-6 rounded-full bg-amber-100 text-amber-800 text-xs flex items-center justify-center font-bold">
                    {{ $i + 1 }}
                </span>

                <span class="text-sm font-medium">
                    {{ $c->name }}
                </span>
            </div>

            <span class="text-amber-700 font-bold text-sm">
                {{ $c->approved_reviews_count }} review
            </span>

        </div>
        @empty
        <p class="text-gray-400 text-sm text-center py-4">
            Belum ada data.
        </p>
        @endforelse

        <a href="{{ route('admin.cafes.index') }}"
            class="block text-center text-amber-700 text-sm mt-3 hover:underline">
            Kelola semua café →
        </a>
    </div>

</div>

{{-- Quick Actions --}}
<div class="flex gap-4 mt-6">

    <a href="{{ route('admin.cafes.create') }}"
        class="bg-amber-700 text-white px-5 py-2.5 rounded-lg hover:bg-amber-800 font-semibold transition">
        + Tambah Café
    </a>

    <a href="{{ route('admin.reviews.index') }}"
        class="bg-blue-600 text-white px-5 py-2.5 rounded-lg hover:bg-blue-700 font-semibold transition">
        Kelola Review
    </a>

</div>

@endsection