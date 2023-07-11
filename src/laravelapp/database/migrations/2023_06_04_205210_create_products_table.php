<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false)->comment('商品名');
            $table->string('description')->nullable(false)->comment('商品説明');
            $table->integer('price')->nullable(false)->comment('商品価格');
            $table->foreignId('user_id')->nullable(false)->constrained('users'); //外部キー制約
            $table->foreignId('category_id')->nullable(false)->constrained('categories'); //外部キー制約
            $table->foreignId('tag_id')->constrained('tags'); //外部キー制約
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
