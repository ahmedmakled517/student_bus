<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillHeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill__heads', function (Blueprint $table) {
            $table->increments('id');
            $table->string("client_id");
            $table->string("date");
            $table->string("tottal");
            $table->string("paid");
            $table->string("roamin");
            $table->string("discount")->default('NULL');;
            $table->string("safe_id");
            $table->string("bill_number")->unique();
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
        Schema::dropIfExists('bill__heads');
    }
}
