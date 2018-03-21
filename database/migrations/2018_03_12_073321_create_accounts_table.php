<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('account_type');//1订阅号 2服务号
            $table->string('wechat_name');
            $table->string('app_id')->unique();
            $table->string('app_secret');
            $table->tinyInteger('url_type');//1直接授权 2第三方授权
            $table->string('wechat_url');
            $table->string('wechat_token');
            $table->string('encoding_aes_key');
            $table->tinyInteger('status');//0禁用 1启用
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
        Schema::dropIfExists('accounts');
    }
}
