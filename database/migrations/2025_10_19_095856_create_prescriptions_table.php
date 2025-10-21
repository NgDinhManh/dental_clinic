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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->id('prescription_id'); // Khóa chính tự tăng
            $table->unsignedBigInteger('record_id'); // Mã hồ sơ bệnh án
            $table->unsignedBigInteger('doctor_id'); // Mã bác sĩ kê đơn
            $table->text('notes')->nullable(); // Ghi chú của bác sĩ
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Ràng buộc khóa ngoại
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors')
                  ->onDelete('restrict');
            $table->foreign('record_id')->references('record_id')->on('medical_records')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
