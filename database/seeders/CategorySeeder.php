<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new category();

        $category->name ="Terror";
        $category->description ="libros que dan miedo";
        $category->save();

        $category = new category();
        $category->name ="Romance";
        $category->description ="libros que dan romance";
        $category->save();

        $category = new category();
        $category->name ="Aventura";
        $category->description ="libros que dan aventura";
        $category->save();

        $category = new category();
        $category->name ="Suspenso";
        $category->description ="libros que dan suspenso";
        $category->save();
          
        $category = new category(); 
        $category->name ="Ciencia ficcion";
        $category->description ="libros que dan ficcion";
        $category->save();
    }
}
