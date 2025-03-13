<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'slug',
        'price',
        'stock',
        'status',
        'category_id',
    ];
    public function User(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function Product_images(): HasMany
    {
        return $this->hasMany(Product_image::class);
    }
}
