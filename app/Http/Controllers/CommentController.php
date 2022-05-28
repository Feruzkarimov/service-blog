<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentCreatedRequest;
use App\Http\Requests\CommentUpdatedRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request) {
        $comment = Comment::query()
            ->get();
        return CommentResource::collection($comment);
    }

    public function create(CommentCreatedRequest $request) {
        $validated = $request->validated();
        
        $comment = Comment::query()
            ->create($validated);

        return CommentResource::make($comment);
    }
    
    public function show(Comment $comment) {

        return CommentResource::make($comment);
    }

    public function update(CommentUpdatedRequest $request, Comment $comment) {
        $validated = $request->validated();

        $comment->update($validated);

        return CommentResource::make($comment);
    }

    public function delete(Comment $comment) {
        $comment->delete();

        return response()->json([
            'message' => 'post successfully deleted!'
        ]);
    }
}
