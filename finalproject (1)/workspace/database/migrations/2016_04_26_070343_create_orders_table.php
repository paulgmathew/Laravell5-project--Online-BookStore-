<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
            $table->string('type');
            $table->integer('quantity');
            $table->string('order_date');
            $table->integer('status');//1 purchased 0 not purchased
            $table->integer('item_id')->unsigned();
            $table->integer('user_id')->unsigned();
             $table->foreign('user_id')->references('id')->on('users');
             $table->foreign('item_id')->references('id')->on('items');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
