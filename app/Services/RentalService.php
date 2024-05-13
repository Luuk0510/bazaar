<?php

namespace App\Services;

use App\Models\Rental;

class RentalService
{
    public function findRentalById($id)
    {
        return Rental::where('id', $id)->firstOrFail();
    }

    public function createRental($data)
    {
        return Rental::create($data);
    }

    public function getRentalsForAdvertisement($rentalAdvertisementId)
    {
        return Rental::where('rental_advertisements_id', 19)->get();
    }

    public function getRentalsByUser($userId)
    {
        return Rental::where('user_id', $userId);
    }

    public function getRentalsByUserWithDate($userId)
    {
        return Rental::join('rental_advertisements', 'rentals.rental_advertisements_id', '=', 'rental_advertisements.id')
            ->where('rentals.user_id', $userId)
            ->select('rentals.id', 'start_date as date', 'rental_advertisements_id', 'rental_advertisements.price as price', 'rental_advertisements.title as title');
    }

    public function getRentalsByUserWithDateAndAdvertisement($userId)
    {
        return Rental::join('rental_advertisements', 'rentals.rental_advertisements_id', '=', 'rental_advertisements.id')
            ->where('rental_advertisements.user_id', $userId)
            ->select('rentals.id', 'start_date as start_date', 'rental_advertisements_id', 'rental_advertisements.price as price', 'rental_advertisements.title as title');
    }
}
