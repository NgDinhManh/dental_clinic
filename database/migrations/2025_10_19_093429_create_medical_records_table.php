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
        Schema::create('medical_records', function (Blueprint $table) {
            $table->id('record_id'); // Mã hồ sơ bệnh án (Primary Key)

            $table->unsignedBigInteger('patient_id'); // Khóa ngoại đến bảng patients
            $table->unsignedBigInteger('doctor_id');  // Khóa ngoại đến bảng doctors
            $table->unsignedBigInteger('appointment_id')->nullable(); // Khóa ngoại đến bảng appointments

            $table->text('symptoms');                   // Triệu chứng
            $table->text('diagnosis');                 // Chẩn đoán bệnh lý
            $table->text('treatment_plan');            // Phương án điều trị
            $table->text('notes')->nullable();         // Ghi chú thêm
            $table->enum('status', ['Đang điều trị', 'Hoàn tất']); // Trạng thái điều trị

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Khóa ngoại
            $table->foreign('patient_id')->references('patient_id')->on('patients')
                ->onDelete('restrict');

            $table->foreign('doctor_id')->references('doctor_id')->on('doctors')
                ->onDelete('restrict');

            $table->foreign('appointment_id')->references('appointment_id')->on('appointments')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_records');
    }
};
