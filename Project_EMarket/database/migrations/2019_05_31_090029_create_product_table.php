<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('model');
            $table->string('category');
            $table->string('brand');
            $table->string('screensize');
            $table->string('resolution');
            $table->string('cpu');
            $table->string('gpu');
            $table->string('os');
            $table->string('ram');
            $table->string('memory');
            $table->string('camera')->nullable();
            $table->string('battery');
            $table->string('color')->nullable();
            $table->string('other_feactures')->nullable();
            $table->integer('price');
            $table->string('image');
            $table->boolean('visibility');
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
        Schema::dropIfExists('product');
    }
}
