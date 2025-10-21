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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id('faq_id'); // Khóa chính tự tăng (INT)
            $table->text('question'); // Câu hỏi
            $table->text('answer'); // Câu trả lời
            $table->boolean('is_active')->default(true); // Trạng thái hiển thị (1 = hoạt động, 0 = ẩn)
            $table->integer('faq_order')->nullable(); // Thứ tự hiển thị
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
