<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'cafe_id', 'user_id', 'rating_wifi', 'rating_seat',
        'rating_food', 'rating_ambience', 'rating_price', 'comment', 'status'
    ];

    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function photos()
    {
        return $this->hasMany(ReviewPhoto::class);
    }

    public function avgRating(): float
    {
        return round(collect([
            $this->rating_wifi, $this->rating_seat, $this->rating_food,
            $this->rating_ambience, $this->rating_price
        ])->filter()->avg() ?? 0, 1);
    }
}
