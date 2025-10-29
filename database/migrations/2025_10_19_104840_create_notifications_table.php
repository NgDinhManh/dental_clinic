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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notification_id'); // Khóa chính tự tăng
            $table->unsignedBigInteger('receiver_id'); // ID người nhận (bệnh nhân, bác sĩ hoặc lễ tân)
            $table->string('title', 255); // Tiêu đề thông báo
            $table->text('content'); // Nội dung thông báo
            $table->boolean('is_read')->default(false); // Đã đọc hay chưa (0 = chưa, 1 = đã đọc)
            $table->boolean('is_deleted')->default(false); // Đã đọc hay chưa (0 = chưa, 1 = đã đọc)
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('receiver_id')->references('user_id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
