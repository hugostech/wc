<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWechatSubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wechat_subscriber', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('openid')->unique();
            $table->string('nickname')->nullable();
            $table->integer('status')->default(0);
            $table->string('remark')->nullable();
            $table->integer('type')->default(0);
            $table->text('headimgeurl')->nullable();
            $table->text('scope_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wechat_subscriber');
    }
}
