<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AuthAttendees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('attendees', function($table) {
            $table->string('remember_token')->nullable();
            $table->renameColumn('salted_password', 'password');
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
        Schema::table('attendees', function($table) {
            $table->dropColumn('remember_token');
            $table->renameColumn('password', 'salted_password');
        });
    }
}
