<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Services\AdvertisementService;
use App\Services\RentalAdvertisementService;
use App\Services\RentalService;
use Carbon\Carbon;
use FontLib\TrueType\Collection;
use Illuminate\Http\Request;


class AgendaController extends Controller
{
    protected $advertisementService;
    protected $rentalService;
    protected $rentalAdvertisementService;

    public function __construct(
        AdvertisementService $advertisementService,
        RentalService $rentalService,
        RentalAdvertisementService $rentalAdvertisementService
    ) {
        $this->advertisementService = $advertisementService;
        $this->rentalService = $rentalService;
        $this->rentalAdvertisementService = $rentalAdvertisementService;
    }

    public function index(Request $request)
    {
        $advertisements = $this->advertisementService->getUserAdvertisements(auth()->id())->get();
        $rentals = $this->rentalService->getRentalsByUser(auth()->id())->get();

        //get the rentals from the advertisements that the user has made
        $rentalsFromAdvertisements = $this->rentalService->getRentalsByUserWithDateAndAdvertisement(auth()->id())->get();
       
        foreach ($rentalsFromAdvertisements as $rental) {
            $rental->start_date = Carbon::parse($rental->start_date);
            $rental->end_date = Carbon::parse($rental->end_date);
        }
        
        foreach ($advertisements as $advertisement) {
            $advertisement->expire_date = Carbon::parse($advertisement->expire_date);
        }

        foreach ($rentals as $rental) {
            $rental->start_date = Carbon::parse($rental->start_date);
            $rental->end_date = Carbon::parse($rental->end_date);
        }

        $weekStart = $request->input('week', Carbon::now()->startOfWeek()->format('Y-m-d'));
        $weekStart = Carbon::parse($weekStart);

        return view('agenda', compact('advertisements', 'rentals', 'weekStart', 'rentalsFromAdvertisements'));
    }
}
