<?php
// app/Http/Controllers/LocalizationController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationController extends Controller
{
    public function setLocale(Request $request)
    {
        $locale = $request->locale;
        if (!in_array($locale, ['en', 'nl'])) {
            abort(400, 'Invalid language');
        }

        App::setLocale($locale);

        
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
?>