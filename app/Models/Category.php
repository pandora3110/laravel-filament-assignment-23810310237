<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // BẮT BUỘC: Thêm dòng này để Laravel tìm đúng bảng MSSV
    protected $table = 'sv23810310237_categories';

    protected $fillable = ['name', 'slug', 'description', 'is_visible'];
}