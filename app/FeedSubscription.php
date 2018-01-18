<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedSubscription extends Model
{
    protected $fillable = ['user_id', 'feed_id'];
    protected $dates = ['created_at'];

    /**
     * Get the Feed for the subscription
     */
    public function feed()
    {
        return $this->belongsTo('App\Feed');
    }

    /**
     * Get the User for the subscription
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
