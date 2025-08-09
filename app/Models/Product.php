<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'sku',
        'description',
        'quantity',
        'price',
        'is_visible',
        'is_featured',
        'type',
        'published_at', 
    ];

    public function brand()
        {
            return $this->belongsTo(Brand::class);
        }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity', 'price');
    }
}
