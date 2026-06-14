@extends('layouts.app')
@section('title', 'Daftar Akun')
@section('content')

<div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow">
    <div class="text-center mb-6">
        <div class="text-4xl mb-2">☕</div>
        <h1 class="text-2xl font-bold text-amber-700">Daftar ke CaféRate</h1>
        <p class="text-gray-500 text-sm mt-1">Buat akun untuk mulai review café</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1 text-gray-700">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama kamu"
                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400
                    @error('name') border-red-400 @enderror">
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1 text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" placeholder="email@kamu.com"
                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400
                    @error('email') border-red-400 @enderror">
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1 text-gray-700">Password</label>
            <input type="password" name="password" placeholder="Min. 6 karakter"
                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400
                    @error('password') border-red-400 @enderror">
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium mb-1 text-gray-700">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Ulangi password"
                class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">
        </div>

        <button type="submit"
            class="w-full bg-amber-700 text-white py-2.5 rounded-lg hover:bg-amber-800 font-semibold transition">
            Daftar Sekarang
        </button>
    </form>

    <p class="mt-4 text-sm text-center text-gray-600">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="text-amber-700 hover:underline font-semibold">Login</a>
    </p>
</div>

@endsection
