<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ProductManagerController extends Controller
{
    public function createUser(Request $request)
    {
        // if (!auth()->user()->hasRole("user_manager")) {
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::where('name', $request->role)->first();
        if ($role) {
            $user->assignRole($role);
        }

        return response()->json(['message' => 'User created successfully', 'user' => $user]);
    }

    public function listUsers()
    {
        // if (!auth()->user()->hasRole('product_manager')) {
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        $users = User::with('roles')->get();
        return response()->json(['users' => $users]);
    }
    public function getUser($id)
    {
        $user = User::with('roles')->find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user]);
    }
    public function updateUser(Request $request, $id)
    {
        // if (!auth()->user()->hasRole('product_manager')) {
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|min:6',
            'role' => 'sometimes|exists:roles,name',
        ]);

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password,
        ]);

        if ($request->role) {
            $role = Role::where('name', $request->role)->first();
            if ($role) {
                $user->syncRoles([$role]);
            }
        }

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    }
    public function deleteUser($id)
    {
        // if (!auth()->user()->hasRole('product_manager')) {
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->destroy();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
