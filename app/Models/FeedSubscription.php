<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedSubscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'feed_id'];
    protected $dates = ['created_at'];

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
