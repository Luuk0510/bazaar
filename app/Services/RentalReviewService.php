<?php

namespace App\Services;

use App\Models\RentalReview;
use Illuminate\Support\Facades\Auth;

class RentalReviewService
{
    public function createReview($data)
    {
        return RentalReview::create($data);
    }

    public function findReviewById($id)
    {
        return RentalReview::where('id', $id)->firstOrFail();
    }

    public function getReviewsForRentalAdvertisement($rentalAdvertisementId)
    {
        return RentalReview::with('reviewer')->where('rental_advertisement_id', $rentalAdvertisementId)->orderBy('created_at')->paginate(10);
    }


    public function getUserReviewCount()
    {
        $userId = Auth::id();
        return RentalReview::where('user_id', $userId)->count();
    }

}