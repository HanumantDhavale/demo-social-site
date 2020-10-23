<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->only('title', 'description', 'images');
        if (empty($data))
            return response()->json(['message' => 'At least title or description or image required'], 400);
        $post_data['title'] = $request->title;
        $post_data['description'] = $request->description;
        $created_post = auth()->user()->posts()->create($post_data);
        return response()->json([
            'created_post' => $created_post,
            'message' => 'Post created successfully!'
        ], 200);
    }

    public function listPosts(Request $request)
    {
        $posts = Post::orderBy('created_at', 'desc')->skip(0)->take(10)->get();
        return response()->json($posts, 200);
    }
}
