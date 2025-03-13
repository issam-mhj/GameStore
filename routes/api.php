<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\ProductController;
use App\Models\Categorie;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/protected', function () {
        return response()->json(['message' => 'Access granted']);
    });

    Route::middleware('role:super_admin')->group(function () {
        Route::post('/assign-role', function (Request $request) {
            $user = User::find($request->user_id);
            $role = Role::where('name', $request->role)->first();

            if (!$user || !$role) {
                return response()->json(['message' => 'User or Role not found'], 404);
            }

            $user->assignRole($role);

            return response()->json(['message' => "Role '{$request->role}' assigned to user"]);
        });

        Route::get('/user/{id}/roles', function ($id) {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json(['roles' => $user->getRoleNames()]);
        });

        Route::get('/user/{id}/permissions', function ($id) {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            return response()->json(['permissions' => $user->getAllPermissions()]);
        });
    });
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name("products.index");
    Route::post('/', [ProductController::class, 'store'])->name("products.store");
    Route::get('/{id}', [ProductController::class, 'show'])->name("products.show");
    Route::put('/{id}', [ProductController::class, 'update'])->name("products.update");
    Route::delete('/{id}', [ProductController::class, 'destroy'])->name("products.destroy");
});
Route::prefix('categorie')->group(function () {
    Route::get('/', [CategorieController::class, 'index'])->name("categorie.index");
    Route::post('/', [CategorieController::class, 'store'])->name("categorie.store");
    Route::get('/{id}', [CategorieController::class, 'show'])->name("categorie.show");
    Route::put('/{id}', [CategorieController::class, 'update'])->name("categorie.update");
    Route::delete('/{id}', [CategorieController::class, 'destroy'])->name("categorie.destroy");
});
