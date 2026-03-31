<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('source_id');
            $table->string('thumbnail');
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->text('description');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('genre_id')
                  ->references('id')
                  ->on('genres')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('source_id')
                  ->references('id')
                  ->on('sources')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            // Add indexes for better performance 
            $table->index('genre_id');
            $table->index('source_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
