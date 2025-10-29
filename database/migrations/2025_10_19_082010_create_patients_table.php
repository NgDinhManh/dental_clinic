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
        Schema::create('patients', function (Blueprint $table) {
            // Khóa chính trùng với user_id từ bảng users
            $table->id('patient_id');
            $table->string('fullname');
            $table->string('gender');
            $table->date('birthday');
            $table->text('address');
            $table->unsignedBigInteger('user_id')->nullable();

            // Thông tin y tế
            $table->char('cccd', 50); // Số CCCD
            $table->char('bhyt', 50); // Số bảo hiểm y tế
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']); // Nhóm máu

            // Tiền sử và dị ứng
            $table->text('allergies')->nullable(); // Dị ứng
            $table->text('medical_history')->nullable(); // Tiền sử bệnh
            $table->text('dental_history')->nullable(); // Tiền sử nha khoa
            $table->text('current_medications')->nullable(); // Thuốc đang sử dụng

            // Liên hệ khẩn cấp
            $table->string('emergency_contact', 255); // Người liên hệ khẩn cấp
            $table->char('emergency_contact_phone', 20); // SĐT liên hệ khẩn cấp
            $table->text('emergency_contact_address'); // Địa chỉ liên hệ khẩn cấp

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Khóa ngoại tới bảng users
            $table->foreign('user_id')->references('user_id')->on('users')
                    ->onDelete('restrict'); // Không cho xóa user nếu có bệnh nhân
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
