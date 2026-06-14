<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['cafe', 'user', 'photos'])->latest();

        if ($request->filled('status') && in_array($request->status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $request->status);
        }

        $reviews = $query->paginate(15);
        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(Review $review)
    {
        $review->update(['status' => 'approved']);
        return back()->with('success', 'Review disetujui.');
    }

    public function reject(Review $review)
    {
        $review->update(['status' => 'rejected']);
        return back()->with('success', 'Review ditolak.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review berhasil dihapus.');
    }
}
