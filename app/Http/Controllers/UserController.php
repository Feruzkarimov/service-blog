<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {
        $users = User::query()
            ->get();
        return response()->json($users);
    }
    public function create(Request $request) {

        $validated = $request->validate([
            'name' => ['required', 'min:3']
        ]);

        $user = User::query()
            ->create($validated);

        return response()->json([$user]);
    }
    public function show(User $user) {
        return response()->json($user);
    }
    public function update(Request $request, User $user) {

        $validated = $request->validate([
            'name' => ['required', 'min:3']
        ]);

        $user->update($validated);

        return response()->json($user);
    }
    public function delete(User $user) {

        $user->delete();
        
        return response()->json([
            'message' => 'user successfully deleted!'
        ]);
    }
}
