<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreatedRequest;
use App\Http\Requests\PostUpdatedRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request) {
        $posts = Post::query()
            ->get();
        return PostResource::collection($posts);
    }

    public function create(PostCreatedRequest $request) {
        $validated = $request->validated();
        
        $post = Post::query()
            ->create($validated);

        return PostResource::make($post);
    }
    
    public function show(Post $post) {

        return PostResource::make($post);
    }

    public function update(PostUpdatedRequest $request, Post $post) {
        $validated = $request->validated();

        $post->update($validated);

        return PostResource::make($post);
    }

    public function delete(Post $post) {
        $post->delete();

        return response()->json([
            'message' => 'post successfully deleted!'
        ]);
    }
}
