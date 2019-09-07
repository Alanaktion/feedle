<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the subscriptions for the feed
     */
    public function subscriptions()
    {
        return $this->hasMany(FeedSubscription::class);
    }

    /**
     * Get the Posts from the subscription
     */
    public function posts()
    {
        return $this->hasMany(FeedPost::class);
    }
}
