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
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->id('detail_id'); // Khóa chính tự tăng
            $table->unsignedBigInteger('prescription_id'); // Mã đơn thuốc
            $table->string('medicine_name', 255); // Tên thuốc
            $table->string('dosage', 100); // Liều dùng
            $table->integer('quantity'); // Số lượng
            $table->text('instruction'); // Hướng dẫn sử dụng
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Ràng buộc khóa ngoại
            $table->foreign('prescription_id')->references('prescription_id')->on('prescriptions')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_details');
    }
};
