<?php

namespace MixCode\Policies;

use MixCode\User;
use MixCode\Language;
use Illuminate\Auth\Access\HandlesAuthorization;

class LanguagePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the language.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Language  $language
     * @return mixed
     */
    public function view(User $user, Language $language)
    {
        return $this->isOwner($user, $language);
    }

    /**
     * Determine whether the user can update the language.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Language  $language
     * @return mixed
     */
    public function update(User $user, Language $language)
    {
        return $this->isOwner($user, $language);
    }

    /**
     * Determine whether the user can delete the language.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Language  $language
     * @return mixed
     */
    public function delete(User $user, Language $language)
    {
        return $this->isOwner($user, $language);
    }

    /**
     * Determine whether the user can restore the language.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Language  $language
     * @return mixed
     */
    public function restore(User $user, Language $language)
    {
        return $this->isOwner($user, $language);
    }

    /**
     * Determine whether the user can permanently delete the language.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Language  $language
     * @return mixed
     */
    public function forceDelete(User $user, Language $language)
    {
        return $this->isOwner($user, $language);
    }

    /**
     * Determine whether the user is owner for language or not.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Language  $language
     * @return bool
     */
    protected function isOwner($user, $language)
    {
        return $user->id === $language->creator_id;
    }
}
