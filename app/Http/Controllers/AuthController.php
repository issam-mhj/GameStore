<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\NewUserNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($user->id == 1) {
            $user->assignRole("super_admin");
        } else {
            $user->assignRole("product_manager");
        }

        return response()->json(['message' => 'Utilisateur créé avec succès']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Les identifiants sont incorrects.'],
            ]);
        }
        $user->notify(new NewUserNotification());

        return response()->json([
            'token' => $user->createToken('api-token')->plainTextToken
        ]);
    }
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->tokens->each(function ($token) {
                $token->delete();
            });

            return response()->json(['message' => 'Déconnexion réussie']);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
