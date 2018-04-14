<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYyghsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yyghs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('open_id');
            $table->string('name');
            $table->string('phone');
            $table->integer('xmid')->nullable();
            $table->string('keshi')->nullable();
            $table->string('yytime')->nullable();
            $table->string('bark')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('yyghs');
    }
}
