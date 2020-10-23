<?php

namespace MixCode\Policies;

use MixCode\User;
use MixCode\Feature;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeaturePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the feature.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Feature  $feature
     * @return mixed
     */
    public function view(User $user, Feature $feature)
    {
        return $this->isOwner($user, $feature);
    }

    /**
     * Determine whether the user can update the feature.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Feature  $feature
     * @return mixed
     */
    public function update(User $user, Feature $feature)
    {
        return $this->isOwner($user, $feature);
    }

    /**
     * Determine whether the user can delete the feature.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Feature  $feature
     * @return mixed
     */
    public function delete(User $user, Feature $feature)
    {
        return $this->isOwner($user, $feature);
    }

    /**
     * Determine whether the user can restore the feature.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Feature  $feature
     * @return mixed
     */
    public function restore(User $user, Feature $feature)
    {
        return $this->isOwner($user, $feature);
    }

    /**
     * Determine whether the user can permanently delete the feature.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Feature  $feature
     * @return mixed
     */
    public function forceDelete(User $user, Feature $feature)
    {
        return $this->isOwner($user, $feature);
    }

    /**
     * Determine whether the user is owner for feature or not.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Feature  $feature
     * @return bool
     */
    protected function isOwner($user, $feature)
    {
        return $user->id === $feature->creator_id;
    }
}
