<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name', 'description', 'price', 'stock', 'product_image'];

    // Example: Method to calculate discounted price
    public function discountedPrice($discount)
    {
        return $this->price - ($this->price * $discount / 100);
    }

    // Relationships (if any)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function isAvailable()
    {
        return $this->stock > 0;
    }
}

