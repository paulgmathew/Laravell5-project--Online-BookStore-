<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     $category = new Category();
        $category->category_name="Fictional";
           $category->save();
        
        $category = new Category();
        $category->category_name="Science";
           $category->save();
           
           $category = new Category();
        $category->category_name="Art";
           $category->save();
    }
}
