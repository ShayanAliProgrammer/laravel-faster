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
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->text('name');
            $table->longText('image');
            $table->string('slug')->primary();
            $table->string('category_slug');
            $table->foreign('category_slug', 'category_slug')
                ->references('slug')
                ->on('categories')
                ->onDelete('cascade'); // Optional: Specify on delete behavior
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_categories');
    }
};
