<?php

namespace App\Policies;

use App\Models\User;
use App\Models\system;
use Illuminate\Auth\Access\HandlesAuthorization;

class SystemPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {

    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        dd(__LINE__);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\system  $system
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, system $system)
    {
        return $system->user == $user;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        dd(__LINE__);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\system  $system
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, system $system)
    {
        dd(__LINE__);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\system  $system
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, system $system)
    {
        dd(__LINE__);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\system  $system
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, system $system)
    {
        dd(__LINE__);
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\system  $system
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, system $system)
    {
        dd(__LINE__);
    }
}
