<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeedPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(FeedPost::class, 'post');
    }

    /**
     * Get a user's posts
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $request->validate([
            'is_read' => 'sometimes|bool',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $posts = $user->posts()
            ->with('feed:id,title')
            ->latest();
        if ($request->has('is_read')) {
            $posts->where('is_read', $request->boolean('is_read'));
        }
        return $posts->paginate(30);
    }

    /**
     * Update a feed post's is_read status
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
