<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */public function up()
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    Schema::create('tags', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->timestamps();
    });

    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('title');
        $table->text('body');
        $table->string('image')->nullable();
        $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
        $table->foreignId('tag_id')->nullable()->constrained()->onDelete('set null');
        $table->decimal('price', 8, 2);
        $table->integer('quantity');
        $table->integer('rating')->default(0);
        $table->timestamps();
    });

    Schema::create('product_tag', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->foreignId('tag_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });

    Schema::create('category_product', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('category_product');
    Schema::dropIfExists('product_tag');
    Schema::dropIfExists('products');
    Schema::dropIfExists('categories');
    Schema::dropIfExists('tags');
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('rating');
    });
}
}
