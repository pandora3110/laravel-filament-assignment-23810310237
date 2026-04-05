<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Khai báo tên bảng có MSSV của bạn
    protected $table = 'sv23810310237_products';

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 
        'price', 'stock_quantity', 'image_path', 
        'status', 'warranty_months'
    ];

    // Thiết lập mối quan hệ với Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}// sinh viên 23810310237