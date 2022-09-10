<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('sku');
            $table->string('brand_id')->nullable();
            $table->text('description')->nullable();
            $table->text('short_description')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('status')->default(1);
            $table->integer('price');
            $table->integer('dis_price')->nullable();
            $table->integer('stock');
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
};
