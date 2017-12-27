<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePostTable extends Migration
{

    public function up()
    {
        Schema::table('posts', function(Blueprint $table){
            $table->string('alias')->nullable();
        });
    }


    public function down()
    {
        Schema::table('posts', function(Blueprint $table){
            $table->dropColumn('alias')->nullable();
        });        
    }
}
