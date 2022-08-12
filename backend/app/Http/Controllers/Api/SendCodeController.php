<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ConfirmationCodeService;
use App\Services\SendEmailService;
use Illuminate\Http\Request;

class SendCodeController extends Controller
{
    public ConfirmationCodeService $confirmationCodeService;
    public SendEmailService $sendEmailService;

    public function __construct
    (
        ConfirmationCodeService $confirmationCodeService,
        SendEmailService $sendEmailService
    )
    {
        $this->confirmationCodeService = $confirmationCodeService;
        $this->sendEmailService = $sendEmailService;
    }

    public function sendCode(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $email = $request->get('email');
            $code = $this->confirmationCodeService->createCode('email_code', $email);
            $this->sendEmailService->sendConfirmMessage($email, $code);

            return response()->json([
                'success' => true,
                'message' => "Код подтверждения отправлен на email"
            ]);

        } catch (\Exception $exception) {

            return response()->json([
                'success' => false,
                'message' => $exception->getMessage()
            ], 500);
        }

    }
}
