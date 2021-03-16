<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('book_category_id');
            $table->string('title',100);
            $table->string('description');
            $table->integer('pages');
            $table->string('author',100);
            $table->string('isbn',100);
            $table->string('publisher',100);
            $table->double('price');
            $table->integer('rating');
            $table->string('shopee_link');
            $table->string('photo')->nullable();
            $table->date('date_published');
            $table->timestamps();

            $table->foreign('book_category_id')->references('id')->on('book_categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book');
    }
}
