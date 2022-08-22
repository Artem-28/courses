<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class AccountPolicy
{
    use HandlesAuthorization;

    // Проверка принадлежит ли аккаунт пользователю
    protected function checkOwnsAnAccount(User $user, Account $account): bool
    {
        return $user->account->id === $account->id;
    }

    // Проверка разрешения на добавления подписчиков
    protected function checkPermissionToAdd(User $user): bool
    {
        return $user->hasPermission(Role::BUSINESS) || $user->hasPermission(Role::TEACHER);
    }


    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Account  $account
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function addSubscriber(User $user, Account $account)
    {

        // Если у пользователя нет нужных ролей
        if (!$this->checkPermissionToAdd($user)) {
            return Response::deny('У вас недостаточно прав для добавления подписчиков', 403);
        }

        // Если пользователю принадлежит аккаунт
        if ($this->checkOwnsAnAccount($user, $account)) {
            // Если у пользователя роль не бизнес
            if (!$user->hasPermission(Role::BUSINESS)) {
                return Response::deny('У вас недостаточно прав для добавления подписчиков в аккаунт', 403);
            }
            return Response::allow();
        }

        // Если аккаунт не принадлежит и пользователь не является учителем этого аккаунта
        if (!$account->listedAsTeacher($user->id)) {
            return Response::deny('Вы не являетесь учителем в аккаунте ' . $account->title, 403);
        }

        return Response::allow();

    }
}
