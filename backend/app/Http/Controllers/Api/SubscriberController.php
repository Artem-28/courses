<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use App\Services\SubscriberService;
use App\Services\UserService;
use App\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use League\Fractal\Resource\Collection;

class SubscriberController extends Controller
{
    public AccountService $accountService;
    public UserService $userService;
    public SubscriberService $subscriberService;

    public function __construct
    (
        AccountService $accountService,
        UserService $userService,
        SubscriberService $subscriberService
    )
    {
        $this->middleware(['auth:sanctum']);
        $this->accountService = $accountService;
        $this->userService = $userService;
        $this->subscriberService = $subscriberService;
    }

    public function addSubscriber(Request $request): \Illuminate\Http\JsonResponse
    {
        $accountId = $request->get('toAccountId');
        $account = $this->accountService->getAccountById($accountId);

        if (!$account) {
            return response()->json([
                'success' => false,
                'message' => 'Аккаунт не найден'
            ], 404);
        }

        $response = Gate::inspect('addSubscriber', $account);

         if (!$response->allowed()) {
             return response()->json([
                 'success' => false,
                 'message' => $response->message()
             ], $response->code());
         }
        $dataSubscribers = $request->get('subscribers');

        $subscriberIds = $this->subscriberService->getAvailableIdsFromData($dataSubscribers);
        $users = $this->userService->getUserByIds(...$subscriberIds);
        $subscribers = $this->subscriberService->addSubscribersToAccount($dataSubscribers, $account, $users);

        $students = new Collection($subscribers['students'], new UserTransformer());
        $teachers = new Collection($subscribers['teachers'], new UserTransformer());

        return response()->json([
            'success' => true,
            'students' => $this->createData($students),
            'teachers' => $this->createData($teachers)
        ]);

    }
}
