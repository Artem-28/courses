<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Services\ProfileService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public AccountService $accountService;
    public ProfileService $profileService;
    public UserService $userService;

    public function __construct
    (
        AccountService $accountService,
        ProfileService $profileService,
        UserService $userService

    )
    {
        $this->accountService = $accountService;
        $this->profileService = $profileService;
        $this->userService = $userService;
    }

    public function registration(Request $request): \Illuminate\Http\JsonResponse
    {
        try {

            DB::transaction(function () use ($request) {
                $accountData = $request->input('account', []);
                $profileData = $request->input('profile', []);
                $userData = $request->only(['email', 'password']);

                $user = $this->userService->create($userData);
                $this->accountService->create($accountData, $user);
                $this->profileService->create($profileData, $user);
            });

            return response()->json([
                'success' => true,
            ]);

        } catch (\Exception $exception) {

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }

    }
}
