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
        Schema::create('products', function (Blueprint $table) {
            $table->string('slug')->primary();
            $table->string('name');
            $table->longText('image');
            $table->longText('description');
            $table->float('price');
            $table->string('nested_sub_category_slug');
            $table->foreign('nested_sub_category_slug', 'nested_sub_category_slug')
                ->references('slug')
                ->on('nested_sub_categories')
                ->onDelete('cascade'); // Optional: Specify on delete behavior
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
