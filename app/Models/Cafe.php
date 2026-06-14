<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    protected $fillable = [
        'name', 'address', 'city', 'description', 'thumbnail',
        'wifi_quality', 'power_outlet', 'noise_level',
        'price_range_min', 'price_range_max', 'status'
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function approvedReviews()
    {
        return $this->hasMany(Review::class)->where('status', 'approved');
    }

    public function avgRating(): float
    {
        $reviews = $this->approvedReviews;
        if ($reviews->isEmpty()) return 0;
        $total = $reviews->avg(fn($r) =>
            collect([$r->rating_wifi, $r->rating_seat, $r->rating_food,
                     $r->rating_ambience, $r->rating_price])->filter()->avg()
        );
        return round($total, 1);
    }
}
