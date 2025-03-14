<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use App\Models\Product;
use App\Models\product_image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductImageController extends Controller
{
    /**
     * Display a listing of images for a specific product.
     */
    public function index($productId)
    {
        $images = product_image::where('product_id', $productId)->get();
        return response()->json($images, 200);
    }

    /**
     * Store a newly uploaded product image.
     */
    public function store(Request $request, $productId)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_primary' => 'required|boolean',
        ]);

        $product = Product::find($productId);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $path = $request->file('image')->store('product_images', 'public');

        $image = product_image::create([
            'product_id' => $productId,
            'image_url' => $path,
            'is_primary' => $validated['is_primary'],
        ]);

        return response()->json($image, 201);
    }

    /**
     * Show a specific product image.
     */
    public function show($id)
    {
        $image = product_image::find($id);
        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }
        return response()->json($image, 200);
    }

    /**
     * Delete a product image.
     */
    public function destroy($id)
    {
        $image = product_image::find($id);
        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        }

        Storage::disk('public')->delete($image->image_url);
        $image->delete();

        return response()->json(['message' => 'Image deleted'], 201);
    }
}
