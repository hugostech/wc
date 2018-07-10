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
        Schema::create('wechat_subscribers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('openid')->unique();
            $table->string('user_name')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('wechat_subscribers');
    }
}
