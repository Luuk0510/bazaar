<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'reviewer_id', 'rental_advertisement_id', 'title', 'comment', 'rating'
    ];

    public function reviewer() {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function rentalAdvertisements()
    {
        return $this->belongsTo(RentalAdvertisement::class);
    }
}
