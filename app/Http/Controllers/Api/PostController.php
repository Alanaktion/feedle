<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\FeedPost;

class PostController extends Controller
{
    /**
     * Get a user's posts
     *
     * @return array
     */
    public function index()
    {
        return Auth::user()->posts()
            ->with('feed:id,name')
            ->where('is_read', '0')
            ->latest()
            ->paginate(15);
    }

    /**
     * Update a feed post's is_read status
     *
     * @param FeedPost $post
     * @param Request $request
     * @return FeedPost
     */
    public function update(FeedPost $post, Request $request)
    {
        // TODO: use policy to enforce this
        if ($post->user_id != Auth::id()) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException;
        }
        // TODO: validate request body
        $post->is_read = (bool)$request->input('is_read');
        $post->save();
        return $post;
    }
}
