<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = json_decode(file_get_contents("database/jsons/books.json"),true);

        foreach ($books as $bk) {
        	
        	$book = new Book();

        	$book->title = $bk['title'];
			$book->description = $bk['description'];
			$book->year = $bk['year'];
			$book->pages = $bk['pages'];
			$book->isbn = $bk['isbn'];
			$book->editorial = $bk['editorial'];
			$book->edition = $bk['edition'];
			$book->autor = $bk['autor'];
			$book->cover = $bk['cover'];
			$book->category_id = $bk['category_id'];

			$book->save();
        }
    }
}
