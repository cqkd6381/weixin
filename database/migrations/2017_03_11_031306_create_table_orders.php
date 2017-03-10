<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('oid')->comment('主键');
            $table->string('ordsn')->comment('订单号');
            $table->integer('uid')->comment('用户uid');
            $table->string('openid',32)->comment('用户openid');
            $table->string('xm',15)->comment('收货人');
            $table->string('address',30)->comment('收货地址');
            $table->string('tel',11)->comment('手机号');
            $table->float('money',7,2)->comment('订单金额');
            $table->tinyinteger('ispay')->comment('是否付款');
            $table->integer('ordtime')->unsigned()->comment('下单时间');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}
