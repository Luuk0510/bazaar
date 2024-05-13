<?php

namespace App\Http\Controllers;

use App\Services\BidService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    protected $bidService;
    protected $userService;

    public function __construct(BidService $bidService, UserService $userService)
    {
        $this->bidService = $bidService;
        $this->userService = $userService;
    }

    public function store(Request $request)
    {
        //validate the request
        $request->validate([
            'amount' => 'required|numeric',
            'advertisement_id' => 'required|exists:advertisements,id'
        ]);

        try {
            $bidData = [
                'user_id' => $this->userService->getLoggedInUser()->id,
                'advertisement_id' => $request->advertisement_id,
                'amount' => $request->amount,
            ];

            
            $this->bidService->createBid($bidData);
            return redirect()->back()->with('success', __('messages.bid_created'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('success', __('messages.bid_created'));
    }

    public function myBids()
    {
        $user = $this->userService->getLoggedInUser();
        $bids = $this->bidService->getUserBids($user->id);

        return view('bids.my_bids', compact('bids'));
    }

}