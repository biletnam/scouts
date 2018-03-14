<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
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
            
            $table->integer('tak_id')->unsigned();
            $table->boolean('paid')->default(0);
            $table->boolean('leiding')->default(0);
            $table->integer('year');

            $table->foreign('tak_id')->references('id')->on('takken')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
