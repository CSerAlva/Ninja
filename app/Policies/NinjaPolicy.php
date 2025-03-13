<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ninja;
use Illuminate\Support\Facades\Auth;

class NinjaPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Ninja $ninja): bool
    {
        //true || true = true (是管理员 或者 修改当前账号下的内容)
        if (\auth()->user()->isAdmin === 1 || Auth::id() === $ninja->id) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Ninja $ninja): bool
    {
        //
        return true;
        return $this->update($user, $ninja);
    }
}
