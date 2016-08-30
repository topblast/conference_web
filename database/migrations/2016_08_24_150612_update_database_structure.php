<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateDatabaseStructure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('clients', function ($table) {
            $table->string('organisation')->nullable()->change();
           
        });
        
        Schema::table('conferences', function ($table) {
            $table->string('description')->after('type');
           
        });
        
        Schema::table('speakers', function ($table) {
            $table->string('bio')->after('affiliation');
            $table->string('affiliation')->nullable()->change();
            $table->string('telephone')->nullable()->change();
            $table->string('image_path')->nullable()->change();
        });
        
        Schema::table('presentations', function ($table) {
            $table->dateTime('start_time')->after('title');
            $table->dateTime('end_time')->after('start_time');
        });
        
        Schema::table('sponsors', function ($table) {
            $table->string('description')->nullable()->change();
            $table->string('image_path')->nullable()->change();
            $table->string('website')->nullable()->change();
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
        Schema::table('clients', function ($table) {
            $table->string('organisation')->nullable(false)->change();
           
        });
        
        Schema::table('conferences', function ($table) {
            $table->dropColumn('description');
           
        });
        
        Schema::table('speakers', function ($table) {
            $table->dropColumn('bio');
            $table->string('affiliation')->nullable(false)->change();
            $table->string('telephone')->nullable(false)->change();
            $table->string('image_path')->nullable(false)->change();
        });
        
        Schema::table('presentations', function ($table) {
            $table->dropColumn(['start_time', 'end_time']);
        });
        
        Schema::table('sponsors', function ($table) {
            $table->string('description')->nullable(false)->change();
            $table->string('image_path')->nullable(false)->change();
            $table->string('website')->nullable(false)->change();
        });
    }
}
