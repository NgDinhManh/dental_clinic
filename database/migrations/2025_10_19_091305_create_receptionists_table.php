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
        Schema::create('receptionists', function (Blueprint $table) {
            $table->id('receptionist_id'); // Khóa chính, liên kết users
            $table->string('fullname');
            $table->string('gender');
            $table->date('birthday');
            $table->text('address');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->date('start_date');                   // Ngày bắt đầu làm việc
            $table->enum('shift', ['Sáng', 'Chiều', 'Tối']); // Ca làm việc
            $table->text('note')->nullable();                         // Ghi chú thêm
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Khóa ngoại liên kết đến bảng users
            $table->foreign('user_id')->references('user_id')->on('users')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receptionists');
    }
};
