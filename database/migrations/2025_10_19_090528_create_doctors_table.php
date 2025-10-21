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
        Schema::create('doctors', function (Blueprint $table) {
            // Khóa chính trùng với user_id trong bảng users
            $table->unsignedBigInteger('doctor_id')->primary();

            // Các cột thông tin
            $table->string('specialization', 255); // Chuyên môn
            $table->integer('experience_years')->default(0);   // Số năm kinh nghiệm >= 0
            $table->string('education', 250);      // Học vấn
            $table->char('certification', 250);    // Bằng cấp chuyên môn
            $table->char('license', 250);          // Giấy phép hành nghề
            $table->text('note')->nullable();                  // Ghi chú thêm
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Khóa ngoại tới bảng users
            $table->foreign('doctor_id')->references('user_id')->on('users')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
