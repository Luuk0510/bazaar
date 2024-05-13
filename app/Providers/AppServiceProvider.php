<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\LandingPage;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (session()->has('locale')) {
                App::setLocale(session('locale'));
            }

            if (str_starts_with(Route::currentRouteName(), 'landingpage')) {
                $landingPage = LandingPage::where('user_id', Auth::id())->with('color')->first();
                $bgColorLight = null;
                $bgColorDark = null;
                if(isset($landingPage->color)){
                    $bgColorLight = 'bg-' . $landingPage->color->name . '-' . $landingPage->color->light;
                    $bgColorDark = 'bg-' . $landingPage->color->name . '-' . $landingPage->color->dark;
                }
                $view->with('landingPage', $landingPage)
                ->with('bgColorLight', $bgColorLight)
                ->with('bgColorDark', $bgColorDark);
            }
        });
    }
}
