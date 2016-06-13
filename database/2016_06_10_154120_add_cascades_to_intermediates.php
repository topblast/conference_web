<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCascadesToIntermediates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        Schema::table('pres_speakers', function(Blueprint $table) {
            $table->dropForeign('pres_speakers_presentation_id_foreign');
            $table->dropForeign('pres_speakers_speaker_id_foreign');
            
            $table->foreign('presentation_id')
                  ->references('presentation_id')
                  ->onDelete('cascade');
           
           $table->foreign('speaker_id')
                 ->references('speaker_id')
                 ->onDelete('cascade');
        });
        
        Schema::table('pres_categories', function(Blueprint $table){
            $table->dropForeign('pres_categories_presentation_id_foreign');
            $table->dropForeign('pres_categories_category_id_foreign');
            
            $table->foreign('presentation_id')
               ->references('presentation_id')  
               ->onDelete('cascade');
           
           $table->foreign('category_id')
                ->references('category_id')   
                ->onDelete('cascade');
        });
        
         Schema::table('conference_attendees', function(Blueprint $table){
           $table->dropForeign('conference_attendees_conference_id_foreign');  
           $table->dropForeign('conference_attendees_attendee_id_foreign');  
             
           $table->foreign('conference_id')
                 ->references('conference_id')  
                 ->onDelete('cascade');
           
           $table->foreign('attendee_id')
                 ->references('attendee_id')  
                 ->onDelete('cascade');
         
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
         Schema::table('pres_speakers', function(Blueprint $table) {
           $table->dropForeign('pres_speakers_presentation_id_foreign');
            $table->dropForeign('pres_speakers_speaker_id_foreign');
             
            $table->foreign('presentation_id')
                  ->references('presentation_id')
                  ->on('presentations')  
                  ->onDelete('no action');
           
           $table->foreign('speaker_id')
                 ->references('speaker_id')
                 ->on('speakers')  
                 ->onDelete('no action');
        });
        
        Schema::table('pres_categories', function(Blueprint $table){
         $table->dropForeign('pres_categories_presentation_id_foreign');
         $table->dropForeign('pres_categories_category_id_foreign');
         
         $table->foreign('presentation_id')
               ->references('presentation_id')
               ->on('presentations')  
               ->onDelete('no action');
           
           $table->foreign('category_id')
                ->references('category_id')
                ->on('categories')   
                ->onDelete('no action');
        });
        
         Schema::table('conference_attendees', function(Blueprint $table){
           $table->dropForeign('conference_attendees_conference_id_foreign');  
           $table->dropForeign('conference_attendees_attendee_id_foreign');  
             
           $table->foreign('conference_id')
                 ->references('conference_id')
                 ->on('conferences')  
                 ->onDelete('no action');
           
           $table->foreign('attendee_id')
                 ->references('attendee_id')  
                 ->on('attendees')  
                 ->onDelete('no action');
         
        });
    }
}
