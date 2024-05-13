<?php

namespace App\Services;

use App\Models\RentalAdvertisement;

class RentalAdvertisementService
{
    public function createRentalAdvertisement($data)
    {
        $userActiveAdvertisementsCount = RentalAdvertisement::where('user_id', $data['user_id'])
            ->count();
        
        if ($userActiveAdvertisementsCount >= 4) {
            throw new \Exception('You can only create 4 rental advertisements.');
        }
        
        return RentalAdvertisement::create($data);
    }

    public function updateRentalAdvertisement($data, $id)
    {
        return RentalAdvertisement::where('id', $id)->update($data);
    }

    public function deleteRentalAdvertisement($id)
    {
        return RentalAdvertisement::where('id', $id)->delete();
    }


    public function findRentalAdvertisementBySlug($slug)
    {
        return RentalAdvertisement::where('slug', $slug)->first();
    }

    public function getAllRentalAdvertisements()
    {
        return RentalAdvertisement::latest();
    }

    public function getUserRentalAdvertisements($userId)
    {
        return RentalAdvertisement::where('user_id', $userId)->orderBy('created_at');
    }

    public function getNewestRentalAdvertisements($limit)
    {
        return RentalAdvertisement::latest()->limit($limit)->get();
    }

    public function getSimilarRentalAdvertisements($slug)
    {
        return RentalAdvertisement::where('slug', 'like', '%' . $slug . '%')
            ->orderByRaw('CHAR_LENGTH(slug)');
    }
    

}