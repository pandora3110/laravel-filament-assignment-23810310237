<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // BẮT BUỘC: Thêm dòng này
    protected $table = 'sv23810310237_products';

    protected $fillable = ['category_id', 'name', 'slug', 'description', 'price', 'stock_quantity', 'image_path', 'status', 'warranty_months'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}