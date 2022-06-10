<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCarts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('cart', function (Blueprint $table) {
        $table->increments('id');
        $table->string('user_id');
        $table->string('product_id');
        $table->timestamp('dt_checkout')->nullable();
        $table->double('delivery_charge')->nullable();
        $table->timestamp('dt_successful')->nullable();
        $table->text('pf_payment_id')->nullable();
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
