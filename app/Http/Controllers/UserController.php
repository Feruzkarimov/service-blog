<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreatedRequest;
use App\Http\Requests\UserUpdatedRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index(Request $request) {
        $users = User::query()
            ->get();
        return UserResource::collection($users);
    }

    public function create(UserCreatedRequest $request) {

        $validated = $request->validated();

        $user = User::query()
            ->create($validated);

        return UserResource::make($user);
    }

    public function show(User $user) {
        return UserResource::make($user);
    }

    public function update(UserUpdatedRequest $request, User $user) {

        $validated = $request->validated();

        $user->update($validated);

        return UserResource::make($user);
    }
    
    public function delete(User $user) {

        $user->delete();
        
        return response()->json([
            'message' => 'user successfully deleted!'
        ]);
    }
}
