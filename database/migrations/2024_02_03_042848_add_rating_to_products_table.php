<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRatingToProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add rating column to products table
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'rating')) {
                $table->decimal('rating', 2, 1)->default(0); // rating column with one decimal place
            }
            if (!Schema::hasColumn('products', 'ratings_count')) {
                $table->integer('ratings_count')->default(0); // ratings_count column
            }
        });

        // Create ratings table if it doesn't exist
        if (!Schema::hasTable('ratings')) {
            Schema::create('ratings', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('product_id');
                $table->integer('rating')->default(0); // rating column
                $table->timestamps();

                $table->foreign('user_id')->references('id')->on('users');
                $table->foreign('product_id')->references('id')->on('products');
                $table->unique(['user_id', 'product_id']); // ensure one rating per user per product
            });
        } else {
            // If ratings table exists, add rating column if it doesn't exist
            Schema::table('ratings', function (Blueprint $table) {
                if (!Schema::hasColumn('ratings', 'rating')) {
                    $table->integer('rating')->default(0); // rating column
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop rating and ratings_count columns from products table
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('rating');
            $table->dropColumn('ratings_count');
        });

        // Drop rating column from ratings table
        Schema::table('ratings', function (Blueprint $table) {
            $table->dropColumn('rating');
        });

        // Drop ratings table
        Schema::dropIfExists('ratings');
    }
}
