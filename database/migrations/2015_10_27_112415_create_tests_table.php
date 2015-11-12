<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('tests', function(Blueprint $table) {
                $table->increments('id');
                $table->string('url');
                $table->integer('user_id')->foreign('user_id')->references('id')->on('users')->nullable();
                $table->string('random_string');
                $table->boolean('test_running');
                $table->boolean('test_started');
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
        Schema::drop('tests');
    }
}
