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
            $table->id('menuid');
            $table->string('menuname', 100);
            $table->boolean('isactive')->default(true);
            $table->integer('level')->default(1);
            $table->unsignedBigInteger('parentid')->default(0);
            $table->char('routename', 100)->nullable();
            $table->char('link', 100);
            $table->integer('menuorder');
            $table->integer('position')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
