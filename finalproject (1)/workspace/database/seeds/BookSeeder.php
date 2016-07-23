<?php

use Illuminate\Database\Seeder;
use App\books;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $book = new books();
        $book->author_name="J K Rowling";
        $book->bookname="Harry Potter and the Sorcers Stone";
        $book->publisher="D.K";
         $book->pages=100;
         $book->version = 2;
        $book->category=1;
         $book->publish_date="2010-05";
          $book->description="A fantasy story for kids";
          $book->book_status=1;
        $book->save();
        
         $book = new books();
        $book->author_name="J K Rowling";
        $book->bookname="Harry Potter and the Deathly Hallows";
        $book->publisher="D.K";
         $book->pages=100;
         $book->version = 2;
        $book->category=1;
         $book->publish_date="2010-05";
          $book->description="A fantasy story for kids";
           $book->book_status=1;
        $book->save();
        
        $book = new books();
        $book->author_name="J K Rowling";
        $book->bookname="Harry Potter and the prisoner of azkaban";
        $book->publisher="D.K";
         $book->pages=100;
         $book->version = 2;
        $book->category=1;
         $book->publish_date="2010-05";
          $book->description="A fantasy story for kids";
           $book->book_status=1;
        $book->save();
    }
}
