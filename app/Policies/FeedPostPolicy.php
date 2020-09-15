<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FeedPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedPostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any feed posts.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(?User $user): bool
    {
        return isset($user->id);
    }

    /**
     * Determine whether the user can view the feed post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPost  $feedPost
     * @return bool
     */
    public function view(User $user, FeedPost $feedPost): bool
    {
        return $user->id === $feedPost->user_id;
    }

    /**
     * Determine whether the user can create feed posts.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(?User $user): bool
    {
        return isset($user->id);
    }

    /**
     * Determine whether the user can update the feed post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPost  $feedPost
     * @return bool
     */
    public function update(User $user, FeedPost $feedPost): bool
    {
        return $user->id === $feedPost->user_id;
    }

    /**
     * Determine whether the user can delete the feed post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPost  $feedPost
     * @return bool
     */
    public function delete(User $user, FeedPost $feedPost): bool
    {
        return $user->id === $feedPost->user_id;
    }

    /**
     * Determine whether the user can restore the feed post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPost  $feedPost
     * @return bool
     */
    public function restore(User $user, FeedPost $feedPost): bool
    {
        return $user->id === $feedPost->user_id;
    }

    /**
     * Determine whether the user can permanently delete the feed post.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedPost  $feedPost
     * @return bool
     */
    public function forceDelete(User $user, FeedPost $feedPost): bool
    {
        return $user->id === $feedPost->user_id;
    }
}
