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
        Schema::create('services', function (Blueprint $table) {
            $table->id('service_id'); // Khóa chính tự tăng
            $table->string('service_name', 250); // Tên dịch vụ
            $table->text('description')->nullable(); // Mô tả chi tiết
            $table->decimal('price', 10, 2); // Giá dịch vụ
            $table->string('duration', 250); // Thời gian thực hiện
            $table->enum('status', ['Có sẵn', 'Tạm ngưng'])->default('Có sẵn'); // Trạng thái
            $table->unsignedBigInteger('post_id')->nullable(); // Liên kết bài viết
            $table->char('image', 250)->nullable(); // Ảnh đại diện
            $table->unsignedBigInteger('category_id'); // Liên kết danh mục dịch vụ
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Khóa ngoại
            $table->foreign('post_id')->references('post_id')->on('posts')
                ->onDelete('restrict');

            $table->foreign('category_id')->references('category_id')->on('category_services')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
