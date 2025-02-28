<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likePost(Post $post)
    {
        $user = Auth::user();

        // Check if user has already liked the post
        if ($post->isLikedBy($user)) {
            $post->likes()->where('user_id', $user->id)->delete();
            return response()->json(['message' => 'Like removed']);
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            return response()->json(['message' => 'Post liked']);
        }
    }
}
