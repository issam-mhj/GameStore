<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index()
    {
        $category = Categorie::all();
        return response()->json($category, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string',
        ]);

        $category = Categorie::create($validated);

        return response()->json($category, 201);
    }

    public function show($id)
    {
        $category = Categorie::find($id);
        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }
        return response()->json($category, 200);
    }

    public function update(Request $request, $id)
    {
        $category = Categorie::find($id);
        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string' . $id,
        ]);

        $category->update($validated);

        return response()->json($category, 200);
    }

    public function destroy($id)
    {
        $category = Categorie::find($id);
        if (!$category) {
            return response()->json(['message' => 'category not found'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'category deleted'], 204);
    }
}
