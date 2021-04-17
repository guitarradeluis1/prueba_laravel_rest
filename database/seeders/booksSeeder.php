<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class booksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = new Book();
        $book->ISBN = 1878058517;
        $book->url = "https://openlibrary.org/books/OL1750022M/PCs_for_dummies";
        $book->key = "/books/OL1750022M";
        $book->title = "PCs for dummies";
        $book->number_of_pages = 368;
        $book->publish_date = "1992";
        $book->save();

        $book = Book::find(1);
        $book->authors()->attach([1, 2]);
    }
}
