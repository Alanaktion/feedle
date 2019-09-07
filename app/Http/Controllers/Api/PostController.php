<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Get a user's posts
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Auth::user()->posts()
            ->with('feed:id,title')
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
        Validator::make($request->all(), [
            'is_read' => 'sometimes|boolean',
        ])->validate();
        $post->fill($request->only(['is_read']));
        $post->save();
        return $post;
    }
}
