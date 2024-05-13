<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Services\AdvertisementService;
use App\Services\BidService;
use App\Services\CategoryService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    protected $advertisementService;
    protected $bidService;
    protected $categoryService;
    protected $userService;

    public function __construct(AdvertisementService $advertisementService, BidService $bidService, CategoryService $categoryService, UserService $userService)
    {
        $this->advertisementService = $advertisementService;
        $this->bidService = $bidService;
        $this->categoryService = $categoryService;
        $this->userService = $userService;
    }

    public function index()
    {
        $advertisements = $this->advertisementService->getAllAdvertisements()->paginate(6);

        foreach ($advertisements as $advertisement) {
            $advertisement->qrCode = app(QrCodeController::class)->generateQrCode(route('advertisements.showBySlug', ['slug' => $advertisement->slug]));
        }

        return view('advertisements.advertisements', compact('advertisements'));
    }

    public function showBySlug($slug)
    {
        $advertisement = $this->advertisementService->findAdvertisementBySlug($slug);

        if ($advertisement === null) {
            return redirect()->route('advertisement.notFound', ['slug' => $slug]);
        }

        $maxBidAmount = 4;
        $userBidCount = $this->bidService->getUserBidCount();
        $disableButton = $userBidCount >= $maxBidAmount;

        return view('advertisements.advertisement', compact('advertisement',  'disableButton', 'maxBidAmount'));
    }

    //crud operations

    public function myAdvertisements()
    {
        $user = $this->userService->getLoggedInUser();
        $advertisements = $this->advertisementService->getUserAdvertisements($user->id)->paginate(10);

        foreach ($advertisements as $advertisement) {
            $advertisement->qrCode = app(QrCodeController::class)->generateQrCode(route('advertisements.showBySlug', ['slug' => $advertisement->slug]));
        }

        return view('advertisements.my_advertisements', compact('advertisements'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('advertisements.create_advertisement', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:20000',
            'slug' => 'required|unique:advertisements|max:255',
            'excerpt' => 'required|max:255',
            'image' => 'required|image|max:2048',
            'duration' => 'required|in:7,14,21',
        ]);

        try {
            $expireDate = Carbon::now()->addWeeks($request->input('duration'));

            $data = $request->all();
            $data['user_id'] = auth()->id();
            $data['category_id'] = $request->input('category');
            $data['expire_date'] = $expireDate;

            $image = $request->file('image');
            $data['image'] = base64_encode(file_get_contents($image));

            $this->advertisementService->createAdvertisement($data);

            return redirect()->route('my-advertisements');
        } catch (\Exception $e) {
            dd([$e->getMessage()]);
            return back()->withInput()->withErrors([$e->getMessage()]);
        }
    }

    public function details($slug)
    {
        $advertisement = $this->advertisementService->findAdvertisementBySlug($slug);
        $bids = $advertisement->bids->sortByDesc('amount');

        return view('advertisements.details_advertisement', compact('advertisement', 'bids'));
    }

    public function createWithCSV(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $csvData = file_get_contents($file);
        $csvData = preg_replace('/^\x{FEFF}/u', '', $csvData);

        $rows = array_map('str_getcsv', explode("\n", $csvData));
        $header = array_shift($rows);


        foreach ($rows as $row) {

            if (empty($row) || (count($row) == 1 && $row[0] === null)) {
                continue;
            }

            $data = array_combine($header, $row);

            try {
                $requiredFields = ['title', 'description', 'slug', 'excerpt', 'category_id', 'expire_date', 'image'];

                foreach ($requiredFields as $field) {
                    if (!isset($data[$field])) {
                        throw new \Exception("Missing fieldname: '$field'");
                    }
                }

                $this->advertisementService->createAdvertisement([
                    'title' => $data['title'],
                    'description' => $data['description'],
                    'slug' => $data['slug'],
                    'excerpt' => $data['excerpt'],
                    'category_id' => $data['category_id'],
                    'user_id' => auth()->id(),
                    'expire_date' => Carbon::createFromFormat('m/d/Y', $data['expire_date']),
                    'image' => $data['image'],
                ], 100);
            } catch (\Exception $e) {
                return back()->withInput()->withErrors([$e->getMessage()]);
            }
        }

        return redirect()->route('my-advertisements')->with('success', 'Advertenties zijn succesvol geüpload.');
    }

    public function notFound($slug)
    {
        $similarAdvertisement = $this->advertisementService->getSimilarAdvertisements($slug)->limit(3)->get();
        return view('advertisements.notFound', compact('similarAdvertisement'));
    }
}
