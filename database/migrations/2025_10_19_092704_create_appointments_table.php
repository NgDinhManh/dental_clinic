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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id'); // Tạo khóa chính tự tăng

            $table->unsignedBigInteger('patient_id'); // Khóa ngoại đến bảng patients
            $table->unsignedBigInteger('doctor_id')->nullable();  // Khóa ngoại đến bảng doctors

            $table->date('appointment_date'); // Ngày hẹn
            $table->time('appointment_time'); // Giờ hẹn

            $table->enum('status', ['Chờ khám', 'Đã khám', 'Đã hủy', 'Quá hẹn'])->default('Chờ khám');
            $table->text('notes')->nullable(); // Ghi chú

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('patient_id')->references('patient_id')->on('patients')->onDelete('restrict');
            $table->foreign('doctor_id')->references('doctor_id')->on('doctors')->onDelete('restrict');

            // Bật event scheduler
            DB::unprepared("SET GLOBAL event_scheduler = ON;");

            // Tạo event cập nhật trạng thái
            DB::unprepared("
            CREATE EVENT IF NOT EXISTS update_appointment_status
            ON SCHEDULE EVERY 60 MINUTE
            DO
                UPDATE appointments
                SET status = 'Quá hẹn'
                WHERE status = 'Chờ khám'
                AND TIMESTAMP(appointment_date, appointment_time) < NOW();
            ");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
        // Xoá event khi rollback migration
        DB::unprepared("DROP EVENT IF EXISTS update_appointment_status;");
    }
};
