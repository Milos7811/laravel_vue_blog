<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function update(User $user, post $post)
    {
        return $post->user_id === $user->id;
    }


    public function delete(User $user, post $post)
    {
        return $post->user_id === $user->id;
    }
}
