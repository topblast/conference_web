<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Initial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Clients
        Schema::create('clients', function(Blueprint $table){
           $table->increments('client_id');
           $table->string('contact_name', 100);
           $table->string('email');
           $table->string('salted_password', 64);
           $table->string('organisation');
           $table->string('address1');
           $table->string('address2');
           $table->string('city');
           $table->string('country');
           $table->timestamps();
        });
        
        // Conferences
        Schema::create('conferences', function(Blueprint $table){
           $table->increments('conference_id');
           $table->integer('client_id')->unsigned();
           $table->string('name', 100);
           $table->enum('type', ['public', 'private']);
           $table->string('address1');
           $table->string('address2');
           $table->string('city');
           $table->string('country');
           $table->dateTimeTz('start_time');
           $table->dateTimeTz('end_time');
           $table->timestamps();
           
           $table->foreign('client_id')
                ->references('client_id')
                ->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('conferences');
        Schema::drop('clients');
    }
}
