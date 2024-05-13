<?php

namespace App\Services;

use App\Models\Advertisement;
use App\Models\Color;
use App\Models\LandingPage;
use Illuminate\Support\Facades\Auth;

class LandingPageService
{
    public function saveLandingPageData($request)
    {
        $landingPage = $this->getLandingPageByUserId($request->input('user_id'));
        $landingPage->user_id = $request->input('user_id');
        $landingPage->title = $request->input('company_title_name');
        $landingPage->description = $request->input('introduction');
        $landingPage->color_id = $request->input('color_id');
        $landingPage->custom_url = $request->input('custom_url');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->getRealPath();
            $landingPage->image = base64_encode(file_get_contents($imagePath));
        }

        $landingPage->save();

        if ($request->has('advertisements')) {
            $advertisementIds = $request->input('advertisements');

            Advertisement::whereIn('id', $advertisementIds)
                ->update(['landing_page_id' => $landingPage->id]);
        }

        return $landingPage;
    }

    public function getLandingPageByUserId($userId)
    {
        return LandingPage::with('advertisements', 'rental_advertisements', 'color')
            ->where('user_id', $userId)
            ->firstOrNew();
    }

    public function getLandingPageData($userId)
    {
        return LandingPage::with('advertisements')->where('user_id', $userId)->first();
    }

    public function getLandingPageDataByUrl($url)
    {
        return LandingPage::where('custom_url', $url)->first();
    }

    public function getAllColors()
    {
        return Color::all();
    }
}
