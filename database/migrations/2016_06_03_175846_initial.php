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
        
        // Speakers
        Schema::create('speakers', function(Blueprint $table){
           $table->increments('speaker_id');
           $table->string('name', 100);
           $table->string('email');
           $table->string('affiliation', 250);
           $table->string('telephone', 24);
           $table->string('image_path', 250);
           $table->timestamps();
        });
        
        // Attendees
        Schema::create('attendees', function(Blueprint $table){
           $table->increments('attendee_id');
           $table->string('name', 100);
           $table->string('email');
           $table->string('salted_password', 64);           
           $table->timestamps();
        });
        
        // Categories
        Schema::create('categories', function(Blueprint $table){
           $table->increments('category_id');
           $table->string('name', 100);
           $table->text('keywords');
           $table->integer('parent_id')->nullable();
           $table->timestamps();
        });
        
        // Rooms
        Schema::create('rooms', function(Blueprint $table){
           $table->increments('room_id');
           $table->string('name', 100);
           $table->integer('conference_id')->unsigned();
           $table->timestamps();
           
           $table->foreign('conference_id')
                ->references('conference_id')
                ->on('conferences');
        });
        
        // Categories
        Schema::create('categories', function(Blueprint $table){
           $table->increments('category_id');
           $table->string('name', 100);
           $table->text('keywords');
           $table->integer('parent_id')->nullable();
           $table->timestamps();
        });
        
        // Presentations
        Schema::create('presentations', function(Blueprint $table){
           $table->increments('presentatin_id');
           $table->integer('room_id')->unsigned();
           $table->integer('conference_id')->unsigned();
           $table->string('title', 100);
           $table->text('abstract');
           $table->text('keywords');
           $table->timestamps();
           
           $table->foreign('room_id')
                ->references('room_id')
                ->on('rooms');
           
           $table->foreign('conference_id')
                ->references('conference_id')
                ->on('confrences');     
            
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
        Schema::drop('presentations');
        Schema::drop('categories');
        Schema::drop('rooms');
        Schema::drop('attendees');
        Schema::drop('speakers');
        Schema::drop('conferences');
        Schema::drop('clients');
    }
}
