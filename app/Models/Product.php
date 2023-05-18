<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'images',
        'description',
        'category_id',
        'price',
        'old_price',
        'slug',
        'options',
        'status',
    ];

    protected $casts = [
        'options' => 'json',
        // 'status' => ProductStatus::class,
    ];

    // Define the relationship with the ProductCategory model
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    // Scope to filter products by category
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Scope to filter products by category
    public function scopeActive($query)
    {
        return $query->where('status');
    }
}