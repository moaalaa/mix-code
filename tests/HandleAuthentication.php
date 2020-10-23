<?php

namespace Tests;

use Laravel\Passport\Passport;
use MixCode\User;

trait HandleAuthentication
{
    
    /**
     * @param null $user
     * @return mixed
     */
    protected function signIn($user = null)
    {
        $user = $user ?: create(User::class);
        $this->actingAs($user);
        return $this;
    }

    /**
     * @param null $user
     * @return mixed
     */
    protected function apiSignIn($user = null)
    {
        $user = $user ?: create(User::class);
        Passport::actingAs($user);
        return $this;
    }
    
    /**
     * @param null $user
     * @return mixed
     */
    protected function signInAsAdmin($user = null)
    {
        return $this->signIn($user ?? create(User::class, ['type' => 'admin']));
    }
    
    /**
     * @param null $user
     * @return mixed
     */
    protected function apiSignInAsAdmin($user = null)
    {
        return $this->apiSignIn($user ?? create(User::class, ['type' => 'admin']));
    }
}
