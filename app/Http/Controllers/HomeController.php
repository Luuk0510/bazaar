<?php

namespace App\Http\Controllers;

use App\Services\AdvertisementService;
use App\Services\RentalAdvertisementService;


class HomeController extends Controller
{
    protected $rentalAdvertisementService;
    protected $advertisementService;

    public function __construct(RentalAdvertisementService $rentalAdvertisementService, AdvertisementService $advertisementService) 
    {
        $this->rentalAdvertisementService = $rentalAdvertisementService;
        $this->advertisementService = $advertisementService;
    }

    public function index()
    {
        $maxAdvertisementAmount = 10;
        $advertisements = $this->advertisementService->getAllAdvertisements()->get();
        $rentalAdvertisements = $this->rentalAdvertisementService->getAllRentalAdvertisements()->get();
    
        foreach ($rentalAdvertisements as $rentalAdvertisement) {
            $rentalAdvertisement->qrCode = app(QrCodeController::class)->generateQrCode(route('rental-advertisements.showBySlug', ['slug' => $rentalAdvertisement->slug]));
        }

        foreach ($advertisements as $advertisement) {
            $advertisement->qrCode = app(QrCodeController::class)->generateQrCode(route('rental-advertisements.showBySlug', ['slug' => $rentalAdvertisement->slug]));
        }
        
        $combined = $advertisements->merge($rentalAdvertisements);
    
        $sorted = $combined->sortByDesc(function ($item) {
            return $item->created_at;
        });
    
        $latestItems = $sorted->take($maxAdvertisementAmount);
    
        return view('home', compact('latestItems'));
    }
}
