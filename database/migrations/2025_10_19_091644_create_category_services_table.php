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
        Schema::create('category_services', function (Blueprint $table) {
            $table->id('category_id'); // Khóa chính tự tăng
            $table->string('category_name', 250); // Tên danh mục
            $table->text('description')->nullable(); // Mô tả
            $table->enum('status', ['Có sẵn', 'Tạm ngưng'])->default('Có sẵn'); // Trạng thái
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('category_services');
    }
};
