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
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropForeign(['product_category_id']);
            $table->unsignedBigInteger('product_category_id')->nullable()->change();
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_categories', function (Blueprint $table) {
            $table->dropForeign(['product_category_id']);
            $table->unsignedBigInteger('product_category_id')->nullable(false)->change();
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }
};
