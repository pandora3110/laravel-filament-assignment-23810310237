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
        Schema::create('sv23810310237_categories', function (Blueprint $table) {
    $table->id();
    $table->string('name')->unique(); // Tên danh mục (duy nhất)
    $table->string('slug')->unique(); // Slug để làm URL đẹp
    $table->text('description')->nullable(); // Mô tả
    $table->boolean('is_visible')->default(true); // Trạng thái hiển thị
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sv23810310237_categories');
    }
};
