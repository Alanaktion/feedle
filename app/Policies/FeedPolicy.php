<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Feed;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any feeds.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(?User $user): bool
    {
        return isset($user->id);
    }

    /**
     * Determine whether the user can view the feed.
     *
     * @return bool
     */
    public function view(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create feeds.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(?User $user): bool
    {
        return isset($user->id);
    }

    /**
     * Determine whether the user can update the feed.
     *
     * @return bool
     */
    public function update(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the feed.
     *
     * @return bool
     */
    public function delete(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the feed.
     *
     * @return bool
     */
    public function restore(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the feed.
     *
     * @return bool
     */
    public function forceDelete(): bool
    {
        return false;
    }
}
