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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id('invoice_id'); // Mã hóa đơn
            $table->unsignedBigInteger('record_id'); // Mã hồ sơ bệnh án

            $table->decimal('total_amount', 10, 2); // Tổng tiền
            $table->decimal('discount', 10, 2)->default(0); // Giảm giá
            $table->decimal('other_fee', 10, 2)->default(0); // Phí khác
            $table->text('other_fee_detail')->nullable(); // Chi tiết phí khác
            $table->decimal('final_amount', 10, 2); // Số tiền thực tế

            $table->enum('payment_method', ['Tiền mặt', 'Tài khoản'])->nullable(); // Phương thức thanh toán
            $table->enum('status', ['Chưa thanh toán', 'Đã thanh toán', 'Đã hủy'])->default('Chưa thanh toán'); // Trạng thái

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('record_id')->references('record_id')->on('medical_records')
                ->onDelete('restrict');
        });

        // ✅ Trigger BEFORE INSERT
        DB::unprepared('
            CREATE TRIGGER trg_invoices_before_insert
            BEFORE INSERT ON invoices
            FOR EACH ROW
            BEGIN
                SET NEW.final_amount = NEW.total_amount - NEW.discount + NEW.other_fee;
            END
        ');

        // ✅ Trigger BEFORE UPDATE
        DB::unprepared('
            CREATE TRIGGER trg_invoices_before_update
            BEFORE UPDATE ON invoices
            FOR EACH ROW
            BEGIN
                SET NEW.final_amount = NEW.total_amount - NEW.discount + NEW.other_fee;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Xóa trigger trước khi xóa bảng
        DB::unprepared('DROP TRIGGER IF EXISTS trg_invoices_before_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_invoices_before_update');

        Schema::dropIfExists('invoices');
    }
};
