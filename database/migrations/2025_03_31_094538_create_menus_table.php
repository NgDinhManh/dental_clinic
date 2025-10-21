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
        Schema::create('menus', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('menu_name', 100);
            $table->integer('level')->default(1);
            $table->integer('parent_id')->default(0);
            $table->char('route_name', 100);
            $table->char('link')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('menu_order');
            $table->integer('position')->default(1);
            $table->timestamps();
        });

        Schema::create('menu_admins', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('menu_name', 100);
            $table->integer('level')->default(1);
            $table->integer('parent_id')->default(0);
            $table->char('route_name', 100); // Route để điều hướng trong Laravel
            $table->boolean('is_active')->default(true); // Trạng thái hoạt động
            $table->integer('menu_order'); // Thứ tự hiển thị
            $table->char('menu_target')->nullable(); // Thuộc tính target HTML
            $table->char('icon')->nullable();
            $table->char('id_name')->nullable();
            $table->timestamps();
        });

        Schema::create('menu_doctors', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('menu_name', 100);
            $table->integer('level')->default(1);
            $table->integer('parent_id')->default(0);
            $table->char('route_name', 100); // Route để điều hướng trong Laravel
            $table->boolean('is_active')->default(true); // Trạng thái hoạt động
            $table->integer('menu_order'); // Thứ tự hiển thị
            $table->char('menu_target')->nullable(); // Thuộc tính target HTML
            $table->char('icon')->nullable();
            $table->char('id_name')->nullable();
            $table->timestamps();
        });

        Schema::create('menu_receptionists', function (Blueprint $table) {
            $table->id('menu_id');
            $table->string('menu_name', 100);
            $table->integer('level')->default(1);
            $table->integer('parent_id')->default(0);
            $table->char('route_name', 100); // Route để điều hướng trong Laravel
            $table->boolean('is_active')->default(true); // Trạng thái hoạt động
            $table->integer('menu_order'); // Thứ tự hiển thị
            $table->char('menu_target')->nullable(); // Thuộc tính target HTML
            $table->char('icon')->nullable();
            $table->char('id_name')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
        Schema::dropIfExists('menu_admins');
        Schema::dropIfExists('menu_doctors');
        Schema::dropIfExists('menu_receptionists');
    }
};
