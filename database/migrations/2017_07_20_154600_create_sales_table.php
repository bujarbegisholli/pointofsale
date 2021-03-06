<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->text('cart');
            $table->string('payment_method');
            $table->boolean('paid');
            $table->string('costumer')->nullable();
            $table->double('total_price');
            $table->integer('cashier_id')->unsigned();
            $table->time('time');
            $table->date('updated_at');
            $table->date('created_at');

            $table->foreign('cashier_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
