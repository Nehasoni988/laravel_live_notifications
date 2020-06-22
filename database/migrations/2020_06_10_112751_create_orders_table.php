<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->longText('address');
            $table->integer('quantity')->default(1);
            $table->integer('size')->default(2)->comment('1=small,2=medium,3=large,4=jumbo');
            $table->string('toppings')->nullable();
            $table->text('instructions')->comment('Ex- Less salty, more cheesy');
            $table->integer('status')->default(1)->comment('1=placed,2=prepared,3=baked,4=out for delivery,5=handed');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
