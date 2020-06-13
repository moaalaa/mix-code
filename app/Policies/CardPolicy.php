<?php

namespace MixCode\Policies;

use MixCode\User;
use MixCode\Card;
use Illuminate\Auth\Access\HandlesAuthorization;

class CardPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view the card.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Card  $card
     * @return mixed
     */
    public function view(User $user, Card $card)
    {
        return $this->isOwner($user, $card);
    }

    /**
     * Determine whether the user can update the card.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Card  $card
     * @return mixed
     */
    public function update(User $user, Card $card)
    {
        return $this->isOwner($user, $card);
    }

    /**
     * Determine whether the user can delete the card.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Card  $card
     * @return mixed
     */
    public function delete(User $user, Card $card)
    {
        return $this->isOwner($user, $card);
    }

    /**
     * Determine whether the user can restore the card.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Card  $card
     * @return mixed
     */
    public function restore(User $user, Card $card)
    {
        return $this->isOwner($user, $card);
    }

    /**
     * Determine whether the user can permanently delete the card.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Card  $card
     * @return mixed
     */
    public function forceDelete(User $user, Card $card)
    {
        return $this->isOwner($user, $card);
    }

    /**
     * Determine whether the user is owner for card or not.
     *
     * @param  \MixCode\User  $user
     * @param  \MixCode\Card  $card
     * @return bool
     */
    protected function isOwner($user, $card)
    {
        return $user->id === $card->creator_id;
    }
}
