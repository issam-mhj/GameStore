<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class product_image extends Model
{
    /** @use HasFactory<\Database\Factories\ProductImageFactory> */
    use HasFactory;
    protected $fillable = [
        'product_id',
        'image_url',
        'is_primary',
    ];
    public function Product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
