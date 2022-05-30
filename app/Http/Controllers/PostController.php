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

        $image = $request->file('image');

        
        $post = Post::query()
            ->create($validated);

        return PostResource::make($post);
    }
    
    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|file|image|mimes:jpg,jpeg,png'
        ]);

        $path = $request->file('image')->store('public/images');

        if (!$path) {
            return response()->json(['error' => 'The file could not be saved.'], 500);
        }

        $uploadedFile = $request->file('image');

        $image = Post::create([
            'image' => $uploadedFile->hashName(),
            // 'extension' => $uploadedFile->extension(),
            // 'size' => $uploadedFile->getSize()
        ]);

        return PostResource::make($image);
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
