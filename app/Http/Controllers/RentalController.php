<?php

namespace App\Http\Controllers;

use App\Services\RentalService;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    protected $rentalService;

    public function __construct(RentalService $rentalService)
    {
        $this->rentalService = $rentalService;
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'rental_advertisements_id' => 'required|exists:rental_advertisements,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $rentalData = [
            'user_id' => auth()->user()->id,
            'rental_advertisements_id' => $request->rental_advertisements_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        $this->rentalService->createRental($rentalData);
        return redirect()->back()->with('success', __('messages.rental_created'));
    }

}