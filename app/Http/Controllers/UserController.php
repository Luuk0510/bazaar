<?php

namespace App\Http\Controllers;

use App\Services\BidService;
use App\Services\RentalService;
use App\Services\UserService;
use App\Services\UserReviewService;
use Carbon\Carbon;


class UserController extends Controller
{
    protected $userService;
    protected $bidService;
    protected $rentalService;
    protected $userReviewService;

    public function __construct(UserService $userService, BidService $bidService, RentalService $rentalService, UserReviewService $userReviewService)
    {
        $this->userService = $userService;
        $this->bidService = $bidService;
        $this->rentalService = $rentalService;
        $this->userReviewService = $userReviewService;
    }

    public function myProfile()
    {
        $user = $this->userService->getLoggedInUser();
        $reviews = $this->userReviewService->getReviewsByUser($user->id);
        return view('user.my_profile', compact('reviews'));
    }

    public function show($id)
    {
        $reviews = $this->userReviewService->getReviewsByUser($id);
        $user = $this->userService->getUser($id);
        return view('user.user_profile', compact('reviews', 'user'));
    }

    public function purchaseHistory()
    {
        $user = $this->userService->getLoggedInUser();
        $bids = $this->bidService->getWinningBidsByUserWithDate($user->id)->get();
        $rentals = $this->rentalService->getRentalsByUserWithDate($user->id)->get();

        $purchaseHistory = [];
        foreach ($bids as $bid) {
            $purchaseHistory[] = $bid;
        }
        foreach ($rentals as $rental) {
            $purchaseHistory[] = $rental;
        }
        foreach ($purchaseHistory as $item) {
            $item->date = Carbon::parse($item->date)->format('d-m-Y');
        }

        return view('user.my_purchase_history', compact('purchaseHistory'));
    }

    //favorites
    public function favorites()
    {
        $user = auth()->user();
        $favorites = $user->favorites;
        return view('user.favorites', compact('favorites'));
    }
}
