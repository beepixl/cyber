<?php

namespace App\Policies;

use App\Models\ApplicationRecord;
use App\Models\User;

class ApplicationRecordPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->user_type, ['admin', 'sp_office']);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, ApplicationRecord $applicationRecord): bool
    {
        return in_array($user->user_type, ['admin', 'sp_office']);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->user_type === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, ApplicationRecord $applicationRecord): bool
    {
        return in_array($user->user_type, ['admin', 'sp_office']);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, ApplicationRecord $applicationRecord): bool
    {
        return $user->user_type === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, ApplicationRecord $applicationRecord): bool
    {
        return $user->user_type === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, ApplicationRecord $applicationRecord): bool
    {
        return $user->user_type === 'admin';
    }
}


