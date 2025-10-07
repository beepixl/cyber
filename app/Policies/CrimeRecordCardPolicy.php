<?php

namespace App\Policies;

use App\Models\CrimeRecordCard;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CrimeRecordCardPolicy
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
    public function view(User $user, CrimeRecordCard $crimeRecordCard): bool
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
    public function update(User $user, CrimeRecordCard $crimeRecordCard): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, CrimeRecordCard $crimeRecordCard): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, CrimeRecordCard $crimeRecordCard): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, CrimeRecordCard $crimeRecordCard): bool
    {
          return $user->user_type === 'demo' ? false : true;
    }
}
