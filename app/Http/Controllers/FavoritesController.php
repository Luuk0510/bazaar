<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use App\Services\UserService;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    protected $favoriteService;
    protected $userService;

    public function __construct(FavoriteService $favoriteService, UserService $userService)
    {
        $this->favoriteService = $favoriteService;
        $this->userService = $userService;
    }

    public function index()
    {
        $user = $this->userService->getLoggedInUser();
        $advertisements = $user->favoriteAdvertisements;
        $rentalAdvertisements = $user->favoriteRentalAdvertisements;

        $favorites = collect();

        foreach ($rentalAdvertisements as $rentalAdvertisement) {
            $rentalAdvertisement->qrCode = app(QrCodeController::class)->generateQrCode(route('rental-advertisements.showBySlug', ['slug' => $rentalAdvertisement->slug]));
        }

        foreach ($advertisements as $advertisement) {
            $advertisement->qrCode = app(QrCodeController::class)->generateQrCode(route('rental-advertisements.showBySlug', ['slug' => $rentalAdvertisement->slug]));
        }
        
        if ($advertisements && $rentalAdvertisements) {
            $advertisements  = $advertisements->merge($rentalAdvertisements);
        } elseif ($rentalAdvertisements) {
            $advertisements  = $rentalAdvertisements;
        }

        return view('favorites.favorites', compact('advertisements'));
    }

    public function toggleAdvertisement(Request $request)
    {
        $advertisementId = $request->advertisement_id;
        $user = $this->userService->getLoggedInUser();
        $isAdded = $this->favoriteService->toggleAdvertisementInFavorites($user, $advertisementId);

        if ($isAdded) {
            return redirect()->back()->with('success', 'Advertentie is aan favorieten toegevoegd.');
        } else {
            return redirect()->back()->with('success', 'Advertentie is uit favorieten verwijderd.');
        }
    }

    public function toggleRentalAdvertisement(Request $request)
    {
        $rentalAdvertisementId = $request->rental_advertisement_id;
        $user = $this->userService->getLoggedInUser();
        $isAdded = $this->favoriteService->toggleRentalInFavorites($user, $rentalAdvertisementId);

        if ($isAdded) {
            return redirect()->back()->with('success', 'Rental is aan favorieten toegevoegd.');
        } else {
            return redirect()->back()->with('success', 'Rental is uit favorieten verwijderd.');
        }
    }
}
