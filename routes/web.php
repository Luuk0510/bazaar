<?php

use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalAdvertisementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\RegistryController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\API\BusinessAdvertisementController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware(['auth', 'verified'])->group(function () {

    //dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile Routes
    Route::prefix('profile')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit')->name('profile.edit');
        Route::patch('/', 'update')->name('profile.update');
        Route::delete('/', 'destroy')->name('profile.destroy');
    });

    //user advertisement routes
    Route::prefix('my-advertisements')->controller(AdvertisementController::class)->group(function () {
        Route::get('/', 'myAdvertisements')->name('my-advertisements');
        Route::get('/create', 'create')->name('advertisements.create');
        Route::get('/details/{slug}', 'details')->name('advertisements.details');
        Route::post('/', 'store')->name('advertisements.store');
        Route::post('/createWithCSV', 'createWithCSV')->name('advertisements.createWithCSV');
    });

    //advertisement routes
    Route::get('/advertisements', [AdvertisementController::class, 'index'])->name('advertisements.index');
    Route::get('/advertisements/{slug}', [AdvertisementController::class, 'showBySlug'])->name('advertisements.showBySlug');
    Route::get('/advertisement-not-found/{slug}', [AdvertisementController::class, 'notFound'])->name('advertisement.notFound');

    //agenda routes
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');

    //my Rental advertisement routes
    Route::prefix('my-rental-advertisements')->controller(RentalAdvertisementController::class)->group(function () {
        Route::get('/', 'myRentalAdvertisements')->name('my-rental-advertisements');
        Route::get('/details/{slug}', 'details')->name('rental-advertisements.details');
        Route::get('/create', 'create')->name('rental-advertisements.create');
        Route::post('/', 'store')->name('rental-advertisements.store');
        Route::post('/createWithCSV', 'createWithCSV')->name('rental-advertisements.createWithCSV');
    });

    //public rental advertisement routes
    Route::get('/rental-advertisements/{slug}', [RentalAdvertisementController::class, 'showBySlug'])->name('rental-advertisements.showBySlug');
    Route::get('/rental-advertisements', [RentalAdvertisementController::class, 'index'])->name('rental-advertisements.index');
    Route::get('/rental-advertisement-not-found/{slug}', [RentalAdvertisementController::class, 'notFound'])->name('rental-advertisement.notFound');

    //bids
    Route::post('/bids', [BidController::class, 'store'])->name('bids.store')->middleware(['auth', 'verified']);
    Route::get('/my-bids', [BidController::class, 'myBids'])->name('my-bids');

    //rental
    Route::post('/rentals', [RentalController::class, 'store'])->name('rentals.store')->middleware(['auth', 'verified']);

    //landing page
    Route::prefix('landingpage')->middleware(['auth.role:zakelijk,admin'])->controller(LandingPageController::class)->group(function () {
        Route::get('/', 'landingPage')->name('landingpage.index');
        Route::get('/edit', 'landingPageEdit')->name('landingpage.edit');
        Route::post('/update', 'landingPageUpdate')->name('landingpage.update');
    });

    //custom url
    Route::get('/url/{customUrl}', [LandingPageController::class, 'landingPageByCustomUrl'])->name('custom-url.landingpage');

    //api
    Route::prefix('api')->controller(BusinessAdvertisementController::class)->group(function () {
        Route::get('/advertisement/{advertisement_id}', 'advertismentDetails');
        Route::get('/advertisementlist', 'advertismentList');
    });

    //language 
    Route::post('setlocale/', [LocalizationController::class, 'setLocale'])->name('setlocale');

    
    //registry
    Route::get('/registry/businessoverview', [RegistryController::class, 'businessRegistry'])->name('registry.businessoverview');

    //pdf
    Route::get('/generate-contract-pdf/{userId}', [PDFController::class, 'generateContractPDF'])->name('generate.contract.pdf');
    Route::get('/contract-page', [PDFController::class, 'show'])->name('contract.page');
    Route::post('/upload-contract', [PDFController::class, 'upload'])->name('upload.contract');
    Route::get('/download-contract/{filename}', [PDFController::class, 'download'])->name('download.contract');

    //user profile
    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/profile/{userId}', 'show')->name('user-profile');
        Route::get('/my-profile', 'myProfile')->name('my-profile');
        Route::get('/my-purchase-history', 'purchaseHistory')->name('my-purchase-history');
    });

    Route::prefix('favorites')->controller(FavoritesController::class)->group(function () {
        Route::get('/', 'index')->name('favorites.index');
        Route::post('/toggle-advertisement', 'toggleAdvertisement')->name('favorites.toggle-advertisement');
        Route::post('/toggle-rental-advertisement', 'toggleRentalAdvertisement')->name('favorites.toggle-rental-advertisement');
    });

    //reviews
    Route::prefix('reviews')->controller(ReviewController::class)->group(function () {
        Route::post('/store-rental-review', 'storeRentalReview')->name('reviews.storeRentalReview');
        Route::post('/store-user-review', 'storeUserReview')->name('reviews.storeUserReview');
    });

    //home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

//public routes
Route::get('/', function () {
    return view('welcome');
});


require __DIR__ . '/auth.php';
