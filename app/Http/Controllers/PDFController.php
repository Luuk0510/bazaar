<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

class PDFController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function generateContractPDF($userId)
    {
        $user = $this->userService->getUser($userId);

        $data = [
            'userName' => $user->name,
            'userEmail' => $user->email,
            'registrationDate' => $user->created_at,
        ];

        $pdf = PDF::loadView('pdf.contract', $data);

        return $pdf->download('contract-' . $user->name . '.pdf');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'contract' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $file = $request->file('contract');
        $file->storeAs('contracts', $file->getClientOriginalName());

        return back()->with('success', __('messages.contract_uploaded_successfully'));
    }

    public function show()
    {
        $files = Storage::files('contracts');
        $pdfs = [];

        foreach ($files as $file) {
            $pdfs[] = [
                'name' => basename($file),
                'path' => $file
            ];
        }

        return view('pdf.contract_page', compact('pdfs'));
    }

    public function download($filename)
    {
        $file = Storage::path('contracts/' . $filename);
        return response()->download($file);
    }
}
