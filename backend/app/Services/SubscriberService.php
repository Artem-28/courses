<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;

class SubscriberService
{
    // Проверяет, может ли быть пользователь быть подписчиком
    private function validateSubscriber($subscriber, $user): bool
    {
        if (!$user) return false;
        return $user->hasPermission($subscriber['role']);
    }

    // Возвращает массив id с учетом валидации ролей
    public function getAvailableIdsFromData(array $dataSubscribers): array
    {
        $subscriberIds = array();

        foreach ($dataSubscribers as $subscriber) {

            switch ($subscriber['role']) {
                case Role::STUDENT:
                case Role::TEACHER:
                    array_push($subscriberIds, $subscriber['id']);
            }
        }
        return $subscriberIds;
    }

    public function addSubscribersToAccount
    (
        array $dataSubscribers,
        Account $account,
        Collection $users

    ): array
    {
        $students = collect();
        $teachers = collect();

        foreach ($dataSubscribers as $data) {
            $user = $users->firstWhere('id', $data['id']);

            if (!$this->validateSubscriber($data, $user)) {
                continue;
            };

            try {
                $account->subscribers()->attach(
                    $user->id,
                    [
                        'status' => 'userConfirmation',
                        'role' => $data['role']
                    ]
                );

                switch ($data['role']) {
                    case Role::TEACHER:
                        $teachers->push($user);
                        break;
                    case Role::STUDENT:
                        $students->push($user);
                }
            } catch (QueryException $exception) {
                continue;
            }
        }

        return [
            'students' => $students,
            'teachers' => $teachers
        ];
    }
}
