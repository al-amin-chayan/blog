<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Multiple Schema is possible in a single method
        Schema::table('users', function (Blueprint $table) {
            $table->integer('profession_id')
                ->unsigned()
                ->after('id');
        });
        
        Schema::table('users', function($table) {
            $table->foreign('profession_id')->references('id')->on('professions')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['profession_id']);
        });
    }
}
