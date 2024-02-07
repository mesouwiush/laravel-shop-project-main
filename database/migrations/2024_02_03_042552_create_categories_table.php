<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $foreignKeyExists = DB::select(
                "SELECT 1 FROM pg_constraint WHERE conname='products_category_id_foreign'"
            );
            if (empty($foreignKeyExists)) {
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            }

            $foreignKeyExists = DB::select(
                "SELECT 1 FROM pg_constraint WHERE conname='products_tag_id_foreign'"
            );
            if (empty($foreignKeyExists)) {
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['tag_id']);
        });
    }
};
