<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('title', 250)->unique();
            $table->string('thumb')->nullable();
            $table->float('new_price')->default(0.00);
            $table->float('old_price')->default(0.00);
            $table->longText('body');
            $table->string('zj_zc')->nullable();
            $table->string('cz_time')->nullable();
            $table->string('zj_sc')->nullable();
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_size')->nullable();
            $table->integer('status')->default(1);
            $table->integer('attr')->default(0);
            $table->integer('user_id');
            $table->integer('click')->default(0);
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
        Schema::dropIfExists('articles');
    }
}
