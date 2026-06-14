<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;

class CafeController extends Controller
{
    public function index(Request $request)
    {
        $query = Cafe::where('status', 'active');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('wifi')) {
            $query->where('wifi_quality', $request->wifi);
        }
        if ($request->filled('noise')) {
            $query->where('noise_level', $request->noise);
        }
        if ($request->filled('outlet')) {
            $query->where('power_outlet', $request->outlet);
        }

        $cafes = $query->withCount('approvedReviews')->paginate(9);
        return view('cafes.index', compact('cafes'));
    }

    public function show(Cafe $cafe)
    {
        $reviews = $cafe->approvedReviews()->with(['user', 'photos'])->latest()->get();
        return view('cafes.show', compact('cafe', 'reviews'));
    }
}
