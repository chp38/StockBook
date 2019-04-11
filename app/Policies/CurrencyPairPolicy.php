<?php

namespace App\Policies;

use App\Model\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CurrencyPairPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Check if the user is a manager
     * @param $user
     * @return bool
     */
    public function isAdmin($user)
    {
        //if($user->role == null) {
        //    return false;
        //}

        return true;
        //return $user->roles->name == $this->allowedRoles['manager'] || $user->roles->name == $this->allowedRoles['dev'];
    }
}
