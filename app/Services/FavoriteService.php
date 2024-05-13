<?php

namespace App\Services;

use App\Models\User;

class FavoriteService
{
    public function toggleAdvertisementInFavorites(User $user, $advertisementId)
    {
        if ($user->favoriteAdvertisements()->where('advertisement_id', $advertisementId)->exists()) {
            $this->removeAdvertisementFromFavorites($user, $advertisementId);
            return false; 
        } else {
            $this->addAdvertisementToFavorites($user, $advertisementId);
            return true; 
        }
    }

    public function toggleRentalInFavorites(User $user, $rentalAdvertisementId)
    {
        if ($user->favoriteRentalAdvertisements()->where('rental_advertisement_id', $rentalAdvertisementId)->exists()) {
            $this->removeRentalFromFavorites($user, $rentalAdvertisementId);
            return false; 
        } else {
            $this->addRentalAdvertisementToFavorites($user, $rentalAdvertisementId);
            return true; 
        }
    }

    private function addAdvertisementToFavorites(User $user, $advertisementId)
    {
        $user->favoriteAdvertisements()->attach($advertisementId);
    }

    private function removeAdvertisementFromFavorites(User $user, $advertisementId)
    {
        $user->favoriteAdvertisements()->detach($advertisementId);
    }

    private function addRentalAdvertisementToFavorites(User $user, $rentalAdvertisementId)
    {
        $user->favoriteRentalAdvertisements()->attach($rentalAdvertisementId);
    }

    private function removeRentalFromFavorites(User $user, $rentalAdvertisementId)
    {
        $user->favoriteRentalAdvertisements()->detach($rentalAdvertisementId);
    }
}
?>