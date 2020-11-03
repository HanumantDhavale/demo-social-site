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
            ->withCount('comments')
            ->userIs($request->user)
            ->orderBy('created_at', 'desc')
            ->skip($start_post)
            ->take($limit)
            ->get();
        foreach ($posts as $post)
            $post->comments = $post->comments()->take(2)->get();
        return response()->json(['posts' => $posts, 'total' => Post::userIs($request->user)->count()], 200);
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

    public function doComment(Request $request)
    {
        $post_id = $request->post_id;
        $comment = $request->comment;
        try {
            $created_comment = auth()->user()->comments()->create([
                'post_id' => $post_id,
                'comment' => $comment
            ]);
            $created_comment->commentor = $created_comment->commentor;
            $post = Post::find($post_id);
            $count = $post->comments()->count();
            return response()->json(['comment' => $created_comment, 'comments_count' => $count], 200);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function allComments(Request $request)
    {
        $post_id = $request->post_id;
        try {
            $post = Post::find($post_id);
            $comments = $post->comments;
            return response()->json(['comments' => $comments, 'post_id' => $post_id], 200);
        } catch (\Exception $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }
}
