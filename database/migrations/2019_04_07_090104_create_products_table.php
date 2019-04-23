<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string('category_name');
            $table->string('product_name');
            $table->string('product_price');
            $table->string('product_img');
            $table->string('product_description');
            $table->integer('numberOfItems')->nullable();
            $table->date('product_expiry_date');
            $table->enum('featured',[0,1])->default(0);
            $table->enum('promote',[0,1])->default(0);
            $table->enum('recommended',[0,1])->default(0);
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
