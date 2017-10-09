<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('book_name');
            $table->string('image');
            $table->boolean('status')->default(0);
            $table->string('source')->nullable();
            $table->text('description')->nullable();
            //optional
            $table->text('category_description')->nullable();
            $table->string('beta')->nullable();
            $table->string('editor')->nullable();
            $table->string('translator')->nullable();
            $table->text('character')->nullable();
            $table->text('other_description')->nullable();
            $table->integer('view_count')->default(0);
            $table->string('slug');
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
