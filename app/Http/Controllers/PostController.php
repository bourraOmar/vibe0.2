<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'content' => 'nullable|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = [
        'user_id' => Auth::id(),
        'content' => $request->content,
    ];

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('posts', 'public');
    }

    Post::create($data);

    return redirect()->back()->with('success', 'Post created successfully.');
}
    public function posts(Request $request)
    {
        $query = Post::with('user');

        if ($request->has('search')) {
            $query->where('content', 'like', '%' . $request->search . '%');
        }

        $posts = $query->latest()->paginate(10);

        return view('posts', compact('posts'));
    }
}
