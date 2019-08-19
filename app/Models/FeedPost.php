<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeedPost extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'feed_id',
        'user_id',
        'is_read',
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
        return $this->belongsTo(Feed::class);
    }

    /**
     * Get the User for the subscription
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
