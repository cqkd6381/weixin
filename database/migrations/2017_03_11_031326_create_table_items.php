<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('iid')->comment('主键');
            $table->integer('oid')->comment('订单号');
            $table->integer('gid')->comment('商品id');
            $table->string('goods_name',40)->comment('商品名称');
            $table->float('price',7,2)->comment('单价');
            $table->smallinteger('amount')->comment('数量');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }
}
