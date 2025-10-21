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
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id('invoice_detail_id'); // Khóa chính tự tăng
            $table->unsignedBigInteger('invoice_id'); // Mã hóa đơn
            $table->unsignedBigInteger('service_id')->nullable(); // Mã dịch vụ nha khoa (có thể null)
            $table->integer('quantity')->default(1); // Số lượng dịch vụ

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            // Khóa ngoại
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices')
                  ->onDelete('restrict');

            $table->foreign('service_id')->references('service_id')->on('services')
                  ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_details');
    }
};
