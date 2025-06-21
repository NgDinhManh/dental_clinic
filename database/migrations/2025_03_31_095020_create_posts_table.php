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
            $table->id('postid');
            $table->string('title', 250);
            $table->text('abstract')->nullable();
            $table->text('contents')->nullable();
            $table->char('images', 250)->nullable();
            $table->char('link', 250)->nullable();
            $table->string('author', 250)->nullable();
            $table->boolean('isactive')->default(false);
            $table->integer('postorder')->nullable();
            $table->timestamps();
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
