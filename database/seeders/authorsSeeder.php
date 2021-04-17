<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class authorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = new Author();
        $author->url = "https://openlibrary.org/authors/OL34842A/Dan_Gookin";
        $author->name = "Dan Gookin";
        $author->save();

        $author = new Author();
        $author->url = "https://openlibrary.org/authors/OL36035A/Andy_Rathbone";
        $author->name = "Andy Rathbone";
        $author->save();
    }
}
