<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cafe;
use Illuminate\Http\Request;

class AdminCafeController extends Controller
{
    public function index()
    {
        $cafes = Cafe::withCount('reviews')->paginate(10);
        return view('admin.cafes.index', compact('cafes'));
    }

    public function create()
    {
        return view('admin.cafes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:100',
            'address'         => 'required|string',
            'city'            => 'required|string',
            'description'     => 'nullable|string',
            'wifi_quality'    => 'nullable|in:good,medium,bad',
            'power_outlet'    => 'nullable|in:many,few,none',
            'noise_level'     => 'nullable|in:quiet,moderate,noisy',
            'price_range_min' => 'nullable|numeric',
            'price_range_max' => 'nullable|numeric',
            'thumbnail'       => 'nullable|image|max:2048',
            'status'          => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('cafes', 'public');
        }

        Cafe::create($data);
        return redirect()->route('admin.cafes.index')->with('success', 'Café berhasil ditambahkan.');
    }

    public function show(Cafe $cafe)
    {
        return redirect()->route('cafes.show', $cafe);
    }

    public function edit(Cafe $cafe)
    {
        return view('admin.cafes.edit', compact('cafe'));
    }

    public function update(Request $request, Cafe $cafe)
    {
        $data = $request->validate([
            'name'            => 'required|string|max:100',
            'address'         => 'required|string',
            'city'            => 'required|string',
            'description'     => 'nullable|string',
            'wifi_quality'    => 'nullable|in:good,medium,bad',
            'power_outlet'    => 'nullable|in:many,few,none',
            'noise_level'     => 'nullable|in:quiet,moderate,noisy',
            'price_range_min' => 'nullable|numeric',
            'price_range_max' => 'nullable|numeric',
            'thumbnail'       => 'nullable|image|max:2048',
            'status'          => 'required|in:active,inactive',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('cafes', 'public');
        }

        $cafe->update($data);
        return redirect()->route('admin.cafes.index')->with('success', 'Café berhasil diupdate.');
    }

    public function destroy(Cafe $cafe)
    {
        $cafe->delete();
        return redirect()->route('admin.cafes.index')->with('success', 'Café berhasil dihapus.');
    }
}
