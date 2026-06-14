<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CaféRate - @yield('title', 'Temukan Café Terbaik')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<nav class="bg-amber-700 text-white px-6 py-4 flex justify-between items-center shadow-md">
    <a href="{{ route('cafes.index') }}" class="text-xl font-bold tracking-wide">☕ CaféRate</a>
    <div class="flex gap-4 items-center">
        @auth
            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="hover:underline text-sm">Admin Panel</a>
            @endif
            <span class="text-sm opacity-80">{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-white text-amber-700 px-3 py-1 rounded hover:bg-amber-100 text-sm font-semibold">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="hover:underline text-sm">Login</a>
            <a href="{{ route('register') }}" class="bg-white text-amber-700 px-3 py-1 rounded hover:bg-amber-100 text-sm font-semibold">Daftar</a>
        @endauth
    </div>
</nav>

<main class="max-w-6xl mx-auto px-4 py-8">
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-800 rounded">
            ✅ {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-800 rounded">
            ❌ {{ session('error') }}
        </div>
    @endif
    @yield('content')
</main>

<footer class="text-center text-gray-400 text-xs py-6 mt-8 border-t">
    © {{ date('Y') }} CaféRate 
</footer>

</body>
</html>
