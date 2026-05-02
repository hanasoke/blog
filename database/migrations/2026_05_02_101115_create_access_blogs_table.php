<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccessBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('blog_id');
            $table->unsignedBigInteger('member_id');
            $table->timestamps();

            // Add foreign key constraints
            $table->foreign('blog_id')
                ->references('id')
                ->on('blogs')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->foreign('member_id')
                ->references('id')
                ->on('members')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            // Add indexes for better performance 
            $table->index('blog_id');
            $table->index('member_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_blogs');
    }
}
