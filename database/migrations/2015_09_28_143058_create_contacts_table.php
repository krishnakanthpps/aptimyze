<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('contacts', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('salutation')->nullable();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email');
                $table->string('organization');
                $table->string('country')->nullable();
                $table->string('phone')->nullable();
                $table->string('test_phase');
                $table->string('current_tool');
                $table->string('load_requirement');
                $table->string('type');
                $table->boolean('way');
                $table->text('message');
                $table->integer('user_id')->foreign('user_id')->references('id')->on('users')->nullable();
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
        Schema::drop('contacts');
    }
}
