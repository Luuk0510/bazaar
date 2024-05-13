<?php

namespace App\Http\Controllers;
use App\Services\UserService;

class RegistryController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function businessRegistry()
    {
        $businessUsers = $this->userService->getUserByRole('zakelijk');
        return view('registry.businessoverview', compact('businessUsers'));
    }
}
