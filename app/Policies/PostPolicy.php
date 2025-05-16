<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function before($user, $ability)
{
    if ($user->is_admin) {
        return true; // admin can do everything
    }
}

public function update(User $user, Post $post)
{
    return $user->is_admin || $post->user_id === $user->id;
}

public function delete(User $user, Post $post)
{
    return $user->is_admin || $post->user_id === $user->id;
}
}