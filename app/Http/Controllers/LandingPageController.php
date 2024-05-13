<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdvertisementService;
use App\Services\LandingPageService;
use App\Services\RentalAdvertisementService;
use App\Services\UserService;

use function Laravel\Prompts\error;

class LandingPageController extends Controller
{
    protected $landingService;
    protected $userService;
    protected $advertisementService;
    protected $rentalAdvertisementService;

    public function __construct(LandingPageService $landingService, UserService $userService, AdvertisementService $advertisementService, RentalAdvertisementService $rentalAdvertisementService)
    {
        $this->landingService = $landingService;
        $this->userService = $userService;
        $this->advertisementService = $advertisementService;
        $this->rentalAdvertisementService = $rentalAdvertisementService;
    }

    public function landingPage()
    {
        $user = $this->userService->getLoggedInUser();
        $landingPage = $this->landingService->getLandingPageByUserId($user->id);

        //check if landingpage isnt null
        if ($landingPage->custom_url) {
            return redirect()->route('custom-url.landingpage', $landingPage->custom_url);
        }
        return redirect()->route('landingpage.edit');
    }

    public function landingPageByCustomUrl($customUrl)
    {
        if (!preg_match('/^[a-z0-9\-]+$/i', $customUrl)) {
            abort(404); //view landingpage not found
        }

        $landingPage = $this->landingService->getLandingPageDataByUrl($customUrl);

        if (!$landingPage) {
            abort(404); //view landingpage not found
        }

        $advertisements = $landingPage->advertisements;
        $rentalAdvertisements = $landingPage->rental_advertisement;
        $combinedAdvertisements = $advertisements ?? $rentalAdvertisements;

        if ($advertisements !== null && $rentalAdvertisements !== null) {
            $combinedAdvertisements = $advertisements->merge($rentalAdvertisements);
        }

        return view('landingpage.landingpage', compact('landingPage', 'combinedAdvertisements'));
    }

    public function landingPageEdit()
    {
        $user = $this->userService->getLoggedInUser();
        $landingPage = $this->landingService->getLandingPageByUserId($user->id);
        $advertisements = $this->advertisementService->getUserAdvertisements($user->id);
        $rentalAdvertisements = $this->rentalAdvertisementService->getUserRentalAdvertisements($user->id);
        $colors = $this->landingService->getAllColors();

        return view('landingpage.landingpage_edit', compact('landingPage', 'advertisements', 'rentalAdvertisements', 'colors'));
    }

    public function landingPageUpdate(Request $request)
    {
        $user = $this->userService->getLoggedInUser();
        $request->validate([
            'company_title_name' => 'required|string|max:50',
            'image' => 'nullable|image|max:10240',
            'introduction' => 'nullable|string',
            'advertisements' => 'array',
            'advertisements.*' => 'exists:advertisements,id',
            'custom_url' => [
                'string',
                'max:50',
                'regex:/^[a-z0-9\-]+$/i',
                'unique:landing_pages,custom_url',
            ],
        ]);
        $request->merge(['user_id' => $user->id]);

        $this->landingService->saveLandingPageData($request);

        return redirect()->route('landingpage.index');
    }
}
