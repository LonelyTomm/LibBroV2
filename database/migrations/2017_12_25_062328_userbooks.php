<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Userbooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userbooks', function (Blueprint $table) {
            $table->increments('ubid');
            $table->unsignedInteger('bid');
            $table->unsignedInteger('uid');
            $table->dateTime('borrow_date');
            $table->dateTime('return_date')->nullable()->default(null);
            
        });
        Schema::table('userbooks', function(Blueprint $table)
        {
            $table->foreign('bid')->references('id')->on('books');
            $table->foreign('uid')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userbooks');
    }
}
