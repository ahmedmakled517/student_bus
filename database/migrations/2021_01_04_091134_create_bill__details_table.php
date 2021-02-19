<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill__details', function (Blueprint $table) {
            $table->increments('id');
            $table->string("bill_id");
            $table->string("item_id");
            $table->string("unite_id");
            $table->string("qtn");
            $table->string("price");
            $table->string("tottal");
            $table->string("store_id");

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
        Schema::dropIfExists('bill__details');
    }
}
