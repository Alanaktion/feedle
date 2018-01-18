<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedPost extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'feed_id',
        'user_id',
        'guid',
        'url',
        'created_at'
    ];

    protected $dates = [
        'created_at'
    ];

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
