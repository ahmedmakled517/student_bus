<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('main_unite');
            $table->string('m_buy_price');
            $table->string('m_sell_price');
            $table->string('sup_unite');
            $table->string('s_buy_price');
            $table->string('s_sell_price');
            $table->string('stamp')->default('NULL');;
            $table->string('sup_count_main');
          
           
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
        Schema::dropIfExists('items');
    }
}
