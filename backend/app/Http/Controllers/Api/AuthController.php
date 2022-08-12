<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Services\ConfirmationCodeService;
use App\Services\ProfileService;
use App\Services\UserService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public AccountService $accountService;
    public ProfileService $profileService;
    public UserService $userService;
    public ConfirmationCodeService $confirmationCodeService;

    public function __construct
    (
        AccountService $accountService,
        ProfileService $profileService,
        UserService $userService,
        ConfirmationCodeService $confirmationCodeService

    )
    {
        $this->accountService = $accountService;
        $this->profileService = $profileService;
        $this->userService = $userService;
        $this->confirmationCodeService = $confirmationCodeService;
    }

    public function registration(Request $request): \Illuminate\Http\JsonResponse
    {

        try {
            $accountData = $request->input('account', []);
            $profileData = $request->input('profile', []);
            $userData = $request->only(['email', 'password']);
            $confirmCode = $request->get('code');

            $checkCode = $this->confirmationCodeService
                ->checkCode('email_code', $userData['email'], $confirmCode );

            if (!$checkCode['live']) {

                return response()->json([
                    'success' => false,
                    'message' => 'Срок действия кода подтверждения истек'
                ], 404);
            }

            if (!$checkCode['matches']) {

                return response()->json([
                    'success' => false,
                    'message' => 'Код подтверждения введен не верно'
                ], 404);
            }

            $userData['email_verified_at'] = Carbon::now()->format('Y-m-d H:i:s');

            DB::transaction(function () use ($accountData, $profileData, $userData) {

                $user = $this->userService->create($userData);
                $this->accountService->create($accountData, $user);
                $this->profileService->create($profileData, $user);
            });

            return response()->json([
                'success' => true,
                'message' => 'Регистрация завершена'
            ]);

        } catch (\Exception $exception) {

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }

    }
}
