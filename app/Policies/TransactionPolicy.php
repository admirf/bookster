<?php

namespace App\Policies;

use App\User;
use App\Transaction;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function view(User $user, Transaction $transaction)
    {
        return $user->id == $transaction->buyer_id || $user->id == $transaction->book->user_id;
    }

    public function complete(User $user, Transaction $transaction)
    {
        return $user->id == $transaction->buyer_id;
    }
}
