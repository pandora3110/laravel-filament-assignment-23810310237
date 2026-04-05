<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sv23810310237_products', function (Blueprint $table) {
    $table->id();
    // Liên kết với bảng categories của bạn (phải khớp tên bảng MSSV)
    $table->foreignId('category_id')->constrained('sv23810310237_categories')->onDelete('cascade');
    
    $table->string('name');
    $table->string('slug');
    $table->text('description')->nullable();
    $table->decimal('price', 15, 2); // Giá tiền
    $table->integer('stock_quantity'); // Số lượng tồn kho
    $table->string('image_path')->nullable(); // Đường dẫn ảnh
    $table->enum('status', ['draft', 'published', 'out_of_stock'])->default('draft');
    
    // TRƯỜNG SÁNG TẠO: Thời gian bảo hành (đơn vị: tháng)
    $table->integer('warranty_months')->default(12); 
    
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sv23810310237_products');
    }
};
