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
        Schema::create('posts', function (Blueprint $table) {
            $table->id('post_id');
            $table->string('title', 250);
            $table->text('abstract')->nullable();
            $table->text('contents')->nullable();
            $table->char('images', 250)->nullable();
            $table->char('link', 250)->nullable();
            $table->enum('topic', ['Dịch vụ', 'Tin tức & Sự kiện', 'Kiến thức răng miệng'])->default('Tin tức & Sự kiện');
            $table->string('author', 250)->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('post_order')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
