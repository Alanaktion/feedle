<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FeedSubscription;
use Illuminate\Auth\Access\HandlesAuthorization;

class FeedSubscriptionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any feed subscriptions.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return isset($user->id);
    }

    /**
     * Determine whether the user can view the feed subscription.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedSubscription  $feedSubscription
     * @return bool
     */
    public function view(User $user, FeedSubscription $feedSubscription): bool
    {
        return $user->id === $feedSubscription->user_id;
    }

    /**
     * Determine whether the user can create feed subscriptions.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(?User $user): bool
    {
        return isset($user->id);
    }

    /**
     * Determine whether the user can update the feed subscription.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedSubscription  $feedSubscription
     * @return bool
     */
    public function update(User $user, FeedSubscription $feedSubscription): bool
    {
        return $user->id === $feedSubscription->user_id;
    }

    /**
     * Determine whether the user can delete the feed subscription.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedSubscription  $feedSubscription
     * @return bool
     */
    public function delete(User $user, FeedSubscription $feedSubscription): bool
    {
        return $user->id === $feedSubscription->user_id;
    }

    /**
     * Determine whether the user can restore the feed subscription.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedSubscription  $feedSubscription
     * @return bool
     */
    public function restore(User $user, FeedSubscription $feedSubscription): bool
    {
        return $user->id === $feedSubscription->user_id;
    }

    /**
     * Determine whether the user can permanently delete the feed subscription.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\FeedSubscription  $feedSubscription
     * @return bool
     */
    public function forceDelete(User $user, FeedSubscription $feedSubscription): bool
    {
        return $user->id === $feedSubscription->user_id;
    }
}
