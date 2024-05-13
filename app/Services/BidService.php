<?php

namespace App\Services;

use App\Models\Bid;
use Illuminate\Support\Facades\Auth;

class BidService
{
    public function createBid($data)
    {
        $maxBidAmount = 4;
        if ($this->getUserBidCount() >= $maxBidAmount) {
            throw new \Exception("You can only make " . $maxBidAmount .  " bids.");
        }
        return Bid::create($data);
    }

    public function findBidById($id)
    {
        return Bid::where('id', $id)->firstOrFail();
    }

    public function updateBid($bid, $data)
    {
        $bid->update($data);
        return $bid;
    }

    public function getBidsByAdvertisement($advertisementId)
    {
        return Bid::with('user')->where('advertisement_id', $advertisementId)->orderBy('created_at')->paginate(10);
    }

    public function getUserBidCount()
    {
        $userId = Auth::id();
        return Bid::whereHas('advertisement', function ($query) {
            $query->where('expire_date', '>', now());
        })->where('user_id', $userId)->count();
    }

    public function setWinner($bidId)
    {
        $bid = $this->findBidById($bidId);
        $bid->is_winner = true;
        $bid->save();
        return $bid;
    }

    public function getWinningBidsByUser($userId)
    {
        return Bid::where('user_id', $userId)->where('is_winner', true);
    }
    
    public function getWinningBidsByUserWithDate($userId)
    {
        return Bid::join('advertisements', 'bids.advertisement_id', '=', 'advertisements.id')
            ->where('bids.user_id', $userId)
            ->where('bids.is_winner', true)
            ->select('bids.id', 'bids.created_at as date', 'amount as price', 'advertisement_id', 'advertisements.title as title');
    }

    public function getUserBids($userId)
    {
        //only the highest bid per advertisement
        return Bid::with('advertisement')->where('user_id', $userId)->where('amount', function ($query) {
            $query->selectRaw('max(amount)')->from('bids');
        })->orderBy('created_at')->paginate(10);
    }
}
