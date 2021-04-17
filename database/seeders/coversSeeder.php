<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cover;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class coversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        $book = Book::find(1);
        $infoCover = [
            'small' => "https://covers.openlibrary.org/b/id/6641242-S.jpg",
            'medium' => "https://covers.openlibrary.org/b/id/6641242-M.jpg",
            'large' => "https://covers.openlibrary.org/b/id/6641242-L.jpg",
        ];
        $book->covers()->create($infoCover);
        #DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
