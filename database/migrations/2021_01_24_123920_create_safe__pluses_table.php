<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSafePlusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safe__pluses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('safe_id');
            $table->string('date');
            $table->string('kiend');
            $table->string('count_plus')->default('NULL');
            $table->string('count_dis')->default('NULL');
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
        Schema::dropIfExists('safe__pluses');
    }
}
