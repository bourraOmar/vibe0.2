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

        $like = $post->likes()->where('user_id', $user->id);

        if ($like->exists()) {
            $like->delete();
            return response()->json(['message' => 'Like removed']);
        }

        $post->likes()->create(['user_id' => $user->id]);
        return response()->json(['message' => 'Post liked']);
    }
}
