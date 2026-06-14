<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Review;
use App\Models\ReviewPhoto;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Cafe $cafe)
    {
        $request->validate([
            'rating_wifi'     => 'nullable|integer|between:1,5',
            'rating_seat'     => 'nullable|integer|between:1,5',
            'rating_food'     => 'nullable|integer|between:1,5',
            'rating_ambience' => 'nullable|integer|between:1,5',
            'rating_price'    => 'nullable|integer|between:1,5',
            'comment'         => 'nullable|string|max:1000',
            'photos.*'        => 'nullable|image|max:2048',
        ]);

        $review = Review::create([
            'cafe_id'         => $cafe->id,
            'user_id'         => auth()->id(),
            'rating_wifi'     => $request->rating_wifi,
            'rating_seat'     => $request->rating_seat,
            'rating_food'     => $request->rating_food,
            'rating_ambience' => $request->rating_ambience,
            'rating_price'    => $request->rating_price,
            'comment'         => $request->comment,
            'status'          => 'approved',
        ]);

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('reviews', 'public');
                ReviewPhoto::create(['review_id' => $review->id, 'photo_path' => $path]);
            }
        }

        return back()->with('success', 'Terima kasih! Review berhasil ditambahkan.');
    }
}
