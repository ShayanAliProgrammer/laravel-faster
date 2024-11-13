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
        Schema::create('nested_sub_categories', function (Blueprint $table) {
            $table->string('slug')->primary();
            $table->string('name');
            $table->longText('image');
            $table->string('sub_category_slug');
            $table->foreign('sub_category_slug', 'sub_category_slug')
                ->references('slug')
                ->on('sub_categories')
                ->onDelete('cascade'); // Optional: Specify on delete behavior
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nested_sub_categories');
    }
};
