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
           
           $table->unique('email');           
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
           
           $table->unique('email');
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
        
        // Presentations
        Schema::create('presentations', function(Blueprint $table){
           $table->increments('presentation_id');
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
                ->on('conferences');     
            
        });
        
        //Chat Logs
        Schema::create('chatlogs', function(Blueprint $table){
           $table->increments('chat_id');
           $table->integer('presentation_id')->unsigned();
           $table->integer('attendee_id')->unsigned();
           $table->string('message', 260);
           $table->timestamps();
           
           $table->foreign('presentation_id')
                ->references('presentation_id')
                ->on('presentations');
           
           $table->foreign('attendee_id')
                ->references('attendee_id')
                ->on('attendees');  
        });
        
        // Sponsors
        Schema::create('sponsors', function(Blueprint $table){
           $table->increments('sponsor_id');
           $table->integer('conference_id')->unsigned();
           $table->string('name');
           $table->string('description', 512);
           $table->string('image_path', 260);
           $table->string('website', 260);
           $table->timestamps();
           
           $table->foreign('conference_id')
                ->references('conference_id')
                ->on('conferences');
        });
        
        // White List
        Schema::create('whitelist', function(Blueprint $table){
           $table->increments('whitelist_id');
           $table->integer('conference_id')->unsigned();
           $table->integer('attendee_id')->unsigned()->nullable();
           $table->string('email');
           $table->string('token', 64);
           $table->enum('type', ['email', 'token']);
           $table->timestamps();
           
           $table->index('attendee_id');
           
           $table->foreign('conference_id')
                ->references('conference_id')
                ->on('conferences');
           
           $table->foreign('attendee_id')
                ->references('attendee_id')
                ->on('attendees');
        });
        
        // Black List
        Schema::create('blacklist', function(Blueprint $table){
           $table->integer('conference_id')->unsigned();
           $table->integer('attendee_id')->unsigned();
           $table->timestamps();
           
           $table->foreign('conference_id')
                ->references('conference_id')
                ->on('conferences');
           
           $table->foreign('attendee_id')
                ->references('attendee_id')
                ->on('attendees');
                
           $table->primary(['conference_id', 'attendee_id']);
        });
        
        // Presentation Speakers
        Schema::create('pres_speakers', function(Blueprint $table){
           $table->integer('presentation_id')->unsigned();
           $table->integer('speaker_id')->unsigned();
           $table->enum('type', ['keynote', 'discussant']);
           $table->timestamps();
           
           $table->foreign('presentation_id')
                ->references('presentation_id')
                ->on('presentations');
           
           $table->foreign('speaker_id')
                ->references('speaker_id')
                ->on('speakers');
                
           $table->primary(['presentation_id', 'speaker_id']);
        });
        
        // Presentation Categories
        Schema::create('pres_categories', function(Blueprint $table){
           $table->integer('presentation_id')->unsigned();
           $table->integer('category_id')->unsigned();
           $table->timestamps();
           
           $table->foreign('presentation_id')
                ->references('presentation_id')
                ->on('presentations');
           
           $table->foreign('category_id')
                ->references('category_id')
                ->on('categories');
                
           $table->primary(['presentation_id', 'category_id']);
        });
        
        // Presentation Categories
        Schema::create('conference_attendees', function(Blueprint $table){
           $table->integer('conference_id')->unsigned();
           $table->integer('attendee_id')->unsigned();
           $table->timestamps();
           
           $table->foreign('conference_id')
                ->references('conference_id')
                ->on('conferences');
           
           $table->foreign('attendee_id')
                ->references('attendee_id')
                ->on('attendees');
                
           $table->primary(['conference_id', 'attendee_id']);
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
        Schema::drop('conference_attendees');
        Schema::drop('pres_categories');
        Schema::drop('pres_speakers');
        Schema::drop('blacklist');
        Schema::drop('whitelist');
        Schema::drop('sponsors');
        Schema::drop('chatlogs');
        Schema::drop('presentations');
        Schema::drop('categories');
        Schema::drop('rooms');
        Schema::drop('attendees');
        Schema::drop('speakers');
        Schema::drop('conferences');
        Schema::drop('clients');
    }
}
