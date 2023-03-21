<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function index()
    {

        $user = User::all();
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::find($id);

        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => 'Usuário não encontrada'], 404);
        }
    }

    public function update(Request $request, User $user)
    {

        info('update method called with data:', $request->all());

        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
        ]);

        if ($request->has('password') && $request->input('password') !== null) {
            $validatedData['password'] = bcrypt($validatedData['password']);
        } else {
            unset($validatedData['password']);
        }

        $isUpdated = $user->update($validatedData);

        if ($isUpdated) {
            return response()->json([
                'user' => $user->fresh(),
                'message' => 'User updated successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to update user'
            ], 500);
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'message' => 'Usuário não encontrada.'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'message' => 'Usuário apagada.'
        ], 200);
    }
}
