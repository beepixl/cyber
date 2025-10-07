<?php

namespace App\Policies;

use App\Models\Fehrist;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FehristPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Fehrist $fehrist): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Fehrist $fehrist): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Fehrist $fehrist): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Fehrist $fehrist): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Fehrist $fehrist): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }
}
