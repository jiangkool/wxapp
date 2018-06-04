<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYminfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yminfos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('phone');
            $table->string('yz');
            $table->timestamps();
        });

        Schema::create('voices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('yminfo_id');
            $table->string('server_id');
            $table->string('local_path');
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
        Schema::dropIfExists('yminfos');
        Schema::dropIfExists('voices');
    }
}
