<?php

namespace App\Policies;

use App\Thread;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ThreadPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can manage the thread.
     *
     * @param  \App\User  $user
     * @param  \App\Thread  $thread
     * @return mixed
     */
    public function manage(User $user, Thread $thread)
    {
        return $user->id === $thread->user_id;
    }
}
