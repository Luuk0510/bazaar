<?php

namespace App\Http\Controllers;

use App\Services\RentalReviewService;
use App\Services\UserReviewService;
use App\Services\UserService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $rentalReviewService;
    protected $userService;
    protected $userReviewService;

    public function __construct(RentalReviewService $rentalReviewService, UserService $userService, UserReviewService $userReviewService)
    {
        $this->rentalReviewService = $rentalReviewService;
        $this->userService = $userService;
        $this->userReviewService = $userReviewService;
    }

    // Store reviews and go back to the previous page
    public function storeRentalReview(Request $request)
    {
        $validatedData = $request->validate([
            'rental_advertisement_id' => 'required|exists:rental_advertisements,id',
            'title' => 'required|string|max:255',
            'comment' => 'nullable|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $user = $this->userService->getLoggedInUser();

        $reviewData = [
            'reviewer_id' => $user->id,
            'rental_advertisement_id' => $validatedData['rental_advertisement_id'],
            'title' => $validatedData['title'],
            'comment' => $validatedData['comment'],
            'rating' => $validatedData['rating'],
        ];

        $this->rentalReviewService->createReview($reviewData);

        return redirect()->back()->with('success', __('messages.review_created'));
    }

    //store user review
    public function storeUserReview(Request $request)
    {
        
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'comment' => 'nullable|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $user = $this->userService->getLoggedInUser();

        $reviewData = [
            'reviewer_id' => $user->id,
            'user_id' => $validatedData['user_id'],
            'title' => $validatedData['title'],
            'comment' => $validatedData['comment'],
            'rating' => $validatedData['rating'],
        ];
        
        $this->userReviewService->createReview($reviewData);
        
        return redirect()->back()->with('success', __('messages.review_created'));
    }
}
