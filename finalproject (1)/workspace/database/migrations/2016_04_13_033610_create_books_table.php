<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     **/
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            //$table->increments('id');
            $table->increments('id');
            $table->timestamps();
            $table->string('bookname');
            $table->string('author_name');
            $table->string('publisher');
            $table->integer('pages');
            $table->integer('version');
            //$table->string('publish_date');
            $table->string('titleimage');
            $table->string('publish_date');
            $table->text('description');
             $table->integer('book_status');
            $table->integer('category')->nullable()->unsigned();
            
            $table->foreign('category')->references('id')->on('categories')->onDelete('set null')->onUpdate('CASCADE');
        });
        
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('books');
    }
}
