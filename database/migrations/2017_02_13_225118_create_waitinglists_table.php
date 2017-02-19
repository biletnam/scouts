<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaitinglistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waitinglists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname');
            $table->string('name');

            $table->string('birthdate');

            $table->string('address');
            $table->string('zip');
            $table->string('city');

            $table->string('tel')->nullable();
            $table->string('gsm')->nullable();
            $table->string('email')->nullable();
            
            $table->string('tak');
            $table->integer('year');
            $table->boolean('priority')->default(0);
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
        Schema::dropIfExists('waitinglists');
    }
}
