<?php
 
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uid')->nullable()->unique();
            $table->string('network')->nullable();
            $table->string('identity')->nullable()->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('bdate')->nullable();
            $table->string('sex')->nullable();
            $table->string('photo')->nullable();
            $table->string('profile')->nullable();
            $table->boolean('verified_partner')->nullable();
            $table->rememberToken();
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
        Schema::drop('partners');
    }
}
