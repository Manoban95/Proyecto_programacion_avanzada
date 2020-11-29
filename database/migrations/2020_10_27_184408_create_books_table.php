<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description')->nullable();

            $table->integer('year');
            $table->integer('pages')->default(0);

            $table->string('isbn')->unique();
            $table->string('editorial')->nullable();
            $table->integer('edition')->default(1);
            $table->string('autor');

            $table->string('cover')->default('book.png');
            $table->unsignedBigInteger('Category_id')->nullable();

            $table->foreign('category_id')->references('id')->on('categories')  ;

            $table->boolean('disponibilidad')->default(true);

            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
