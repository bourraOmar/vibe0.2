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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'user_id' => Auth::id(),
            'content' => $request->content,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $data['image'] = $imagePath;
        } else {
            $imagePath = null;
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

    // PostController.php
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }


    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post->content = $request->content;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imagePath = $file->store('uploads', 'public');
            $post->image = $imagePath;
        }
        

        $post->save();

        return redirect()->route('posts.store')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        // Ensure the user is the owner of the post
        if (Auth::id() !== $post->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
}
