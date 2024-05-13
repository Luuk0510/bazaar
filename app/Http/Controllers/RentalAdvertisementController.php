<?php
//create controller for rental advertisement
namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\RentalAdvertisementService;
use App\Services\RentalReviewService;
use App\Services\RentalService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentalAdvertisementController extends Controller
{
    protected $rentalAdvertisementService;
    protected $rentalService;
    protected $rentalReviewService;
    protected $categoryService;
    protected $userService;

    public function __construct(RentalAdvertisementService $rentalAdvertisementService, RentalService $rentalService, RentalReviewService $rentalReviewService, CategoryService $categoryService, UserService $userService)
    {
        $this->rentalAdvertisementService = $rentalAdvertisementService;
        $this->rentalService = $rentalService;
        $this->rentalReviewService = $rentalReviewService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function index()
    {
        $rentalAdvertisements = $this->rentalAdvertisementService->getAllRentalAdvertisements()->paginate(6);

        foreach ($rentalAdvertisements as $rentalAdvertisement) {
            $rentalAdvertisement->qrCode = app(QrCodeController::class)->generateQrCode(route('rental-advertisements.showBySlug', ['slug' => $rentalAdvertisement->slug]));
        }

        return view('rental_advertisements.rental_advertisements', compact('rentalAdvertisements'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('rental_advertisements.create_rental_advertisement', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|exists:categories,id',
            'slug' => 'required|string|unique:rental_advertisements,slug|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'excerpt' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $data = $request->all();
        $data['user_id'] = auth()->id();
        $image = $request->file('image');
        $data['image'] = base64_encode(file_get_contents($image));
        $data['slug'] = strtolower($data['slug']);
        $data['category_id'] = $request->input('category');


        $this->rentalAdvertisementService->createRentalAdvertisement($data);

        return redirect()->route('my-rental-advertisements')->with('success', __('messages.rental_advertisement_created'));
    }

    public function showBySlug($slug)
    {
        $rentalAdvertisement = $this->rentalAdvertisementService->findRentalAdvertisementBySlug($slug);
   
        if ($rentalAdvertisement === null) {
            return redirect()->route('rental-advertisement.notFound', ['slug' => $slug]);
        }

        $rentals = $this->rentalService->getRentalsForAdvertisement($rentalAdvertisement->id);
        $reviews = $this->rentalReviewService->getReviewsForRentalAdvertisement($rentalAdvertisement->id);

        return view('rental_advertisements.rental_advertisement', compact('rentalAdvertisement', 'rentals', 'reviews'));
    }

    public function details($slug)
    {
        $rentalAdvertisement = $this->rentalAdvertisementService->findRentalAdvertisementBySlug($slug);
        $reviews = $this->rentalReviewService->getReviewsForRentalAdvertisement($rentalAdvertisement->id);
        return view('rental_advertisements.details_rental_advertisement', compact('rentalAdvertisement', 'reviews'));
    }

    public function myRentalAdvertisements()
    {
        $user = $this->userService->getLoggedInUser();
        $rentalAdvertisements = $this->rentalAdvertisementService->getUserRentalAdvertisements($user->id)->paginate(10);

        return view('rental_advertisements.my_rental_advertisements', compact('rentalAdvertisements'));
    }

    public function uploadCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $csvData = file_get_contents($file);

        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            try {
                $requiredFields = ['title', 'category', 'slug', 'image', 'excerpt', 'description', 'price', 'start_date', 'end_date'];
                foreach ($requiredFields as $field) {
                    if (!isset($data[$field])) {
                        throw new \Exception("Het veld '$field' is vereist in het CSV-bestand.");
                    }
                }

                $imagePath = $data['image'];
                $imageContents = file_get_contents($imagePath);
                $imageBase64 = base64_encode($imageContents);

                $this->rentalAdvertisementService->createRentalAdvertisement([
                    'title' => $data['title'],
                    'category_id' => $data['category'],
                    'slug' => $data['slug'],
                    'image' => $imageBase64,
                    'excerpt' => $data['excerpt'],
                    'description' => $data['description'],
                    'price' => $data['price'],
                    'start_date' => Carbon::parse($data['start_date']),
                    'end_date' => Carbon::parse($data['end_date']),
                ]);
            } catch (\Exception $e) {
                return back()->withInput()->withErrors([$e->getMessage()]);
            }
        }

        return redirect()->route('my-rental-advertisements')->with('success', __('messages.rental_advertisements_uploaded'));
    }

    public function notFound($slug)
    {
        $similarAdvertisements = $this->rentalAdvertisementService->getSimilarRentalAdvertisements($slug)->limit(3)->get();
        return view('rental_advertisements.rental_not_found', compact('similarAdvertisements'));
    }
}
