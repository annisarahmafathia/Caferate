<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin CaféRate — @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">
    {{-- Sidebar --}}
    <aside class="w-56 bg-amber-800 text-white flex flex-col py-6 px-4 fixed h-full shadow-lg">
        <div class="mb-8">
            <div class="text-xl font-bold tracking-wide">☕ CaféRate</div>
            <div class="text-xs text-amber-200 mt-0.5">Admin Panel</div>
        </div>

        <nav class="flex flex-col gap-1 text-sm flex-1">
            <a href="{{ route('admin.dashboard') }}"
                class="px-3 py-2 rounded hover:bg-amber-700 transition flex items-center gap-2
                    {{ request()->routeIs('admin.dashboard') ? 'bg-amber-700 font-semibold' : '' }}">
                📊 Dashboard
            </a>
            <a href="{{ route('admin.cafes.index') }}"
                class="px-3 py-2 rounded hover:bg-amber-700 transition flex items-center gap-2
                    {{ request()->routeIs('admin.cafes.*') ? 'bg-amber-700 font-semibold' : '' }}">
                🏪 Kelola Café
            </a>
            <a href="{{ route('admin.reviews.index') }}"
                class="px-3 py-2 rounded hover:bg-amber-700 transition flex items-center gap-2
                    {{ request()->routeIs('admin.reviews.*') ? 'bg-amber-700 font-semibold' : '' }}">
                💬 Moderasi Review
            </a>
            <div class="border-t border-amber-600 my-3"></div>
            <a href="{{ route('cafes.index') }}"
                class="px-3 py-2 rounded hover:bg-amber-700 transition flex items-center gap-2 text-amber-200">
                🌐 Lihat Website
            </a>
        </nav>

        <div class="mt-auto text-xs text-amber-300 pt-4 border-t border-amber-600">
            <div class="font-medium text-white">{{ auth()->user()->name }}</div>
            <div class="text-amber-300 mb-2">Administrator</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="hover:text-white underline">Logout</button>
            </form>
        </div>
    </aside>

    {{-- Main Content --}}
    <div class="ml-56 flex-1 p-8 min-h-screen">
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-400 text-green-800 rounded flex items-center gap-2">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-800 rounded">
                ❌ {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </div>
</div>

</body>
</html>
