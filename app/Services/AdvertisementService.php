<?php

namespace App\Services;

use App\Models\Advertisement;
use Carbon\Carbon;

class AdvertisementService
{
    public function getAllAdvertisements()
    {
        return Advertisement::latest();
    }

    public function createAdvertisement($data, $maxAdvertisements = 4)
    {
        
        $userActiveAdvertisementsCount = Advertisement::where('user_id', $data['user_id'])
            ->where('expire_date', '>', now())
            ->count();
        if ($userActiveAdvertisementsCount >= $maxAdvertisements) {
            throw new \Exception("You can only create up to 4 active advertisements.");
        }
        return Advertisement::create($data);
    }
    
    public function findAdvertisementBySlug($slug)
    {
        return Advertisement::where('slug', $slug)->first();
    }

    public function findAdvertisementById($id)
    {
        return Advertisement::findOrFail($id);
    }

    public function updateAdvertisement($advertisement, $data)
    {
        $advertisement->update($data);
        return $advertisement;
    }

    public function deleteAdvertisement($advertisement)
    {
        return $advertisement->delete();
    }

    public function getUserAdvertisements($userId)
    {
        return Advertisement::with('bids')->where('user_id', $userId)->orderBy('created_at');
    }

    public function getNewestAdvertisements($limit)
    {
        return Advertisement::latest()->limit($limit)->get();
    }

    public function getSimilarAdvertisements($slug)
    {
        return Advertisement::where('slug', 'like', '%' . $slug . '%')
            ->orderByRaw('CHAR_LENGTH(slug)');
    }
}
