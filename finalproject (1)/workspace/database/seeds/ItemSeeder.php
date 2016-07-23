<?php

use Illuminate\Database\Seeder;
use App\Items;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *$table->string('price');
     *       $table->string('type');
     *       $table->String('quantity');
     *         $table->integer('books_id');
     * @return void
     */
    public function run()
    {
         $item = new Items();
        $item->books_id = 1;
        $item->quantity= 100;
        $item->type="new";
        $item->price="10";
         $item->item_status=1;
        $item->save();
        
        $item = new Items();
        $item->books_id = 2;
        $item->quantity= 100;
        $item->type="new";
        $item->price="10";
        $item->item_status=1;
        $item->save();
        
        $item = new Items();
        $item->books_id = 3;
        $item->quantity= 100;
        $item->type="new";
        $item->price="10";
        $item->item_status=1;
      $item->save();
    }
}
