<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManagerStatic;

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

        foreach ($request->images as $image) {
            $name = uniqid() . '.png';
            try {
                $path = 'uploads/' . $name;
                ImageManagerStatic::make($image)->save(public_path($path));
                $created_post->images()->create([
                    'file' => $path
                ]);
            } catch (\Exception $exception) {
                Log::info($exception->getMessage(), []);
            }
        }
        $created_post->owner = $created_post->owner;
        $created_post->images = $created_post->images;
        $created_post->likes_count = $created_post->likes()->count();
        return response()->json([
            'created_post' => $created_post,
            'message' => 'Post created successfully!'
        ], 200);
    }

    public function listPosts(Request $request)
    {
        $limit = $request->limit;
        $start_post = $request->start_post;
        $posts = Post::with('owner', 'images')
            ->withCount('likes')
            ->orderBy('created_at', 'desc')
            ->skip($start_post)
            ->take($limit)
            ->get();
        return response()->json(['posts' => $posts, 'total' => Post::count()], 200);
    }

    public function doLike(Request $request)
    {
        try {
            $post = Post::find($request->post_id);
            $post->likes()->attach(auth()->user()->id);
            $post->likes_count = $post->likes()->count();
            return response()->json($post, 200);
        } catch (\Exception $exception) {

        }
    }
}
