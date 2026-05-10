<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsPage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('payment_id');
            $table->string('payment_proof');
            $table->string('account_number');
            $table->timestamps();

            // Add foreign key constraint 
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDeleter('restrict')
                ->onUpdate('cascade');

            $table->foreign('member_id')
                  ->references('id')
                  ->on('members')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            $table->foreign('payment_id')
                  ->references('id')
                  ->on('payments')
                  ->onDelete('restrict')
                  ->onUpdate('cascade');

            // Add indexes for better performance 
            $table->index('user_id');
            $table->index('member_id');
            $table->index('payment_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
