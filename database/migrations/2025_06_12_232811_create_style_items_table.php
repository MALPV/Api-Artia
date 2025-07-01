<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('style_items', function (Blueprint $table) {
            $table->id();  // id autoincremental
            $table->string('code');
            $table->foreignId('category_id')->constrained('category_styles')->onDelete('cascade');
            $table->text('extraPrompt');
            $table->string('url');
            $table->timestamps(); // created_at y updated_at
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('style_items');
    }
};
