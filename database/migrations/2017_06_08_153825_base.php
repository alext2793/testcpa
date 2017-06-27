<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Base extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('click', function (Blueprint $table) {
            $table->increments('id');
            $table->string('click_id');
            $table->string('ua');
            $table->string('ip');
            $table->string('ref');
            $table->string('param1');
            $table->string('param2');
            $table->integer('error');
            $table->integer('bad_domain');    
            
            $table->timestamps();
        });
        Schema::create('bad_domains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
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
        //
    }
}
