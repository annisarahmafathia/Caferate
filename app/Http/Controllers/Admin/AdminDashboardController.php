<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cafe;
use App\Models\Review;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_cafes'   => Cafe::count(),
            'total_reviews' => Review::count(),
            'pending'       => Review::where('status', 'pending')->count(),
            'total_users'   => User::where('role', 'user')->count(),
        ];

        $recentReviews = Review::with(['cafe', 'user'])->latest()->take(5)->get();
        $topCafes = Cafe::withCount('approvedReviews')
            ->orderByDesc('approved_reviews_count')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentReviews', 'topCafes'));
    }
}
