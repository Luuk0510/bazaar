<?php

namespace App\Services;

use App\Models\UserReview;
use Illuminate\Support\Facades\Auth;

class UserReviewService
{
    public function createReview($data)
    {
        return UserReview::create($data);
    }

    public function findReviewById($id)
    {
        return UserReview::where('id', $id)->firstOrFail();
    }

    public function getReviewsByUser($userId)
    {
        return UserReview::with('reviewer')->where('user_id', $userId)->orderBy('created_at')->paginate(10);
    }

    public function getUserReviewCount()
    {
        $userId = Auth::id();
        return UserReview::where('user_id', $userId)->count();
    }

}