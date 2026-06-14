@extends('layouts.admin')
@section('title', 'Edit Café')
@section('content')

<div class="max-w-2xl">
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.cafes.index') }}" class="text-amber-700 hover:underline text-sm">← Kembali</a>
        <h1 class="text-2xl font-bold text-amber-800">✏️ Edit: {{ $cafe->name }}</h1>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <form method="POST" action="{{ route('admin.cafes.update', $cafe) }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">
                        Nama Café <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ old('name', $cafe->name) }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400
                            @error('name') border-red-400 @enderror">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">
                        Kota <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="city" value="{{ old('city', $cafe->city) }}"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400
                            @error('city') border-red-400 @enderror">
                    @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1 text-gray-700">
                    Alamat <span class="text-red-500">*</span>
                </label>
                <input type="text" name="address" value="{{ old('address', $cafe->address) }}"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400
                        @error('address') border-red-400 @enderror">
                @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1 text-gray-700">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-amber-400 resize-none">{{ old('description', $cafe->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Kualitas WiFi</label>
                    <select name="wifi_quality"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400">
                        <option value="">Pilih...</option>
                        <option value="good"   @selected(old('wifi_quality',$cafe->wifi_quality)=='good')>📶 Good</option>
                        <option value="medium" @selected(old('wifi_quality',$cafe->wifi_quality)=='medium')>📶 Medium</option>
                        <option value="bad"    @selected(old('wifi_quality',$cafe->wifi_quality)=='bad')>📶 Bad</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Colokan Listrik</label>
                    <select name="power_outlet"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400">
                        <option value="">Pilih...</option>
                        <option value="many" @selected(old('power_outlet',$cafe->power_outlet)=='many')>🔌 Banyak</option>
                        <option value="few"  @selected(old('power_outlet',$cafe->power_outlet)=='few')>🔌 Sedikit</option>
                        <option value="none" @selected(old('power_outlet',$cafe->power_outlet)=='none')>❌ Tidak Ada</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Tingkat Kebisingan</label>
                    <select name="noise_level"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400">
                        <option value="">Pilih...</option>
                        <option value="quiet"    @selected(old('noise_level',$cafe->noise_level)=='quiet')>🤫 Quiet</option>
                        <option value="moderate" @selected(old('noise_level',$cafe->noise_level)=='moderate')>🔉 Moderate</option>
                        <option value="noisy"    @selected(old('noise_level',$cafe->noise_level)=='noisy')>🔊 Noisy</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Harga Minimum (Rp)</label>
                    <input type="number" name="price_range_min"
                        value="{{ old('price_range_min', $cafe->price_range_min) }}" min="0"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1 text-gray-700">Harga Maksimum (Rp)</label>
                    <input type="number" name="price_range_max"
                        value="{{ old('price_range_max', $cafe->price_range_max) }}" min="0"
                        class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1 text-gray-700">Foto Thumbnail</label>
                @if($cafe->thumbnail)
                    <div class="mb-2">
                        <img src="{{ Storage::url($cafe->thumbnail) }}"
                            class="h-28 w-44 object-cover rounded-lg border">
                        <p class="text-xs text-gray-400 mt-1">Foto saat ini. Upload baru untuk mengganti.</p>
                    </div>
                @endif
                <input type="file" name="thumbnail" accept="image/*"
                    class="block w-full text-sm text-gray-500 border rounded-lg px-3 py-2
                        file:mr-4 file:py-1 file:px-3 file:rounded file:border-0
                        file:text-sm file:font-semibold file:bg-amber-100 file:text-amber-700
                        hover:file:bg-amber-200">
                @error('thumbnail') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-1 text-gray-700">
                    Status <span class="text-red-500">*</span>
                </label>
                <select name="status"
                    class="w-full border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-amber-400">
                    <option value="active"   @selected(old('status',$cafe->status)=='active')>✅ Active</option>
                    <option value="inactive" @selected(old('status',$cafe->status)=='inactive')>❌ Inactive</option>
                </select>
            </div>

            <div class="flex gap-3 pt-2 border-t">
                <button type="submit"
                    class="bg-amber-700 text-white px-6 py-2.5 rounded-lg hover:bg-amber-800 font-semibold transition">
                    💾 Update Café
                </button>
                <a href="{{ route('admin.cafes.index') }}"
                    class="bg-gray-200 text-gray-700 px-6 py-2.5 rounded-lg hover:bg-gray-300 font-semibold transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
