<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Advertisement;

class BusinessAdvertisementController extends Controller
{
    public function advertismentDetails(Request $request, $advertisementId)
    {
        $user = Auth::user();

        $advertisement = Advertisement::where('id', $advertisementId)
            ->where('user_id', $user->id)
            ->first();

        if (!$advertisement) {
            return response()->json(['message' => 'Advertisement not found or access denied.'], 404);
        }

        return response()->json($advertisement);
    }

    public function advertismentList(Request $request)
    {
        $user = Auth::user();

        $advertisementIds = Advertisement::where('user_id', $user->id)
            ->pluck('id');

        if ($advertisementIds->isEmpty()) {
            return response()->json(['message' => 'No advertisements found for the user.'], 404);
        }

        return response()->json(['advertisementIds' => $advertisementIds]);
    }
}
